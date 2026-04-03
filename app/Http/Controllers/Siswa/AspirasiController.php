<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAspirasiRequest;
use App\Http\Requests\UpdateOwnAspirasiRequest;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AspirasiController extends Controller
{
    public function index(): View
    {
        $nis = Auth::guard('siswa')->id();

        $aspirasis = Aspirasi::query()
            ->with(['kategori', 'latestProgress'])
            ->where('nis', $nis)
            ->latest()
            ->paginate(10);

        $ringkasan = [
            'total' => Aspirasi::query()->where('nis', $nis)->count(),
            'menunggu' => Aspirasi::query()->where('nis', $nis)->where('status', 'Menunggu')->count(),
            'proses' => Aspirasi::query()->where('nis', $nis)->where('status', 'Proses')->count(),
            'selesai' => Aspirasi::query()->where('nis', $nis)->where('status', 'Selesai')->count(),
        ];

        return view('siswa.aspirasi.index', compact('aspirasis', 'ringkasan'));
    }

    public function create(): View
    {
        $kategoris = Kategori::query()->orderBy('ket_kategori')->get();

        return view('siswa.aspirasi.create', compact('kategoris'));
    }

    public function store(StoreAspirasiRequest $request): RedirectResponse
    {
        Aspirasi::query()->create([
            'nis' => Auth::guard('siswa')->id(),
            'kategori_id' => $request->validated('kategori_id'),
            'lokasi' => $request->validated('lokasi'),
            'ket' => $request->validated('ket'),
            'status' => 'Menunggu',
            'progress_persen' => 0,
        ]);

        return redirect()->route('siswa.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dikirim.');
    }

    public function show(Aspirasi $aspirasi): View
    {
        $this->authorizeOwner($aspirasi);

        $aspirasi->load(['kategori', 'progressUpdates.admin']);

        return view('siswa.aspirasi.show', compact('aspirasi'));
    }

    public function edit(Aspirasi $aspirasi): View
    {
        $this->authorizeEditable($aspirasi);

        $kategoris = Kategori::query()->orderBy('ket_kategori')->get();

        return view('siswa.aspirasi.edit', compact('aspirasi', 'kategoris'));
    }

    public function update(UpdateOwnAspirasiRequest $request, Aspirasi $aspirasi): RedirectResponse
    {
        $this->authorizeEditable($aspirasi);

        $aspirasi->update($request->validated());

        return redirect()->route('siswa.aspirasi.index')
            ->with('success', 'Aspirasi berhasil diperbarui.');
    }

    public function destroy(Aspirasi $aspirasi): RedirectResponse
    {
        $this->authorizeEditable($aspirasi);

        $aspirasi->delete();

        return redirect()->route('siswa.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dihapus.');
    }

    private function authorizeOwner(Aspirasi $aspirasi): void
    {
        abort_unless($aspirasi->nis === Auth::guard('siswa')->id(), 403);
    }

    private function authorizeEditable(Aspirasi $aspirasi): void
    {
        $this->authorizeOwner($aspirasi);

        abort_if($aspirasi->status !== 'Menunggu', 403, 'Aspirasi yang sudah diproses tidak dapat diubah.');
    }
}
