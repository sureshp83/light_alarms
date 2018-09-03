<?php

namespace App\Http\Controllers;

use App\Models\NewProduct;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $total      = 0;
    private $maxresults = 10;

    /**
     * Search for activities.
     *
     * @param  Request $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        //dd($request->all());
        try{
            $query = $request->input('q');

            // Get Search results hits
            $hits = [
                "new-products" => $this->_search(NewProduct::class, $query, 'name'),
            ];

            // Create output object
            $results = [
                'query' => $query,
                'total' => $this->total,
                'hits'  => $hits,
            ];

            return $results;

        }catch (\Exception $e){
            return [$e->getMessage()];
        }
    }

    /**
     * Search a single model for a text query.
     *
     * @param  Model $model
     * @param  string $query Search text used on the query
     * @param  string $key   The field used to build each link of the auto suggestion
     *
     * @return JSON
     */
    private function _search($model, $query, $key = 'id')
    {

        /*$res = $model::search($query)
            ->paginate($this->maxresults)
            ->pluck('name', $key);*/
        $res = $model::where($key,'LIKE',$query.'%')->paginate($this->maxresults)->pluck('name', $key);

        $this->total += $res->count();

        return $res;
    }
}
