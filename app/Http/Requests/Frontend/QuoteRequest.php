<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
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
                        'email' => 'required|email',
                        'phone' => 'required',
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'name' => 'required',
                        'email' => 'required|email',
                        'phone' => 'required',
                    ];
                }
            default:break;
        }
    }
}
