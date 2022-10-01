<?php
defined('BASEPATH') or exit('No direct script access allowed');

class databarang extends CI_Controller
{
    public function index()
    {
        $this->load->model('DModel');
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['hasil'] = $this->DModel->getdatmod('tmodel');

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/data_barang', $data);
        $this->load->view('template/footer');
    }
}
