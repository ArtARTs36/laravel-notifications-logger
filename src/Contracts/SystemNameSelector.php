<?php

namespace ArtARTs36\LaravelNotificationsLogger\Contracts;

use ArtARTs36\LaravelNotificationsLogger\Operation\System\Envelope;

interface SystemNameSelector
{
    public function select(Envelope $envelope): ?string;
}
