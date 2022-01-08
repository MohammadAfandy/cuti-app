<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Cuti</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Cuti</h6>
    </div>
    <div class="card-body">
        
        <?php $validation = \Config\Services::validation(); ?>
        <?php if (count($validation->getErrors())) : ?>
            <?= $validation->listErrors('errors_list') ?>
        <?php endif; ?>
        <form class="form-cuti" action="/cuti/form" method="POST">
            <div class="form-group row">
                <label class="col-sm-2" for="nama">
                    NIP / Nama Karyawan
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="nama" name="nama" disabled
                        placeholder="nama" value="<?= $karyawan->nip . ' - ' . $karyawan->nama ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="nama">
                    Sisa Cuti
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="sisa_cuti" name="sisa_cuti" disabled
                        placeholder="Sisa Cuti" value="<?= $karyawan->jumlah_cuti . ' Hari' ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="tgl_mulai">
                    Tanggal Mulai
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai"
                        placeholder="tgl_mulai" value="<?= set_value('tgl_mulai', isset($cuti) ? $cuti->tgl_mulai : '') ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="tgl_selesai">
                    Tanggal Selesai
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai"
                        placeholder="tgl_selesai" value="<?= set_value('tgl_selesai', isset($cuti) ? $cuti->tgl_selesai : '') ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="keterangan">
                    Keterangan
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <textarea class="form-control" id="keterangan" name="keterangan"><?= set_value('keterangan', isset($cuti) ? $cuti->keterangan : '') ?></textarea>
                </div>
            </div>

            <div class="form-group row text-right">
                <div class="col-sm-12">
                    <a href="/cuti" class="btn btn-danger">
                        Batal
                    </a>
                    <button class="btn btn-primary" type="submit">
                        Ajukan
                    </button>
                </div>
            </div>
            <hr>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
