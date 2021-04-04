<?php

namespace ArtARTs36\LaravelNotificationsLogger\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 */
class System extends Model
{
    public const FIELD_TITLE = 'title';
    public const FIELD_SLUG = 'slug';

    public $timestamps = false;

    protected $table = 'log_notification_systems';

    protected $fillable = [
        self::FIELD_TITLE,
        self::FIELD_SLUG,
    ];
}
