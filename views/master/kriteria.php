<h1 class="h3 mb-4 text-gray-800">Data Master Kriteria (C<sub>j</sub>)</h1>
<p class="mb-4">Tabel ini berisi kriteria, tipe, dan bobot yang digunakan dalam metode SAW.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengaturan Kriteria & Bobot</h6>
    </div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>/kriteria/update" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Tipe (Benefit/Cost)</th>
                            <th>Bobot (W<sub>j</sub>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_bobot = 0;
                        foreach ($kriteria as $k) : 
                            $total_bobot += $k['bobot'];
                        ?>
                        <tr>
                            <td><?= $k['kode_kriteria'] ?></td>
                            <td><?= $k['nama_kriteria'] ?></td>
                            <td>
                                <select name="kriteria[<?= $k['id_kriteria'] ?>][tipe]" class="form-control" required>
                                    <option value="benefit" <?= $k['tipe'] == 'benefit' ? 'selected' : '' ?>>Benefit</option>
                                    <option value="cost" <?= $k['tipe'] == 'cost' ? 'selected' : '' ?>>Cost</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" max="1.00" 
                                    name="kriteria[<?= $k['id_kriteria'] ?>][bobot]" 
                                    class="form-control" value="<?= number_format($k['bobot'], 2, '.', '') ?>" required>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="table-info">
                            <td colspan="3" class="text-right"><strong>Total Bobot</strong></td>
                            <td><strong><?= number_format($total_bobot, 2) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button type="submit" class="btn btn-success" onclick="return confirm('Pastikan Total Bobot = 1.00 sebelum menyimpan!')">
                <i class="fas fa-save"></i> Simpan Perubahan Bobot
            </button>
        </form>
    </div>
</div>