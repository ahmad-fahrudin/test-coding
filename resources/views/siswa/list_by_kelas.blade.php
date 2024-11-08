@extends('layouts.app')
@section('title', 'List Siswa Berdasarkan Kelas')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="card-title fs-4">List Siswa Berdasarkan Kelas</h1>
        </div>
        <div class="card-body">
            <div class="card card-p-0 card-flush">
                <div class="card-body p-2">
                    <table class="table align-middle border rounded table-sm fs-7" id="kelas_siswa_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold text-uppercase">
                                <th class="px-2 text-center">No</th>
                                <th class="px-2 text-start">Nama Kelas</th>
                                <th class="px-2 text-start">Data Siswa</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($kelasList as $index => $kelas)
                                <tr>
                                    <td class="px-2 text-center">{{ $index + 1 }}</td>
                                    <td class="px-2 text-start">{{ $kelas->nama_kelas }}</td>
                                    <td class="px-2 text-start">
                                        @if ($kelas->siswa->isEmpty())
                                            <span class="badge bg-secondary">Tidak ada siswa di kelas ini</span>
                                        @else
                                            <ul>
                                                @foreach ($kelas->siswa as $siswa)
                                                    <li>{{ $siswa->nama }} (NIS: {{ $siswa->nis }})</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            $('#kelas_siswa_table').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    </script>
@endsection
