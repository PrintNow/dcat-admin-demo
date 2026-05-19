<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

namespace App\Admin\Controllers\Movies;

use App\Admin\Repositories\InTheater;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;

class InTheaterController extends ComingSoonController
{
    protected $header = '正在上映的电影';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($repository = null)
    {
        $grid = parent::grid(new InTheater);

        $grid->disableActions(false);
        $grid->disableViewButton();
        $grid->showQuickEditButton();

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new InTheater);

        $form->display('id', 'ID');
        $form->text('title')->rules('required');
        $form->text('original_title');
        $form->textarea('summary');
        $form->url('alt');
        $form->url('mobile_url');
        $form->url('share_url');
        $form->tags('countries');
        $form->tags('genres');
        $form->tags('aka');
        $form->year('year');

        $form->disableViewButton();
        $form->disableViewCheck();

        return $form;
    }
}
