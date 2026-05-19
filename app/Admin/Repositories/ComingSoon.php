<?php

namespace App\Admin\Repositories;

class ComingSoon extends MovieRepository
{
    protected function getApiUrl(): string
    {
        return 'https://api.douban.com/v2/movie/coming_soon';
    }
}
