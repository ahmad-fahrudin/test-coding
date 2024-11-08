<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    public function guru()
    {
        return $this->hasOne(Guru::class, 'kelas_id');
    }
}
