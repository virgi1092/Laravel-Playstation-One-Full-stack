<?php

namespace App\Providers;

use App\Models\Pembayaran;
use App\Models\Penyewaan;
use App\Observers\PenyewaanObserver;
use App\Observers\PembayaranObserver;
use Illuminate\Support\Facades\Log;
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
        // Penyewaan::observe(PenyewaanObserver::class);
        Pembayaran::observe(PembayaranObserver::class);
        Log::info('PembayaranObserver registered successfully');
        Penyewaan::observe(PenyewaanObserver::class);
    }
}
