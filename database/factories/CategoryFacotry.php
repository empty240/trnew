<?php

use Faker\Generator as Faker;

/*
 *
 * 記事カテゴリファクトリ
 *
 * */
$factory->define(App\Repositories\Eloquent\Models\Category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->word,
    ];
});
