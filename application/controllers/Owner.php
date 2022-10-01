<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarowner', $data);
        $this->load->view('template/topbarowner', $data);
        $this->load->view('owner/index', $data);
        $this->load->view('template/footer');
    }
}
