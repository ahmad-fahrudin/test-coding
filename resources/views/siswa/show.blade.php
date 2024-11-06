@extends('layouts.app')
@section('title', 'Siswa Details')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-secondary">
            <h3 class="card-title">Siswa Detail</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3"><strong>Nama:</strong></div>
                <div class="col-md-9">{{ $siswa->nama }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>NIS:</strong></div>
                <div class="col-md-9">{{ $siswa->nis }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Kelas:</strong></div>
                <div class="col-md-9">{{ $siswa->kelas->nama_kelas ?? '-' }}</div>
            </div>

            <div class="mt-4">
                <a href="{{ route('siswa.index') }}" class="btn btn-danger btn-sm">Back</a>
                <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-primary btn-sm">
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
