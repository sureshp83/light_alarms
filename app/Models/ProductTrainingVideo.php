<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class ProductTrainingVideo extends Model implements HasMedia
{
    use SoftDeletes, Sluggable,HasMediaTrait;


    protected $fillable = [
        "title",
        "slug",
        "description",
        "image",
        "video_url",
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
    public function storeBanner($request,$productTrainingVideo)
    {
        if ($request->hasFile("banner_image")) {
            $image = $request->file("banner_image");
            $this->clearMediaCollection("training-banner-image");
            $this->addMedia($image)->toMediaCollection("training-banner-image");
        }
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    // public function salesTools()
    // {
    //     return $this->belongsToMany(SalesTool::class, "prod_train_video_sales_tool");
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    // public function productTrainingTools()
    // {
    //     return $this->belongsToMany(ProductTrainingTool::class, "prod_train_video_prod_train_tool");
    // }
}
