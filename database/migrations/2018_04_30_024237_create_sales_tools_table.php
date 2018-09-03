<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_tools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->enum('file_type', ["Video", "DOCX", "PDF"]);
            $table->string('file_name')->nullable();
            $table->string('video_url')->nullable();
            $table->date('release_date')->nullable()->default('2018-12-30');
            // $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });


        Schema::create('new_product_sales_tool', function (Blueprint $table){
            $table->integer('new_product_id')->unsigned();
            $table->integer('sales_tool_id')->unsigned();
            $table->timestamps();

            $table->foreign('new_product_id')->references('id')->on('new_products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sales_tool_id')->references('id')->on('sales_tools')->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('prod_train_video_sales_tool', function (Blueprint $table){
            $table->integer('prod_train_video_id')->unsigned();
            $table->integer('sales_tool_id')->unsigned();
            $table->timestamps();

            $table->foreign('prod_train_video_id')->references('id')->on('product_training_videos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sales_tool_id')->references('id')->on('sales_tools')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('sales_tools')->truncate();
        DB::table('new_product_sales_tool')->truncate();
        DB::table('prod_train_video_sales_tool')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Schema::table('new_product_sales_tool', function (Blueprint $table){
            $table->dropForeign(['new_product_id']);
            $table->dropForeign(['sales_tool_id']);
        });

        Schema::table('prod_train_video_sales_tool', function (Blueprint $table){
            $table->dropForeign(['prod_train_video_id']);
            $table->dropForeign(['sales_tool_id']);
        });

        Schema::dropIfExists('sales_tools');
        Schema::dropIfExists('new_product_sales_tool');
        Schema::dropIfExists('prod_train_video_sales_tool');
    }
}
