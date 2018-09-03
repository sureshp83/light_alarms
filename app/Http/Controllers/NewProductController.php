<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\NewProduct;
use App\Traits\ProductQuery;
use Caffeinated\Flash\Facades\Flash;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded;

/**
 * Class NewProductController
 * @package App\Http\Controllers
 */
class NewProductController extends Controller
{
    use ProductQuery;

    /**
     * @var string
     */
    protected $item;

    /**
     * NewProductController constructor.
     */
    public function __construct()
    {
        $this->item = "New Product";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $newProducts = NewProduct::paginate(20);

        // $this->addMissingSlug($newProducts);

        return view("newProducts.index", compact("newProducts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("newProducts.create");
    }

    /**
     * @param NewProductCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewProductCreateRequest $request)
    {
        //dd($request->all());
        try{

            $newProduct = new NewProduct();
            $newProduct->fill($request->except( "_token", "image"));
            $newProduct->save();

            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $newProduct->clearMediaCollection("product-image");
                $newProduct->addMedia($image)->toMediaCollection("product-image");
            }
            $newProduct->save();

            Flash::success(trans("flash.success.created", ["item" => $this->item]));

        }catch (FileCannotBeAdded $fe){
            Flash::error(trans("flash.error.file_not_added", ["item" => $this->item]));
        }catch (ModelNotFoundException $mnfe){
            Flash::error(trans("flash.error.not_found", ["item" => $this->item]));

        }catch (Exception $e){
            Flash::error("ERROR: {$e->getCode()}");
        }

        return redirect()->route("new-products.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug = "")
    {
        try {
            if ($slug == "") {
                throw new ModelNotFoundException();
            }

            $newProduct = NewProduct::where("slug", "=", $slug)
                ->with('salesTools')
                ->firstOrFail();

            return view("newProducts.show", compact("newProduct"));

        } catch (ModelNotFoundException $mnfe){
            Flash::error(trans("flash.error.not_found", ["item" => $this->item]));

        } catch (Exception $e){
            Flash::error("ERROR: {$e->getCode()}");
        }

        return redirect()->route("new-products.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        try{
            if ($slug == "") {
                throw new ModelNotFoundException();
            }

            $newProduct = NewProduct::where("id", "=", $slug)->firstOrFail();

            return view("newProducts.edit", compact("newProduct"));
        }catch (ModelNotFoundException $mnfe){
            return response()->json($mnfe->getMessage());
        }catch (Exception $e){
            return response()->json($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductUpdateRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {

        try{
            $input = $request->except("_method", "_token", "image");

            $product = NewProduct::findOrFail($id);
            $product->fill($input);

            //if the product has image, save it to the product-image media collection
            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $product->clearMediaCollection("product-image");
                $product->addMedia($image)->toMediaCollection("product-image");
            }

            $product->save();

            Flash::success(trans("flash.success.updated", ["item" => $this->item]));

            return redirect()->route("new-products.index");
        }catch (ModelNotFoundException $mnfe){
            Flash::error("Product not found");
        }catch (Exception $e){
            Flash::error("Error {$e->getCode()}");
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try{
            NewProduct::destroy($id);
            Flash::success("Product deleted successfully");
        }catch (ModelNotFoundException $e){
            Flash::error("Product not found");
        }catch (Exception $e){
            Flash::error("ERROR {$e->getCode()}");
        }

        return redirect()->route("new-products.index");
    }

    /**
     * @param $products
     */
    public function addMissingSlug($products)
    {
        foreach ($products as $newProduct) {
            if ($newProduct->name == "" || $newProduct->name == null) {
                $newProduct->name = $newProduct->name;
                $newProduct->save();
            }
        }
    }
}
