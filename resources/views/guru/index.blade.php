@extends('layouts.app')
@section('title', 'Data Guru')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="card-title fs-4">Data Guru</h1>
        </div>
        <div class="card-body">
            <div class="card-toolbar mb-3">
                <a href="{{ route('guru.create') }}" class="btn btn-bg-primary btn-sm">Tambah Baru</a>
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
@endsection

@section('page_script')
    <script>
        $(function() {
            $('#guru-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('guru.data') !!}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center'
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
                    }, // Menampilkan nama kelas
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-end'
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });
        });
    </script>
@endsection
