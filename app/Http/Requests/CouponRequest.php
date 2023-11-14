<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|alpha_num|min:3|max:255|unique:coupons,code,'.$this->id,
            'type' => 'required|in:numeric,percentage',
            'coupon_value' => 'required|numeric|between:0.01,99999999.99',
            'minimum_cart_amount' => 'required|numeric|between:0,99999999.99',
            'expires_at' => 'required|date|after_or_equal:today'
        ];
    }
}
