<button type="button" class="btn btn-bg-primary btn-sm edit-btn" data-id="{{ $guru->id }}"
    data-nama="{{ $guru->nama }}" data-nip="{{ $guru->nip }}" data-kelas_id="{{ $guru->kelas_id }}"
    data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
<button class="btn btn-sm btn-danger delete-btn" data-id="{{ $guru->id }}">Delete</button>
