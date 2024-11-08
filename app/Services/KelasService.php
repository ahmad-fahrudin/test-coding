<?php

namespace App\Services;

use App\Repositories\Interfaces\KelasRepositoryInterface;

class KelasService
{
    protected $kelasRepository;

    public function __construct(KelasRepositoryInterface $kelasRepository)
    {
        $this->kelasRepository = $kelasRepository;
    }

    public function getAllKelas()
    {
        return $this->kelasRepository->all();
    }

    public function getKelasById($id)
    {
        return $this->kelasRepository->find($id);
    }

    public function createKelas(array $data)
    {
        return $this->kelasRepository->create($data);
    }

    public function updateKelas($id, array $data)
    {
        return $this->kelasRepository->update($id, $data);
    }

    public function deleteKelas($id)
    {
        return $this->kelasRepository->delete($id);
    }

    public function getKelasWithLimitedSiswa(int $limit = 10)
    {
        return $this->kelasRepository->getKelasWithLimitedSiswa($limit);
    }

    public function getKelasWithGuru()
    {
        return $this->kelasRepository->getKelasWithGuru();
    }
}
