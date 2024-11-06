<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected Model $model;

    public function __construct(Model $instance)
    {
        $this->model = $instance;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id): ?Model
    {
        return $this->model->find($id) ?? null;
    }

    public function create(array $data): Model|null
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): ?Model
    {
        $instance = $this->model->find($id);
        if ($instance) {
            $instance->update($data);
            return $instance;
        }
        return null;
    }

    public function delete($id): bool
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}
