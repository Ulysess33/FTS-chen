<?php
defined('BASEPATH') or exit('No direct script access allowed');

class fts extends CI_Controller
{
    public function index()
    {
        $modelbarang = 'Abinawa';
        $ukuran = 'L';
        $tahun = '2020';

        function sortByAge($a, $b)
        {
            return $a['terjual'] > $b['terjual'];
        }
        $data = $this->db->get_where('data_bulanan', ['modelbarang' => $modelbarang, 'ukuran' => $ukuran, 'tahun' => $tahun])->result_array();
        $jumlah_data = count($data);

        // sort($data);

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
        array_push($uod, $min);
        array_push($uod, $max);

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

        //fuzzifikasi
        $qryS = "SELECT *, MONTH(bulan) as bulan, k.tahun, k.terjual FROM `data_bulanan` k  where modelbarang = '$modelbarang' AND ukuran = '$ukuran'";
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

        //flr
        $qryS = "SELECT *, MONTH(bulan) as bulan, k.tahun, k.terjual FROM `data_bulanan` k  where modelbarang = '$modelbarang' AND ukuran = '$ukuran'";
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

        //flrg
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

        //defuzzifikasi

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

        //prediksi
        $_SESSION['interval'] = $interval;
        $_SESSION['rata2'] = $rata2;

        $qryS = "SELECT *, MONTH(bulan) as bulan, k.tahun, k.terjual FROM `data_bulanan` k  where modelbarang = '$modelbarang' AND ukuran = '$ukuran'";
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
    }
}
