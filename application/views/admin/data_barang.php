<?= $this->session->flashdata('pesan'); ?>
<?= $this->session->flashdata('pesan1'); ?>
<?= $this->session->flashdata('pesan2'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data Barang</h1>
  <div class="card shadow mb-4">
    <div class="card-header">
      <a href="<?= base_url('modbarang') ?>" class="btn btn-primary"><i class="fas fa-plus"> Tambah</i></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dtmodel" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Model Barang</th>
              <th scope="col">Ukuran</th>
              <th scope="col">Aksi</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($hasil as $datamodel) {
            ?>
              <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $datamodel['modelbarang'] ?></td>
                <td><?= $datamodel['ukuran'] ?></td>
                <td>
                  <button data-toggle="modal" data-target="#edit<?= $datamodel['idmodel'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                  <a href="<?= base_url('modbarang/delete/' . $datamodel['idmodel']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                </td>
              <?php } ?>
              </tr>
          </tbody>
        </table>
      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
  </div>
</div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<?php foreach ($hasil as $datamodel) { ?>
  <div class="modal fade" id="edit<?= $datamodel['idmodel'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?= form_open('modbarang/edit/' . $datamodel['idmodel']) ?>
          <input type="hidden" value="<?= $datamodel['idmodel'] ?>" name="id_barang">
          <div class="form-group">
            <label for="model">Model Barang<span class="required">*</span></label>
            <input type="text" value="<?= $datamodel['modelbarang'] ?>" class=" form-control" name="modelbarang" required>
          </div>
          <div class="form-group">
            <label for="ukuran">Ukuran<span class="required">*</span></label>
            <select class="form-control" name="ukuran" required>
              <option>-- PILIH JENIS UKURAN --</option>
              <option value="S" <?= $datamodel['ukuran'] == 'S' ? 'selected' : null ?>>S</option>
              <option value="M" <?= $datamodel['ukuran'] == 'M' ? 'selected' : null ?>>M</option>
              <option value="L" <?= $datamodel['ukuran'] == 'L' ? 'selected' : null ?>>L</option>
              <option value="XL" <?= $datamodel['ukuran'] == 'XL' ? 'selected' : null ?>>XL</option>
              <option value="XXL" <?= $datamodel['ukuran'] == 'XXL' ? 'selected' : null ?>>XXL</option>
              <option value="XXXL" <?= $datamodel['ukuran'] == 'XXXL' ? 'selected' : null ?>>XXXL</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

        <?= form_close() ?>
      </div>
    </div>
  </div>
<?php } ?>