<?php

namespace ArtARTs36\LaravelNotificationsLogger\Resources;

use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Services\BodyParser;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Message
 * @property Message $resource
 */
class MessageResource extends JsonResource
{
    /**
     * @return array<string, string>
     */
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            Message::FIELD_BODY => app(BodyParser::class)->parseMessage($this->resource),
        ]);
    }
}
