<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

namespace App\Admin\Renderable;

use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;
use Faker\Factory;

class PostTable extends LazyRenderable
{
    public function render()
    {
        $data = [];

        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                $faker->title,
                $faker->email,
                $faker->date(),
            ];
        }

        return Table::make(['Title', 'Email', 'date'], $data);
    }
}
