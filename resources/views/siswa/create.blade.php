@extends('layouts.app')
@section('title', 'Create Siswa')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Create Siswa</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('siswa.store') }}">
                @csrf

                <!-- Nama Input -->
                <div class="form-group mb-4">
                    <label for="nama" class="required fw-semibold fs-6 mb-2">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}"
                        required placeholder="Enter student name...">
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIS Input -->
                <div class="form-group mb-4">
                    <label for="nis" class="required fw-semibold fs-6 mb-2">NIS:</label>
                    <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis') }}"
                        required placeholder="Enter student NIS...">
                    @error('nis')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kelas Select -->
                <div class="form-group mb-4">
                    <label for="kelas_id" class="fw-semibold fs-6 mb-2">Kelas:</label>
                    <select class="form-control" id="kelas_id" data-control="select2" name="kelas_id">
                        <option value="">-- Select Class --</option>
                        @foreach ($kelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('siswa.index') }}" class="btn btn-danger btn-sm me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
