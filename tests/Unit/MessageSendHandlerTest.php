<?php

namespace ArtARTs36\LaravelNotificationsLogger\Tests\Unit;

use ArtARTs36\LaravelNotificationsLogger\Handlers\MessageSentHandler;
use ArtARTs36\LaravelNotificationsLogger\Models\Message;
use ArtARTs36\LaravelNotificationsLogger\Tests\TestCase;
use Illuminate\Mail\Events\MessageSent;

class MessageSendHandlerTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelNotificationsLogger\Handlers\MessageSentHandler::handle
     */
    public function testHandle(): void
    {
        $message = (new \Swift_Message(
            $subject = 'test-subject',
            $body = 'test-body',
        ))
            ->setTo($to = 'test@mail.ru')
            ->setFrom($sender = 'test@mail.ru')
            ->setSender($sender, 'mailer');

        $event = new MessageSent($message);

        //

        /** @var MessageSentHandler $handler */
        $handler = $this->app->make(MessageSentHandler::class);

        $handler->handle($event);

        /** @var Message $log */
        $log = Message::query()->first();

        self::assertEquals($subject, $log->subject);
        self::assertEquals($body, $log->body);
        self::assertEquals($to, $log->recipient);
        self::assertEquals('test@mail.ru', $log->sender);
    }
}
