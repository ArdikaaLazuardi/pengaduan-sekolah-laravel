<?php $__env->startSection('content'); ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1">Dashboard Admin</h1>
        <p class="text-muted mb-0">Kelola aspirasi, feedback, histori, dan progres perbaikan.</p>
    </div>
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

<div class="card card-shadow mb-4">
    <div class="card-body">
        <h2 class="h5 mb-3">Filter Aspirasi</h2>
        <form method="get" class="row g-3">
            <div class="col-md-2">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" value="<?php echo e($filters['tanggal'] ?? ''); ?>" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Bulan</label>
                <input type="month" name="bulan" value="<?php echo e($filters['bulan'] ?? ''); ?>" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Siswa</label>
                <select name="siswa" class="form-select">
                    <option value="">Semua siswa</option>
                    <?php $__currentLoopData = $siswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($siswa->nis); ?>" <?php if(($filters['siswa'] ?? '') === $siswa->nis): echo 'selected'; endif; ?>>
                            <?php echo e($siswa->nis); ?> - <?php echo e($siswa->nama); ?> (<?php echo e($siswa->kelas); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select">
                    <option value="">Semua kategori</option>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kategori->id); ?>" <?php if((string) ($filters['kategori'] ?? '') === (string) $kategori->id): echo 'selected'; endif; ?>>
                            <?php echo e($kategori->ket_kategori); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua status</option>
                    <?php $__currentLoopData = ['Menunggu', 'Proses', 'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php if(($filters['status'] ?? '') === $status): echo 'selected'; endif; ?>><?php echo e($status); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>
        <div class="mt-3">
            <a href="<?php echo e(route('admin.aspirasi.index')); ?>" class="btn btn-outline-secondary btn-sm">Reset Filter</a>
        </div>
    </div>
</div>

<div class="card card-shadow">
    <div class="card-body">
        <h2 class="h5 mb-3">Daftar Aspirasi</h2>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Siswa</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Isi Aspirasi</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $aspirasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($aspirasi->created_at->format('d/m/Y')); ?></td>
                        <td>
                            <div class="fw-semibold"><?php echo e($aspirasi->siswa->nama); ?></div>
                            <div class="small text-muted"><?php echo e($aspirasi->nis); ?> - <?php echo e($aspirasi->siswa->kelas); ?></div>
                        </td>
                        <td><?php echo e($aspirasi->kategori->ket_kategori); ?></td>
                        <td><?php echo e($aspirasi->lokasi); ?></td>
                        <td><?php echo e(\Illuminate\Support\Str::limit($aspirasi->ket, 70)); ?></td>
                        <td>
                            <span class="badge status-badge text-bg-<?php echo e($aspirasi->status === 'Selesai' ? 'success' : ($aspirasi->status === 'Proses' ? 'warning' : 'secondary')); ?>">
                                <?php echo e($aspirasi->status); ?>

                            </span>
                        </td>
                        <td style="min-width: 160px;">
                            <div class="progress" role="progressbar" aria-valuenow="<?php echo e($aspirasi->progress_persen); ?>" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: <?php echo e($aspirasi->progress_persen); ?>%"><?php echo e($aspirasi->progress_persen); ?>%</div>
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.aspirasi.show', $aspirasi)); ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                            <a href="<?php echo e(route('admin.aspirasi.edit', $aspirasi)); ?>" class="btn btn-sm btn-primary">Update</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data aspirasi.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php echo e($aspirasis->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Dashboard Admin'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Downloads\pengaduan-sekolah-laravel\pengaduan-sekolah-laravel\resources\views/admin/aspirasi/index.blade.php ENDPATH**/ ?>