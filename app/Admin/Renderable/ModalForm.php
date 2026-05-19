<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

namespace App\Admin\Renderable;

use App\Admin\Forms\UserProfile;
use Dcat\Admin\Support\LazyRenderable;

class ModalForm extends LazyRenderable
{
    public function render()
    {
        return UserProfile::make()->setCurrentUrl($this->current);
    }
}
