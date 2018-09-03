<?php

use Illuminate\Database\Seeder;
use App\Models\NewProduct;
use App\Models\ProductCategory;

class NewProductsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('new_products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        $productCategories = ProductCategory::get();


        // Seed New Products for each product category
        foreach ($productCategories as $productCategory) {
            $this->addProductsPerCategory($productCategory);
        }
    }


    private function addProductsPerCategory($productCategory)
    {
        // SKIP Search Indexing when running this batch job
        NewProduct::withoutSyncingToSearch(function () use ($productCategory){
            $total = rand(15, 25);

            // We are using the same product image per product category.
            $image = $productCategory->slug.'.jpg';

            for ($i = 1; $i < $total; $i++) {
                $this->addProduct(
                    $productCategory->name.' '.substr('00'.$i, -2),
                    $productCategory->id,
                    $image
                );
            }
        });
    }

    /**
     * Add a single Product.
     *
     * @param string $name
     * @param string $product_category_id
     * @param string $image
     */
    private function addProduct($name, $product_category_id, $image)
    {
        $product = NewProduct::create([
            'name'                => $name,
            "product_category_id" => $product_category_id,
            "launch_date"         => Carbon\Carbon::now()->addMonth(rand(5,8))->addDay(rand(1,5)),
            'application'         => 'For first-class performance in emergency lighting, the <strong>Camray™ LED</strong> illuminates a 40-70’ path of egress with a wide beam, and consumes less than 5W in stand-by mode. Optional dual-mode illumination provides lighting during power outages and in normal conditions. LED technology miniaturizes emergency lighting to be more environmentally friendly by providing more illumination with a smaller unit. The high-performance <strong>Camray™ LED</strong> reduces energy consumption, requires fewer units to install, and uses a compact, Leadfree & Cadmium-free battery.',
            'description'         => '<strong>Features</strong>:<ul style="margin-top:0; margin-left: 0px; padding-left: 30px; margin-right: 0px; padding-right: 30px; margin-bottom:1em;"><li>Die-Cast aluminum housing</li><li>Clear, High Impact, UV- Resistant (3” x 1.5”) polycarbonate lens</li><li>Four colors are available: off white, black, platinum gray and dark bronze</li><li>Wall Mount</li><li>1/2” rigid conduit entry provision on the top of the unit</li><li>Universal knock-outs to mount to any standard 4” junction box</li><li>Patent-pending design for easy installation: wall-mount back-plate includes electrical wire box with snap-on connector</li><li>Patent-pending light engine: four power LEDs with redundant connections and very wide beam</li><li>400-640 Lumens</li><li>Color temperature: 5000K</li></ul>',
            'img_description'     => '/demo/products/'.$image,
            'img_application'     => '/demo/products/_placeholder_application.jpg',
        ]);
    }
}
