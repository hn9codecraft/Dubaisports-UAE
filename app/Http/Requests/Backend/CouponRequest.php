<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
                        'coupon_code' => 'required',
                        'start_date' => 'required',
                        'end_date' => 'required',
                        'percentage' => 'required',
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'coupon_code' => 'required',
                        'start_date' => 'required',
                        'end_date' => 'required',
                        'percentage' => 'required',
                    ];
                }
            default:break;
        }
    }
}
