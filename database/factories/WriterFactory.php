<?php

use Faker\Generator as Faker;

/*
 *
 * ライタークラス用ファクトリ
 *
 * */
$factory->define(App\Repositories\Eloquent\Models\Writer::class, function (Faker $faker) {
    return [
        'writer_name'         => $faker->unique()->regexify('[a-zA-Z0-9_]{5,20}'),
        'status'              => 200,
    ];
});
