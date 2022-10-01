<?php
defined('BASEPATH') or exit('No direct script access allowed');

class prediksi extends CI_Controller
{
    public function index()
    {
        //di ambil data dari table data_bulanan
        $data['data_bulanan'] = $this->dbulanan->getdhbulanan('data_bulanan');
        $data['modelbarang'] = [];
        $data['ukuran'] = [];

        foreach ($data['data_bulanan'] as $db) {
            array_push($data['modelbarang'], $db['modelbarang']);
        }
        foreach ($data['data_bulanan'] as $db) {
            array_push($data['ukuran'], $db['ukuran']);
        }

        // return data
        $data['modelbarang'] = array_unique($data['modelbarang']);
        $data['ukuran'] = array_unique($data['ukuran']);
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/prosesprediksi', $data);
        $this->load->view('template/footer');
        $this->load->view('load_js/prediksi');
    }


    public function get_ukuran($modelbarang)
    {

        //mengambil data dari database dengan modelbarang sesuai isi prameter
        $data = $this->db->get_where('data_bulanan', ['modelbarang' => $modelbarang])->result_array();

        //mengambil data ukuran
        $ukuran = [];
        foreach ($data as $dt) {
            array_push($ukuran, $dt['ukuran']);
        }

        // return data json agar bisa di baca oleh javascript
        echo json_encode(array_unique($ukuran));
    }

    public function get_penjualan($modelbarang, $ukuran, $tgl)
    {
        //mengambil data dari database dengan modelbarang sesuai isi 3 prameter
        $data = $this->db->get_where('data_bulanan', ['modelbarang' => $modelbarang, 'ukuran' => $ukuran, 'bulan'  => $tgl])->result_array();

        //mengambil data terjual
        $penjualan = [];
        foreach ($data as $dt) {
            array_push($penjualan, $dt['terjual']);
        }

        // return data json agar bisa di baca oleh javascript
        echo json_encode(array_sum($penjualan));
    }
}
