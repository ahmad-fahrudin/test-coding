<?php

namespace App\Repositories;

use App\Models\Guru;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\GuruRepositoryInterface;

class GuruRepository extends BaseRepository implements GuruRepositoryInterface
{
    public function __construct(Guru $guru)
    {
        parent::__construct($guru);
    }
}
