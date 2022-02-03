<?php

namespace ArtARTs36\LaravelNotificationsLogger\Providers;

use ArtARTs36\LaravelNotificationsLogger\Handlers\MessageSentHandler;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as AbstractEventProvider;
use Illuminate\Mail\Events\MessageSent;

class EventServiceProvider extends AbstractEventProvider
{
    /** @var array<class-string, array<class-string>> */
    protected $listen = [
        MessageSent::class => [
            MessageSentHandler::class,
        ],
    ];
}
