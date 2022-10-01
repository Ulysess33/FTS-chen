  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Model Barang</h1>
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
            <?= form_open('modbarang/tambahmodel') ?>
            <div class="form-group">
              <label for="model">Model Barang<span class="required">*</span></label>
              <input type="text" class="form-control" name="modelbarang" required>
            </div>
            <div class="form-group">
              <label for="ukuran">Ukuran<span class="required">*</span></label>
              <select class="form-control" name="ukuran" value="" required>
                <option value="">-- PILIH JENIS UKURAN --</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="XXXL">XXXL</option>
              </select>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->