<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Pusat Rompi Bandung <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/index') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>/js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/'); ?>/js/demo/datatables-demo.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/Buttons-2.2.2/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/Buttons-2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/Buttons-2.2.2/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/Buttons-2.2.2/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>/vendor/datatables/Buttons-2.2.2/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: [{
                    extend: 'pdf',
                    split: ['csv', 'excel'],
                },
                'colvis'
            ]
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });

    $(document).ready(function() {
        $('#example').DataTable();
        $('#dataTables-example').DataTable();
        $('#dataTables-example2').DataTable();
        $('#dataTables-example3').DataTable();
        $('#dataTables-example4').DataTable();
        $('#dataTables-example5').DataTable();
    });


    $(document).ready(function() {
        var table = $('#dtmodel').DataTable({
            lengthChange: false,
            buttons: [{
                    extend: 'pdf',
                    split: ['csv', 'excel'],
                },
                'colvis'
            ]
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });


    $(document).ready(function() {
        var table = $('#dthasilp').DataTable({
            lengthChange: false,
            buttons: [{
                    extend: 'pdf',
                    split: ['csv', 'excel'],
                },
                'colvis'
            ]
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });


    $(document).ready(function() {
        var options = {
            chart: {
                renderTo: 'container',
                type: 'area'
            }
        };
        $.getJSON('admin/statistik', function(data) {
            options.series[0].data = data;
            var chart = new Highcharts.chart(options);
        });
    });

    // $(document).ready(function() {

    function getUkuran() {
        var model = $('#model-barang').val();
        if (model !== '') {
            $('#ukuran').html('<option value="">Loading</option');
            $.get("<?= base_url() ?>/hasilpredik/get_ukuran/" + model, function(data) {
                $('#ukuran').html(data);
            });
        }
    }

    function getBulanTahun() {
        var model = $('#model-barang').val();
        var ukuran = $('#ukuran').val();
        if (model !== '' && ukuran !== '') {
            $('#bulan').html('<option value="">Loading</option');
            $('#tahun').html('<option value="">Loading</option');
            $.getJSON("<?= base_url() ?>/hasilpredik/get_bulan_tahun/" + model + '/' + ukuran, function(data) {
                $('#bulan').html(data.bulan);
                $('#tahun').html(data.tahun);
            });
        } else {
            alert('model belum dipilih');
        }

    }


    function getUkuran2() {
        var model = $('#model-barang').val();
        if (model !== '') {
            $('#ukuran').html('<option value="">Loading</option');
            $.get("<?= base_url() ?>/datapenjualan/get_ukuran/" + model, function(data) {
                $('#ukuran').html(data);
            });
        }
    }

    function getBulanTahun2() {
        var model = $('#model-barang').val();
        var ukuran = $('#ukuran').val();
        if (model !== '' && ukuran !== '') {
            $('#bulan').html('<option value="">Loading</option');
            $('#tahun').html('<option value="">Loading</option');
            $.getJSON("<?= base_url() ?>/datapenjualan/get_bulan_tahun/" + model + '/' + ukuran, function(data) {
                $('#bulan').html(data.bulan);
                $('#tahun').html(data.tahun);
            });
        } else {
            alert('model belum dipilih');
        }

    }
</script>

</body>

</html>