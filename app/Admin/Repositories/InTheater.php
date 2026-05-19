<?php

namespace App\Admin\Repositories;

class InTheater extends MovieRepository
{
    protected function getApiUrl(): string
    {
        return 'https://api.douban.com/v2/movie/in_theaters';
    }
}
