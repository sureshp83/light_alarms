<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisplayBoardRequest extends FormRequest
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
            "name_of_distributor"  => "required|min:2",
            "quantity"             => "required|numeric",
            "product_ids"          => "required|array",
            "contact_name"         => "required|min:2",
            "contact_phone_number" => "required|min:2",
            "company"              => "required|min:2",
            "ship_date"            => "date|required",
            "address"              => "required|min:2",
            "city"                 => "required|min:2",
            "state"                => "required|min:2",
            "zip_code"             => "required|min:2",
            "special_instructions" => "nullable|max:900",
        ];
    }
}
