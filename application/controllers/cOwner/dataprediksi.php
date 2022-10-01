<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dataprediksi extends CI_Controller
{
    public function index()
    {
        $this->load->model('hasilprediksi');
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['hasil'] = $this->hasilprediksi->getdatapredik('hpredik');

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarowner', $data);
        $this->load->view('template/topbarowner', $data);
        $this->load->view('owner/hasilprediksi', $data);
        $this->load->view('template/footer');
    }
}
