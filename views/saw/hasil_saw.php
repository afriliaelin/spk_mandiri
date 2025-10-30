<h1 class="h3 mb-4 text-gray-800">Hasil Akhir Perankingan (V<sub>i</sub>)</h1>
<p class="mb-4">
    Hasil ini diperoleh dari penjumlahan terbobot Matriks Normalisasi (V<sub>i</sub> = &Sigma; R<sub>ij</sub>W<sub>j</sub>). 
    Debitur dengan nilai V<sub>i</sub> tertinggi adalah debitur terbaik.
</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Perankingan</h6>
        <div>
            <a href="<?= BASE_URL ?>/saw/proses" class="btn btn-warning btn-sm" onclick="return confirm('Proses ulang perhitungan SAW sekarang?')">
                <i class="fas fa-calculator"></i> Proses Ulang
            </a>
            <a href="<?= BASE_URL ?>/saw/audit" class="btn btn-info btn-sm">
                <i class="fas fa-file-alt"></i> Detail Proses Audit
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-light">
                        <th>Ranking</th>
                        <th>Nama Debitur (A<sub>i</sub>)</th>
                        <th>Nilai Akhir (V<sub>i</sub>)</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($hasil)) : ?>
                        <tr><td colspan="4" class="text-center">Silakan proses perhitungan SAW terlebih dahulu.</td></tr>
                    <?php else : ?>
                        <?php foreach ($hasil as $h) : ?>
                        <tr class="<?= $h['ranking'] == 1 ? 'table-primary font-weight-bold' : '' ?>">
                            <td><?= $h['ranking'] ?></td>
                            <td><?= $h['nama_debitur'] ?></td>
                            <td><?= number_format($h['nilai_akhir'], 4) ?></td>
                            <td>
                                <?php if ($h['ranking'] == 1) : ?>
                                    <span class="badge badge-primary">Debitur Terbaik</span>
                                <?php elseif ($h['nilai_akhir'] >= 0.70) : ?>
                                    <span class="badge badge-success">Sangat Direkomendasikan</span>
                                <?php else : ?>
                                    <span class="badge badge-secondary">Direkomendasikan</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>