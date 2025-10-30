<h1 class="h3 mb-4 text-gray-800">Input Penilaian Debitur</h1>
<p class="mb-4">
    Input skor (1-5) untuk **<?= htmlspecialchars($debitur['nama_debitur']) ?>** (A<sub><?= $debitur['id_debitur'] ?></sub>) 
    terhadap setiap kriteria (C<sub>j</sub>).
</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Matriks Penilaian</h6>
    </div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>/penilaian/simpanSkor/<?= $debitur['id_debitur'] ?>" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Tipe</th>
                            <th>Skor (1-5)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kriteria as $k) : ?>
                        <tr>
                            <td><?= $k['kode_kriteria'] ?></td>
                            <td><?= $k['nama_kriteria'] ?></td>
                            <td>
                                <span class="badge badge-<?= $k['tipe'] == 'benefit' ? 'success' : 'danger' ?>">
                                    <?= ucfirst($k['tipe']) ?>
                                </span>
                            </td>
                            <td>
                                <?php 
                                // Ambil skor yang sudah ada, default 1
                                $current_score = $skor_saat_ini[$k['id_kriteria']] ?? 1;
                                ?>
                                <select name="skor[<?= $k['id_kriteria'] ?>]" class="form-control" required>
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <option value="<?= $i ?>" <?= $current_score == $i ? 'selected' : '' ?>>
                                            <?= $i ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan Penilaian
            </button>
            <a href="<?= BASE_URL ?>/penilaian" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>