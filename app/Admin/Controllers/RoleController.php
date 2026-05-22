<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Auth\Permission;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Http\Controllers\HasMenuTreeField;
use Dcat\Admin\Http\Repositories\Role;
use Dcat\Admin\Show;
use Dcat\Admin\Support\Helper;

class RoleController extends AdminController
{
    use HasMenuTreeField;

    public function title()
    {
        return trans('admin.roles');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Role, function (Grid $grid) {
            $grid->column('id', 'ID')->sortable();
            $grid->column('slug', trans('admin.slug'));
            $grid->column('name', trans('admin.name'));

            $grid->column('created_at', trans('admin.created_at'));
            $grid->column('updated_at', trans('admin.updated_at'));

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if ($actions->getKey() == 1) {
                    $actions->disableDelete();
                }
            });

            $grid->tools(function (Grid\Tools $tools) {
                $tools->batch(function (Grid\Tools\BatchActions $actions) {
                    $actions->disableDelete();
                });
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param  mixed  $id
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Role, function (Show $show) {
            $show->field('id', 'ID');
            $show->field('slug', trans('admin.slug'));
            $show->field('name', trans('admin.name'));

            $show->field('created_at', trans('admin.created_at'));
            $show->field('updated_at', trans('admin.updated_at'));

            $show->permissions(function (Show $show) {
                $show->id('ID');
                $show->slug(trans('admin.slug'));
                $show->name(trans('admin.name'));
                $show->http_method(trans('admin.http_method'));
                $show->http_path(trans('admin.http_path'));

                $show->disableCreateButton();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Role, function (Form $form) {
            $form->display('id', 'ID');

            $form->text('slug', trans('admin.slug'))
                ->required()
                ->creationRules(['required', "unique:{$this->getRolesTable()}", 'max:100'])
                ->updateRules(['required', "unique:{$this->getRolesTable()},slug,{{id}}", 'max:100']);

            $form->text('name', trans('admin.name'))->required();

            $form->listbox('permissions', trans('admin.permission'))
                ->options(function () {
                    return config('admin.database.permissions_model')::all()->pluck('name', 'id');
                });

            $this->addMenuTreeField($form);

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));

            $controller = $this;

            /** @var \Dcat\Admin\Models\Role $roleModel */
            $roleModel = config('admin.database.roles_model');
            if ($form->getKey() == $roleModel::ADMINISTRATOR_ID) {
                $form->disableDeleteButton();
            }

            $form->saved(function () use ($controller) {
                $controller->flushMenuCache();
            });
        });
    }

    /**
     * 获取角色表名
     */
    protected function getRolesTable(): string
    {
        return config('admin.database.roles_table');
    }

    public function destroy($id)
    {
        /** @var \Dcat\Admin\Models\Role $roleModel */
        $roleModel = config('admin.database.roles_model');
        if (in_array($roleModel::ADMINISTRATOR_ID, Helper::array($id))) {
            Permission::error();
        }

        return $this->form()->destroy($id);
    }
}
