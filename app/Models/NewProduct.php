<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Traits\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class NewProduct extends Model implements HasMedia
{
    use Searchable, Sluggable, SoftDeletes,HasMediaTrait;

    protected $fillable = [
        "product_category_id",
        "name",
        "slug",
        "launch_date",
        "application",
        "description",
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

    /*
    |--------------------------------------------------------------------------
    | Scout / TNTSearch
    |--------------------------------------------------------------------------
    */

    /**
     * Get the indexable data array for the model.
     * Maybe remove this, since we are using a Command for creating custom index.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $productCategory = $this->productCategory()->pluck('name')->toArray();

        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'application' => $this->application,
            'category'    => implode(' ', $productCategory),
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function salesTools()
    {
        return $this->belongsToMany(SalesTool::class, "new_product_sales_tool");
    }
}
