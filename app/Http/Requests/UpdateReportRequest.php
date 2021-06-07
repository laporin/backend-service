<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
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
            'serial' => 'alpha_num',
            'category_id' => 'numeric',
            'detail' => 'min:10',
            'address' => 'min:10',
            'city' => 'min:3',
            'subdistrict' => 'min:3',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'private' => 'boolean',
            'images' => 'nullable',
        ];
    }
}
