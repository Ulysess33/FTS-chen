<link href="<?= base_url('assets/'); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data History Bulanan</h1>
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Model Barang</th>
              <th scope="col">Ukuran</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Tahun</th>
              <th scope="col">Terjual</th>
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
              <?php } ?>
              </tr>
          </tbody>
        </table>
      </div>
      <!-- /.container-fluid -->
    </div>
  </div>
</div>