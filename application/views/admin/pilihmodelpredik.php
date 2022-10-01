<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pilih Model Untuk Prediksi</h1>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <style type="text/css">
                        .required {
                            color: red;
                        }
                    </style>
                    <?= $this->session->flashdata('msg') ?>
                    <?= form_open() ?>
                    <div class="form-group">
                        <label for="model">Model Barang<span class="required">*</span></label>
                        <select onchange="getUkuran()" class="form-control" id="model-barang" name="modelbarang" required>
                            <option>-- PILIH MODEL BARANG --</option>
                            <!-- perulangan untuk memanggil model barang -->
                            <?php foreach ($modelbarang as $dt) : ?>
                                <option value="<?= $dt ?>"><?= $dt ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ukuran">Ukuran<span class="required">*</span></label>
                        <select onchange="getBulanTahun()" class="form-control" id="ukuran" name="ukuran" required>
                            <option>-- PILIH JENIS UKURAN --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun<span class="required">*</span></label>
                        <select name="tahun" class="form-control" id="tahun" required>
                            <option value="">Pilih Tahun</option>
                        </select>
                    </div>
                    <input type="submit" name="Prediksi" value="Submit" class="btn btn-primary">
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->