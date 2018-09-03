<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestCustomBrochure extends Model
{
    use SoftDeletes;

    protected $table = "request_custom_brochure";

    protected $fillable = [
        'email',                     // The email address of the user generating the brochure
        'brand',                     // The brand whose products will be in the generated  brochure
        'products',                  // The list of [ids] for the products to be included in the brochure
        'include_nexus_information', // True if the Nexus information should be included
        'include_led_information',   // True if the Led information should be included
        'client_name',               // Name of the client the brochure is being generated for
        'agency_name',               // Name of the agency the agent works with
        'agent_name',                // Name of the agent
        'agent_phone_number',        // Phone number of the agent
        'agent_address',             // Address of the agency
        'agent_city',                // City the agent is located in
        'agent_country',             // Country the agent is located in
        'agent_zip_code',            // Zip/postal code of the agent
    ];
}
