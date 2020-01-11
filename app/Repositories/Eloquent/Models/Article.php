<?php

namespace App\Repositories\Eloquent\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'is_video'             => 'boolean',
    ];
    protected $appends = [
        'video_flag',
    ];

    protected $dates = ['deleted_at'];

    /**
     * 記事URL
     * @return string
     */

    public function getVideoFlagAttribute()
    {
        return $this->is_video ? '動画記事' : '通常記事';
    }

    /**
     * Relations
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }
}
