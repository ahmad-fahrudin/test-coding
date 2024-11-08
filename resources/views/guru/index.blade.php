@extends('layouts.app')
@section('title', 'Data Guru')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="card-title fs-4">Data Guru</h1>
        </div>
        <div class="card-body">
            <div class="card-toolbar mb-3">
                <button type="button" class="btn btn-bg-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#createModal">Tambah Baru</button>
            </div>

            <div class="card card-p-0 card-flush">
                <div class="card-body p-2">
                    <table class="table align-middle border rounded table-sm fs-7" id="guru-table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold text-uppercase">
                                <th class="px-2 text-center">Id</th>
                                <th class="px-2 text-start">Nama</th>
                                <th class="px-2 text-start">NIP</th>
                                <th class="px-2 text-start">Kelas</th>
                                <th class="px-2 text-end">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('guru.modal-create')
    @include('guru.modal-edit')
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            console.log("Document ready");

            // Inisialisasi DataTable
            let table = $("#guru-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('guru.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'kelas.nama_kelas',
                        name: 'kelas.nama_kelas'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Kosongkan form di dalam Create Modal ketika modal ditutup
            $('#createModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

            // Ketika tombol Edit ditekan
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let nip = $(this).data('nip');
                let kelas_id = $(this).data('kelas_id');

                // Pastikan semua field form terisi dengan data yang benar
                $('#edit_id').val(id);
                $('#edit_nama').val(nama);
                $('#edit_nip').val(nip);
                $('#edit_kelas_id').val(kelas_id);
            });

            // Fungsi Update
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit_id').val(); // Pastikan id diambil dengan benar dari form
                $.ajax({
                    url: '/guru/' + id,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#editModal').modal('hide'); // Tutup modal setelah update
                            table.ajax.reload(null,
                            false); // Reload data tabel tanpa refresh halaman
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr.responseText);
                    }
                });
            });


            // Fungsi Delete
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/guru/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log("Delete success response:", response);

                            if (response.status === 'success') {
                                table.ajax.reload(null, false);
                            }
                            alert(response.message);
                        }
                    });
                }
            });

            // Fungsi Create
            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                console.log("Create form submit triggered");

                $.ajax({
                    url: '{{ route('guru.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log("Create success response:", response);

                        if (response.status === 'success') {
                            $('#createModal').modal('hide');
                            table.ajax.reload(null, false);
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log("Create error:", xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
