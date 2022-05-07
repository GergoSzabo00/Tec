<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator; 

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' => 'required_with:password'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->flash('tab', 'security');

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

}
