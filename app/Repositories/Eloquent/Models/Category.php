<?php

namespace App\Repositories\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [
        'id',
    ];

    /**
     * Relations
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
