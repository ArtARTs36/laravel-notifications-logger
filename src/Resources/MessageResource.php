<?php

namespace ArtARTs36\LaravelNotificationsLogger\Resources;

use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Operation\Message\MessageView;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MessageView
 * @property MessageView $resource
 */
class MessageResource extends JsonResource
{
    /**
     * @return array<string, string>
     */
    public function toArray($request): array
    {
        return array_merge($this->resource->message->toArray(), [
            Message::FIELD_BODY => $this->resource->body,
        ]);
    }
}
