<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestSalesLiteratureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_sales_literature', function (Blueprint $table){
            $table->increments('id');
            $table->string("contact_name");
            $table->string("contact_phone_number");
            $table->string("agency_name");
            $table->date("ship_date");
            $table->string("address");
            $table->string("city");
            $table->string("state");
            $table->string("zip_code");
            $table->longText("special_instructions")->nullable();
            $table->longText("literatures");
            $table->integer("quantity");
            $table->string("part_number");
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
        Schema::dropIfExists('request_sales_literature');
    }
}
