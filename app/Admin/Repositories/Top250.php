<?php

namespace App\Admin\Repositories;

class Top250 extends ComingSoon
{
    protected function getApiUrl(): string
    {
        return 'https://api.douban.com/v2/movie/top250';
    }
}
