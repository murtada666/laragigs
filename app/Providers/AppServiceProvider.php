<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        /*
            - Here is the other way to handel mass Assignment Rule
            - When using this way we are basically saying we are allowing the mass assignment and we no longer require us to add fillable(check the listing model).
            - If we do it this way we gotta know whats going into the DATABASE and have it setup correctly like don't just create and do something like :
            - Listing::create($request->all();) !!!!!. 
        */

        // Model::unguard();

        // Changing pagination template(we can use whatever we want).
        // Paginator::useBootstrapFive();
    }
}
