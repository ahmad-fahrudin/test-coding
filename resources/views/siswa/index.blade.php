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
    @include('siswa.scripts')
@endsection
