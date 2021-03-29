<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 8-12桁の半角英数値のみ許容
        return preg_match("/^[a-zA-Z0-9]{8,12}$/", $value)
            && preg_match("/[a-z]+/", $value)
            && preg_match("/[A-Z]+/", $value)
            && preg_match("/[0-9]+/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attributeは８～１２桁の小文字英語、大文字英語、数字で入力するんだわん';
    }
}
