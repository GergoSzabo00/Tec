<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(auth()->check())
        {
            return [
                'firstname' => 'required|alpha|min:2|max:255',
                'lastname' => 'required|alpha|min:2|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|min:4|max:15',
                'payment_option' => 'required|exists:payment_options,id',
                'address' => 'required|check_existence_or_other:addresses,id,Newaddress',
                'country' => 'required_if:address,Newaddress|exclude_unless:address,Newaddress|exists:countries,id',
                'city' => 'required_if:address,Newaddress|exclude_unless:address,Newaddress|alpha|min:2|max:255',
                'state' => 'required_if:address,Newaddress|exclude_unless:address,Newaddress|alpha|min:2|max:255',
                'zip_code' => 'required_if:address,Newaddress|exclude_unless:address,Newaddress|integer|min:0|digits_between:3,10',
                'new_address' => 'required_if:address,Newaddress|exclude_unless:address,Newaddress|string|min:2|max:255',
                'save_address' => 'boolean',
                'card_number' => 'required_if:payment_option,1|exclude_unless:payment_option,1|numeric|card_number',
                'card_holder_name' => 'required_if:payment_option,1|exclude_unless:payment_option,1|alpha',
                'card_expiry_date' => 'required_if:payment_option,1|exclude_unless:payment_option,1|regex:/^\d{2}\/\d{2}$/',
                'card_security_code' => 'required_if:payment_option,1|exclude_unless:payment_option,1|numeric|regex:/^\d{3}$/'
            ];
        }
        return [
            'firstname' => 'required|alpha|min:2|max:255',
            'lastname' => 'required|alpha|min:2|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|min:4|max:15',
            'country' => 'required|exists:countries,id',
            'city' => 'required|alpha|min:2|max:255',
            'state' => 'required|alpha|min:2|max:255',
            'zip_code' => 'required|integer|min:0|digits_between:3,10',
            'address' => 'required|string|min:2|max:255',
            'payment_option' => 'required|exists:payment_options,id',
            'card_number' => 'bail|required_if:payment_option,1|numeric|card_number',
            'card_holder_name' => 'bail|required_if:payment_option,1|alpha',
            'card_expiry_date' => 'bail|required_if:payment_option,1|regex:/^\d{2}\/\d{2}$/',
            'card_security_code' => 'bail|required_if:payment_option,1|numeric|regex:/^\d{3}$/'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'firstname' => trcw($this->firstname),
            'lastname' => trcw($this->lastname),
            'city' => trcw($this->city),
            'state' => trcw($this->state),
            'address' => trcw($this->address),
        ]);
    }

}
