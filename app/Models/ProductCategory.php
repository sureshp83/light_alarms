<?php

namespace App\Models;

use App\Models\NewProduct;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class ProductCategory extends Model implements HasMediaConversions
{
    use HasMediaTrait, Sluggable;

    protected $table = "product_categories";

    protected $fillable = [
        'name',
        'is_active',
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
                'source' => 'name'
            ]
        ];
    }

    /**
     * @param Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
             ->width(250)
             ->height(250)
             ->sharpen(10);

        $this->addMediaConversion('square')
             ->width(500)
             ->height(500)
             ->sharpen(10);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function newProducts()
    {
        return $this->hasMany(NewProduct::class);
    }
}
