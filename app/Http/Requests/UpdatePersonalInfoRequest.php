<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator; 

class UpdatePersonalInfoRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->user()->id,
            'phone' => 'required|min:4|max:15'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'firstname' => trcw($this->firstname),
            'lastname' => trcw($this->lastname)
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->flash('tab', 'personal-info');

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

}
