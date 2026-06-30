<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
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
                        'country_id' => 'required',
                        'delivery_charge' => 'required',
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'name' => 'required',
                        'country_id' => 'required',
                        'delivery_charge' => 'required',
                    ];
                }
            default:break;
        }
    }
}
