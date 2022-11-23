<?php

namespace ArtARTs36\LaravelNotificationsLogger\Data;

class MessageData
{
    /** @var string */
    public $subject;

    /** @var string */
    public $body;

    /** @var string */
    public $recipient;

    /** @var string */
    public $sender;

    /** @var array<AttachmentData> */
    public $attachments;

    public function __construct(
        ?string $subject,
        string $body,
        string $recipient,
        string $sender,
        array $attachments
    ) {
        $this->subject = $subject ?? '';
        $this->body = $body;
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->attachments = $attachments;
    }
}
