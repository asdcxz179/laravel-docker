<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Byg\Admin\Http\Responses\Api\Response;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(env('SERVICE_HTTPS', 0)) \URL::forceScheme('https');

        Passport::enablePasswordGrant();

        Gate::policy(\App\Models\System\Website::class, \App\Policies\System\WebsitePolicy::class);
        Gate::policy(\App\Models\AWS\S3::class, \App\Policies\AWS\S3Policy::class);
    }
}
