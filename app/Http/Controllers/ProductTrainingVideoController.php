<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTrainingVideoCreateRequest;
use App\Http\Requests\ProductTrainingVideoUpdateRequest;
use App\Models\ProductTrainingVideo;
use App\Traits\ProductTrainingVideoQuery;

use Caffeinated\Flash\Facades\Flash;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\Image\Image;
use Illuminate\Http\Request;

class ProductTrainingVideoController extends Controller implements HasMedia
{
    use ProductTrainingVideoQuery;
    use HasMediaTrait;


    protected $item;

    public function __construct()
    {
        $this->item = "Product Training Video";
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $productTrainingVideo = ProductTrainingVideo::paginate(20);

            return view("productTrainingVideos.index", compact("productTrainingVideo"));

        } catch (Exception $e){
            Flash::error("ERROR: {$e->getCode()}");
        }

        return redirect()->route("home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("productTrainingVideos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductTrainingVideoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            if($request->has("video_url")){
               $videoUrl=$request->get("video_url");
               preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $videoUrl, $matches);
               $id=$matches[1];
               $newlink="https://www.youtube.com/embed/".$id;
               $request->merge(['video_url' => $newlink]);
            }

            $productTrainingVideo = new ProductTrainingVideo();
            $productTrainingVideo->fill($request->except("_method", "_token", "banner_image"));
            $productTrainingVideo->save();
            if($request->hasFile("banner_image")){
                $image=$request->file("banner_image");
                $name="trainvideo".$productTrainingVideo->id.".".$image->getClientOriginalExtension();
                $input = "trainvideo".$productTrainingVideo->id."-small.".$image->getClientOriginalExtension();
                $image->move(storage_path( 'app/public' )."/demo/training_modules/image",$name);
                $imgname='/demo/training_modules/image/'.$name;
                ProductTrainingVideo::where('id',$productTrainingVideo->id)->update(array("image"=>$imgname));
                $newPath =storage_path( 'app/public' )."/demo/training_modules/image/".$input;
                \File::copy(storage_path( 'app/public' )."/demo/training_modules/image/".$name , $newPath);
            }
            /*if($request->hasFile("banner_image")){
                $image = $request->file('banner_image');
                $input = "trainvideo".$productTrainingVideo->id."-small.".$image->getClientOriginalExtension();
                $img = \Image::make($image->getRealPath());
                $img->resize(260, 260);
                $img->save(storage_path( 'app/public' )."/demo/training_modules/image/".$input);
            }*/

            if($request->hasFile("video_file")){
                $video=$request->file("video_file");
                $name="trainvideo".$productTrainingVideo->id.".".$video->getClientOriginalExtension();
                $video->move(storage_path( 'app/public' )."/demo/training_modules/video",$name);
                $videoname='/demo/training_modules/video/'.$name;
                ProductTrainingVideo::where('id',$productTrainingVideo->id)->update(array("video_url"=>$videoname));
            }
            //$productTrainingVideo->storeBanner($request,$productTrainingVideo);

            Flash::success(trans("flash.success.created", ["item" => $this->item]));

        } catch (ModelNotFoundException $mnfe){
            Flash::error(trans("flash.error.not_found", ["item" => $this->item]));

        } catch (Exception $e){
            Flash::error("ERROR: {$e->getCode()}");
        }

        return redirect()->route("product-training-videos.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        try {
            $productTrainingVideo = ProductTrainingVideo::where("slug", "=", $slug)
                // ->with('salesTools', 'productTrainingTools')
                ->firstOrFail();
            return \Response::json($productTrainingVideo,200);
            //return view("productTrainingVideos.show", compact("productTrainingVideo"));

        } catch (ModelNotFoundException $mnfe){
            Flash::error(trans("flash.error.not_found", ["item" => $this->item]));

        } catch (Exception $e){
            Flash::error("ERROR: {$e->getCode()}");
        }

        return redirect()->route("home");
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

        try {
            $productTrainingVideo = ProductTrainingVideo::where("id", "=", $slug)->firstOrFail();
            //dd($productTrainingVideo );
            return view("productTrainingVideos.edit", compact("productTrainingVideo"));

        } catch (ModelNotFoundException $mnfe){
            Flash::error(trans("flash.error.not_found", ["item" => $this->item]));

        } catch (Exception $e){
            Flash::error("ERROR {$e->getCode()}");
        }

        return redirect()->route("product-training-videos.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductTrainingVideoUpdateRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductTrainingVideoUpdateRequest $request, $id)
    {
        try {
            $productTrainingVideo = ProductTrainingVideo::findOrFail($id);
            $productTrainingVideo->update($request->except("_method", "_token", "banner_image"));

            $this->storeBanner($request, $productTrainingVideo);

            Flash::success(__("Product Training Video successfully updated."));

        } catch (ModelNotFoundException $mnfe){
            Flash::error(__("Product Training Video not found!"));

        } catch (Exception $e){
            Flash::error(__("ERROR: ") . "{$e->getCode()}");
        }

        return redirect()->route("product-training-videos.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            ProductTrainingVideo::destroy($id);
            Flash::success(trans("flash.success.deleted", ["item" => $this->item]));

        } catch (ModelNotFoundException $mnfe){
            Flash::error(trans("flash.error.not_found", ["item" => $this->item]));

        } catch (Exception $e){
            Flash::error("ERROR: {$e->getCode()}");
        }

        return redirect()->route("product-training-videos.index");
    }

    private function storeBanner($request, $productTrainingVideo)
    {
        if ($request->hasFile("banner_image")) {
            $image = $request->file("banner_image");
            //$this->clearMediaCollection("training-banner-image");
            $productTrainingVideo->addMedia($image)->toMediaCollection("training-banner-image");
        }
    }
}
