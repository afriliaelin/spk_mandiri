<?php
/**
 * View: /views/penilaian/index.php
 * Daftar semua debitur yang menunggu input penilaian skor.
 */
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Input Penilaian (Matriks Keputusan)</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pilih Debitur untuk Dinilai</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Debitur</th>
                        <th>Pekerjaan</th>
                        <th>Status Penilaian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; if (!empty($debitur)) : ?>
                    <?php foreach ($debitur as $d) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($d['nama_debitur']) ?></td>
                        <td><?= htmlspecialchars($d['pekerjaan']) ?></td>
                        <td>
                            <span class="badge bg-secondary">Belum Dinilai</span>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/penilaian/input/<?= $d['id_debitur'] ?>" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i> Input/Edit Skor
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr><td colspan="5" class="text-center">Belum ada data debitur yang dimasukkan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>