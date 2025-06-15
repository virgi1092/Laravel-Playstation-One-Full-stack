<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Penyewaan;
use App\Observers\PenyewaanObserver;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Register Observer
        Penyewaan::observe(PenyewaanObserver::class);
    }
}
