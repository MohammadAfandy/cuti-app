<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Cuti</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Cuti Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <a href="/cuti/form" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Ajukan Cuti</span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">NIP</th>
                        <th class="text-center">Nama Karyawan</th>
                        <th class="text-center">Tanggal Mulai</th>
                        <th class="text-center">Tanggal Selesai</th>
                        <th class="text-center">Durasi</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Waktu Verifikasi</th>
                        <?php if ($karyawan->jabatan !== 'Staff') : ?>
                            <th class="text-center">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_cuti as $cuti) : ?>
                        <?php
                            $badge_class = 'badge-warning';
                            if ($cuti->status === 'reject') $badge_class = 'badge-danger';
                            if ($cuti->status === 'approve') $badge_class = 'badge-success';
                        ?>
                        <tr>
                            <td><?= $cuti->nip ?></td>
                            <td><?= $cuti->nama ?></td>
                            <td><?= date_format(date_create($cuti->tgl_mulai), 'd M Y') ?></td>
                            <td><?= date_format(date_create($cuti->tgl_selesai), 'd M Y') ?></td>
                            <td><?= date_diff(date_create($cuti->tgl_mulai), date_create($cuti->tgl_selesai))->days + 1 ?> Hari</td>
                            <td><?= $cuti->keterangan ?></td>
                            <td class="text-center">
                                <span class="badge <?= $badge_class ?>"><?= ucWords($cuti->status) ?></div>
                            </td>
                            <td class="text-center">
                                <?php if ($cuti->waktu_verifikasi) : ?>
                                    <div class="small"><?= date_format(date_create($cuti->waktu_verifikasi), 'd M Y H:i:s') ?></div>
                                    <div class="small">By <?= $cuti->nama_verifikator ?></div>
                                <?php else : ?>
                                    <span>-</span>
                                <?php endif; ?>
                            </td>
                            <?php if ($karyawan->jabatan !== 'Staff') : ?>
                                <td class="text-center">
                                    <?php if ($cuti->status === 'pending') : ?>
                                        <button
                                            class="btn btn-success btn-sm btn-icon-split btn-verify"
                                            data-id="<?= $cuti->id ?>"
                                            data-type="approve"
                                        >
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Approve</span>
                                        </button>
    
                                        <button
                                            class="btn btn-danger btn-sm btn-icon-split btn-verify"
                                            data-id="<?= $cuti->id ?>"
                                            data-type="reject"
                                        >
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <span class="text">Reject</span>
                                        </button>
                                    <?php else : ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form
                id="form-verify"
                class="d-inline-block"
                action=""
                method="POST"
            >
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function () {
        $('.btn-verify').click(function() {
            let id = $(this).data('id');
            let type = $(this).data('type');
            if (confirm('Apakah Anda Yakin Untuk ' + type + ' ?')) {
                let form = $('#form-verify');
                form.attr('action', '/cuti/verify/' + id + '/' + type);
                form.submit();
            }
        });
    });
</script>
<?= $this->endSection(); ?>
