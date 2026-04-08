<?php $__env->startSection('content'); ?>
<?php
    $statusClass = match ($aspirasi->status) {
        'Menunggu' => 'status-menunggu',
        'Proses' => 'status-proses',
        'Selesai' => 'status-selesai',
        default => 'status-menunggu',
    };

    $progressColor = match ($aspirasi->status) {
        'Menunggu' => '#9ca3af',
        'Proses' => '#d4a017',
        'Selesai' => '#1f9254',
        default => 'var(--primary)',
    };
?>

<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
        <div class="small text-uppercase fw-bold" style="letter-spacing:.12em; color: var(--text-soft);">Student Detail</div>
        <h1 class="mb-2" style="font-size:2rem; font-weight:800; letter-spacing:-.03em;">Detail Aspirasi Saya</h1>
        <p class="mb-0" style="color: var(--text-soft); max-width: 760px;">
            Pantau informasi laporan, feedback admin, serta histori progres penanganan
            dalam tampilan yang lebih modern dan nyaman dibaca.
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="<?php echo e(route('siswa.aspirasi.index')); ?>" class="btn btn-soft">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </a>

        <?php if($aspirasi->status === 'Menunggu'): ?>
            <a href="<?php echo e(route('siswa.aspirasi.edit', $aspirasi)); ?>" class="btn btn-primary">
                <i class="bi bi-pencil-square me-2"></i>
                Ubah Aspirasi
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-xl-4">
        <div class="card-soft p-4 h-100" style="background: linear-gradient(145deg, #0f4f4b 0%, #0b3d3a 100%); color: #fff;">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <div class="small text-white-50 fw-semibold mb-2">Status Laporan</div>
                    <div style="font-size:1.95rem; font-weight:800; line-height:1.1;">
                        <?php echo e($aspirasi->status); ?>

                    </div>
                    <div class="mt-2 text-white-50">
                        Dipantau secara real-time dari dashboard siswa
                    </div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
                     style="width:54px; height:54px; background: rgba(255,255,255,.12);">
                    <i class="bi bi-clipboard-data fs-5"></i>
                </div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Progress Saat Ini</div>
                <div class="d-flex align-items-center justify-content-between">
                    <div style="font-size:1.9rem; font-weight:800;"><?php echo e($aspirasi->progress_persen); ?>%</div>
                    <div class="small text-white-50"><?php echo e($aspirasi->created_at->format('d M Y')); ?></div>
                </div>

                <div class="progress mt-3" style="height:10px; border-radius:999px; background: rgba(255,255,255,.14);">
                    <div class="progress-bar"
                         style="width: <?php echo e($aspirasi->progress_persen); ?>%; background: rgba(255,255,255,.85);"></div>
                </div>
            </div>

            <div class="rounded-4 p-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Feedback Admin</div>
                <div class="fw-semibold" style="line-height:1.7;">
                    <?php echo e($aspirasi->feedback ?: 'Belum ada feedback dari admin.'); ?>

                </div>
            </div>

            <div class="mt-4">
                <div class="small text-white-50 mb-2">Aksi cepat</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?php echo e(route('siswa.aspirasi.index')); ?>" class="btn btn-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-clock-history me-1"></i>
                        Riwayat
                    </a>

                    <?php if($aspirasi->status === 'Menunggu'): ?>
                        <a href="<?php echo e(route('siswa.aspirasi.edit', $aspirasi)); ?>" class="btn btn-outline-light btn-sm px-3 rounded-pill fw-bold">
                            <i class="bi bi-pencil-square me-1"></i>
                            Edit
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card-soft p-0 overflow-hidden h-100">
            <div class="p-4 border-bottom" style="border-color: var(--border-soft) !important;">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Informasi Aspirasi</div>
                        <h5 class="mb-1 fw-bold">Data utama laporan</h5>
                        <div class="small" style="color: var(--text-soft);">
                            Ringkasan detail aspirasi yang sudah kamu kirim.
                        </div>
                    </div>

                    <span class="status-pill <?php echo e($statusClass); ?>">
                        <?php echo e($aspirasi->status); ?>

                    </span>
                </div>
            </div>

            <div class="p-4 p-lg-5">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 h-100" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Tanggal</div>
                            <div class="fw-bold" style="font-size:1.02rem;">
                                <?php echo e($aspirasi->created_at->format('d F Y H:i')); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded-4 h-100" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Kategori</div>
                            <div class="fw-bold" style="font-size:1.02rem;">
                                <?php echo e($aspirasi->kategori->ket_kategori); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="p-3 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Lokasi</div>
                            <div class="fw-bold" style="font-size:1.02rem;">
                                <?php echo e($aspirasi->lokasi); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="p-4 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Isi Aspirasi / Keluhan</div>
                            <div style="line-height:1.85; color:#445050; white-space: pre-line;"><?php echo e($aspirasi->ket); ?></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="p-4 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-3">
                                <div>
                                    <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Progress Perbaikan</div>
                                    <div class="fw-bold">Status saat ini: <?php echo e($aspirasi->status); ?></div>
                                </div>
                                <div class="fw-bold" style="font-size:1.15rem; color: var(--primary);">
                                    <?php echo e($aspirasi->progress_persen); ?>%
                                </div>
                            </div>

                            <div class="progress" style="height:12px; border-radius:999px; background:#e9e4dc;">
                                <div class="progress-bar"
                                     style="width: <?php echo e($aspirasi->progress_persen); ?>%; background: <?php echo e($progressColor); ?>;"></div>
                            </div>

                            <div class="small mt-3" style="color: var(--text-soft);">
                                Persentase ini menunjukkan sejauh mana tindak lanjut admin terhadap laporan kamu.
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="p-4 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Feedback Admin</div>
                            <div style="line-height:1.8; color:#445050;">
                                <?php echo e($aspirasi->feedback ?: 'Belum ada feedback.'); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="p-4 border-bottom" style="border-color: var(--border-soft) !important;">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
            <div>
                <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Histori Progres</div>
                <h5 class="mb-1 fw-bold">Perjalanan penanganan laporan</h5>
                <div class="small" style="color: var(--text-soft);">
                    Semua catatan progres dari admin ditampilkan berurutan.
                </div>
            </div>

            <div class="topbar-chip">
                <i class="bi bi-clock-history"></i>
                <?php echo e($aspirasi->progressUpdates->count()); ?> update
            </div>
        </div>
    </div>

    <div class="p-4 p-lg-5">
        <?php $__empty_1 = true; $__currentLoopData = $aspirasi->progressUpdates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progress): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="d-flex gap-3 <?php echo e(!$loop->last ? 'mb-4 pb-4 border-bottom' : ''); ?>" style="<?php echo e(!$loop->last ? 'border-color: var(--border-soft) !important;' : ''); ?>">
                <div class="flex-shrink-0">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
                         style="width:54px; height:54px; background:#eef3f1; color:var(--primary);">
                        <i class="bi bi-activity"></i>
                    </div>
                </div>

                <div class="flex-grow-1">
                    <div class="d-flex flex-column flex-lg-row justify-content-between gap-2 mb-2">
                        <div class="fw-bold" style="font-size:1.02rem;">
                            <?php echo e($progress->progress_persen); ?>% progress
                        </div>
                        <div class="small" style="color: var(--text-soft);">
                            <?php echo e($progress->created_at->format('d/m/Y H:i')); ?>

                        </div>
                    </div>

                    <div class="progress mb-3" style="height:8px; border-radius:999px; background:#ece7e1;">
                        <div class="progress-bar"
                             style="width: <?php echo e($progress->progress_persen); ?>%; background: var(--primary);"></div>
                    </div>

                    <div class="p-3 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft); line-height:1.8; color:#445050;">
                        <?php echo e($progress->catatan); ?>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-4">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:72px; height:72px; background:#f1efea; color:var(--primary);">
                    <i class="bi bi-inbox fs-3"></i>
                </div>
                <h6 class="fw-bold mb-2">Belum ada histori progres</h6>
                <p class="mb-0" style="color: var(--text-soft); max-width: 460px; margin: 0 auto;">
                    Saat admin mulai menindaklanjuti laporan ini, catatan progres akan muncul di bagian ini.
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => 'Detail Aspirasi Saya'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Downloads\pengaduan-sekolah-laravel\pengaduan-sekolah-laravel\resources\views/siswa/aspirasi/show.blade.php ENDPATH**/ ?>