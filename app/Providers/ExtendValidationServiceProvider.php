<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use IsoCodes\Iban;
use IsoCodes\SwiftBic;
use Validator;
use Hash;

class ExtendValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->ibanAndBic();
        $this->matchPassword();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function ibanAndBic()
    {
        Validator::extendImplicit('swiftbic', function ($attribute, $value, $parameters, $validator) {
            return SwiftBic::validate($value);
        });

        Validator::extendImplicit('iban', function ($attribute, $value, $parameters, $validator) {
            return Iban::validate($value);
        });
    }

    private function matchPassword()
    {
        Validator::extendImplicit('matched', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });
    }
}
