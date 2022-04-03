<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    abstract public function getModelClass(): string;

    public function setModel($model_path): void
    {
        $this->model = app($model_path);
    }

    public function __construct()
    {
        $this->setModel($this->getModelClass());
    }

    public function getOneById($id): ?Model
    {
        return $this->model->find($id);
    }

    public function getByIds(array $ids): Collection
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getQuery()
    {
        return $this->model->query();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        $item->delete();
    }

    public function copyByIds(array $ids)
    {
        foreach ($ids as $id) {
            $item = $this->model->find($id);
            $newItem = $item->replicate();
            $newItem->save();
        }
    }

    public function deleteByIds(array $ids)
    {
        foreach ($ids as $id) {
            $this->delete($id);
        }
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }

    public function getCount()
    {
        return $this->model->count();
    }
}
