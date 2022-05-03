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
        return [
            'firstname' => 'required|alpha|min:2|max:255',
            'lastname' => 'required|alpha|min:2|max:255',
            'email' => 'required|string|email|max:255',
            'country' => 'required|exists:countries,id',
            'city' => 'required|alpha|min:2|max:255',
            'state' => 'required|alpha|min:2|max:255',
            'zip_code' => 'required|integer|min:0|digits_between:3,10',
            'address' => 'required|string|min:2|max:255',
            'phone' => 'required|min:4|max:15',
            'payment_option' => 'required|exists:payment_options,id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'firstname' => trcw($this->firstname),
            'lastname' => trcw($this->lastname),
            'city' => trcw($this->city),
            'state' => trcw($this->state),
            'address' => trcw($this->address)
        ]);
    }

}
