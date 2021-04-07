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
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            Message::FIELD_BODY => app(BodyParser::class)->parse(
                $this->resource->body,
                $this->resource->attachments->all(),
            ),
        ]);
    }
}
