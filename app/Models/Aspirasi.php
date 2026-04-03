<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aspirasi extends Model
{
    protected $fillable = [
        'nis',
        'kategori_id',
        'lokasi',
        'ket',
        'status',
        'feedback',
        'progress_persen',
        'admin_id',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'closed_at' => 'datetime',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function progressUpdates(): HasMany
    {
        return $this->hasMany(ProgressUpdate::class)->latest();
    }

    public function latestProgress(): HasMany
    {
        return $this->hasMany(ProgressUpdate::class)->latest()->limit(1);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['tanggal'] ?? null, fn (Builder $q, string $tanggal) => $q->whereDate('created_at', $tanggal))
            ->when($filters['bulan'] ?? null, function (Builder $q, string $bulan) {
                [$tahun, $nomorBulan] = explode('-', $bulan);
                return $q->whereYear('created_at', (int) $tahun)
                    ->whereMonth('created_at', (int) $nomorBulan);
            })
            ->when($filters['siswa'] ?? null, fn (Builder $q, string $siswa) => $q->where('nis', $siswa))
            ->when($filters['kategori'] ?? null, fn (Builder $q, string $kategori) => $q->where('kategori_id', $kategori))
            ->when($filters['status'] ?? null, fn (Builder $q, string $status) => $q->where('status', $status));
    }
}
