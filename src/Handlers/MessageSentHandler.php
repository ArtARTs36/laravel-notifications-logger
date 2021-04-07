<?php

namespace ArtARTs36\LaravelNotificationsLogger\Handlers;

use ArtARTs36\LaravelNotificationsLogger\Data\AttachmentData;
use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Loggers\Logger;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Services\Swift;
use Illuminate\Mail\Events\MessageSent;

class MessageSentHandler
{
    protected $logger;

    protected $swift;

    public function __construct(Logger $logger, Swift $swift)
    {
        $this->logger = $logger;
        $this->swift = $swift;
    }

    public function handle(MessageSent $event): void
    {
        foreach ($event->message->getTo() ?? [] as $toMail => $toName) {
            $message = $this->logger->save(
                new MessageData(
                    $event->message->getSubject() ?? '',
                    $event->message->getBody() ?? '',
                    is_string($toMail) ? $toMail : $toName,
                    $this->parseSender($event->message)
                )
            );

            $this->applyAttachments($message, $this->swift->getAttachments($event->message));
        }
    }

    /**
     * @param array<AttachmentData> $attachments
     */
    protected function applyAttachments(Message $message, array $attachments): void
    {
        foreach ($attachments as $attachment) {
            if (mb_strpos($attachment->getMime(), 'image') === false) {
                continue;
            }

            $this->logger->saveAttachment($message, $attachment);
        }
    }

    protected function parseSender(\Swift_Message $message): string
    {
        foreach ([$message->getFrom(), $message->getSender()] as $expect) {
            if (is_string($expect)) {
                return $expect;
            }

            if (($sender = $this->parseValueFromArray($expect))) {
                return $sender;
            }
        }

        return '';
    }

    protected function parseValueFromArray(array $array): ?string
    {
        $key = array_key_first($array);

        if (is_string($key)) {
            if ($array[$key] === null) {
                return $key;
            }

            return "$key <$array[$key]>";
        }

        return $array[$key];
    }
}
