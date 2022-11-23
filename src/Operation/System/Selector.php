<?php

namespace ArtARTs36\LaravelNotificationsLogger\Operation\System;

use ArtARTs36\LaravelNotificationsLogger\Contracts\SystemNameSelector;
use ArtARTs36\LaravelNotificationsLogger\Models\System;
use ArtARTs36\LaravelNotificationsLogger\Repositories\SystemRepository;

class Selector
{
    /** @var SystemNameSelector */
    protected $name;

    /** @var SystemRepository */
    protected $systemRepo;

    /** @var array<string, System> */
    protected $systems;

    /**
     * @param array<string, System> $systems
     */
    public function __construct(
        SystemNameSelector $name,
        SystemRepository $systemRepository,
        array $systems = []
    ) {
        $this->name = $name;
        $this->systemRepo = $systemRepository;
        $this->systems = $systems;
    }

    public function select(Envelope $envelope): ?System
    {
        $name = $this->name->select($envelope);

        if ($name === null) {
            return null;
        }

        return $this->getOrFindOrCreateSystem($name);
    }

    protected function getOrFindOrCreateSystem(string $slug): System
    {
        if (! array_key_exists($slug, $this->systems)) {
            $this->systems[$slug] = $this->systemRepo->findOrCreate($slug);
        }

        return $this->systems[$slug];
    }
}
