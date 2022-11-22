<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\Message;

use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Services\BodyParser;

class MessageViewer
{
    /** @var BodyParser */
    private $bodyParser;

    public function __construct(
        BodyParser $bodyParser
    ) {
        $this->bodyParser = $bodyParser;
    }

    public function view(Message $message): MessageView
    {
        return new MessageView(
            $message,
            $this->bodyParser->parseMessage($message)
        );
    }
}
