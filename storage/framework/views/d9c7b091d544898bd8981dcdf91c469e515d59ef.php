

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
        <div class="small text-uppercase fw-bold" style="letter-spacing:.12em; color: var(--text-soft);">Student Form</div>
        <h1 class="mb-2" style="font-size:2rem; font-weight:800; letter-spacing:-.03em;">Input Aspirasi Siswa</h1>
        <p class="mb-0" style="color: var(--text-soft); max-width: 760px;">
            Sampaikan keluhan atau masukan terkait sarana dan prasarana sekolah
            dengan tampilan form yang lebih modern, rapi, dan nyaman digunakan.
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="<?php echo e(route('siswa.aspirasi.index')); ?>" class="btn btn-soft">
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
                    <div class="small text-white-50 fw-semibold mb-2">Panduan Input</div>
                    <div style="font-size:1.8rem; font-weight:800; line-height:1.15;">
                        Buat laporan dengan informasi yang jelas.
                    </div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width:54px; height:54px; background: rgba(255,255,255,.12);">
                    <i class="bi bi-pencil-square fs-5"></i>
                </div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Tips</div>
                <div class="fw-semibold">Pilih kategori yang sesuai dengan masalah utama.</div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Lokasi</div>
                <div class="fw-semibold">Tuliskan lokasi spesifik agar admin lebih mudah menindaklanjuti.</div>
            </div>

            <div class="rounded-4 p-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Deskripsi</div>
                <div class="fw-semibold">Jelaskan kondisi secara singkat, jelas, dan mudah dipahami.</div>
            </div>

            <div class="mt-4">
                <div class="small text-white-50 mb-2">Akses cepat</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?php echo e(route('siswa.aspirasi.index')); ?>" class="btn btn-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-clock-history me-1"></i>
                        Riwayat Aspirasi
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
                        <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Form Aspirasi</div>
                        <h5 class="mb-1 fw-bold">Lengkapi data laporan</h5>
                        <div class="small" style="color: var(--text-soft);">
                            Pastikan data yang kamu isi benar sebelum mengirim aspirasi.
                        </div>
                    </div>

                    <div class="topbar-chip">
                        <i class="bi bi-send"></i>
                        Input Baru
                    </div>
                </div>
            </div>

            <div class="p-4 p-lg-5">
                <form method="post" action="<?php echo e(route('siswa.aspirasi.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-tags"></i>
                                </span>
                                <select name="kategori_id" class="form-select" required>
                                    <option value="">Pilih kategori</option>
                                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kategori->id); ?>" <?php if(old('kategori_id') == $kategori->id): echo 'selected'; endif; ?>>
                                            <?php echo e($kategori->ket_kategori); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Pilih jenis sarana atau prasarana yang paling sesuai.
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Lokasi</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                                <input
                                    type="text"
                                    name="lokasi"
                                    value="<?php echo e(old('lokasi')); ?>"
                                    class="form-control"
                                    maxlength="100"
                                    placeholder="Contoh: Ruang Kelas XI IPA 2 / Toilet Lantai 1"
                                    required
                                >
                            </div>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Tulis lokasi sejelas mungkin agar mempermudah pengecekan.
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Isi Aspirasi / Pengaduan</label>
                            <div class="p-3 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                                <textarea
                                    name="ket"
                                    rows="7"
                                    class="form-control"
                                    maxlength="2000"
                                    placeholder="Jelaskan kondisi sarana yang rusak atau masukan yang ingin disampaikan..."
                                    style="min-height: 180px; resize: vertical;"
                                    required
                                ><?php echo e(old('ket')); ?></textarea>

                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="small" style="color: var(--text-soft);">
                                        Gunakan bahasa yang jelas dan mudah dipahami.
                                    </div>
                                    <div class="small" style="color: var(--text-soft);">
                                        Maks. 2000 karakter
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4 pt-2">
                        <div class="small" style="color: var(--text-soft); max-width: 480px;">
                            Setelah dikirim, laporan akan masuk ke dashboard siswa dan bisa dipantau status progresnya.
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?php echo e(route('siswa.aspirasi.index')); ?>" class="btn btn-soft">
                                Batal
                            </a>
                            <button class="btn btn-primary">
                                <i class="bi bi-send-fill me-2"></i>
                                Kirim
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => 'Input Aspirasi'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Downloads\pengaduan-sekolah-laravel\pengaduan-sekolah-laravel\resources\views/siswa/aspirasi/create.blade.php ENDPATH**/ ?>