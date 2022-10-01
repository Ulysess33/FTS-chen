<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Edit Profil</h1>
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
          <?= form_open('cOwner/editprofilowner/edit/' . $dtprofil['id']) ?>
          <div class="form-group">
            <div class="form-group">
              <label for="username">Username<span class="required">*</span></label>
              <input type="text" name="username" class="form-control" value="<?= $dtprofil['username'] ?>" required>
            </div>
            <div class="form-group">
              <label for="nama">Nama<span class="required">*</span></label>
              <input type="text" name="nama" class="form-control" value="<?= $dtprofil['nama'] ?>" required>
            </div>
            <div class="form-group">
              <label for="password">Password<span class="required">*</span></label>
              <input type="password" class="form-control" name="password" value="" placeholder="Masukkan Kata Sandi Baru">
            </div>
            <div class="form-group">
              <label for="level">Level<span class="required">*</span></label>
              <input type="number" min="0" class="form-control" name="level" value="<?= $dtprofil['level'] ?>" readonly>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <?= form_close() ?>

            <?php
            if (!empty($_POST)) {
              $id = $_POST['id'];
              $nama = $_POST['nama'];
              $username = $_POST['username'];
              $password = $_POST['password'];
              $level = $_POST['level'];
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
</div>

<!-- End of Main Content -->