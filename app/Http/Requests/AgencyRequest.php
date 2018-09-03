<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
            "name"        => "required|string|max:255|unique:agencies",
            "phone"       => "required|min:2|max:24",
            "address"     => "required|min:2",
            "city"        => "required|min:2",
            "state"       => "required|min:2",
            "postal_code" => "required|min:2",
        ];
    }
}
