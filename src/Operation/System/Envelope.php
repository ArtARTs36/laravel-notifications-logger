<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\System;

class Envelope
{
    /** @var string */
    public $subject;

    /** @var string */
    public $body;

    public function __construct(
        string $subject,
        string $body
    ) {
        $this->subject = $subject;
        $this->body = $body;
    }
}
