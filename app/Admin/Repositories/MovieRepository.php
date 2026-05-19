<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Grid;
use Dcat\Admin\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class MovieRepository extends Repository
{
    protected string $apiKey = 'apikey=0b2bdeda43b5688921839c8ecb20399b';

    protected string $city = '广州';

    abstract protected function getApiUrl(): string;

    /**
     * Query grid data.
     */
    public function get(Grid\Model $model): LengthAwarePaginator
    {
        $currentPage = $model->getCurrentPage();
        $perPage = $model->getPerPage();

        $start = ($currentPage - 1) * $perPage;

        $data = [
            'total' => 1,
            'subjects' => [
                [
                    'title' => '盗梦空间',
                    'images' => ['https://img9.doubanio.com/view/photo/s_ratio_poster/public/p2616355133.webp'],
                    'year' => '2010',
                    'rating' => '9.3',
                    'directors' => [['name' => '克里斯托弗·诺兰']],
                    'genres' => ['剧情', '科幻', '悬疑', '冒险'],
                ],
            ],
        ];

        return $model->makePaginator(
            $data['total'] ?? 0,
            $data['subjects'] ?? []
        );
    }
}
