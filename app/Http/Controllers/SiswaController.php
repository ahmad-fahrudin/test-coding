<?php

namespace App\Http\Controllers;

use App\Services\SiswaService;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Siswa\StoreSiswaRequest;
use App\Http\Requests\Siswa\UpdateSiswaRequest;
use App\Models\Kelas;

class SiswaController extends Controller
{
    protected $siswaService;

    public function __construct(SiswaService $siswaService)
    {
        $this->siswaService = $siswaService;
    }

    public function index()
    {
        if (request()->ajax()) {
            $siswa = $this->siswaService->getAllSiswa();

            return DataTables::of($siswa)
                ->addColumn('kelas.nama_kelas', function ($siswa) {
                    return $siswa->kelas ? $siswa->kelas->nama_kelas : '-';
                })
                ->addColumn('actions', function ($siswa) {
                    return view('siswa.partials.actions', compact('siswa'))->render();
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        $kelas = Kelas::all();
        return view('siswa.index', compact('kelas'));
    }


    public function store(StoreSiswaRequest $request)
    {
        try {
            $siswa = $this->siswaService->createSiswa($request->validated());
            return response()->json(['status' => 'success', 'message' => 'Siswa created successfully!', 'data' => $siswa]);
        } catch (\Exception $e) {
            Log::error('Error creating siswa: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error occurred while creating siswa.']);
        }
    }

    public function update(UpdateSiswaRequest $request, $id)
    {
        try {
            $siswa = $this->siswaService->updateSiswa($id, $request->validated());
            return response()->json(['status' => 'success', 'message' => 'Siswa updated successfully!', 'data' => $siswa]);
        } catch (\Exception $e) {
            Log::error('Error updating siswa: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error occurred while updating siswa.']);
        }
    }

    public function destroy($id)
    {
        try {
            $this->siswaService->deleteSiswa($id);
            return response()->json(['status' => 'success', 'message' => 'Siswa deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting siswa: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error occurred while deleting siswa.']);
        }
    }
}
