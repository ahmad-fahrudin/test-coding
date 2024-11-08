<!-- Show Modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Detail Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="show_nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" id="show_nama_kelas" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="show_deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="show_deskripsi" class="form-control" rows="3" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
