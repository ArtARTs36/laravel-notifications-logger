<?php

namespace ArtARTs36\LaravelNotificationsLogger\Handlers;

use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Loggers\Logger;
use Illuminate\Mail\Events\MessageSent;

class MessageSentHandler
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(MessageSent $event): void
    {
        foreach ($event->message->getTo() as $to) {
            $this->logger->save(
                new MessageData(
                    $event->message->getSubject() ?? '',
                    $event->message->getBody() ?? '',
                    $to ?? '',
                    $event->message->getSender() ?? ''
                )
            );
        }
    }
}
