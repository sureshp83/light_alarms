<?php

namespace App\Models;

use App\Models\ProductTrainingVideo;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ProductTrainingTool extends Model
{
    use Sluggable;

    protected $fillable = [
        "title",
        "slug",
        "image",
        "file_type",
        "file_name",
        "video_url",
        "release_date",
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function productTrainingVideos()
    {
        return $this->belongsToMany(ProductTrainingVideo::class);
    }
}
