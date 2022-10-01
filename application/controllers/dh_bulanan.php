<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dh_bulanan extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['hasil'] = $this->dbulanan->getdhbulanan('data_bulanan');
        $data['modelbarang'] = $this->db->get('tmodel')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/dabul', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        $this->load->model('dbulanan');
        $where = array('id_bulanan' => $id);
        $this->dbulanan->delete($where, 'data_bulanan');
        $this->session->set_flashdata('pesan1', '<div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Data Berhasil Dihapus
        </div>
      </div>');
        redirect('dh_bulanan');
    }

    public function edit($id_bulanan)
    {
        $this->load->model('dbulanan');
        $modelbarang = $this->input->post('modelbarang');
        $ukuran = $this->input->post('ukuran');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $terjual = $this->input->post('terjual');

        $ArrEdit  = array(
            'id_bulanan' => $id_bulanan,
            'modelbarang' => $modelbarang,
            'ukuran' => $ukuran,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'terjual' => $terjual
        );

        $this->dbulanan->editDataPenjualan($ArrEdit);
        $this->session->set_flashdata('pesan2', '<div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Data Berhasil Diubah
        </div>
      </div>');
        redirect('dh_bulanan');
    }
}
