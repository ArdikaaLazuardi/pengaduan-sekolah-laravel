<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAspirasiUpdateRequest;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\ProgressUpdate;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AspirasiController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->only(['tanggal', 'bulan', 'siswa', 'kategori', 'status']);

        $aspirasis = Aspirasi::query()
            ->with(['siswa', 'kategori'])
            ->filter($filters)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $ringkasan = [
            'total' => Aspirasi::query()->count(),
            'menunggu' => Aspirasi::query()->where('status', 'Menunggu')->count(),
            'proses' => Aspirasi::query()->where('status', 'Proses')->count(),
            'selesai' => Aspirasi::query()->where('status', 'Selesai')->count(),
        ];

        $siswas = Siswa::query()->orderBy('nama')->get(['nis', 'nama', 'kelas']);
        $kategoris = Kategori::query()->orderBy('ket_kategori')->get();

        return view('admin.aspirasi.index', compact('aspirasis', 'ringkasan', 'siswas', 'kategoris', 'filters'));
    }

    public function show(Aspirasi $aspirasi): View
    {
        $aspirasi->load(['siswa', 'kategori', 'admin', 'progressUpdates.admin']);

        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    public function edit(Aspirasi $aspirasi): View
    {
        $aspirasi->load(['siswa', 'kategori', 'progressUpdates.admin']);

        return view('admin.aspirasi.edit', compact('aspirasi'));
    }

    public function update(AdminAspirasiUpdateRequest $request, Aspirasi $aspirasi): RedirectResponse
    {
        $data = $request->validated();
        $adminId = Auth::guard('admin')->id();

        DB::transaction(function () use ($aspirasi, $data, $adminId): void {
            $progress = (int) $data['progress_persen'];

            if ($data['status'] === 'Menunggu') {
                $progress = 0;
            }

            if ($data['status'] === 'Selesai') {
                $progress = 100;
            }

            if ($data['status'] === 'Proses' && $progress === 0) {
                $progress = 50;
            }

            $aspirasi->update([
                'status' => $data['status'],
                'feedback' => $data['feedback'] ?? null,
                'progress_persen' => $progress,
                'admin_id' => $adminId,
                'closed_at' => $data['status'] === 'Selesai' ? now() : null,
            ]);

            if (! empty($data['catatan_progress']) || $aspirasi->wasChanged('progress_persen')) {
                ProgressUpdate::query()->create([
                    'aspirasi_id' => $aspirasi->id,
                    'progress_persen' => $progress,
                    'catatan' => $data['catatan_progress'] ?: 'Pembaruan status oleh admin.',
                    'admin_id' => $adminId,
                ]);
            }
        });

        return redirect()->route('admin.aspirasi.index')
            ->with('success', 'Status, feedback, dan progres aspirasi berhasil diperbarui.');
    }

    public function destroy(Aspirasi $aspirasi): RedirectResponse
    {
        $aspirasi->delete();

        return redirect()->route('admin.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dihapus.');
    }
}
