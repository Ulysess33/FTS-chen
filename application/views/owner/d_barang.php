<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Barang</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dtmodel" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Model Barang</th>
                            <th scope="col">Ukuran</th>

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