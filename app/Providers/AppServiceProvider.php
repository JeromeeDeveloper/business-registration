<?php

namespace App\Providers;

use App\Models\Cooperative;
use App\Models\Participant;
use App\Models\GARegistration;
use App\Models\UploadedDocument;
use App\Observers\CooperativeObserver;
use App\Observers\ParticipantObserver;
use App\Observers\GARegistrationObserver;
use App\Observers\UploadedDocumentObserver;
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
        UploadedDocument::observe(UploadedDocumentObserver::class);
        Cooperative::observe(CooperativeObserver::class);
        Participant::observe(ParticipantObserver::class);
        GARegistration::observe(GARegistrationObserver::class);
    }
}



