<?php

namespace App\Services;

use App\Repositories\Interfaces\GuruRepositoryInterface;

class GuruService
{
    protected $guruRepository;

    public function __construct(GuruRepositoryInterface $guruRepository)
    {
        $this->guruRepository = $guruRepository;
    }

    public function getAllGuru()
    {
        return $this->guruRepository->all()->load('kelas');
    }

    public function getGuruById($id)
    {
        return $this->guruRepository->find($id);
    }

    public function createGuru(array $data)
    {
        return $this->guruRepository->create($data);
    }

    public function updateGuru($id, array $data)
    {
        return $this->guruRepository->update($id, $data);
    }

    public function deleteGuru($id)
    {
        return $this->guruRepository->delete($id);
    }
}
