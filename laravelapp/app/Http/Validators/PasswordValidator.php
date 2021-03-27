<?php
namespace App\Http\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Crypt;

class PasswordValidator extends Validator
{
    public function validatePassword($input_password, $userData_password)
    {
        return $input_password === Crypt::decryptString($userData_password);
    }
}
