<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required|unique:users',
                        'password' => 'required',
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required|unique:users,email'.$this->id,
                    ];
                }
            default:break;
        }
    }
}
