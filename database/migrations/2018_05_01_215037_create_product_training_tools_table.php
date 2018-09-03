<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTrainingToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_training_tools', function (Blueprint $table) {
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

        Schema::create('prod_train_video_prod_train_tool', function (Blueprint $table){
            $table->integer('prod_train_video_id')->unsigned();
            $table->integer('prod_train_tool_id')->unsigned();
            $table->timestamps();

            $table->foreign('prod_train_video_id', 'tm_id_fk')
                ->references('id')
                ->on('product_training_videos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('prod_train_tool_id', 'ptt_id_fk')
                ->references('id')
                ->on('product_training_tools')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        DB::table('product_training_tools')->truncate();
        DB::table('prod_train_video_prod_train_tool')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Schema::table('prod_train_video_prod_train_tool', function (Blueprint $table){
            $table->dropForeign(['tm_id_fk']);
            $table->dropForeign(['ptt_id_fk']);
        });

        Schema::dropIfExists('product_training_tools');
        Schema::dropIfExists('prod_train_video_prod_train_tool');
    }
}
