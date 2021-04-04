<?php

namespace ArtARTs36\LaravelNotificationsLogger\Tests\Unit;

use ArtARTs36\LaravelNotificationsLogger\Services\SystemNameSelector;
use ArtARTs36\LaravelNotificationsLogger\Tests\TestCase;

class SystemNameSelectorTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelNotificationsLogger\Services\SystemNameSelector::select
     */
    public function testSelect(): void
    {
        $selector = new SystemNameSelector([
            '/kk/i' => 'ee',
            '/Hello, (.*)/i' => $name = 'my-system-1',
        ]);

        //

        self::assertEquals($name, $selector->select('Hello, Artem'));
        self::assertNull($selector->select('rr'));
    }
}
