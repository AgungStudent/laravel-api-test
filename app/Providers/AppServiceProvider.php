<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

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
        $helperResponse = fn($isSuccess, $data, $errors, $status) => Response::make([
            'success' => $isSuccess,
            'data' => $data,
            'errors' => $errors
        ], $status);

        Response::macro('success', fn($data, $status = 200) => $helperResponse(true, $data, null, $status));
        Response::macro('error', fn($error, $status = 400) => $helperResponse(false, null, $error, $status));
    }
}
