<?php

use Faker\Generator as Faker;

/*
 *
 * タグクラス用ファクトリ
 *
 * */
$factory->define(App\Repositories\Eloquent\Models\Tag::class, function (Faker $faker) {
    return [
        // 一旦、文字列にuniqidつけてユニークな文字列作成
        'tag_name'               => 'tag'.uniqid(),
    ];
});
