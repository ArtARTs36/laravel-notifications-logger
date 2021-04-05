<?php

namespace ArtARTs36\LaravelNotificationsLogger\Services;

class SystemNameSelector
{
    protected $systemsDict = [];

    /**
     * @param array<string, string> $systemsDict
     * @codeCoverageIgnore
     */
    public function __construct(array $systemsDict)
    {
        $this->systemsDict = $systemsDict;
    }

    public function select(string $subjectOrNotification): ?string
    {
        foreach ($this->systemsDict as $pattern => $systemName) {
            if (@preg_match($pattern, $subjectOrNotification)) {
                return $systemName;
            }
        }

        return null;
    }
}
