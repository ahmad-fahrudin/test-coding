@extends('layouts.app')
@section('title', 'Data Orang Tua')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="card-title fs-4">Data Orang Tua</h1>
        </div>
        <div class="card-body">
            <div class="card-toolbar mb-3">
                <button type="button" class="btn btn-bg-primary btn-sm text-white" data-bs-toggle="modal"
                    data-bs-target="#createModal">Tambah Baru</button>
            </div>

            <div class="card card-p-0 card-flush">
                <div class="card-body p-2">
                    <table class="table align-middle border rounded table-sm fs-7" id="orang-tua-table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold text-uppercase">
                                <th class="px-2 text-center">Id</th>
                                <th class="px-2 text-start">Nama</th>
                                <th class="px-2 text-start">Siswa</th>
                                <th class="px-2 text-end">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('orang-tua.modals.modal-create')
    @include('orang-tua.modals.modal-edit')
    @include('orang-tua.modals.modal-show')
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            let table = $("#orang-tua-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orang_tua.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'siswa.nama',
                        name: 'siswa.nama'
                    }, // Assuming 'siswa' relationship
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'text-end'
                    }
                ]
            });

            // Clear form and errors on modal close
            $('#createModal, #editModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

            // Set data in Edit Modal when Edit button is clicked
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let siswa_id = $(this).data('siswa_id');

                $('#edit_id').val(id);
                $('#edit_nama').val(nama);
                $('#edit_siswa_id').val(siswa_id);
            });

            // Set data in Show Modal when Show button is clicked
            $(document).on('click', '.show-btn', function() {
                let nama = $(this).data('nama');
                let nama_siswa = $(this).data('nama_siswa');

                $('#show_nama').val(nama);
                $('#show_nama_siswa').val(nama_siswa);
            });

            // AJAX Create
            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                $.ajax({
                    url: '{{ route('orang_tua.store') }}',
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

            // AJAX Update
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                $.ajax({
                    url: '/orang-tua/' + id,
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

            // AJAX Delete
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/orang-tua/' + id,
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
        });
    </script>

@endsection
