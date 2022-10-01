<?php
defined('BASEPATH') or exit('No direct script access allowed');

class datapredik extends CI_Controller
{
    public function index()
    {
        $this->load->model('hasilprediksi');
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['hasil'] = $this->hasilprediksi->getdatapredik('hpredik');

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/historipredik', $data);
        $this->load->view('template/footer');
    }
}
