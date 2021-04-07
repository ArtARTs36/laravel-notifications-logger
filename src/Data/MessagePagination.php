<?php

namespace ArtARTs36\LaravelNotificationsLogger\Data;

class MessagePagination
{
    public const DATE_SORT_ASC = 'asc';
    public const DATE_SORT_DESC = 'desc';

    public $limit;

    public $page;

    public $systemId;

    public $dateSort;

    public $recipient;

    public function __construct(
        int $limit,
        int $page,
        ?int $systemId = null,
        string $dateSort = self::DATE_SORT_DESC,
        ?string $recipient = null
    ) {
        $this->limit = $limit;
        $this->page = $page;
        $this->systemId = $systemId;
        $this->recipient = $recipient;
        $this->applyDateSort($dateSort);
    }

    protected function applyDateSort(string $value): void
    {
        $this->dateSort = $value === static::DATE_SORT_DESC ? static::DATE_SORT_DESC : static::DATE_SORT_ASC;
    }
}
