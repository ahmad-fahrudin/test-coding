<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
    </button>
    <ul class="dropdown-menu">
        <li>
            <button type="button" class="dropdown-item show-btn" data-id="{{ $orangTua->id }}"
                data-nama="{{ $orangTua->nama }}" data-nama_siswa="{{ $orangTua->siswa->nama ?? '-' }}"
                {{-- Pastikan nama siswa ada --}} data-bs-toggle="modal" data-bs-target="#showModal">
                <i class="fas fa-eye me-2"></i>Show
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item edit-btn" data-id="{{ $orangTua->id }}"
                data-nama="{{ $orangTua->nama }}" data-siswa_id="{{ $orangTua->siswa->id ?? '' }}"
                data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit me-2"></i>Edit
            </button>
        </li>
        <li>
            <button class="dropdown-item text-danger delete-btn" data-id="{{ $orangTua->id }}">
                <i class="fas fa-trash-alt me-2"></i>Delete
            </button>
        </li>
    </ul>
</div>
