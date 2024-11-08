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

    public function getKelasWithLimitedSiswa(int $limit)
    {
        return $this->model->with(['siswa' => function ($query) use ($limit) {
            $query->take($limit);
        }])->get();
    }

    public function getKelasWithGuru()
    {
        return $this->model->with('guru')->get();
    }
}
