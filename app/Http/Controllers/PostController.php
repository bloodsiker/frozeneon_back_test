<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Services\LikeService;

class PostController extends Controller
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
     * @param  PostRepository  $postRepository
     * @param  LikeService     $likeService
     */
    public function __construct(PostRepository $postRepository, LikeService $likeService)
    {
        $this->repository = $postRepository;
        $this->service = $likeService;
    }

    /**
     * @return PostCollection
     */
    public function allPosts()
    {
        $posts = $this->repository->getAll();

        return new PostCollection($posts);
    }

    /**
     * @param  int  $id
     *
     * @return PostResource
     */
    public function getPost(int $id)
    {
        $post = $this->repository->getOneById($id);

        return new PostResource($post);
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addLike(int $id)
    {
        // TODO: task 3, лайк поста

        $post = $this->repository->getOneById($id);
        $result = $this->service->addLike($post);

        return response()->json($result);
    }
}
