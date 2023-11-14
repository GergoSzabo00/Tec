<?php

namespace App\Providers;

use App\Rules\CheckExistenceOrOther;
use App\Rules\CardNumber;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('check_existence_or_other', function ($attribute, $value, $parameters, $validator) {
            list($table, $column, $otherValue) = $parameters;
            return (new CheckExistenceOrOther($table, $column, $otherValue))->passes($attribute, $value);
        });

        Validator::extend('card_number', function ($attribute, $value, $parameters, $validator) {
            return (new CardNumber())->passes($attribute, $value);
        });

        Paginator::useBootstrap();
    }
}
