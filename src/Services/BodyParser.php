<?php

namespace ArtARTs36\LaravelNotificationsLogger\Services;

use ArtARTs36\LaravelNotificationsLogger\Models\Attachment;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;

class BodyParser
{
    public function parseMessage(Message $message): string
    {
        return $this->parse($message->body, $message->attachments->all());
    }

    /**
     * @param array<Attachment> $attachments
     */
    public function parse(string $body, array $attachments): string
    {
        $result = $body;

        //

        $replaces = [];

        foreach ($attachments as $attachment) {
            $replaces[$attachment->content_id] = 'data:'. $attachment->mime . ';base64,'. $attachment->encoded_body;
        }

        //

        return str_replace(array_keys($replaces), array_values($replaces), $result);
    }
}
