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
        return view('siswa.index');
    }

    public function getData()
    {
        try {
            $siswa = $this->siswaService->getAllSiswa()->load('kelas');

            return DataTables::of($siswa)
                ->addColumn('action', function ($row) {
                    return '
                <a href="' . route('siswa.show', $row->id) . '" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                <a href="' . route('siswa.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                <form action="' . route('siswa.destroy', $row->id) . '" method="POST" style="display:inline-block;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </form>';
                })
                ->addColumn('kelas.nama_kelas', function ($row) {
                    return $row->kelas->nama_kelas ?? '-';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error fetching siswa data: ' . $e->getMessage());
            toast('Error fetching siswa data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }


    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    public function store(StoreSiswaRequest $request)
    {
        try {
            $this->siswaService->createSiswa($request->validated());
            toast('Siswa created successfully!', 'success')->timerProgressBar();
            return redirect()->route('siswa.index');
        } catch (\Exception $e) {
            Log::error('Error creating siswa: ' . $e->getMessage());
            toast('Error occurred while creating siswa.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function show($id)
    {
        try {
            $siswa = $this->siswaService->getSiswaById($id);
            return view('siswa.show', compact('siswa'));
        } catch (\Exception $e) {
            Log::error('Error fetching siswa details: ' . $e->getMessage());
            toast('Error fetching siswa details.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
            $siswa = $this->siswaService->getSiswaById($id);
            $kelas = Kelas::all();
            return view('siswa.edit', compact('siswa', 'kelas'));
        } catch (\Exception $e) {
            Log::error('Error fetching siswa for editing: ' . $e->getMessage());
            toast('Error fetching siswa for editing.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(UpdateSiswaRequest $request, $id)
    {
        try {
            $this->siswaService->updateSiswa($id, $request->validated());
            toast('Siswa updated successfully!', 'success')->timerProgressBar();
            return redirect()->route('siswa.index');
        } catch (\Exception $e) {
            Log::error('Error updating siswa: ' . $e->getMessage());
            toast('Error occurred while updating siswa.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->siswaService->deleteSiswa($id);
            toast('Siswa deleted successfully!', 'success')->timerProgressBar();
            return redirect()->route('siswa.index');
        } catch (\Exception $e) {
            Log::error('Error deleting siswa: ' . $e->getMessage());
            toast('Error occurred while deleting siswa.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
