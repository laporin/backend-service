<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
            'user_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'detail' => 'required|alpha_num|min:20',
            'address' => 'required|alpha_num|min:20',
            'city' => 'required|alpha',
            'subdistrict' => 'required|alpha',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'private' => 'required',
        ];
    }
}
