<?php $__env->startSection('content'); ?>
<?php
    $statusClass = match ($aspirasi->status) {
        'Menunggu' => 'status-menunggu',
        'Proses' => 'status-proses',
        'Selesai' => 'status-selesai',
        default => 'status-menunggu',
    };

    $statusProgressMap = [
        'Menunggu' => 0,
        'Proses' => 50,
        'Selesai' => 100,
    ];

    $selectedStatus = old('status', $aspirasi->status);
    $selectedProgress = $statusProgressMap[$selectedStatus] ?? 0;
?>

<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
        <div class="small text-uppercase fw-bold" style="letter-spacing:.12em; color: var(--text-soft);">Admin Update Form</div>
        <h1 class="mb-2" style="font-size:2rem; font-weight:800; letter-spacing:-.03em;">Update Status Aspirasi</h1>
        <p class="mb-0" style="color: var(--text-soft); max-width: 760px;">
            Kelola status laporan siswa, atur progres penanganan, dan tambahkan feedback
            dalam tampilan admin yang lebih modern, rapi, dan nyaman digunakan.
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="<?php echo e(route('admin.aspirasi.show', $aspirasi)); ?>" class="btn btn-soft">
            <i class="bi bi-eye me-2"></i>
            Lihat Detail
        </a>
        <a href="<?php echo e(route('admin.aspirasi.index')); ?>" class="btn btn-soft">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-xl-4">
        <div class="card-soft p-4 h-100" style="background: linear-gradient(145deg, #0f4f4b 0%, #0b3d3a 100%); color: #fff;">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <div class="small text-white-50 fw-semibold mb-2">Laporan Siswa</div>
                    <div style="font-size:1.75rem; font-weight:800; line-height:1.15;">
                        <?php echo e($aspirasi->siswa->nama); ?>

                    </div>
                    <div class="mt-2 text-white-50">
                        <?php echo e($aspirasi->nis); ?> • <?php echo e($aspirasi->siswa->kelas); ?>

                    </div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
                     style="width:54px; height:54px; background: rgba(255,255,255,.12);">
                    <i class="bi bi-person-check fs-5"></i>
                </div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Kategori</div>
                <div class="fw-semibold"><?php echo e($aspirasi->kategori->ket_kategori); ?></div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Lokasi</div>
                <div class="fw-semibold"><?php echo e($aspirasi->lokasi); ?></div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Status Saat Ini</div>
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <div class="fw-semibold"><?php echo e($aspirasi->status); ?></div>
                    <span class="badge rounded-pill text-bg-light px-3 py-2"><?php echo e($aspirasi->progress_persen); ?>%</span>
                </div>
            </div>

            <div class="rounded-4 p-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Isi Aspirasi</div>
                <div class="fw-semibold" style="line-height:1.75;">
                    <?php echo e(\Illuminate\Support\Str::limit($aspirasi->ket, 180)); ?>

                </div>
            </div>

            <div class="mt-4">
                <div class="small text-white-50 mb-2">Akses cepat</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?php echo e(route('admin.aspirasi.show', $aspirasi)); ?>" class="btn btn-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-file-earmark-text me-1"></i>
                        Detail
                    </a>
                    <a href="<?php echo e(route('admin.aspirasi.index')); ?>" class="btn btn-outline-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-table me-1"></i>
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card-soft p-0 overflow-hidden">
            <div class="p-4 border-bottom" style="border-color: var(--border-soft) !important;">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Form Update</div>
                        <h5 class="mb-1 fw-bold">Perbarui status dan progres laporan</h5>
                        <div class="small" style="color: var(--text-soft);">
                            Gunakan form ini untuk mengubah status, memberi feedback, dan mencatat perkembangan terbaru.
                        </div>
                    </div>

                    <span class="status-pill <?php echo e($statusClass); ?>">
                        <?php echo e($aspirasi->status); ?>

                    </span>
                </div>
            </div>

            <div class="p-4 p-lg-5">
                <form method="post" action="<?php echo e(route('admin.aspirasi.update', $aspirasi)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-ui-checks-grid"></i>
                                </span>
                                <select name="status" id="statusSelect" class="form-select" required>
                                    <?php $__currentLoopData = ['Menunggu', 'Proses', 'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status); ?>" <?php if($selectedStatus === $status): echo 'selected'; endif; ?>>
                                            <?php echo e($status); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Pilih status terbaru sesuai kondisi penanganan saat ini.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Progress (%)</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-speedometer2"></i>
                                </span>
                                <input
                                    type="number"
                                    id="progressDisplay"
                                    min="0"
                                    max="100"
                                    class="form-control"
                                    value="<?php echo e($selectedProgress); ?>"
                                    placeholder="0 - 100"
                                    disabled
                                >
                                <input
                                    type="hidden"
                                    name="progress_persen"
                                    id="progressValue"
                                    value="<?php echo e($selectedProgress); ?>"
                                >
                            </div>
                            <?php $__errorArgs = ['progress_persen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Persentase akan terisi otomatis berdasarkan status:
                                Menunggu = 0%, Proses = 50%, Selesai = 100%.
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Feedback untuk Siswa</label>
                            <div class="p-3 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                                <textarea
                                    name="feedback"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Tulis feedback yang akan dilihat siswa..."
                                    style="min-height: 150px; resize: vertical;"
                                ><?php echo e(old('feedback', $aspirasi->feedback)); ?></textarea>

                                <?php $__errorArgs = ['feedback'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <div class="small mt-2" style="color: var(--text-soft);">
                                    Feedback ini akan tampil pada detail aspirasi siswa.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan Progres Baru</label>
                            <div class="p-3 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                                <textarea
                                    name="catatan_progress"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Contoh: Teknisi mengganti lampu dan memeriksa instalasi listrik."
                                    style="min-height: 150px; resize: vertical;"
                                ><?php echo e(old('catatan_progress')); ?></textarea>

                                <?php $__errorArgs = ['catatan_progress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <div class="small mt-2" style="color: var(--text-soft);">
                                    Catatan ini akan masuk ke histori progres penanganan.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4 pt-2">
                        <div class="small" style="color: var(--text-soft); max-width: 520px;">
                            Setelah disimpan, status dan progres aspirasi akan langsung diperbarui di dashboard admin dan detail siswa.
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?php echo e(route('admin.aspirasi.show', $aspirasi)); ?>" class="btn btn-soft">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check2-circle me-2"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-soft p-0 overflow-hidden mt-3">
            <div class="p-4 border-bottom" style="border-color: var(--border-soft) !important;">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Zona Hapus</div>
                        <h5 class="mb-1 fw-bold">Hapus data aspirasi</h5>
                        <div class="small" style="color: var(--text-soft);">
                            Gunakan tindakan ini hanya jika data memang perlu dihapus dari sistem.
                        </div>
                    </div>

                    <div class="topbar-chip">
                        <i class="bi bi-trash"></i>
                        Tindakan Permanen
                    </div>
                </div>
            </div>

            <div class="p-4 p-lg-5">
                <div class="p-4 rounded-4" style="background:#fff4f4; border:1px solid #f3d7d7;">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                        <div>
                            <div class="fw-bold mb-1" style="color:#991b1b;">Hapus aspirasi ini</div>
                            <div class="small" style="color:#7f1d1d; line-height:1.7;">
                                Data aspirasi yang dihapus tidak akan muncul lagi di daftar admin maupun dashboard siswa.
                            </div>
                        </div>

                        <form method="post"
                              action="<?php echo e(route('admin.aspirasi.destroy', $aspirasi)); ?>"
                              onsubmit="return confirm('Hapus aspirasi ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit" class="btn btn-danger rounded-4 px-4">
                                <i class="bi bi-trash3 me-2"></i>
                                Hapus Aspirasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.getElementById('statusSelect');
        const progressDisplay = document.getElementById('progressDisplay');
        const progressValue = document.getElementById('progressValue');

        const statusProgressMap = {
            Menunggu: 0,
            Proses: 50,
            Selesai: 100
        };

        function syncProgress() {
            const progress = statusProgressMap[statusSelect.value] ?? 0;
            progressDisplay.value = progress;
            progressValue.value = progress;
        }

        if (statusSelect && progressDisplay && progressValue) {
            syncProgress();
            statusSelect.addEventListener('change', syncProgress);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => 'Update Aspirasi'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Downloads\pengaduan-sekolah-laravel\pengaduan-sekolah-laravel\resources\views/admin/aspirasi/edit.blade.php ENDPATH**/ ?>