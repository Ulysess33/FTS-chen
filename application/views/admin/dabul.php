<?= $this->session->flashdata('pesan'); ?>
<?= $this->session->flashdata('pesan1'); ?>
<?= $this->session->flashdata('pesan2'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data History Bulanan</h1>
  <div class="card shadow mb-4">
    <div class="card-header">
      <a href="<?= base_url('datapenjualan') ?>" class="btn btn-primary"><i class="fas fa-plus"> Penjualan</i></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table data-order='[[ 0, "desc" ]]' class="table table-bordered" id="example" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Model Barang</th>
              <th scope="col">Ukuran</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Tahun</th>
              <th scope="col">Terjual</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($hasil as $dhbulanan) {
            ?>
              <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $dhbulanan['modelbarang'] ?></td>
                <td><?= $dhbulanan['ukuran'] ?></td>
                <td><?= $dhbulanan['bulan'] ?></td>
                <td><?= $dhbulanan['tahun'] ?></td>
                <td><?= $dhbulanan['terjual'] ?></td>
                <td>
                  <button data-toggle="modal" data-target="#edit<?= $dhbulanan['id_bulanan'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                  <a href="<?= base_url('dh_bulanan/delete/' . $dhbulanan['id_bulanan']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                </td>
              <?php } ?>
              </tr>
          </tbody>
        </table>
      </div>
      <!-- /.container-fluid -->
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<?php foreach ($hasil as $dhbulanan) { ?>
  <div class="modal fade" id="edit<?= $dhbulanan['id_bulanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?= form_open('dh_bulanan/edit/' . $dhbulanan['id_bulanan']) ?>
          <div class="form-group">
            <label for="model">Model Barang<span class="required">*</span></label>
            <select onchange="getUkuran2()" class="form-control" id="model-barang" name="modelbarang" required>
              <option>-- PILIH MODEL BARANG --</option>
              <!-- perulangan untuk memanggil model barang -->
              <?php foreach ($modelbarang as $dt) : ?>
                <option value="<?= $dt['modelbarang'] ?>" <?= $dt['modelbarang'] == $dhbulanan['modelbarang'] ? 'selected' : null ?>><?= $dt['modelbarang'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="ukuran">Ukuran<span class="required">*</span></label>
            <select onchange="getBulanTahun2()" class="form-control" id="ukuran" name="ukuran" required>
              <option>-- PILIH JENIS UKURAN --</option>
              <option value="S" <?= $dhbulanan['ukuran'] == 'S' ? 'selected' : null ?>>S</option>
              <option value="M" <?= $dhbulanan['ukuran'] == 'M' ? 'selected' : null ?>>M</option>
              <option value="L" <?= $dhbulanan['ukuran'] == 'L' ? 'selected' : null ?>>L</option>
              <option value="XL" <?= $dhbulanan['ukuran'] == 'XL' ? 'selected' : null ?>>XL</option>
              <option value="XXL" <?= $dhbulanan['ukuran'] == 'XXL' ? 'selected' : null ?>>XXL</option>
              <option value="XXXL" <?= $dhbulanan['ukuran'] == 'XXXL' ? 'selected' : null ?>>XXXL</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Tangga penjualan">Bulan<span class="required">*</span></label>
            <input id="tgl" type="date" value="<?= $dhbulanan['bulan'] ?>" name="bulan" class="form-control">
          </div>
          <div class="form-group">
            <label for="tahun">Tahun<span class="required">*</span></label>
            <input type="number" value="<?= $dhbulanan['tahun'] ?>" class="form-control" name="tahun" required>
          </div>
          <div class="form-group">
            <label for="terjual">Terjual<span class="required">*</span></label>
            <input type="number" value="<?= $dhbulanan['terjual'] ?>" min="0" class="form-control" name="terjual" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          <?= form_close() ?>

        </div>
      </div>
    </div>
  </div>
<?php } ?>