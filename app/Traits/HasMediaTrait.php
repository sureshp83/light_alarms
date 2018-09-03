<?php
// NOTES:
// Links related for loading variations, etc.
// https://github.com/spatie/laravel-medialibrary/issues/892
// https://github.com/spatie/laravel-medialibrary/issues/705
//
namespace App\Traits;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait as HasMediaTraitSpatie;

trait HasMediaTrait
{
    use HasMediaTraitSpatie;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function mediaFirst()
    {
        return $this->media()
                    ->orderBy('order_column')
                    ->limit(1);
    }

    /**
     * Scope a query to certain media collections only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMediaCollection($query, $mediaCollection)
    {
        return $query->whereHas('media', function($q) use ($mediaCollection){
            $q->where('collection_name', $mediaCollection);
        });
    }

    /**
     * Scope a query to certain media collections only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMediaFirstByCollection($query, $mediaCollection)
    {
        return $query->whereHas('mediaFirst', function($q) use ($mediaCollection){
            $q->where('collection_name', $mediaCollection);
        });
    }
}
