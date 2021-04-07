<?php

namespace ArtARTs36\LaravelNotificationsLogger\Tests\Feature;

use ArtARTs36\LaravelNotificationsLogger\Models\Message;
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

    /**
     * @covers \ArtARTs36\LaravelNotificationsLogger\Http\Controllers\MessageController::show
     */
    public function testShow(): void
    {
        $request = function (int $id) {
            return $this->getJson('messages/'. $id);
        };

        //

        $request(1)->assertStatus(404);

        //

        $message = factory(Message::class)->create();

        $request($message->id)->assertStatus(200);
    }
}
