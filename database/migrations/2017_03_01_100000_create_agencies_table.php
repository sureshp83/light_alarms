<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('phone', 25)->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state_province')->nullable();
            $table->string('postal_code', 25)->nullable();
            $table->string('website')->nullable();
            $table->string('avatar')->nullable()->default('/demo/placeholder__avatar.jpg');
            $table->boolean('is_approved')->default(0);
            $table->timestamps();
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
        DB::table('agencies')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Schema::dropIfExists('agencies');
    }
}
