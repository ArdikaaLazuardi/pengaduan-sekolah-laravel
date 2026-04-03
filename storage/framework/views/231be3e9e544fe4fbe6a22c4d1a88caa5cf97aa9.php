<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Update Status Aspirasi</h1>
                <p class="text-muted mb-0"><?php echo e($aspirasi->siswa->nama); ?> · <?php echo e($aspirasi->kategori->ket_kategori); ?> · <?php echo e($aspirasi->lokasi); ?></p>
            </div>
            <a href="<?php echo e(route('admin.aspirasi.show', $aspirasi)); ?>" class="btn btn-outline-secondary">Kembali</a>
        </div>

        <div class="card card-shadow">
            <div class="card-body">
                <div class="alert alert-light border">
                    <div class="fw-semibold mb-1">Isi aspirasi</div>
                    <?php echo e($aspirasi->ket); ?>

                </div>

                <form method="post" action="<?php echo e(route('admin.aspirasi.update', $aspirasi)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <?php $__currentLoopData = ['Menunggu', 'Proses', 'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status); ?>" <?php if(old('status', $aspirasi->status) === $status): echo 'selected'; endif; ?>><?php echo e($status); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Progress (%)</label>
                            <input type="number" name="progress_persen" min="0" max="100" class="form-control"
                                   value="<?php echo e(old('progress_persen', $aspirasi->progress_persen)); ?>" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Feedback untuk siswa</label>
                            <textarea name="feedback" rows="4" class="form-control"><?php echo e(old('feedback', $aspirasi->feedback)); ?></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan progres baru</label>
                            <textarea name="catatan_progress" rows="4" class="form-control" placeholder="Contoh: Teknisi mengganti lampu dan memeriksa instalasi listrik."><?php echo e(old('catatan_progress')); ?></textarea>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

                <hr class="my-4">

                <form method="post" action="<?php echo e(route('admin.aspirasi.destroy', $aspirasi)); ?>" onsubmit="return confirm('Hapus aspirasi ini?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-outline-danger">Hapus Aspirasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Update Aspirasi'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Downloads\pengaduan-sekolah-laravel\pengaduan-sekolah-laravel\resources\views/admin/aspirasi/edit.blade.php ENDPATH**/ ?>