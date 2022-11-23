<?php

namespace ArtARTs36\LaravelNotificationsLogger\Event;

use ArtARTs36\LaravelNotificationsLogger\Data\AttachmentData;
use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Loggers\Logger;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Services\Swift;
use Illuminate\Mail\Events\MessageSent;

class MessageSentListener
{
    /** @var Logger */
    protected $logger;

    /** @var Swift */
    protected $swift;

    public function __construct(Logger $logger, Swift $swift)
    {
        $this->logger = $logger;
        $this->swift = $swift;
    }

    public function handle(MessageSent $event): void
    {
        foreach ($event->message->getTo() ?? [] as $toMail => $toName) { // @phpstan-ignore-line
            $message = $this->logger->save(
                new MessageData(
                    $event->message->getSubject() ?? '', // @phpstan-ignore-line
                    $event->message->getBody() ?? '', // @phpstan-ignore-line
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
            if (! $attachment->isImage()) {
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

    /**
     * @param array<mixed> $array
     */
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
