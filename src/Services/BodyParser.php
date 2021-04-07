<?php

namespace ArtARTs36\LaravelNotificationsLogger\Services;

use ArtARTs36\LaravelNotificationsLogger\Models\Attachment;

class BodyParser
{
    /**
     * @param array<Attachment> $attachments
     */
    public function parse(string $body, array $attachments): string
    {
        $result = $body;

        //

        $replaces = [];

        foreach ($attachments as $attachment) {
            $replaces[$attachment->content_id] = 'data:image/png;base64,'. $attachment->encoded_body;
        }

        //

        return str_replace(array_keys($replaces), array_values($replaces), $result);
    }
}
