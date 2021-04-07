<?php

namespace ArtARTs36\LaravelNotificationsLogger\Data;

use League\Flysystem\Util\MimeType;

class AttachmentData
{
    public $fileName;

    public $body;

    public function __construct(string $fileName, string $body)
    {
        $this->fileName = $fileName;
        $this->body = $body;
    }

    public function getMime(): string
    {
        return MimeType::detectByContent($this->body);
    }

    public function encode(): string
    {
        return base64_encode($this->body);
    }
}
