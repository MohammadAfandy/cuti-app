<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Karyawan</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $mode ?> Karyawan</h6>
    </div>
    <div class="card-body">
        
        <?php $validation = \Config\Services::validation(); ?>
        <?php if (count($validation->getErrors())) : ?>
            <?= $validation->listErrors('errors_list') ?>
        <?php endif; ?>
        <form class="form-karyawan" method="POST">
            <div class="form-group row">
                <label class="col-sm-2" for="nip">
                    NIP
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="nip" name="nip"
                        <?= $mode === 'Edit' ? 'disabled' : '' ?>
                        placeholder="NIP" value="<?= set_value('nip', isset($karyawan) ? $karyawan->nip : '') ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="nama">
                    Nama
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="nama" name="nama"
                        placeholder="Nama Karyawan" value="<?= set_value('nama', isset($karyawan) ? $karyawan->nama : '') ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="jabatan">
                    Jabatan
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <select class="form-control" id="jabatan" name="jabatan"
                        placeholder="Jabatan">
                        <option value="">-- Pilih Jabatan --</option>
                        <?php foreach ($list_jabatan as $jabatan): ?>
                            <option value="<?= $jabatan ?>" <?= set_select('jabatan', $jabatan, isset($karyawan) ? $karyawan->jabatan === $jabatan : false) ?>><?= $jabatan ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="nama">
                    Jumlah Cuti
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" class="form-control" id="jumlah_cuti" name="jumlah_cuti"
                        placeholder="Jumlah Cuti (Hari)" value="<?= set_value('jumlah_cuti', isset($karyawan) ? $karyawan->jumlah_cuti : '') ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" for="password">
                    Password
                </label>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control" name="password"
                        id="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group row text-right">
                <div class="col-sm-12">
                    <a href="/karyawan" class="btn btn-danger">
                        Batal
                    </a>
                    <button class="btn btn-primary" type="submit">
                        Simpan
                    </button>
                </div>
            </div>
            <hr>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
