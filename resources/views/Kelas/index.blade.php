@extends('layouts.app')
@section('title', 'Data Kelas')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="card-title fs-4">Data Kelas</h1>
        </div>
        <div class="card-body">
            <div class="card-toolbar mb-3">
                <button type="button" class="btn btn-bg-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#createModal">Tambah Baru</button>
            </div>

            <div class="card card-p-0 card-flush">
                <div class="card-body p-2">
                    <table class="table align-middle border rounded table-sm fs-7" id="kt_datatable_zero_configuration">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold text-uppercase">
                                <th class="px-2 text-center">No</th>
                                <th class="px-2 text-start">Nama Kelas</th>
                                <th class="px-2 text-start">Deskripsi</th>
                                <th class="px-2 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kelas }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-bg-primary btn-sm edit-btn"
                                            data-id="{{ $item->id }}" data-nama_kelas="{{ $item->nama_kelas }}"
                                            data-deskripsi="{{ $item->deskripsi }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal">Edit</button>
                                        <button class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $item->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('kelas.modal')
                @include('kelas.modal-edit')
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            let table = $("#kt_datatable_zero_configuration").DataTable();

            // Kosongkan form di dalam Create Modal ketika modal ditutup
            $('#createModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

            // Populasi data pada Edit Modal ketika tombol edit ditekan
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let nama_kelas = $(this).data('nama_kelas');
                let deskripsi = $(this).data('deskripsi');

                // Isi form Edit Modal dengan data yang sesuai
                $('#edit_id').val(id);
                $('#edit_nama_kelas').val(nama_kelas);
                $('#edit_deskripsi').val(deskripsi);
            });

            // Delete functionality
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
                                table.row($(`tr[data-id="${id}"]`)).remove().draw(false);
                            }
                            alert(response.message);
                        }
                    });
                }
            });

            // Create Data
            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('kelas.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#createModal').modal('hide');
                            table.row.add([
                                response.data.id,
                                response.data.nama_kelas,
                                response.data.deskripsi,
                                `<button type="button" class="btn btn-bg-primary btn-sm edit-btn" data-id="${response.data.id}" data-nama_kelas="${response.data.nama_kelas}" data-deskripsi="${response.data.deskripsi}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                 <button class="btn btn-sm btn-danger delete-btn" data-id="${response.data.id}">Delete</button>`
                            ]).draw(false);
                        }
                        alert(response.message);
                    }
                });
            });

            // Update data via Edit form submission
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();
                $.ajax({
                    url: '/kelas/' + id,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#editModal').modal('hide');
                            table.row($(`tr[data-id="${id}"]`)).data([
                                response.data.id,
                                response.data.nama_kelas,
                                response.data.deskripsi,
                                `<button type="button" class="btn btn-bg-primary btn-sm edit-btn" data-id="${response.data.id}" data-nama_kelas="${response.data.nama_kelas}" data-deskripsi="${response.data.deskripsi}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                 <button class="btn btn-sm btn-danger delete-btn" data-id="${response.data.id}">Delete</button>`
                            ]).draw(false);
                        }
                        alert(response.message);
                    }
                });
            });
        });
    </script>
@endsection
