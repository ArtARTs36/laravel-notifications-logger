<?php

namespace ArtARTs36\LaravelNotificationsLogger\Data;

class MessageData
{
    public $subject;

    public $body;

    public $recipient;

    public $sender;

    public function __construct(
        ?string $subject,
        string $body,
        string $recipient,
        string $sender
    ) {
        $this->subject = $subject ?? '';
        $this->body = $body;
        $this->recipient = $recipient;
        $this->sender = $sender;
    }
}
