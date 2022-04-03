<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return Post::class;
    }

    public function getQuery()
    {
        return $this->model->query()->with(['user'])->select(['post.*']);
    }

    public function getOneById($id): ?Model
    {
        return $this->getQuery()->where('id', $id)->first();
    }
}
