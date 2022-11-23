<?php

namespace ArtARTs36\LaravelNotificationsLogger\Loggers;

use ArtARTs36\LaravelNotificationsLogger\Contracts\MessageRepository;
use ArtARTs36\LaravelNotificationsLogger\Contracts\SystemNameSelector;
use ArtARTs36\LaravelNotificationsLogger\Data\AttachmentData;
use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Models\Attachment;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Models\System;
use ArtARTs36\LaravelNotificationsLogger\Operation\System\Envelope;
use ArtARTs36\LaravelNotificationsLogger\Operation\System\NameSelector;
use ArtARTs36\LaravelNotificationsLogger\Repositories\AttachmentRepository;
use ArtARTs36\LaravelNotificationsLogger\Repositories\SystemRepository;

class Logger
{
    /** @var NameSelector */
    protected $systemName;

    /** @var array<string, System> */
    protected $systems = [];

    /** @var SystemRepository */
    protected $systemRepo;

    /** @var MessageRepository */
    protected $messages;

    /** @var AttachmentRepository */
    protected $attachments;

    public function __construct(
        SystemNameSelector         $name,
        SystemRepository     $systemRepo,
        MessageRepository    $messages,
        AttachmentRepository $attachments
    ) {
        $this->systemName = $name;
        $this->systemRepo = $systemRepo;
        $this->messages = $messages;
        $this->attachments = $attachments;
    }

    public function save(MessageData $msgData): Message
    {
        $system = $this->getSystem($msgData);

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

    protected function getSystem(MessageData $message): ?System
    {
        $name = $this->systemName->select(new Envelope($message->subject, $message->body));

        if ($name === null) {
            return null;
        }

        return $this->getOrFindOrCreateSystem($name);
    }

    protected function getOrFindOrCreateSystem(string $slug): System
    {
        if (! array_key_exists($slug, $this->systems)) {
            $this->systems[$slug] = $this->systemRepo->findOrCreate($slug);
        }

        return $this->systems[$slug];
    }
}
