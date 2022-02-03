<?php

namespace ArtARTs36\LaravelNotificationsLogger\Services;

use ArtARTs36\LaravelNotificationsLogger\Data\AttachmentData;

class Swift
{
    /**
     * @return array<AttachmentData>
     */
    public function getAttachments(\Swift_Message $message): array
    {
        $attachments = [];

        foreach ($message->getChildren() ?? [] as $child) { // @phpstan-ignore-line
            $fileName = $this->getFileName($child);

            if (! $fileName) {
                continue;
            }

            $attachments[] = new AttachmentData($child->getId(), $fileName, $child->getBody());
        }

        return $attachments;
    }

    protected function getFileName(\Swift_Mime_SimpleMimeEntity $entity): ?string
    {
        $disposition = $entity->getHeaders()->get('Content-Disposition');

        if (! $disposition instanceof \Swift_Mime_Headers_ParameterizedHeader) {
            return null;
        }

        $params = $disposition->getParameters();

        if (! array_key_exists('filename', $params)) {
            return null;
        }

        return $params['filename'];
    }
}
