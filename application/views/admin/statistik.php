  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Statistik Penjualan</h1>
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
    <hr>
    <?php
    if (!empty($_POST)) {
      if (empty($_POST['modelbarang']) || empty($_POST['ukuran']) || empty($_POST['tahun'])) {
        echo 'ada yang belum diisi cok';
      } else {

        $modelbarang = $_POST['modelbarang'];
        $ukuran = $_POST['ukuran'];
        $tahun = $_POST['tahun'];

        $this->db->group_by('YEAR(bulan), MONTH(bulan)');
        $this->db->select('MONTH(bulan) as bulan, tahun, terjual');
        $data_penjualan = $this->db->get_where('data_bulanan', ['modelbarang' => $modelbarang, 'ukuran' => $ukuran, 'tahun' => $tahun])->result_array();
        // print_r($data_penjualan);
        // die;

        $arr_bulan = [];
        $arr_terjual = [];

        foreach ($data_penjualan as $d) {
          $arr_bulan[] = '"' . bulan_p($d['bulan']) . '"';
          $arr_terjual[] = $d['terjual'];
        }

        // print_r($arr_bulan);
        // die;


    ?>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= "$modelbarang $ukuran $tahun" ?></h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myAreaChart"></canvas>
            </div>
          </div>
        </div>
    <?php
      }
    } ?>
  </div>
  </div>



  <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?= implode(',', $arr_bulan) ?>],
        datasets: [{
          label: "Terjual",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: [<?= implode(',', $arr_terjual) ?>],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              // maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ':' + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });
  </script>