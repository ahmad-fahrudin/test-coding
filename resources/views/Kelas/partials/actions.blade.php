    <button type="button" class="btn btn-bg-warning btn-sm edit-btn" data-id="{{ $kelas->id }}"
        data-nama_kelas="{{ $kelas->nama_kelas }}" data-deskripsi="{{ $kelas->deskripsi }}" data-bs-toggle="modal"
        data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
    <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $kelas->id }}"><i
            class="fas fa-trash-alt"></i></button>
