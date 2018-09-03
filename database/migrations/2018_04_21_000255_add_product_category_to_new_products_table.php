<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductCategoryToNewProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_products', function (Blueprint $table){
            $table->integer('product_category_id')->after('id');

            $table->foreign('product_category_id')
                ->references('id')
                ->on('product_categories')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_products', function (Blueprint $table){
            $table->dropForeign(['product_category_id']);
            $table->dropColumn('product_category_id');
        });
    }
}
