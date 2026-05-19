<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

namespace App\Admin\Controllers\Movies;

use App\Admin\Repositories\Top250;
use Dcat\Admin\Grid;

class Top250Controller extends ComingSoonController
{
    protected $header = 'Top250';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($repository = null)
    {
        return parent::grid(new Top250);
    }
}
