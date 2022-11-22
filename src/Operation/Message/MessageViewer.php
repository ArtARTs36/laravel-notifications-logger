<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\Message;

use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Operation\Body\Envelope;
use ArtARTs36\LaravelNotificationsLogger\Contracts\BodyParser;

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
            $this->bodyParser->parse(new Envelope($message->body, $message->attachments->all()))
        );
    }
}
