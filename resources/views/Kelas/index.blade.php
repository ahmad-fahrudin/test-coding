@extends('layouts.app')
@section('title', 'Data Kelas')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="card-title fs-4">Data Kelas</h1>
        </div>
        <div class="card-body">
            <div class="card-toolbar mb-3">
                <button type="button" class="btn btn-bg-primary btn-sm text-white" data-bs-toggle="modal"
                    data-bs-target="#createModal">Tambah Baru</button>
            </div>

            <div class="card card-p-0 card-flush">
                <div class="card-body p-2">
                    <table class="table align-middle border rounded table-sm fs-7" id="kelas-table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold text-uppercase">
                                <th class="px-2 text-center">Id</th>
                                <th class="px-2 text-start">Nama Kelas</th>
                                <th class="px-2 text-start">Deskripsi</th>
                                <th class="px-2 text-end">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('kelas.modal-create')
    @include('kelas.modal-edit')
    @include('kelas.modal-show')
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            let table = $("#kelas-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kelas.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_kelas',
                        name: 'nama_kelas'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
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
                let nama_kelas = $(this).data('nama_kelas');
                let deskripsi = $(this).data('deskripsi');

                $('#edit_id').val(id);
                $('#edit_nama_kelas').val(nama_kelas);
                $('#edit_deskripsi').val(deskripsi);
            });

            // Ketika tombol Show ditekan
            $(document).on('click', '.show-btn', function() {
                let nama_kelas = $(this).data('nama_kelas');
                let deskripsi = $(this).data('deskripsi');

                $('#show_nama_kelas').val(nama_kelas);
                $('#show_deskripsi').val(deskripsi);
            });

            // Fungsi Update dengan Toastr
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();

                // Kosongkan pesan error sebelumnya
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                $.ajax({
                    url: '/kelas/' + id,
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

            // Fungsi Delete dengan Toastr
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/kelas/' + id,
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
                    url: '{{ route('kelas.store') }}',
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
        });
    </script>
@endsection
