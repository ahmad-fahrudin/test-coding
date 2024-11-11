<?php

namespace App\Services;

use App\Repositories\Interfaces\OrangTuaRepositoryInterface;


class OrangTuaService
{
    protected $orangTuaRepository;

    public function __construct(OrangTuaRepositoryInterface $orangTuaRepository)
    {
        $this->orangTuaRepository =  $orangTuaRepository;
    }

    public function getAllOrangTua()
    {
        return $this->orangTuaRepository->all()->load('siswa');
    }

    public function getOrangTuaById($id)
    {
        return $this->orangTuaRepository->find($id);
    }

    public function createOrangTua(array $data)
    {
        return $this->orangTuaRepository->create($data);
    }

    public function updateOrangTua($id, array $data)
    {
        return $this->orangTuaRepository->update($id, $data);
    }

    public function deleteOrangTua($id)
    {
        return $this->orangTuaRepository->delete($id);
    }
}
