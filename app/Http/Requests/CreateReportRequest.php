<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReportRequest extends FormRequest
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
            'category_id' => 'required|numeric',
            'detail' => 'required|min:10',
            'address' => 'required|min:10',
            'city' => 'required|alpha',
            'subdistrict' => 'required|alpha',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'private' => 'required',
            'images' => 'nullable',
        ];
    }
}
