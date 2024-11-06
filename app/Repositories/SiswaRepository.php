<?php

namespace App\Repositories;

use App\Models\Siswa;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\SiswaRepositoryInterface;

class SiswaRepository extends BaseRepository implements SiswaRepositoryInterface
{
    public function __construct(Siswa $siswa)
    {
        parent::__construct($siswa);
    }
}
