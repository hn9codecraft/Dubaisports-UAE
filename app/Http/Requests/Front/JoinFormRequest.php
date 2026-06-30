<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class JoinFormRequest extends FormRequest
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
                        'street_address' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'zipcode' => 'required',
                        'contact_number' => 'required',
                        'designation_id' => 'required',
                        'skills' => 'required',
                        'english_fluency' => 'required',
                        'availability' => 'required',
                        'about_self' => 'required',
                        'linkedin_link' => 'url',
                        'github_link' => 'url',
                    ];
                }
            case 'PATCH':
                {
                    return [
                    ];
                }
            default:break;
        }
    }
}
