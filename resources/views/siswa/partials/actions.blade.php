<button type="button" class="btn btn-bg-primary btn-sm edit-btn" data-id="{{ $siswa->id }}"
    data-nama="{{ $siswa->nama }}" data-nis="{{ $siswa->nis }}" data-kelas_id="{{ $siswa->kelas_id }}"
    data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
<button class="btn btn-sm btn-danger delete-btn" data-id="{{ $siswa->id }}">Delete</button>
