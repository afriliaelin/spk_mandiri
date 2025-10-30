<?php
// Tentukan apakah ini mode edit atau tambah
$is_edit = isset($debitur_data);
$title = $is_edit ? 'Edit Data Debitur' : 'Tambah Debitur Baru';
$action_url = $is_edit ? BASE_URL . '/debitur/update/' . $debitur_data['id_debitur'] : BASE_URL . '/debitur/store';

// Nilai default
$nama = $is_edit ? $debitur_data['nama_debitur'] : '';
$pekerjaan = $is_edit ? $debitur_data['pekerjaan'] : '';
$alamat = $is_edit ? $debitur_data['alamat'] : '';
?>

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="<?= $action_url ?>" method="POST">
            
            <div class="form-group">
                <label for="nama_debitur">Nama Debitur</label>
                <input type="text" class="form-control" id="nama_debitur" name="nama_debitur" value="<?= htmlspecialchars($nama) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan / Jenis Usaha</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= htmlspecialchars($pekerjaan) ?>" required>
            </div>
            
            
            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= htmlspecialchars($alamat) ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="<?= BASE_URL ?>/debitur" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>