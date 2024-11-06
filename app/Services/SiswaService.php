<?php

namespace App\Services;

use App\Repositories\Interfaces\SiswaRepositoryInterface;

class SiswaService
{
    protected $siswaRepository;

    public function __construct(SiswaRepositoryInterface $siswaRepository)
    {
        $this->siswaRepository = $siswaRepository;
    }

    public function getAllSiswa()
    {
        return $this->siswaRepository->all()->load('kelas');
    }

    public function getSiswaById($id)
    {
        return $this->siswaRepository->find($id);
    }

    public function createSiswa(array $data)
    {
        return $this->siswaRepository->create($data);
    }

    public function updateSiswa($id, array $data)
    {
        return $this->siswaRepository->update($id, $data);
    }

    public function deleteSiswa($id)
    {
        return $this->siswaRepository->delete($id);
    }
}
