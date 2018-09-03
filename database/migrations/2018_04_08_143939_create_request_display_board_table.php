<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestDisplayBoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_display_board', function (Blueprint $table){
            $table->increments('id');
            $table->string("name_of_distributor");
            $table->integer("quantity");
            $table->longText("product_ids");
            $table->string("contact_name");
            $table->string("contact_phone_number");
            $table->string("company");
            $table->date("ship_date");
            $table->string("address");
            $table->string("city");
            $table->string("state");
            $table->string("zip_code");
            $table->longText("special_instructions")->nullable();
            $table->integer("submit_by_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_display_board');
    }
}
