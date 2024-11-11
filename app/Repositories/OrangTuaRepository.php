<?php

namespace App\Repositories;

use App\Models\OrangTua;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\OrangTuaRepositoryInterface;

class OrangTuaRepository extends BaseRepository implements OrangTuaRepositoryInterface
{
    public function __construct(OrangTua $orangTua)
    {
        parent::__construct($orangTua);
    }
}
