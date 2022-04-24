<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|min:2|max:255|unique:products,product_name',
            'manufacturer' => 'nullable|exists:manufacturers,id',
            'product_id' => 'nullable|exists:products,id',
            'category_id' => 'nullable|exists:categories,id',
            'product_image' => 'file|image',
            'price' => 'required|numeric|between:0,99999999.99',
            'quantity_in_stock' => 'required|numeric|between:0,1000'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'product_name' => trcw($this->product_name)
        ]);
    }

}
