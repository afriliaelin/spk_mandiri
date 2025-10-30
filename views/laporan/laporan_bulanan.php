<h1 class="h3 mb-4 text-gray-800">Laporan Bulanan Hasil SPK Debitur Terbaik</h1>
<p class="mb-4">Rekapitulasi hasil perhitungan SAW untuk penentuan debitur terbaik periode <?= date('F Y') ?>.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Hasil Perankingan Akhir</h6>
        <button onclick="window.print()" class="btn btn-success btn-sm"><i class="fas fa-print"></i> Cetak Laporan</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-light">
                        <th>Ranking</th>
                        <th>Nama Debitur</th>
                        <th>Nilai Akhir (V<sub>i</sub>)</th>
                        <th>Keputusan Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Diasumsikan $hasil_ranking sudah di-fetch dari tabel hasil_saw
                    $threshold = 0.60; // Contoh nilai batas kelayakan (misalnya 0.60)

                    if (empty($hasil_ranking)) : ?>
                        <tr><td colspan="4" class="text-center">Belum ada data hasil perhitungan SAW yang tersimpan.</td></tr>
                    <?php else : ?>
                        <?php foreach ($hasil_ranking as $hasil) : 
                            $rekomendasi = $hasil['nilai_akhir'] >= $threshold ? 'DITERIMA' : 'DITOLAK';
                            $class = $rekomendasi == 'DITERIMA' ? 'table-success' : 'table-danger';
                        ?>
                        <tr class="<?= $class ?>">
                            <td><?= $hasil['ranking'] ?></td>
                            <td><?= $hasil['nama_debitur'] ?></td>
                            <td><?= number_format($hasil['nilai_akhir'], 4) ?></td>
                            <td><strong><?= $rekomendasi ?></strong></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <small class="text-muted">*Rekomendasi DITERIMA jika Nilai Akhir (V<sub>i</sub>) >= <?= number_format($threshold, 2) ?></small>
    </div>
</div>