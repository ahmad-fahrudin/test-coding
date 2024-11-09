@extends('layouts.app')
@section('title', 'Data Siswa')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="card-title fs-4">Data Siswa</h1>
        </div>
        <div class="card-body">
            <div class="card-toolbar mb-3">
                <button type="button" class="btn btn-bg-primary btn-sm text-white" data-bs-toggle="modal"
                    data-bs-target="#createModal">Tambah Baru</button>
            </div>

            <div class="card card-p-0 card-flush">
                <div class="card-body p-2">
                    <table class="table align-middle border rounded table-sm fs-7" id="siswa-table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold text-uppercase">
                                <th class="px-2 text-center">No</th>
                                <th class="px-2 text-start">Nama</th>
                                <th class="px-2 text-start">NIS</th>
                                <th class="px-2 text-start">Kelas</th>
                                <th class="px-2 text-end">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('siswa.modals.modal')
    @include('siswa.modals.modal-edit')
    @include('siswa.modals.modal-show')
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable dengan server-side processing
            let table = $("#siswa-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('siswa.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'kelas.nama_kelas',
                        name: 'kelas.nama_kelas'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'text-end'
                    }
                ]
            });

            // Kosongkan form di dalam Create Modal ketika modal ditutup
            $('#createModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

            // Kosongkan form di dalam Edit Modal ketika modal ditutup
            $('#editModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

            // Ketika tombol Edit ditekan
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let nis = $(this).data('nis');
                let kelas_id = $(this).data('kelas_id');

                $('#edit_id').val(id);
                $('#edit_nama').val(nama);
                $('#edit_nis').val(nis);
                $('#edit_kelas_id').val(kelas_id);
            });

            // Ketika tombol Show ditekan
            $(document).on('click', '.show-btn', function() {
                let nama = $(this).data('nama');
                let nis = $(this).data('nis');
                let kelas = $(this).data('kelas');

                $('#show_nama').val(nama);
                $('#show_nis').val(nis);
                $('#show_kelas').val(kelas);
            });

            // Fungsi Delete dengan Toastr
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/siswa/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                table.ajax.reload(null, false);
                                toastr.success(response.message, 'Deleted');
                            } else {
                                toastr.warning(response.message, 'Warning');
                            }
                        },
                        error: function(xhr) {
                            toastr.error(
                                'An unexpected error occurred. Please try again later.',
                                'Error');
                        }
                    });
                }
            });

            // Fungsi Create dengan Toastr
            $('#createForm').on('submit', function(e) {
                e.preventDefault();

                // Kosongkan pesan error sebelumnya
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                $.ajax({
                    url: '{{ route('siswa.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#createModal').modal('hide');
                            table.ajax.reload(null, false);
                            toastr.success(response.message, 'Success');
                        } else {
                            toastr.warning(response.message, 'Warning');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                let input = $(`[name="${key}"]`);
                                input.addClass('is-invalid');
                                input.after(
                                    `<div class="invalid-feedback">${errors[key][0]}</div>`);
                            }
                            toastr.error('Please correct the highlighted errors and try again.',
                                'Validation Error');
                        } else {
                            toastr.error(
                                'An unexpected error occurred. Please try again later.',
                                'Error');
                        }
                    }
                });
            });

            // Fungsi Update dengan Toastr
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();

                // Kosongkan pesan error sebelumnya
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                $.ajax({
                    url: '/siswa/' + id,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#editModal').modal('hide');
                            table.ajax.reload(null, false);
                            toastr.success(response.message, 'Updated');
                        } else {
                            toastr.warning(response.message, 'Warning');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                let input = $(`[name="${key}"]`);
                                input.addClass('is-invalid');
                                input.after(
                                    `<div class="invalid-feedback">${errors[key][0]}</div>`);
                            }
                            toastr.error('Please correct the highlighted errors and try again.',
                                'Validation Error');
                        } else {
                            toastr.error(
                                'An unexpected error occurred. Please try again later.',
                                'Error');
                        }
                    }
                });
            });
        });
    </script>
@endsection
