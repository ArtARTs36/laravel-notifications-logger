<?php

namespace ArtARTs36\LaravelNotificationsLogger\Repositories;

use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MessageRepository
{
    /**
     * @return Message|Model
     */
    public function create(
        string $subject,
        string $sender,
        string $recipient,
        string $body,
        ?int $systemId = null
    ): Message {
        return Message::query()->create([
            Message::FIELD_SUBJECT => $subject,
            Message::FIELD_SENDER => $sender,
            Message::FIELD_RECIPIENT => $recipient,
            Message::FIELD_BODY => $body,
            Message::FIELD_SYSTEM_ID => $systemId,
        ]);
    }

    public function paginate(int $count, int $page, ?int $systemId = null): LengthAwarePaginator
    {
        return Message::query()
            ->with(Message::RELATION_SYSTEM)
            ->when($systemId !== null, function (Builder $query) use ($systemId) {
                $query->where(Message::FIELD_SYSTEM_ID, $systemId);
            })
            ->paginate($count, ['*'], 'MessagesList', $page);
    }
}
