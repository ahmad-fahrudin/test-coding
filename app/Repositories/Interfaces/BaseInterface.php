<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseInterface
{
    public function all(): Collection;
    public function find($id): Model|null;
    public function create(array $data): Model|null;
    public function update($id, array $data): Model|null;
    public function delete($id): bool;
}
