<?php
defined('BASEPATH') or exit('No direct script access allowed');

class datapenjualan extends CI_Controller
{
    public function index()
    {
        $this->load->model('DModel');
        $data['tmodel'] = $this->DModel->getdatmod('tmodel');
        $data['modelbarang'] = [];
        $data['ukuran'] = [];

        foreach ($data['tmodel'] as $db) {
            array_push($data['modelbarang'], $db['modelbarang']);
        }
        foreach ($data['tmodel'] as $db) {
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
        $this->load->view('admin/datapenjualan', $data);
        $this->load->view('template/footer');
    }

    public function get_ukuran($modelbarang)
    {

        //mengambil data dari database dengan modelbarang sesuai isi prameter
        $this->db->group_by('ukuran');
        $data = $this->db->get_where('tmodel', ['modelbarang' => $modelbarang])->result_array();

        //mengambil data ukuran
        $hasil = '<option value="">Pilih Ukuran</option>';
        foreach ($data as $dt) {
            // array_push($ukuran, $dt['ukuran']);
            $hasil .= '<option value="' . $dt['ukuran'] . '">' . $dt['ukuran'] . '</option>';
        }

        // return data json agar bisa di baca oleh javascript
        // echo json_encode(array_unique($ukuran));
        echo $hasil;
    }

    public function tambahpenjualan()
    {
        $this->load->model('DModel');
        $modelbarang = $this->input->post('modelbarang');
        $ukuran = $this->input->post('ukuran');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $terjual = $this->input->post('terjual');

        $ArrInsert  = array(
            'modelbarang' => $modelbarang,
            'ukuran' => $ukuran,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'terjual' => $terjual
        );

        $this->dbulanan->insertDatabulanan($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <div>
          Data Berhasil Ditambah
        </div>
      </div>');
        redirect('dh_bulanan');
    }
}
