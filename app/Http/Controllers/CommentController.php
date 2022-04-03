<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;
use App\Services\LikeService;

class CommentController extends Controller
{
    /**
     * @var CommentRepository
     */
    private $repository;

    /**
     * @var LikeService
     */
    private $service;

    /**
     * @param  CommentRepository  $commentRepository
     * @param  LikeService        $likeService
     */
    public function __construct(CommentRepository $commentRepository, LikeService $likeService)
    {
        $this->repository = $commentRepository;
        $this->service = $likeService;
    }

    /**
     * @param  CommentRequest  $request
     *
     * @return CommentResource
     */
    public function addComment(CommentRequest $request)
    {
        // TODO: task 2, комментирование

        $comment = $this->repository->create($request->all());

        return CommentResource::make($comment);
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addLike(int $id)
    {
        // TODO: task 3, лайк комментария

        $comment = $this->repository->getOneById($id);
        $result = $this->service->addLike($comment);

        return response()->json($result);
    }
}
