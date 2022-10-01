<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data Penjualan</h1>
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
          <?= form_open('datapenjualan/tambahpenjualan') ?>
          <div class="form-group">
            <label for="model">Model Barang<span class="required">*</span></label>
            <select onchange="getUkuran2()" class="form-control" id="model-barang" name="modelbarang" required>
              <option value="">-- PILIH MODEL BARANG --</option>
              <!-- perulangan untuk memanggil model barang -->
              <?php foreach ($modelbarang as $dt) : ?>
                <option value="<?= $dt ?>"><?= $dt ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="ukuran">Ukuran<span class="required">*</span></label>
            <select onchange="getBulanTahun2()" class="form-control" id="ukuran" name="ukuran" required>
              <option value="">-- PILIH JENIS UKURAN --</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Tangga penjualan">Bulan<span class="required">*</span></label>
            <input id="tgl" type="date" name="bulan" class="form-control" value="" required>
          </div>
          <div class="form-group">
            <label for="tahun">Tahun<span class="required">*</span></label>
            <input type="number" class="form-control" name="tahun" required>
          </div>
          <div class="form-group">
            <label for="terjual">Terjual<span class="required">*</span></label>
            <input type="number" min="0" class="form-control" name="terjual" required>
          </div>
          <input type="submit" name="Prediksi" value="Submit" class="btn btn-primary">
          <?= form_close() ?>

          <?php
          if (!empty($_POST)) {
            $model = $_POST['modelbarang'];
            $ukuran = $_POST['ukuran'];
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $terjual = $_POST['terjual'];
          ?>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->