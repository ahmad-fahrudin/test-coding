@extends('layouts.app')
@section('title', 'Data Guru')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="card-title fs-4">Data Guru</h1>
        </div>
        <div class="card-body">
            <div class="card-toolbar mb-3">
                <button type="button" class="btn btn-bg-primary btn-sm text-white" data-bs-toggle="modal"
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
    @include('guru.modal-show')
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
                let nip = $(this).data('nip');
                let kelas_id = $(this).data('kelas_id');

                // Pastikan semua field form terisi dengan data yang benar
                $('#edit_id').val(id);
                $('#edit_nama').val(nama);
                $('#edit_nip').val(nip);
                $('#edit_kelas_id').val(kelas_id);
            });

            // Ketika tombol Show ditekan
            $(document).on('click', '.show-btn', function() {
                let nama = $(this).data('nama');
                let nip = $(this).data('nip');
                let kelas = $(this).data('kelas');

                // Isi data ke dalam Show Modal
                $('#show_nama').val(nama);
                $('#show_nip').val(nip);
                $('#show_kelas').val(kelas);
            });

            // Fungsi Create dengan Toastr
            $('#createForm').on('submit', function(e) {
                e.preventDefault();

                // Kosongkan pesan error sebelumnya
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                $.ajax({
                    url: '{{ route('guru.store') }}',
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
                    url: '/guru/' + id,
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
                        url: '/guru/' + id,
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
