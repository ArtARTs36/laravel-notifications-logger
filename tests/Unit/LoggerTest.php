<?php

namespace ArtARTs36\LaravelNotificationsLogger\Tests\Unit;

use ArtARTs36\LaravelNotificationsLogger\Data\MessageData;
use ArtARTs36\LaravelNotificationsLogger\Operation\Logger\Logger;
use ArtARTs36\LaravelNotificationsLogger\Operation\System\NameSelector;
use ArtARTs36\LaravelNotificationsLogger\Tests\TestCase;

class LoggerTest extends TestCase
{
    public function testSave(): void
    {
        /** @var Logger $logger */
        $logger = $this->app->make(Logger::class);

        //

        $data = new MessageData(
            'test-subject',
            'test-body',
            'test-recipient',
            'test-sender'
        );

        //

        $message = $logger->save($data);

        self::assertEquals('test-subject', $message->subject);
        self::assertEquals('test-body', $message->body);
        self::assertEquals('test-recipient', $message->recipient);
        self::assertEquals('test-sender', $message->sender);
        self::assertNull($message->system_id);

        //

        /** @var Logger $logger */
        $logger = $this->app->make(Logger::class, [
            'name' => new NameSelector([
                '/test-subject/i' => 'system-1',
            ])
        ]);

        $message = $logger->save($data);

        self::assertNotNull($message->system_id);
        self::assertEquals('system-1', $message->system->slug);
    }
}
