<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\System;

use ArtARTs36\LaravelNotificationsLogger\Contracts\SystemNameSelector;

class NameSelector implements SystemNameSelector
{
    /** @var array<string, string> */
    protected $systemsDict = [];

    /**
     * @param array<string, string> $systemsDict
     * @codeCoverageIgnore
     */
    public function __construct(array $systemsDict)
    {
        $this->systemsDict = $systemsDict;
    }

    public function select(Envelope $envelope): ?string
    {
        foreach ($this->systemsDict as $pattern => $systemName) {
            if (@preg_match($pattern, $envelope->body)) {
                return $systemName;
            }
        }

        return null;
    }
}
