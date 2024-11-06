@extends('layouts.app')
@section('title', 'Guru Details')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-secondary">
            <h3 class="card-title">Guru Detail</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3"><strong>Nama:</strong></div>
                <div class="col-md-9">{{ $guru->nama }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>NIP:</strong></div>
                <div class="col-md-9">{{ $guru->nip }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Kelas:</strong></div>
                <div class="col-md-9">{{ $guru->kelas->nama_kelas ?? '-' }}</div>
            </div>

            <div class="mt-4">
                <a href="{{ route('guru.index') }}" class="btn btn-danger btn-sm">Back</a>
                <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-primary btn-sm">
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
