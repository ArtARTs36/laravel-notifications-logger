<?php

namespace ArtARTs36\LaravelNotificationsLogger\Tests\Unit;

use ArtARTs36\LaravelNotificationsLogger\Data\MessagePagination;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Repositories\MessageRepository;
use ArtARTs36\LaravelNotificationsLogger\Tests\TestCase;

class MessageRepositoryTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelNotificationsLogger\Repositories\MessageRepository::paginate
     */
    public function testPaginate(): void
    {
        /** @var MessageRepository $repo */
        $repo = $this->app->make(MessageRepository::class);

        //

        self::assertCount(0, $repo->paginate(new MessagePagination(10, 1)));

        //

        factory(Message::class, 10)->create();

        self::assertCount(10, $repo->paginate(new MessagePagination(10, 1)));
    }
}
