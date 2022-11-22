<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\Message;

use ArtARTs36\LaravelNotificationsLogger\Models\Message;

class MessageView
{
    /** @var Message */
    public $message;

    /** @var string */
    public $body;

    public function __construct(
        Message $message,
        string $body
    ) {
        $this->body = $body;
        $this->message = $message;
    }
}
