<?php

namespace ArtARTs36\LaravelNotificationsLogger\Repositories;

use ArtARTs36\LaravelNotificationsLogger\Models\Attachment;
use Illuminate\Database\Eloquent\Model;

class AttachmentRepository
{
    /**
     * Create new Attachment.
     */
    public function create(string $contentId, int $messageId, string $name, string $body, string $mime): Attachment
    {
        return Attachment::query()->create([
            Attachment::FIELD_CONTENT_ID => $contentId,
            Attachment::FIELD_MESSAGE_ID => $messageId,
            Attachment::FIELD_FILE_NAME => $name,
            Attachment::FIELD_ENCODED_BODY => $body,
            Attachment::FIELD_MIME => $mime,
        ]);
    }
}
