<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MyAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = 'Title';

    /**
     * Handle the action request.
     *
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // dump($this->key());

        return $this->response()
            ->success('Processed successfully: ' . $this->key())
            ->redirect('/');
    }

    /**
     * @return string|void
     */
    public function confirm()
    {
        // return 'Confirm?';
    }

    /**
     * @param Model|Authenticatable|null $user
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
