<?php

namespace App\Repositories;

use App\Models\Kelas;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\KelasRepositoryInterface;

class KelasRepository extends BaseRepository implements KelasRepositoryInterface
{
    public function __construct(Kelas $kelas)
    {
        parent::__construct($kelas);
    }
}
