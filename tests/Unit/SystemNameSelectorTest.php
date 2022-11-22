<?php

namespace ArtARTs36\LaravelNotificationsLogger\Tests\Unit;

use ArtARTs36\LaravelNotificationsLogger\Operation\System\NameSelector;
use ArtARTs36\LaravelNotificationsLogger\Tests\TestCase;

class SystemNameSelectorTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelNotificationsLogger\Operation\System\NameSelector::select
     */
    public function testSelect(): void
    {
        $selector = new NameSelector([
            '/kk/i' => 'ee',
            '/Hello, (.*)/i' => $name = 'my-system-1',
        ]);

        //

        self::assertEquals($name, $selector->select('Hello, Artem'));
        self::assertNull($selector->select('rr'));
    }
}
