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
        $this->load->view('template/sidebarowner', $data);
        $this->load->view('template/topbarowner', $data);
        $this->load->view('owner/d_barang', $data);
        $this->load->view('template/footer');
    }
}
