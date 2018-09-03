<?php

namespace App\Traits;

use Auth;
use App\User;
use App\Models\ProductTrainingVideo;
use Illuminate\Http\Request;

trait ProductTrainingVideoQuery
{
    /**
     * Return a list of Product Training Videos, sortBy and/or filter.
     *
     * @param \Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery(Request $request, ProductTrainingVideo $productTrainingVideo)
    {
        try {
            $data = $request->except("_method", "_token");

            // Start a new query
            $_videos = $productTrainingVideo->newQuery();

            $_videos = $_videos
                ->offset($data["offset"])
                ->limit($data["pagesize"])
                ->get();

            return $_videos;


        } catch (Exception $e) {
            return response()->toJson([$e->getMessage()], $e->getCode());
        }
    }
}
