<?php

namespace ArtARTs36\LaravelNotificationsLogger\Contracts;

use ArtARTs36\LaravelNotificationsLogger\Operation\Body\Envelope;

interface BodyParser
{
    public function parse(Envelope $envelope): string;
}
