<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Widgets\Form;

class EditorController extends Controller
{
    use PreviewCode;

    public function tinymce(Content $content)
    {
        return $this->buildEditorForm($content, 'TinyMCE编辑器', 'editor');
    }

    protected function buildEditorForm(Content $content, string $title, string $type): Content
    {
        return $content
            ->title($title)
            ->body($this->buildPreviewButton())
            ->body($this->newline())
            ->body(function (Row $row) use ($type) {
                $form = Form::make();

                $form->$type('content', '内容');

                $form->disableSubmitButton();
                $form->disableResetButton();

                $row->column(12, Card::make($form));
            });
    }

    public function markdown(Content $content)
    {
        return $this->buildEditorForm($content, 'Markdown编辑器', 'markdown');
    }
}
