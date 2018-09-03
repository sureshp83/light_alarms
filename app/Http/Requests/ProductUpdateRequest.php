<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
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
            "launch_date"     => "required|date",
            "application"     => "required|min:2",
            "description"     => "required|min:2",
            "img_application" => "image|dimensions:min_width=80,min_height=80",
            "img_description" => "image|dimensions:min_width=80,min_height=80"
        ];
    }
}
