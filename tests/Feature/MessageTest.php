<?php

namespace ArtARTs36\LaravelNotificationsLogger\Tests\Feature;

use ArtARTs36\LaravelNotificationsLogger\Tests\TestCase;

class MessageTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelNotificationsLogger\Http\Controllers\MessageController::index
     */
    public function testIndex(): void
    {
        $this->getJson('messages')->assertStatus(200);
    }
}
