<button type="button" class="btn btn-bg-warning btn-sm edit-btn" data-id="{{ $guru->id }}"
    data-nama="{{ $guru->nama }}" data-nip="{{ $guru->nip }}" data-kelas_id="{{ $guru->kelas_id }}"
    data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit text-white"></i></button>
<button class="btn btn-sm btn-danger delete-btn" data-id="{{ $guru->id }}"><i class="fas fa-trash-alt"></i></button>
