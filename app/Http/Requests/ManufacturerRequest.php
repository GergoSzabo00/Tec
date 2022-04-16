<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:manufacturers|min:2|max:255'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trcw($this->name)
        ]);
    }

}
