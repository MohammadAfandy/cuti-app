<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Karyawan</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <a href="/karyawan/add" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Karyawan</span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">NIP</th>
                        <th class="text-center">Nama Karyawan</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Sisa Cuti</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_karyawan as $karyawan) : ?>
                        <tr>
                            <td><?= $karyawan->nip ?></td>
                            <td><?= $karyawan->nama ?></td>
                            <td><?= $karyawan->jabatan ?></td>
                            <td><?= $karyawan->jumlah_cuti ?> Hari</td>
                            <td class="text-center">
                                <a href="/karyawan/edit/<?= $karyawan->nip ?>" class="btn btn-primary btn-sm btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form
                                    class="d-inline-block"
                                    action="/karyawan/delete/<?= $karyawan->nip ?>"
                                    method="POST"
                                    onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini ?');"
                                >
                                    <button class="btn btn-danger btn-sm btn-circle" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<script>

</script>
