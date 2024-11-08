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
        return view('guru.index');
    }

    public function getData()
    {
        try {
            $guru = $this->guruService->getAllGuru()->load('kelas');

            return DataTables::of($guru)
                ->addColumn('action', function ($row) {
                    return '
                <a href="' . route('guru.show', $row->id) . '" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                <a href="' . route('guru.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                <form action="' . route('guru.destroy', $row->id) . '" method="POST" style="display:inline-block;">
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
            Log::error('Error fetching guru data: ' . $e->getMessage());
            toast('Error fetching guru data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function create()
    {
        $kelas = Kelas::whereDoesntHave('guru')->get();
        return view('guru.create', compact('kelas'));
    }

    public function store(StoreGuruRequest $request)
    {
        try {
            $this->guruService->createGuru($request->validated());
            toast('Guru created successfully!', 'success')->timerProgressBar();
            return redirect()->route('guru.index');
        } catch (\Exception $e) {
            Log::error('Error creating guru: ' . $e->getMessage());
            toast('Error occurred while creating guru.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function show($id)
    {
        try {
            $guru = $this->guruService->getGuruById($id);
            return view('guru.show', compact('guru'));
        } catch (\Exception $e) {
            Log::error('Error fetching guru details: ' . $e->getMessage());
            toast('Error fetching guru details.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
            $guru = $this->guruService->getGuruById($id);
            $kelas = Kelas::whereDoesntHave('guru')
                ->orWhere('id', $guru->kelas_id) // Tambahkan kelas yang saat ini dipegang oleh guru ini
                ->get();
            return view('guru.edit', compact('guru', 'kelas'));
        } catch (\Exception $e) {
            Log::error('Error fetching guru for editing: ' . $e->getMessage());
            toast('Error fetching guru for editing.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(UpdateGuruRequest $request, $id)
    {
        try {
            $this->guruService->updateGuru($id, $request->validated());
            toast('Guru updated successfully!', 'success')->timerProgressBar();
            return redirect()->route('guru.index');
        } catch (\Exception $e) {
            Log::error('Error updating guru: ' . $e->getMessage());
            toast('Error occurred while updating guru.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->guruService->deleteGuru($id);
            toast('Guru deleted successfully!', 'success')->timerProgressBar();
            return redirect()->route('guru.index');
        } catch (\Exception $e) {
            Log::error('Error deleting guru: ' . $e->getMessage());
            toast('Error occurred while deleting guru.', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
