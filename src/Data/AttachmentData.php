<?php

namespace ArtARTs36\LaravelNotificationsLogger\Data;

use League\Flysystem\Util\MimeType;

class AttachmentData
{
    public $contentId;

    public $fileName;

    public $body;

    public $mime;

    public function __construct(string $contentId, string $fileName, string $body)
    {
        $this->contentId = $contentId;
        $this->fileName = $fileName;
        $this->body = $body;
        $this->mime = MimeType::detectByContent($this->body);
    }

    public function isImage(): bool
    {
        return mb_strpos($this->mime, 'image') === 0;
    }

    public function encode(): string
    {
        return base64_encode($this->body);
    }
}
