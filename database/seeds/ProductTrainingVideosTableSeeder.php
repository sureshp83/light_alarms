<?php

use App\Models\ProductTrainingVideo;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductTrainingVideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('product_training_videos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $productCategories = ProductCategory::get();

        // Product Training Videos are not related to product categories!
        // This is just an handy way of seed records.
        foreach ($productCategories as $productCategory) {
            $this->addProductTrainingVideos($productCategory);
        }
    }

    private function addProductTrainingVideos($productCategory)
    {
        $total = rand(12, 25);
        $image = $productCategory->slug.'.jpg';

        for ($i = 1; $i < $total; $i++) {
            $name = $productCategory->name.' '.substr('00'.$i, -2);

            $this->addProductTrainingVideo($name, $image);
        }
    }

    /**
     * Add a single Record.
     *
     * @param string $name
     * @param string $image
     */
    private function addProductTrainingVideo($name, $image)
    {
        $rec = ProductTrainingVideo::create([
            'title'       => $name,
            'description' => '<strong>Features</strong>:<ul style="margin-top:0; margin-left: 0px; padding-left: 30px; margin-right: 0px; padding-right: 30px; margin-bottom:1em;"><li>Die-Cast aluminum housing</li><li>Clear, High Impact, UV- Resistant (3” x 1.5”) polycarbonate lens</li><li>Four colors are available: off white, black, platinum gray and dark bronze</li><li>Wall Mount</li><li>1/2” rigid conduit entry provision on the top of the unit</li><li>Universal knock-outs to mount to any standard 4” junction box</li><li>Patent-pending design for easy installation: wall-mount back-plate includes electrical wire box with snap-on connector</li><li>Patent-pending light engine: four power LEDs with redundant connections and very wide beam</li><li>400-640 Lumens</li><li>Color temperature: 5000K</li></ul>',
            'image'       => '/demo/products/'.$image,
        ]);
    }
}
