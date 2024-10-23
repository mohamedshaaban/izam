<?php

namespace Modules\Order\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Order\Events\OrderPlaced;
use Modules\Order\Listeners\NotifyUsersOfNewOrder;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        OrderPlaced::class => [
            NotifyUsersOfNewOrder::class,
        ],
    ];
    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void
    {
        //
    }
}
