<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomBrochureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'                     => "required|min:2",
            'brand'                     => "required|min:2",
            'products'                  => "required|array",
            // 'include_nexus_information' => "required|min:2",
            // 'include_led_information'   => "required|min:2",
            'client_name'               => "required|min:2",
            'agency_name'               => "required|min:2",
            'agent_name'                => "required|min:2",
            'agent_phone_number'        => "required|min:2",
            'agent_address'             => "required|min:2",
            'agent_city'                => "required|min:2",
            'agent_country'             => "required|min:2",
            'agent_zip_code'            => "required|min:2",
        ];
    }
}
