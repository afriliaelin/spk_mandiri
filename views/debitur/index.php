<h1 class="h3 mb-4 text-gray-800">Data Master Debitur (Alternatif A<sub>i</sub>)</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Calon Debitur</h6>
        <a href="<?= BASE_URL ?>/debitur/tambah" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Debitur
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Debitur</th>
                        <th>Pekerjaan</th>
                        <th>Tanggal Input</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($debitur as $d) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama_debitur'] ?></td>
                        <td><?= $d['pekerjaan'] ?></td>
                        <td><?= date('d/m/Y', strtotime($d['tgl_input'])) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>/debitur/edit/<?= $d['id_debitur'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="<?= BASE_URL ?>/debitur/delete/<?= $d['id_debitur'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>