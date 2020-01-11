<?php

use Carbon\CarbonImmutable;
use Faker\Generator as Faker;

/*
 *
 * 記事用ファクトリ
 *
 * */
$factory->define(
    App\Repositories\Eloquent\Models\Article::class,
    function (Faker $faker) {
        return [
            'writer_id'                  => function () {
                return factory(App\Repositories\Eloquent\Models\Writer::class)->create()->id;
            },
            'category_id'                => function () {
                return factory(App\Repositories\Eloquent\Models\Category::class)->create()->id;
            },
            'title'                      => $faker->title,
            'description'                => $faker->text,
            'status'                     => 500,
            'published_at'               => new CarbonImmutable(),
            'is_video'                   => 1,
            'thumbnail'                  => $faker->url,
        ];
    }
);
