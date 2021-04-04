<?php

namespace ArtARTs36\LaravelNotificationsLogger\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $subject
 * @property string $sender
 * @property string $body
 * @property string $recipient
 * @property int $system_id
 * @property System $system
 */
class Message extends Model
{
    public const FIELD_SUBJECT = 'subject';
    public const FIELD_SENDER = 'sender';
    public const FIELD_BODY = 'body';
    public const FIELD_RECIPIENT = 'recipient';
    public const FIELD_SYSTEM_ID = 'system_id';

    public const RELATION_SYSTEM = 'system';

    protected $table = 'log_notification_messages';

    protected $fillable = [
        self::FIELD_SUBJECT,
        self::FIELD_SENDER,
        self::FIELD_BODY,
        self::FIELD_RECIPIENT,
        self::FIELD_SYSTEM_ID,
    ];

    /**
     * @codeCoverageIgnore
     */
    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }
}
