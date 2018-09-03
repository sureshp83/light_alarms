<?php

namespace App\Traits;

use Auth;
use App\User;
use App\Models\NewProduct;
use Illuminate\Http\Request;

trait ProductQuery
{
    /**
     * Return a list of products, sortBy and/or filter.
     *
     * @param \Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery(Request $request, NewProduct $product)
    {
        try{
            $data = $request->except("_method", "_token");

            $productCategoryID = $data["product_category"] ?? 0;

            // Start a new query
            $products = $product->newQuery();


            // Filter by Product Category
            if ($productCategoryID > 0) {
                $products->where('product_category_id', '=', $productCategoryID);
            }


            // Return records
            $products = $products
                ->offset($data["offset"])
                ->limit($data["pagesize"])
                ->get();

            return $products;


        }catch (Exception $e){
            return response()->toJson([$e->getMessage()], $e->getCode());
        }
    }
}
