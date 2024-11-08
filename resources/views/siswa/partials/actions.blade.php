<button type="button" class="btn btn-bg-warning btn-sm edit-btn" data-id="{{ $siswa->id }}"
    data-nama="{{ $siswa->nama }}" data-nis="{{ $siswa->nis }}" data-kelas_id="{{ $siswa->kelas_id }}"
    data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
<button class="btn btn-sm btn-danger delete-btn" data-id="{{ $siswa->id }}"><i class="fas fa-trash-alt"></i></button>
