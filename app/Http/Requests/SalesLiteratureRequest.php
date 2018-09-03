<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesLiteratureRequest extends FormRequest
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
            "contact_name"         => "required|min:2",
            "contact_phone_number" => "required|min:2",
            "agency_name"          => "required|min:2",
            "ship_date"            => "date|required|min:2",
            "address"              => "required|min:2",
            "city"                 => "required|min:2",
            "state"                => "required|min:2",
            "zip_code"             => "required|min:2",
            "quantity"             => "required|numeric",
            "part_number"          => "required|min:2",
            "literatures"          => "required|array",
            "special_instructions" => "nullable|max:900",
        ];
    }
}
