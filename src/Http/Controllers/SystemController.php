<?php

namespace ArtARTs36\LaravelNotificationsLogger\Http\Controllers;

use ArtARTs36\LaravelNotificationsLogger\Models\System;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;

class SystemController extends Controller
{
    /**
     * @return AnonymousResourceCollection&iterable<System>
     */
    public function index(): AnonymousResourceCollection
    {
        return JsonResource::collection(System::all());
    }
}
