<h1 class="h3 mb-4 text-gray-800">Audit Trail: Matriks Normalisasi (R<sub>ij</sub>)</h1>
<p class="mb-4">
    Tabel ini menunjukkan nilai skor yang telah dinormalisasi. Nilai ini yang akan dikalikan dengan bobot kriteria.
</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Matriks R<sub>ij</sub></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-light">
                        <th rowspan="2">Debitur</th>
                        <th colspan="<?= count($kriteria) ?>" class="text-center">Kriteria (C<sub>j</sub>)</th>
                    </tr>
                    <tr>
                        <?php foreach ($kriteria as $k) : ?>
                            <th><?= $k['kode_kriteria'] ?> (<?= strtoupper(substr($k['tipe'], 0, 1)) ?>)</th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($matriks_normalisasi)) : ?>
                        <tr><td colspan="<?= count($kriteria) + 1 ?>" class="text-center">Matriks normalisasi kosong. Lakukan input penilaian.</td></tr>
                    <?php else : ?>
                        <?php foreach ($matriks_normalisasi as $debitur_id => $data_r) : ?>
                        <tr>
                            <td><?= $data_r['nama_debitur'] ?></td>
                            <?php 
                            // Loop berdasarkan urutan kriteria yang sama di header
                            foreach ($kriteria as $k) : 
                                $kriteria_id = $k['id_kriteria'];
                                $nilai_r = $data_r[$kriteria_id] ?? 0;
                            ?>
                                <td><?= number_format($nilai_r, 4) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <p class="mt-3">
            <small class="text-muted">*Keterangan: (B) = Benefit, (C) = Cost.</small>
        </p>
    </div>
</div>