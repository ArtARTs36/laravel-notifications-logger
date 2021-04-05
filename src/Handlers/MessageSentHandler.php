<?php

namespace ArtARTs36\LaravelNotificationsLogger\Handlers;

use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Loggers\Logger;
use Illuminate\Mail\Events\MessageSent;

class MessageSentHandler
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(MessageSent $event): void
    {
        foreach ($event->message->getTo() ?? [] as $toMail => $toName) {
            $this->logger->save(
                new MessageData(
                    $event->message->getSubject() ?? '',
                    $event->message->getBody() ?? '',
                    is_string($toMail) ? $toMail : $toName,
                    $this->parseSender($event->message)
                )
            );
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
