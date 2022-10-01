<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Pilih Model Untuk Prediksi</h1>
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
          <input type="submit" name="Prediksi" value="Submit" class="btn btn-primary">
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <?php
  if (!empty($_POST)) {



    if (empty($_POST['modelbarang']) || empty($_POST['ukuran'])) {
      echo 'ada yang belum diisi cok';
    } else {
  ?>


      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-header">.:: Proses Perhitungan ::.
            <!-- Button trigger modal -->

          </h2>

          <!-- /.row -->
          <div class="modal fade" id="addSurvey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" href="#interval" data-toggle="tab">Interval</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#fuzzifikasi" data-toggle="tab">Fuzzifikasi</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#flr" data-toggle="tab">Fuzzy Logic Relationship</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#flrg" data-toggle="tab">Fuzzy Logic Relationship Group</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#defuzzifikasi" data-toggle="tab">Defuzzifikasi FLRG</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#hasil" data-toggle="tab">Hasil Peramalan</a>
                </li>
              </ul>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="col-lg-12">
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <!-- Tab panes -->
                  <div class="tab-content" style='margin-top:-20px'>
                    <div class="tab-pane fade show active" id="interval">
                      <?php
                      $modelbarang = $this->input->post('modelbarang');
                      $ukuran = $this->input->post('ukuran');


                      function sortByAge($a, $b)
                      {
                        return $a['terjual'] > $b['terjual'];
                      }
                      $this->db->group_by('YEAR(bulan), MONTH(bulan)');
                      $data = $this->db->get_where('data_bulanan', ['modelbarang' => $modelbarang, 'ukuran' => $ukuran])->result_array();
                      $jumlah_data = count($data);

                      sort($data);

                      usort($data, 'sortByAge');
                      $dmin = $data[0]['terjual'];
                      $dmax = $data[$jumlah_data - 1]['terjual'];
                      $d1 = 0;
                      $d2 = 1;

                      // Pembentukan universe of discourse = U =[Dmin - D1, Dmax - D2]
                      $uod = array();
                      $min = $dmin - $d1;
                      $max = $dmax + $d2;

                      // array_push untuk memasukkan suatu nilai ke dalam array
                      array_push($uod, $dmin);
                      array_push($uod, $dmax);

                      // Menentukan Jangkauan
                      $jangkauan = ($uod[1] - $uod[0]);

                      // Menentukan interval = 1 + (3.3 * log(n))
                      $banyak_kelas = round((1 + (3.3 * log10($jumlah_data))));

                      // Cari panjang interval 
                      $panjang_interval = ($jangkauan / $banyak_kelas);

                      // print_r($temp_interval);
                      // die;

                      // print_r($temp_interval);
                      $interval = ($panjang_interval);
                      // echo "<br>";
                      // print_r($interval);
                      // die;
                      ?>

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <hr class="sidebar-divider">
                        <div>
                          <?php
                          $warna = array("danger", "primary", "success", "info", "warning");
                          $count_warna = 0;
                          $awal = $data[0]['terjual'];
                          $temp = $data[0]['terjual'];
                          $fts = [];
                          $interval = [];
                          for ($i = 1; $i <= $panjang_interval; $i++) {
                            $hitung = 0;
                            $awal += ($panjang_interval);
                            $hitung = round(($awal + $temp) / 2);
                            // echo 'U' . $i . ': ' . round($temp) . ' - ' . round($awal) . '<br>';
                            echo "<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>";
                            echo "<a class='btn btn-sm btn-block btn-" . $warna[$count_warna] . " block' style='margin-top:10px;'>U<sub>" . ($i) . "</sub></a>";
                            echo "<a class='btn btn-sm btn-block btn-default block' style='margin-bottom:10px;'><center>" . ($temp) . "-" . ($awal) . "</center></a>";
                            echo "</div>";
                            if ($count_warna < 4) $count_warna++;
                            else $count_warna = 0;
                            array_push($fts, ['title' => 'A' . +$i, 'from' => round($temp), 'to' => round($awal)]);

                            array_push($interval, [round($temp), round($awal)]);
                            $temp = $awal;
                          }

                          // $interval = transpose($interval);
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade in" id="fuzzifikasi">
                      <br>
                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                            <tr>
                              <th>
                                <center>No</center>
                              </th>
                              <th>
                                <center>Bulan</center>
                              </th>
                              <th>
                                <center>Tahun</center>
                              </th>
                              <th>
                                <center>Terjual</center>
                              </th>
                              <th>
                                <center>Fuzzifikasi</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            // $this->db->group_by('YEAR(bulan), MONTH(bulan)');
                            $qryS = "SELECT MONTH(bulan) as bulan, k.tahun, SUM(k.terjual) as terjual FROM `data_bulanan` k  where modelbarang = '$modelbarang' AND ukuran = '$ukuran' GROUP BY YEAR(bulan), MONTH(bulan)";
                            $qry2 = $this->db->query($qryS)->result_array();
                            $i = 0;
                            foreach ($qry2 as $data) {
                              echo "<tr>";
                              echo "<td><center>" . ($i + 1) . "</center></td>";
                              echo "<td align='center'>" . ucwords($data['bulan']) . "</td>";
                              echo "<td align='center'>" . ucwords($data['tahun']) . "</td>";
                              echo "<td><center>" . $data['terjual'] . "</center></td>";

                              $indeks = cek_interval($data['terjual'], $interval);
                              $fuzzifikasi[$i] = $indeks;
                              echo "<td><center>A<sub>" . $indeks . "</sub></center></td>";
                              echo "</tr>";

                              $i++;
                            }

                            ?>

                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                    <?php

                    // print_r($fuzzifikasi);
                    // die;
                    ?>

                    <div class="tab-pane fade in" id="flr">
                      <br>
                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                          <thead>
                            <tr>
                              <th>
                                <center>No</center>
                              </th>
                              <th>
                                <center>Urutan Waktu</center>
                              </th>
                              <th>
                                <center>FLR</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            $qryS = "SELECT MONTH(bulan) as bulan, k.tahun, SUM(k.terjual) as terjual FROM `data_bulanan` k  where modelbarang = '$modelbarang' AND ukuran = '$ukuran' GROUP BY YEAR(bulan), MONTH(bulan)";
                            $qry2 = $this->db->query($qryS)->result_array();
                            $i = 0;
                            foreach ($qry2 as $data) {
                              $waktu[] = $data;
                            }

                            // print_r($waktu);

                            /* for($i=0; $i<count($interval); $i++){
															$flrg[$i][0] = "";
														} */

                            for ($i = 0; $i < (count($waktu) - 1); $i++) {

                              echo "<tr>";
                              echo "<td><center>" . ($i + 1) . "</center></td>";
                              echo "<td style='padding-left:30px'>" . ucwords($waktu[$i]['bulan']) . " " . $waktu[$i]['tahun'] . " - " . ucwords($waktu[($i + 1)]['bulan']) . " " . $waktu[($i + 1)]['tahun'] . "</td>";
                              echo "<td><center>A<sub>" . $fuzzifikasi[$i] . "</sub> - A<sub>" . $fuzzifikasi[($i + 1)] . "</sub></center></td>";
                              echo "</tr>";

                              $save_flrg[($fuzzifikasi[$i] - 1)][] = $fuzzifikasi[($i + 1)];
                            }

                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>

                    <div class="tab-pane fade in" id="flrg">
                      <br>
                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                          <thead>
                            <tr>
                              <th>
                                <center>No</center>
                              </th>
                              <th>
                                <center>Current State</center>
                              </th>
                              <th>
                                <center>FLRG</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            for ($i = 0; $i < count($interval); $i++) {
                              if (!empty($save_flrg[$i])) {
                                $unik[$i] = array_unique($save_flrg[$i]);
                                foreach ($unik[$i] as $key => $value) {
                                  $flrg[$i][] = $value;
                                }
                              }
                            }
                            $x = 0;
                            for ($i = 0; $i < count($interval); $i++) {
                              if (!empty($flrg[$i])) {
                                echo "<tr>";
                                echo "<td align='center'>" . ($x + 1) . "</td>";
                                echo "<td align='center'>A<sub>" . ($i + 1) . "</sub> => </td>";
                                echo "<td align='center'>";
                                for ($j = 0; $j < count($flrg[$i]); $j++) {
                                  if ($j < (count($flrg[$i]) - 1))
                                    echo "A<sub>" . $flrg[$i][$j] . "</sub>, ";
                                  else
                                    echo "A<sub>" . $flrg[$i][$j] . "</sub>";
                                }
                                echo "</td>";
                                echo "</tr>";
                                $x++;
                              }
                            }
                            ?>

                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>

                    <div class="tab-pane fade in" id="defuzzifikasi">
                      <br>
                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example4">
                          <thead>
                            <tr>
                              <th>
                                <center>No</center>
                              </th>
                              <th>
                                <center>Current State</center>
                              </th>
                              <th>
                                <center>Next State</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php


                            for ($i = 0; $i < count($interval); $i++) {
                              $jml = 0;
                              if (!empty($flrg[$i])) {
                                for ($j = 0; $j < count($flrg[$i]); $j++) {
                                  $jml += (($interval[($flrg[$i][$j] - 1)][0] + $interval[($flrg[$i][$j] - 1)][1]) / 2);
                                }
                                $rata2[] = $jml / count($flrg[$i]);
                              } else {
                                $rata2[] = (($interval[$i][0] + $interval[$i][1]) / 2);
                              }
                            }

                            for ($i = 0; $i < count($rata2); $i++) {
                              echo "<tr>";
                              echo "<td align='center'>" . ($i + 1) . "</td>";
                              echo "<td align='center'>A<sub>" . ($i + 1) . "</sub></td>";
                              echo "<td align='center'>" . number_format($rata2[$i], 2) . "</td>";
                              echo "</tr>";
                            }

                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>

                    <div class="tab-pane fade in" id="hasil">
                      <br>
                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example5">
                          <thead>
                            <tr>
                              <th>
                                <center>No</center>
                              </th>
                              <th>
                                <center>Bulan</center>
                              </th>
                              <th>
                                <center>Tahun</center>
                              </th>
                              <th>
                                <center>Data Perkembangan Aktual</center>
                              </th>
                              <th>
                                <center>Fuzzifikasi</center>
                              </th>
                              <th>
                                <center>Peramalan</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $_SESSION['interval'] = $interval;
                            $_SESSION['rata2'] = $rata2;

                            $qryS = "SELECT MONTH(bulan) as bulan, k.tahun, SUM(k.terjual) as terjual FROM `data_bulanan` k  where modelbarang = '$modelbarang' AND ukuran = '$ukuran' GROUP BY YEAR(bulan), MONTH(bulan)";
                            $qry2 = $this->db->query($qryS)->result_array();
                            $i = 0;
                            $ramalan = "-";
                            foreach ($qry2 as $data) {
                              echo "<tr>";
                              echo "<td><center>" . ($i + 1) . "</center></td>";
                              echo "<td align='center'>" . ucwords($data['bulan']) . "</td>";
                              echo "<td align='center'>" . ucwords($data['tahun']) . "</td>";
                              echo "<td><center>" . $data['terjual'] . "</center></td>";

                              $indeks = cek_interval($data['terjual'], $interval);
                              echo "<td><center>A<sub>" . $indeks . "</sub></center></td>";
                              echo "<td><center>";
                              if ($i == 0) echo $ramalan;
                              else echo number_format($ramalan, 2);
                              echo "</center></td>";
                              echo "</tr>";

                              $data_insert = ['modelbarang' => $modelbarang, 'ukuran' => $ukuran, 'bulan' => $data['bulan'], 'tahun' => $data['tahun'], 'data_aktual' => $data['terjual'], 'peramalan' => is_numeric($ramalan) ? number_format($ramalan, 2) : $ramalan];

                              $cek = $this->db->get_where('hasil_prediksi', ['modelbarang' => $modelbarang, 'ukuran' => $ukuran, 'bulan' => $data['bulan'], 'tahun' => $data['tahun']])->row();
                              if ($cek) {
                                $this->db->update('hasil_prediksi', $data_insert, ['id' => $cek->id]);
                              } else {
                                $this->db->insert('hasil_prediksi', $data_insert);
                              }


                              $temp_bulan = $data['bulan'];
                              $temp_tahun = $data['tahun'];
                              $terjual = $data['terjual'];
                              $ramalan = $rata2[$indeks - 1];
                              $hasil[] = $ramalan;
                              $i++;
                            }
                            $bln = cek_bulan($temp_bulan);
                            // $data_bln = mysqli_fetch_array(mysqli_query($conn, "select * from bulan where id = " . $bln));
                            $bulan = $bln;

                            $tahun = cek_tahun($bln, $temp_tahun);

                            echo "<tr>";
                            echo "<td><center>" . ($i + 1) . "</center></td>";
                            echo "<td align='center'>" . ucwords($bulan) . "</td>";
                            echo "<td align='center'>" . $tahun . "</td>";
                            echo "<td align='center'>-</td>";
                            echo "<td><center>-</center></td>";
                            echo "<td><center>" . number_format($ramalan, 2) . "</center></td>";
                            echo "</tr>";

                            $data_insert = ['modelbarang' => $modelbarang, 'ukuran' => $ukuran, 'bulan' => $bulan, 'tahun' => $tahun, 'data_aktual' => 0, 'peramalan' => is_numeric($ramalan) ? number_format($ramalan, 2) : $ramalan];

                            $cek = $this->db->get_where('hasil_prediksi', ['modelbarang' => $modelbarang, 'ukuran' => $ukuran, 'bulan' => $bulan, 'tahun' => $tahun])->row();
                            if ($cek) {
                              $this->db->update('hasil_prediksi', $data_insert, ['id' => $cek->id]);
                            } else {
                              $this->db->insert('hasil_prediksi', $data_insert);
                            }


                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>

                    <div class="tab-pane fade in" id="akurasi">
                      <br>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <?php

                        // $qry = "select * from data_bulanan";
                        // $qry2 = mysqli_query($conn, $qry);
                        // $row = mysqli_num_rows(mysqli_query($conn, $qry));

                        $qryS = "SELECT MONTH(bulan) as bulan, k.tahun, SUM(k.terjual) as terjual FROM `data_bulanan` k  where modelbarang = '$modelbarang' AND ukuran = '$ukuran' GROUP BY YEAR(bulan), MONTH(bulan)";
                        $qry2 = $this->db->query($qryS)->result_array();
                        $row = count($qry2);
                        $i = 0;
                        $jml = 0;

                        foreach ($qry2 as $data2) {
                          $jml += abs(($data2['terjual'] - $hasil[$i]) / $data2['terjual']);
                          $i++;
                        }
                        $akurasi = (100 * $jml) / $row;
                        echo "<button class='btn btn-info'>MAPE</button>&nbsp;= <u>100 % x " . number_format($jml, 2);
                        echo "</u><br/>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row;
                        echo "<br/>";

                        echo "<button class='btn btn-info'>MAPE</button>&nbsp;= " . number_format($akurasi, 2) . " %";
                        echo "<br/>";

                        ?>
                      </div>
                    </div>

                  </div>
                </div>
                <!-- /.panel-body -->
              </div>
            </div>
            <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
      </div>
    <?php
    }

    ?>
  <?php
  }
  ?>
</div>


</div>