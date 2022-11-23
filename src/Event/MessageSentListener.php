<?php

namespace ArtARTs36\LaravelNotificationsLogger\Event;

use ArtARTs36\LaravelNotificationsLogger\Data\AttachmentData;
use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Operation\Logger\Logger;
use ArtARTs36\LaravelNotificationsLogger\Operation\Swift\AttachmentExtractor;
use Illuminate\Mail\Events\MessageSent;

class MessageSentListener
{
    /** @var Logger */
    protected $logger;

    /** @var AttachmentExtractor */
    protected $attachment;

    public function __construct(Logger $logger, AttachmentExtractor $attachmentExtractor)
    {
        $this->logger = $logger;
        $this->attachment = $attachmentExtractor;
    }

    public function handle(MessageSent $event): void
    {
        foreach ($event->message->getTo() ?? [] as $toMail => $toName) { // @phpstan-ignore-line
            $this->logger->save(
                new MessageData(
                    $event->message->getSubject() ?? '', // @phpstan-ignore-line
                    $event->message->getBody() ?? '', // @phpstan-ignore-line
                    is_string($toMail) ? $toMail : $toName,
                    $this->parseSender($event->message),
                    $this->filterAttachments($this->attachment->extract($event->message))
                )
            );
        }
    }

    /**
     * @param array<AttachmentData> $attachments
     * @return array<AttachmentData>
     */
    protected function filterAttachments(array $attachments): array
    {
        return array_filter($attachments, function (AttachmentData $data) {
            return $data->isImage();
        });
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
