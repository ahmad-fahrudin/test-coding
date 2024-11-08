    <button type="button" class="btn btn-bg-primary btn-sm edit-btn" data-id="{{ $kelas->id }}"
        data-nama_kelas="{{ $kelas->nama_kelas }}" data-deskripsi="{{ $kelas->deskripsi }}" data-bs-toggle="modal"
        data-bs-target="#editModal">Edit</button>
    <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $kelas->id }}">Delete</button>
