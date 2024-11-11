<?php

namespace App\Http\Controllers;

use App\Services\OrangTuaService;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\OrangTua\StoreOrangTuaRequest;
use App\Http\Requests\OrangTua\UpdateOrangTuaRequest;
use App\Models\Siswa;

class OrangTuaController extends Controller
{
    protected $orangTuaService;

    public function __construct(OrangTuaService $orangTuaService)
    {
        $this->orangTuaService = $orangTuaService;
    }

    public function index()
    {
        if (request()->ajax()) {
            $orangTua = $this->orangTuaService->getAllOrangTua();

            return DataTables::of($orangTua)
                ->addColumn('actions', function ($orangTua) {
                    return view('orang-tua.partials.actions', compact('orangTua'))->render();
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        $siswas = Siswa::all();
        return view('orang-tua.index', compact('siswas'));
    }

    public function store(StoreOrangTuaRequest $request)
    {
        try {
            $orangTua = $this->orangTuaService->createOrangTua($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Orang Tua created successfully!',
                'data' => $orangTua
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating orang tua: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while creating orang tua.'
            ], 500);
        }
    }

    public function update(UpdateOrangTuaRequest $request, $id)
    {
        try {
            $orangTua = $this->orangTuaService->updateOrangTua($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Orang Tua updated successfully!',
                'data' => $orangTua
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating orang tua: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while updating orang tua.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->orangTuaService->deleteOrangTua($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Orang Tua deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting orang tua: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while deleting orang tua.'
            ], 500);
        }
    }
}
