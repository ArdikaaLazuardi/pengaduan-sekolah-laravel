<?php $__env->startSection('content'); ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1">Histori Aspirasi Saya</h1>
        <p class="text-muted mb-0">Pantau status penyelesaian, feedback admin, dan progres perbaikan.</p>
    </div>
    <a href="<?php echo e(route('siswa.aspirasi.create')); ?>" class="btn btn-primary">+ Input Aspirasi</a>
</div>

<div class="row g-3 mb-4">
    <?php $__currentLoopData = [
        ['label' => 'Total', 'value' => $ringkasan['total'], 'class' => 'primary'],
        ['label' => 'Menunggu', 'value' => $ringkasan['menunggu'], 'class' => 'secondary'],
        ['label' => 'Proses', 'value' => $ringkasan['proses'], 'class' => 'warning'],
        ['label' => 'Selesai', 'value' => $ringkasan['selesai'], 'class' => 'success'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-lg-3">
            <div class="card card-shadow h-100">
                <div class="card-body">
                    <div class="text-muted small"><?php echo e($item['label']); ?></div>
                    <div class="display-6 fw-bold text-<?php echo e($item['class']); ?>"><?php echo e($item['value']); ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="card card-shadow">
    <div class="card-body">
        <h2 class="h5 mb-3">Daftar Aspirasi</h2>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Isi Aspirasi</th>
                    <th>Status</th>
                    <th>Feedback</th>
                    <th>Progres</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $aspirasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($aspirasi->created_at->format('d/m/Y')); ?></td>
                        <td><?php echo e($aspirasi->kategori->ket_kategori); ?></td>
                        <td><?php echo e($aspirasi->lokasi); ?></td>
                        <td><?php echo e(\Illuminate\Support\Str::limit($aspirasi->ket, 70)); ?></td>
                        <td>
                            <span class="badge status-badge text-bg-<?php echo e($aspirasi->status === 'Selesai' ? 'success' : ($aspirasi->status === 'Proses' ? 'warning' : 'secondary')); ?>">
                                <?php echo e($aspirasi->status); ?>

                            </span>
                        </td>
                        <td><?php echo e(\Illuminate\Support\Str::limit($aspirasi->feedback ?: '-', 50)); ?></td>
                        <td style="min-width: 160px;">
                            <div class="progress" role="progressbar" aria-valuenow="<?php echo e($aspirasi->progress_persen); ?>" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: <?php echo e($aspirasi->progress_persen); ?>%"><?php echo e($aspirasi->progress_persen); ?>%</div>
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="<?php echo e(route('siswa.aspirasi.show', $aspirasi)); ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                            <?php if($aspirasi->status === 'Menunggu'): ?>
                                <a href="<?php echo e(route('siswa.aspirasi.edit', $aspirasi)); ?>" class="btn btn-sm btn-primary">Ubah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada aspirasi yang dikirim.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php echo e($aspirasis->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Histori Aspirasi Siswa'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Downloads\pengaduan-sekolah-laravel\pengaduan-sekolah-laravel\resources\views/siswa/aspirasi/index.blade.php ENDPATH**/ ?>