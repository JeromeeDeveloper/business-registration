<?php

namespace App\Providers;

use App\Models\Cooperative;
use App\Models\UploadedDocument;
use App\Observers\CooperativeObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\UploadedDocumentObserver;
use App\Observers\UpdateCooperativeObserver;

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
        UploadedDocument::observe(UploadedDocumentObserver::class);
        Cooperative::observe(CooperativeObserver::class);
        Cooperative::observe(UpdateCooperativeObserver::class);
    }
}
