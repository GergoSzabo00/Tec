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
                'address' => 'required|check_existence_or_other:addresses,id,newAddress',
                'newAddressCountry' => 'required_if:address,newAddress|exclude_unless:address,newAddress|exists:countries,id',
                'newAddressCity' => 'required_if:address,newAddress|exclude_unless:address,newAddress|alpha|min:2|max:255',
                'newAddressState' => 'required_if:address,newAddress|exclude_unless:address,newAddress|alpha|min:2|max:255',
                'newAddressZip_code' => 'required_if:address,newAddress|exclude_unless:address,newAddress|integer|min:0|digits_between:3,10',
                'newAddressAddress' => 'required_if:address,newAddress|exclude_unless:address,newAddress|string|min:2|max:255',
                'save_address' => 'boolean'
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
            'newAddressCity' => trcw($this->newAddressCity),
            'newAddressState' => trcw($this->newAddressState),
            'newAddressAddress' => trcw($this->newAddressAddress)
        ]);
    }

}
