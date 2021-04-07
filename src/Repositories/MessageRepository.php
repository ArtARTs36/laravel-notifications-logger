<?php

namespace ArtARTs36\LaravelNotificationsLogger\Repositories;

use ArtARTs36\LaravelNotificationsLogger\Data\MessagePagination;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public function paginate(MessagePagination $pagination): LengthAwarePaginator
    {
        return Message::query()
            ->with(Message::RELATION_SYSTEM)
            ->orderBy(Message::CREATED_AT, $pagination->dateSort)
            ->when($pagination->systemId !== null, function (Builder $query) use ($pagination) {
                $query->where(Message::FIELD_SYSTEM_ID, $pagination->systemId);
            })
            ->when($pagination->recipient !== null, function (Builder $query) use ($pagination) {
                $query->where(Message::FIELD_RECIPIENT, $pagination->recipient);
            })
            ->paginate($pagination->limit, ['*'], 'MessagesList', $pagination->page);
    }

    /**
     * @return Message|Model
     */
    public function findOrFail(int $id): Message
    {
        return Message::query()
            ->with(Message::RELATION_ATTACHMENTS)
            ->findOrFail($id);
    }

    /**
     * @return Collection|iterable<string>
     */
    public function getAllRecipients(): Collection
    {
        return Message::query()
            ->toBase()
            ->distinct()
            ->get([Message::FIELD_RECIPIENT])
            ->pluck(Message::FIELD_RECIPIENT);
    }
}
