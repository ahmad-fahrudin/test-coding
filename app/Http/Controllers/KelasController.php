<?php

namespace App\Http\Controllers;

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
        return view('kelas.index');
    }

    public function getData()
    {
        try {
            $kelas = $this->kelasService->getAllKelas();

            return DataTables::of($kelas)
                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('kelas.show', $row->id) . '" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="' . route('kelas.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form action="' . route('kelas.destroy', $row->id) . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error fetching kelas data: ' . $e->getMessage());
            toast('Error fetching kelas data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(StoreKelasRequest $request)
    {
        try {
            $this->kelasService->createKelas($request->validated());
            toast('Kelas created successfully!', 'success')->timerProgressBar();
            return redirect()->route('kelas.index');
        } catch (\Exception $e) {
            Log::error('Error creating kelas: ' . $e->getMessage());
            toast('Error occurred while creating kelas.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function show($id)
    {
        try {
            $kelas = $this->kelasService->getKelasById($id);
            return view('kelas.show', compact('kelas'));
        } catch (\Exception $e) {
            Log::error('Error fetching kelas details: ' . $e->getMessage());
            toast('Error fetching kelas details.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
            $kelas = $this->kelasService->getKelasById($id);
            return view('kelas.edit', compact('kelas'));
        } catch (\Exception $e) {
            Log::error('Error fetching kelas for editing: ' . $e->getMessage());
            toast('Error fetching kelas for editing.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(UpdateKelasRequest $request, $id)
    {
        try {
            $this->kelasService->updateKelas($id, $request->validated());
            toast('Kelas updated successfully!', 'success')->timerProgressBar();
            return redirect()->route('kelas.index');
        } catch (\Exception $e) {
            Log::error('Error updating kelas: ' . $e->getMessage());
            toast('Error occurred while updating kelas.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->kelasService->deleteKelas($id);
            toast('Kelas deleted successfully!', 'success')->timerProgressBar();
            return redirect()->route('kelas.index');
        } catch (\Exception $e) {
            Log::error('Error deleting kelas: ' . $e->getMessage());
            toast('Error occurred while deleting kelas.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
