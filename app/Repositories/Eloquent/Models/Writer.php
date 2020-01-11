<?php

namespace App\Repositories\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $guarded = [
        'id',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * query scope
     */

    // 有効ライター
    public function scopeValidWriter($query)
    {
        // return $query->where('status', WriterStatus::VALID());
        return $query->where('status', 200);
    }

    // 無効ライター
    public function scopeInvalidWriter($query)
    {
        // return $query->where('status', WriterStatus::INVALID());
        return $query->where('status', 400);
    }
}
