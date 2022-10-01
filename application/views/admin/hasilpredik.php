<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Prediksi Penjualan</h1>
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
              <option value="">-- PILIH MODEL BARANG --</option>
              <!-- perulangan untuk memanggil model barang -->
              <?php foreach ($modelbarang as $dt) : ?>
                <option value="<?= $dt ?>"><?= $dt ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="ukuran">Ukuran<span class="required">*</span></label>
            <select onchange="getBulanTahun()" class="form-control" id="ukuran" name="ukuran" required>
              <option value="">-- PILIH JENIS UKURAN --</option>
            </select>
          </div>
          <div class="form-group">
            <label for="bulan">Berdasarkan Data Bulan<span class="required">*</span></label>
            <select name="bulan" class="form-control" id="bulan" required>
              <option value="">Pilih Bulan</option>
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

          <?php
          if (!empty($_POST)) {
            $model = $_POST['modelbarang'];
            $ukuran = $_POST['ukuran'];
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];

            $bulan_ini = $this->db->get_where('hasil_prediksi', ['modelbarang' => $model, 'ukuran' => $ukuran, 'bulan' => $bulan, 'tahun' => $tahun])->row();

            $next_bulan = cek_bulan($bulan);
            $next_tahun = cek_tahun($next_bulan, $tahun);

            $bulan_depan = $this->db->get_where('hasil_prediksi', ['modelbarang' => $model, 'ukuran' => $ukuran, 'bulan' => $next_bulan, 'tahun' => $next_tahun])->row();


          ?>
            <hr>
            <div class="form-group">
              <label for="penjualan">Total terjual<span class="required">*</span></label>
              <?php
              if ($bulan_ini) {
              ?>
                <p>Total penjualan untuk model <?= $model ?> ukuran <?= $ukuran ?> pada <?= bulan($bulan) ?> <?= $tahun ?> adalah <?= $bulan_ini->data_aktual ?></p>
              <?php
              } else {
              ?>
                <p>Data tidak ditemukan, silahkan lakukan perhitungan pada menu Proses Prediksi</p>
              <?php
              }
              ?>
            </div>
            <div class="form-group">
              <label for="hpredik">Hasil Prediksi<span class="required">*</span></label>

              <?php
              if ($bulan_depan) {
                $ArrInsert  = array(
                  'modelbarang' => $model,
                  'ukuran' => $ukuran,
                  'bulan' => $bulan_depan->bulan,
                  'tahun' => $bulan_depan->tahun,
                  'hasil' => $bulan_depan->peramalan
                );

                $this->hasilprediksi->insertHasilprediksi($ArrInsert);
              ?>
                <p>Hasil prediksi bulan depan untuk model <?= $model ?> ukuran <?= $ukuran ?> pada <?= bulan($bulan_depan->bulan) ?> <?= $bulan_depan->tahun ?> adalah <?= $bulan_depan->peramalan ?></p>
              <?php
              } else {
              ?>
                <p>Data tidak ditemukan, silahkan lakukan perhitungan pada menu Proses Prediksi</p>
              <?php
              }
              ?>
              <p></p>
            </div>
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