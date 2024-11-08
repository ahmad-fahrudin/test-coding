<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Services\KelasService;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Kelas\StoreKelasRequest;
use App\Http\Requests\Kelas\UpdateKelasRequest;

class KelasController extends Controller
{
    protected $kelasService;

    public function __construct(KelasService $kelasService)
    {
        $this->kelasService = $kelasService;
    }

    public function index()
    {
        if (request()->ajax()) {
            $kelas = Kelas::select(['id', 'nama_kelas', 'deskripsi']);

            return DataTables::of($kelas)
                ->addColumn('actions', function ($kelas) {
                    return view('kelas.partials.actions', compact('kelas'))->render();
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('kelas.index');
    }

    public function store(StoreKelasRequest $request)
    {
        try {
            $kelas = $this->kelasService->createKelas($request->validated());
            return response()->json(['status' => 'success', 'message' => 'Kelas created successfully!', 'data' => $kelas]);
        } catch (\Exception $e) {
            Log::error('Error creating kelas: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error occurred while creating kelas.']);
        }
    }

    public function update(UpdateKelasRequest $request, $id)
    {
        try {
            $kelas = $this->kelasService->updateKelas($id, $request->validated());
            return response()->json(['status' => 'success', 'message' => 'Kelas updated successfully!', 'data' => $kelas]);
        } catch (\Exception $e) {
            Log::error('Error updating kelas: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error occurred while updating kelas.']);
        }
    }

    public function destroy($id)
    {
        try {
            $this->kelasService->deleteKelas($id);
            return response()->json(['status' => 'success', 'message' => 'Kelas deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting kelas: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error occurred while deleting kelas.']);
        }
    }

    public function siswaByKelas()
    {
        $kelasList = $this->kelasService->getKelasWithLimitedSiswa(10);
        return view('siswa.list_by_kelas', compact('kelasList'));
    }

    public function guruByKelas()
    {
        $kelasList = $this->kelasService->getKelasWithGuru();
        return view('guru.list_by_kelas', compact('kelasList'));
    }

    public function kelasList()
    {
        // Mengambil semua data kelas beserta relasi guru dan hanya 10 siswa pertama
        $kelasList = Kelas::with([
            'guru',
            'siswa' => function ($query) {
                $query->take(10); // Mengambil hanya 10 siswa pertama untuk setiap kelas
            }
        ])->get();

        // Mengarahkan ke view dengan data kelas
        return view('kelas.list_kelas', compact('kelasList'));
    }
}
