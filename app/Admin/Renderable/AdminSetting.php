<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

namespace App\Admin\Renderable;

use App\Admin\Forms\AdminSetting as AdminSettingForm;
use Dcat\Admin\Support\LazyRenderable;

class AdminSetting extends LazyRenderable
{
    public function render()
    {
        return AdminSettingForm::make();
    }
}
