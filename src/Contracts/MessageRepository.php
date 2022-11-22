<?php

namespace ArtARTs36\LaravelNotificationsLogger\Contracts;

use ArtARTs36\LaravelNotificationsLogger\Data\MessagePagination;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface MessageRepository
{
    public function create(
        string $subject,
        string $sender,
        string $recipient,
        string $body,
        ?int $systemId = null
    ): Message;

    public function paginate(MessagePagination $pagination): LengthAwarePaginator;

    /**
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $id): Message;

    /**
     * @return Collection&iterable<string>
     */
    public function getAllRecipients(): Collection;
}