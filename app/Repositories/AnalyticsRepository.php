<?php

namespace App\Repositories;

use App\Models\Analytics;
use Illuminate\Database\Eloquent\Model;

class AnalyticsRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return Analytics::class;
    }

    public function getQuery()
    {
        return $this->model->query()->with(['user'])->select(['analytics.*']);
    }

    public function getOneById($id): ?Model
    {
        return $this->getQuery()->where('id', $id)->first();
    }
}
