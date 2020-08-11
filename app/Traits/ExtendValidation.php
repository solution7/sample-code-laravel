<?php

namespace App\Traits;

use IsoCodes\Iban;
use IsoCodes\SwiftBic;

use Validator;
use Hash;

trait ExtendValidation
{
    private function ibanAndBic()
    {
        Validator::extendImplicit('swiftbic', function ($attribute, $value, $parameters, $validator) {
            return SwiftBic::validate($value);
        });

        Validator::extendImplicit('iban', function ($attribute, $value, $parameters, $validator) {
            return Iban::validate($value);
        });
    }

    private function matchPassword($user)
    {
        Validator::extendImplicit('matched', function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) use ($user) {
            return Hash::check($value, $user->password);
        });
    }
}
