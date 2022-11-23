<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\Logger;

use ArtARTs36\LaravelNotificationsLogger\Contracts\MessageRepository;
use ArtARTs36\LaravelNotificationsLogger\Data\AttachmentData;
use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Models\Attachment;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Operation\System\Envelope;
use ArtARTs36\LaravelNotificationsLogger\Operation\System\Selector;
use ArtARTs36\LaravelNotificationsLogger\Repositories\AttachmentRepository;

class Logger
{
    /** @var Selector */
    protected $system;

    /** @var MessageRepository */
    protected $messages;

    /** @var AttachmentRepository */
    protected $attachments;

    public function __construct(
        Selector $system,
        MessageRepository    $messages,
        AttachmentRepository $attachments
    ) {
        $this->system = $system;
        $this->messages = $messages;
        $this->attachments = $attachments;
    }

    public function save(MessageData $msgData): Message
    {
        $system = $this->system->select(new Envelope($msgData->subject, $msgData->body));

        $message = $this->messages->create(
            $msgData->subject,
            $msgData->sender,
            $msgData->recipient,
            $msgData->body,
            $system ? $system->id : null
        );

        foreach ($msgData->attachments as $attachment) {
            $this->saveAttachment($message, $attachment);
        }

        return $message;
    }

    protected function saveAttachment(Message $message, AttachmentData $attachment): Attachment
    {
        return $this->attachments->create(
            $attachment->contentId,
            $message->id,
            $attachment->fileName,
            $attachment->encode(),
            $attachment->mime
        );
    }
}
