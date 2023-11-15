<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            'country' => 'required|exists:countries,id',
            'city' => 'required|string|min:2|max:255',
            'state' => 'required|string|min:2|max:255',
            'zip_code' => 'required|integer|min:0|digits_between:3,10',
            'address' => 'required|string|min:2|max:255',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'city' => trcw($this->city),
            'state' => trcw($this->state),
            'address' => trcw($this->address)
        ]);
    }

}
