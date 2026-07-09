<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'name' => 'required',
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                    ];
                }
            case 'PATCH':
            case 'PUT':
                {
                    return [
                        'name' => 'required',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                    ];
                }
            default:
                return [];
        }
    }
}
