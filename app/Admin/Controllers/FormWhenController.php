<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

namespace App\Admin\Controllers;

use Dcat\Admin\Form\Field;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Form;

class FormWhenController
{
    use PreviewCode;

    protected $options = [
        1 => '显示文本框',
        2 => '显示编辑器',
        3 => '显示文件上传',
        4 => '还是显示文本框',
    ];

    public function index(Content $content)
    {
        return $content->title('表单动态显示')
            ->body($this->buildPreviewButton())
            ->body($this->newline())
            ->body(
                <<<HTML
<div class="card">{$this->form()->render()}</div>
HTML
            );
    }

    protected function form()
    {
        $form = new Form;

        $form->tab('Radio', function (Form $form) {
            $form->display('title')->value('单选框动态展示');

            $this->applyWhenConditions($form->radio('radio'))
                ->options($this->options)
                ->default(1);
        });

        $form->tab('Checkbox', function (Form $form) {
            $form->display('title')->value('复选框动态展示');

            $this->applyWhenConditions($form->checkbox('checkbox'))
                ->options($this->options);
        });

        $form->tab('Select', function (Form $form) {
            $form->display('title')->value('下拉选框动态展示');

            $this->applyWhenConditions($form->select('select'))
                ->options($this->options);
        });

        $form->tab('MultipleSelect', function (Form $form) {
            $form->display('title')->value('下拉选框多选动态展示');

            $this->applyWhenConditions($form->multipleSelect('selects'))
                ->options($this->options);
        });

        return $form;
    }

    /**
     * @return Field
     */
    protected function applyWhenConditions($field)
    {
        return $field
            ->when([1, 4], function (Form $form) {
                $form->text('text1');
                $form->text('text2');
                $form->text('text3');
            })
            ->when(2, function (Form $form) {
                $form->editor('editor');
            })
            ->when(3, function (Form $form) {
                $form->image('image');
            });
    }
}
