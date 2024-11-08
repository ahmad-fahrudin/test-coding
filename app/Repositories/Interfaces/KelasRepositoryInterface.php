<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseInterface;

interface KelasRepositoryInterface extends BaseInterface
{
    public function getKelasWithLimitedSiswa(int $limit);
    public function getKelasWithGuru();
}
