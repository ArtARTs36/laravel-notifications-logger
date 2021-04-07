<?php

namespace ArtARTs36\LaravelNotificationsLogger\Loggers;

use ArtARTs36\LaravelNotificationsLogger\Data\AttachmentData;
use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Models\Attachment;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Models\System;
use ArtARTs36\LaravelNotificationsLogger\Repositories\AttachmentRepository;
use ArtARTs36\LaravelNotificationsLogger\Repositories\MessageRepository;
use ArtARTs36\LaravelNotificationsLogger\Repositories\SystemRepository;
use ArtARTs36\LaravelNotificationsLogger\Services\SystemNameSelector;

class Logger
{
    protected $systemName;

    /** @var <string, System> */
    protected $systems = [];

    protected $systemRepo;

    protected $messages;

    protected $attachments;

    public function __construct(
        SystemNameSelector $name,
        SystemRepository $systemRepo,
        MessageRepository $messages,
        AttachmentRepository $attachments
    ) {
        $this->systemName = $name;
        $this->systemRepo = $systemRepo;
        $this->messages = $messages;
        $this->attachments = $attachments;
    }

    public function save(MessageData $message): Message
    {
        $system = $this->getSystem($message);

        return $this->messages->create(
            $message->subject,
            $message->sender,
            $message->recipient,
            $message->body,
            $system ? $system->id : null
        );
    }

    public function saveAttachment(Message $message, AttachmentData $attachment, string $contentId): Attachment
    {
        return $this->attachments->create(
            $contentId,
            $message->id,
            $attachment->fileName,
            $attachment->encode(),
            $attachment->getMime()
        );
    }

    protected function getSystem(MessageData $message): ?System
    {
        $name = $this->systemName->select($message->implement ?? $message->subject);

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
