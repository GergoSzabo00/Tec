<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255|unique:manufacturers,id'.$this->id
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trcw($this->name)
        ]);
    }

}
