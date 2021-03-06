<?php

namespace ArtARTs36\LaravelNotificationsLogger\Repositories;

use ArtARTs36\LaravelNotificationsLogger\Models\System;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SystemRepository
{
    public function findOrCreate(string $title): System
    {
        /** @var System|null $system */
        $system = System::query()->where(System::FIELD_TITLE, $title)->first();

        if ($system) {
            return $system;
        }

        return System::query()->create([
            System::FIELD_SLUG => Str::slug($title),
            System::FIELD_TITLE => $title,
        ]);
    }
}
