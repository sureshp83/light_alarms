<?php

use App\Models\NewProduct;
use App\Models\SalesTool;
use App\Models\ProductTrainingVideo;
use Illuminate\Database\Seeder;

class SalesToolsTableSeeder extends Seeder
{
    private $data = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('sales_tools')->truncate();
        DB::table('new_product_sales_tool')->truncate();
        DB::table('prod_train_video_sales_tool')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Seed dummy sales tools
        //
        $this->_add('Catalog sheet', 'catalog_sheet.jpg', '');
        $this->_add('Instruction sheet', 'instruction_sheet.jpg', '');
        $this->_add('Photometric data', 'photometric_data.jpg', '');
        $this->_add('Price sheet', 'price_sheet.jpg', '');
        $this->_add('Warranty', 'warranty.jpg', '');
        $this->_add('Exit signs', 'exit-signs.jpg', '');
        $this->_add('HPI video', 'video-hpi.jpg', 'https://www.youtube.com/watch?v=kitASo-C7Fs');
        $this->_add('Mini-Inverters video', 'video-inverter.jpg', 'https://www.youtube.com/watch?v=AlYtT0Zm9i0');

        $this->data = SalesTool::get();

        $this->_addNewProductSalesTools();
        $this->_addProdTrainVideosSalesTools();
    }


    private function _add($title, $image, $video_url = '')
    {
        $is_video = ($video_url != '');
        $file     = $is_video ? '' : '/storage/demo/sales_tools/la-demo-pdf.pdf';
        $image    = '/demo/sales_tools/'.$image;

        SalesTool::create([
            'title'        => $title,
            'slug'         => str_slug($title),
            'image'        => $image,
            'file_type'    => ($is_video ? 'Video' : 'PDF'),
            'file_name'    => $file,
            'video_url'    => $video_url,
            'release_date' => Carbon\Carbon::now()->subMonths(rand(1,4))->format('Y-m-d'),
        ]);
    }



    private function _addNewProductSalesTools()
    {
        $newProducts = NewProduct::get();

        $newProducts->each(function ($prod) {
            $total = rand(4, count($this->data));
            $_data = $this->data->random($total);

            $_data->each(function ($salesTool) use ($prod){
                DB::table('new_product_sales_tool')->insert([
                    'new_product_id' => $prod->id,
                    'sales_tool_id'  => $salesTool->id,
                    'created_at'     => Carbon\Carbon::now(),
                    'updated_at'     => Carbon\Carbon::now(),
                ]);
            });
        });
    }


    private function _addProdTrainVideosSalesTools()
    {
        $trainModules = ProductTrainingVideo::get();

        $trainModules->each(function ($trainModule) {
            $total = rand(4, count($this->data));
            $_data = $this->data->random($total);

            $_data->each(function ($salesTool) use ($trainModule){
                DB::table('prod_train_video_sales_tool')->insert([
                    'prod_train_video_id' => $trainModule->id,
                    'sales_tool_id'       => $salesTool->id,
                    'created_at'          => Carbon\Carbon::now(),
                    'updated_at'          => Carbon\Carbon::now(),
                ]);
            });
        });
    }
}
