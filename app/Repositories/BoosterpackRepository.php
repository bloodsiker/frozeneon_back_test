<?php

namespace App\Repositories;

use App\Models\Boosterpack;
use Illuminate\Database\Eloquent\Model;

class BoosterpackRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return Boosterpack::class;
    }

    public function getQuery()
    {
        return $this->model->query()->select(['boosterpack.*']);
    }

    public function getOneById($id): ?Model
    {
        return $this->getQuery()->where('id', $id)->first();
    }
}
