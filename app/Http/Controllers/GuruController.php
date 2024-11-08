<?php

namespace App\Http\Controllers;

use App\Services\GuruService;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Guru\StoreGuruRequest;
use App\Http\Requests\Guru\UpdateGuruRequest;
use App\Models\Kelas;

class GuruController extends Controller
{
    protected $guruService;

    public function __construct(GuruService $guruService)
    {
        $this->guruService = $guruService;
    }

    public function index()
    {
        if (request()->ajax()) {
            $guru = $this->guruService->getAllGuru();

            return DataTables::of($guru)
                ->addColumn('kelas.nama_kelas', function ($guru) {
                    return $guru->kelas ? $guru->kelas->nama_kelas : '-';
                })
                ->addColumn('actions', function ($guru) {
                    return view('guru.partials.actions', compact('guru'))->render();
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        $kelas = Kelas::all();
        return view('guru.index', compact('kelas'));
    }

    public function store(StoreGuruRequest $request)
    {
        try {
            $guru = $this->guruService->createGuru($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Guru created successfully!',
                'data' => $guru
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating guru: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while creating guru.'
            ], 500);
        }
    }

    public function update(UpdateGuruRequest $request, $id)
    {
        try {
            $guru = $this->guruService->updateGuru($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Guru updated successfully!',
                'data' => $guru
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating guru: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while updating guru.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->guruService->deleteGuru($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Guru deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting guru: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while deleting guru.'
            ], 500);
        }
    }
}
