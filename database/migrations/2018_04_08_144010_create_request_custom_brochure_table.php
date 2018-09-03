<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestCustomBrochureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_custom_brochure', function (Blueprint $table){
            $table->increments('id');
            $table->string('email');                      // The email address of the user generating the brochure
            $table->string('brand');                      // The brand whose products will be in the generated brochure
            $table->longText('products');                     // The list of [ids] for the products to be included in the brochure
            $table->boolean('include_nexus_information'); // True if the Nexus information should be included
            $table->boolean('include_led_information');   // True if the Led information should be included
            $table->string('client_name');                // Name of the client the brochure is being generated for

            // Ship to
            // -----------------
            $table->string('agency_name');        // Name of the agency the agent works with
            $table->string('agent_name');         // Name of the agent
            $table->string('agent_phone_number'); // Phone number of the agent
            $table->string('agent_address');      // Address of the agency
            $table->string('agent_city');         // City the agent is located in
            $table->string('agent_state');        // State the agent is located in
            // $table->string('agent_country');      // Country the agent is located in
            $table->string('agent_zip_code');     // Zip/postal code of the agent
            $table->integer('submit_by_id');
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
        Schema::dropIfExists('request_custom_brochure');
    }
}
