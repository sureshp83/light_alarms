<?php

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('product_categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // add Product Categories
        //
        $this->_add(1, "Battery Units", "la-battery.jpg");
        $this->_add(2, "Exit Signs", "la-exit.jpg");
        $this->_add(4, "Remote Fixtures", "la-remote.jpg");
        $this->_add(5, "Inverter Series", "la-inverter.jpg");
        $this->_add(7, "Emergency Ballasts", "la-ballast.jpg");
        // $this->_add("Lamp Information", "la-ledlamp.jpg");
        // $this->_add("Accessories", "la-accessories.jpg");
        // $this->_add("Warranty", "la-warranty.jpg");
    }


    private function _add($id, $name, $image)
    {
        // $image = storage_path('demo/product_category/'.$image);

        ProductCategory::create([
            'id'   => $id,
            'name' => $name,
        ]);

        // $prodCategory->name = $name;
        // $prodCategory->addMedia($image)
        //     ->preservingOriginal()
        //     ->toMediaCollection("product-category-image");

        // $prodCategory->save();
    }
}
