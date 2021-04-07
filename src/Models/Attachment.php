<?php

namespace ArtARTs36\LaravelNotificationsLogger\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $content_id
 * @property int $message_id
 * @property string $file_name
 * @property string $encoded_body
 * @property string $mime
 */
class Attachment extends Model
{
    public const FIELD_CONTENT_ID = 'content_id';
    public const FIELD_MESSAGE_ID = 'message_id';
    public const FIELD_FILE_NAME = 'file_name';
    public const FIELD_ENCODED_BODY = 'encoded_body';
    public const FIELD_MIME = 'mime';

    protected $fillable = [
        self::FIELD_CONTENT_ID,
        self::FIELD_MESSAGE_ID,
        self::FIELD_FILE_NAME,
        self::FIELD_ENCODED_BODY,
        self::FIELD_MIME,
    ];
}
