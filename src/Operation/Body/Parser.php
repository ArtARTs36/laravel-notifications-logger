<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\Body;

use ArtARTs36\LaravelNotificationsLogger\Contracts\BodyParser;
use ArtARTs36\LaravelNotificationsLogger\Models\Attachment;

class Parser implements BodyParser
{
    public function parse(Envelope $envelope): string
    {
        $keys = [];
        $values = [];

        foreach ($envelope->attachments as $attachment) {
            $keys[] = 'cid:'. $attachment->content_id;
            $values[] = $this->convertAttachmentToBase64String($attachment);
        }

        //

        return str_replace($keys, $values, $envelope->body);
    }

    protected function convertAttachmentToBase64String(Attachment $attachment): string
    {
        return 'data:'. $attachment->mime
            . ';base64,'
            . $attachment->encoded_body;
    }
}
