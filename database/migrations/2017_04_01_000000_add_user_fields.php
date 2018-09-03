<?php

use Illuminate\Database\Migrations\Migration;

class AddUserFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->integer('role_id')->unsigned()->after('id');
            $table->integer('agency_id')->unsigned()->after('role_id');
            $table->boolean('is_approved')->after('agency_id')->default(0);
            $table->string('position')->after('is_approved')->nullable()->default('');

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('agency_id')->references('id')->on('agencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['agency_id']);
            $table->dropForeign(['is_approved']);
            $table->dropForeign(['role_id']);
            $table->dropColumn('agency_id', 'role_id', 'position');
        });
    }
}
