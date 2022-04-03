<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return Comment::class;
    }

    public function getQuery()
    {
        return $this->model->query()->with(['user', 'reply'])->select(['comment.*']);
    }

    public function getOneById($id): ?Model
    {
        return $this->getQuery()->where('id', $id)->first();
    }

    public function create(array $data): ?Comment
    {
        $data['assign_id'] = $data['postId'];
        $data['text'] = $data['commentText'];
        if (isset($data['commentId'])) {
            $data['reply_id'] = $data['commentId'];
        }

        return $this->model->create($data);
    }

}
