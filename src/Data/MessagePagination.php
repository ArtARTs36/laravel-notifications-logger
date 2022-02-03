<?php

namespace ArtARTs36\LaravelNotificationsLogger\Data;

class MessagePagination
{
    public const DATE_SORT_ASC = 'asc';
    public const DATE_SORT_DESC = 'desc';

    /** @var int */
    public $limit;

    /** @var int */
    public $page;

    /** @var int|null */
    public $systemId;

    /** @var string */
    public $dateSort;

    /** @var string|null */
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
