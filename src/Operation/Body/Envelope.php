<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\Body;

use ArtARTs36\LaravelNotificationsLogger\Models\Attachment;

class Envelope
{
    /** @var string */
    public $body;

    /** @var Attachment[] */
    public $attachments;

    /**
     * @param array<Attachment> $attachments
     */
    public function __construct(
        string $body,
        array $attachments
    ) {
        $this->body = $body;
        $this->attachments = $attachments;
    }
}
