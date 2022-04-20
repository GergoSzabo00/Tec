<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name' => 'required|unique:categories|min:2|max:255'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'category_name' => trcw($this->category_name)
        ]);
    }

}
