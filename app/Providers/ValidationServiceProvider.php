<?php

namespace App\Providers;

use App\Http\Validators\PersonalValidations;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Factory as ValidationFactory;

class ValidationServiceProvider extends ServiceProvider
{
    // public function boot()
    // {
    //     $this->app->make(ValidationFactory::class)->resolver(function ($translator, $data, $rules, $messages) {
    //         $validator = new Validator($translator, $data, $rules, $messages);
    //         $validator->setContainer($this->app);
    //         $validator->setPresenceVerifier($this->app['validation.presence']);

    //         // Agrega la validación personalizada validateFly
    //         $validator->addExtension('validateFly', function ($attribute, $value, $parameters) {
    //             return (new PersonalValidations)->validateFly($attribute, $value, $parameters);
    //         });

    //         return $validator;
    //     });
    // }

    // public function register()
    // {
    //     //
    // }
}