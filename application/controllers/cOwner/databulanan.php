<?php
defined('BASEPATH') or exit('No direct script access allowed');

class databulanan extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['hasil'] = $this->dbulanan->getdhbulanan('data_bulanan');

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarowner', $data);
        $this->load->view('template/topbarowner', $data);
        $this->load->view('owner/H_Bulanan', $data);
        $this->load->view('template/footer');
    }
}
