@extends('layouts.app')
@section('title', 'Kelas Details')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-secondary">
            <h3 class="card-title">Kelas Detail</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3"><strong>Nama Kelas:</strong></div>
                <div class="col-md-9">{{ $kelas->nama_kelas }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Deskripsi:</strong></div>
                <div class="col-md-9">{{ $kelas->deskripsi }}</div>
            </div>

            <div class="mt-4">
                <a href="{{ route('kelas.index') }}" class="btn btn-danger btn-sm">Back</a>
                <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-primary btn-sm">
                    Edit</i>
                </a>
            </div>
        </div>
    </div>
@endsection
