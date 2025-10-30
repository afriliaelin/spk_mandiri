<h1 class="h3 mb-4 text-gray-800">Dokumentasi Bobot Kriteria</h1>
<p class="mb-4">Tampilan ringkasan bobot akhir yang digunakan untuk perhitungan SPK.</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="alert alert-info">
            Perubahan bobot dilakukan di halaman Kriteria. Total bobot saat ini adalah: 
            <strong><?= number_format(array_sum(array_column($kriteria, 'bobot')), 2) ?></strong>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot (Wj)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Diasumsikan $kriteria sudah dimuat oleh MasterController
                    foreach ($kriteria as $k) : ?>
                    <tr>
                        <td><?= $k['kode_kriteria'] ?></td>
                        <td><?= $k['nama_kriteria'] ?></td>
                        <td><?= number_format($k['bobot'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>