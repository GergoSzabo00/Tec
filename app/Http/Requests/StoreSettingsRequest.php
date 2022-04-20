<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address' => 'required|min:2|max:255',
            'phone' => 'required|max:15',
            'email' => 'required|string|email|max:255',
            'shipping_cost' => 'required|numeric|between:0,99.99'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'address' => trcw($this->address)
        ]);
    }

}
