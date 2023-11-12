<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CardNumber implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = preg_replace('/[^0-9]/', '', $value);

        $sum = 0;
        $numOfDigits = strlen($value);
        $parity = $numOfDigits % 2;

        for ($i = 0; $i < $numOfDigits; $i++) {
            $digit = (int)$value[$i];

            if ($i % 2 == $parity) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return ($sum % 10 == 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.card_number');
    }
}
