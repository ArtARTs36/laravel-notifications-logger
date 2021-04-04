<?php

namespace ArtARTs36\LaravelNotificationsLogger\Http\Controllers;

use ArtARTs36\LaravelNotificationsLogger\Repositories\MessageRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MessageController extends Controller
{
    protected $repo;

    public function __construct(MessageRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return $this->repo->paginate(
            $request->input('limit', 10),
            $request->input('page', 1),
            $request->input('system_id')
        );
    }
}
