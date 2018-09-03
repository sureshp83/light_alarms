<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewProductCreateRequest extends FormRequest
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
            "name"            => 'required|max:255|min:2',
            "launch_date"     => "required|date", ///^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/
            "application"     => "required|min:2",
            "img_application" => "dimensions:min_width=500,min_height=500",
            "img_description" => "dimensions:min_width=500,min_height=500"
        ];
    }
}
