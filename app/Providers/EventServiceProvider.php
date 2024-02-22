<?php

namespace App\Providers;

use App\Events\PermisoSalidaSuccesfull;
use App\Events\UserFormRequestSaved;
use App\Listeners\SaveLogUserFormRequest;
use App\Listeners\SendEmailCustomerPermisoSalidaSuccess;
use App\Listeners\SendEMailUserPermisoSalidaSuccess;
use App\Listeners\SendEmailWelcomeUserVerified;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Verified::class => [
            SendEmailWelcomeUserVerified::class,
        ],
        PermisoSalidaSuccesfull::class => [ // Event handle when Permiso Salida SUccessfully
            SendEmailCustomerPermisoSalidaSuccess::class, // Send email Copy Customer
            SendEMailUserPermisoSalidaSuccess::class // Send email for user
        ],
        UserFormRequestSaved::class => [
            SaveLogUserFormRequest::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
