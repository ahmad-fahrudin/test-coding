@extends('layouts.app')
@section('title', 'Edit Kelas')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Edit Kelas</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kelas.update', $kelas->id) }}">
                @csrf
                @method('PUT')

                <!-- Nama Kelas Input -->
                <div class="form-group mb-4">
                    <label for="nama_kelas" class="required fw-semibold fs-6 mb-2">Nama Kelas:</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                        value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required placeholder="Enter class name...">
                    @error('nama_kelas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi Input -->
                <div class="form-group mb-4">
                    <label for="deskripsi" class="fw-semibold fs-6 mb-2">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Enter class description...">{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('kelas.index') }}" class="btn btn-danger btn-sm me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
