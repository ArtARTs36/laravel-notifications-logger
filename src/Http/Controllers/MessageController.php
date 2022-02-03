<?php

namespace ArtARTs36\LaravelNotificationsLogger\Http\Controllers;

use ArtARTs36\LaravelNotificationsLogger\Data\MessagePagination;
use ArtARTs36\LaravelNotificationsLogger\Repositories\MessageRepository;
use ArtARTs36\LaravelNotificationsLogger\Resources\MessageResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MessageController extends Controller
{
    /** @var MessageRepository */
    protected $repo;

    /** @var ResponseFactory */
    protected $response;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(MessageRepository $repo, ResponseFactory $response)
    {
        $this->repo = $repo;
        $this->response = $response;
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return $this->repo->paginate(
            new MessagePagination(
                $request->input('limit', 10),
                $request->input('page', 1),
                $request->input('system_id'),
                $request->input('date_sort', 'desc'),
                $request->input('recipient')
            )
        );
    }

    public function show(int $messageId): MessageResource
    {
        return new MessageResource($this->repo->findOrFail($messageId));
    }

    public function recipients(): JsonResponse
    {
        return $this->response->json([
            'data' => $this->repo->getAllRecipients(),
        ]);
    }
}
