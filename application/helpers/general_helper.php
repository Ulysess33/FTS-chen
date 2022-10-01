<?php
function transpose($temp_interval)
{
	$x = 0;
	for ($i = count($temp_interval); $i > 0; $i--) {
		$data[$x] = $temp_interval[$i - 1];
		$x++;
	}
	return $data;
}

function cek_interval($data, $interval)
{
	$indeks = 1;
	for ($i = 1; $i < count($interval); $i++) {
		if (($data > $interval[$i][0]) && ($data <= $interval[$i][1]))
			$indeks = ($i + 1);
	}
	return $indeks;
}

function cek_nilai($flrg, $data1, $data2)
{
	$indeks = 0;

	for ($i = 0; $i < count($flrg); $i++) {
		for ($j = 0; ($j < count($flrg[$i]) - 1); $j++) {
			echo $flrg[$i][$j] . "==" . $flrg[$data1][$data2];
			echo "<br>";
		}
		echo "<br>";
	}

	return $indeks;
}

function cek_bulan($temp_bulan)
{
	if ($temp_bulan != 12)
		$bulan = ($temp_bulan + 1);
	else
		$bulan = 1;
	return $bulan;
}

function cek_tahun($bulan, $temp_tahun)
{
	if ($bulan == 1) $temp_tahun = $temp_tahun + 1;
	return $temp_tahun;
}

/**
 * Helpher untuk mencetak tanggal dalam format bahasa indonesia
 *
 * @package CodeIgniter
 * @category Helpers
 * @author Ardianta Pargo (ardianta_pargo@yhaoo.co.id)
 * @link https://gist.github.com/ardianta/ba0934a0ee88315359d30095c7e442de
 * @version 1.0
 */

/**
 * Fungsi untuk merubah bulan bahasa inggris menjadi bahasa indonesia
 * @param int nomer bulan, Date('m')
 * @return string nama bulan dalam bahasa indonesia
 */
if (!function_exists('bulan')) {
	function bulan($bulan)
	{
		// $bulan = Date('m');
		switch ($bulan) {
			case 1:
				$bulan = "Januari";
				break;
			case 2:
				$bulan = "Februari";
				break;
			case 3:
				$bulan = "Maret";
				break;
			case 4:
				$bulan = "April";
				break;
			case 5:
				$bulan = "Mei";
				break;
			case 6:
				$bulan = "Juni";
				break;
			case 7:
				$bulan = "Juli";
				break;
			case 8:
				$bulan = "Agustus";
				break;
			case 9:
				$bulan = "September";
				break;
			case 10:
				$bulan = "Oktober";
				break;
			case 11:
				$bulan = "November";
				break;
			case 12:
				$bulan = "Desember";
				break;

			default:
				$bulan = Date('F');
				break;
		}
		return $bulan;
	}
}


if (!function_exists('bulan_p')) {
	function bulan_p($bulan)
	{
		// $bulan = Date('m');
		switch ($bulan) {
			case 1:
				$bulan = "Jan";
				break;
			case 2:
				$bulan = "Feb";
				break;
			case 3:
				$bulan = "Mar";
				break;
			case 4:
				$bulan = "Apr";
				break;
			case 5:
				$bulan = "Mei";
				break;
			case 6:
				$bulan = "Jun";
				break;
			case 7:
				$bulan = "Jul";
				break;
			case 8:
				$bulan = "Agu";
				break;
			case 9:
				$bulan = "Sep";
				break;
			case 10:
				$bulan = "Okt";
				break;
			case 11:
				$bulan = "Nov";
				break;
			case 12:
				$bulan = "Des";
				break;

			default:
				$bulan = Date('F');
				break;
		}
		return $bulan;
	}
}
