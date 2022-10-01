<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pmpredik extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['hasil'] = $this->dbulanan->getdhbulanan('data_bulanan');

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/pilihmodelpredik', $data);
        $this->load->view('template/footer');
    }
}
