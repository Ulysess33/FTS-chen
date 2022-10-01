<?php
defined('BASEPATH') or exit('No direct script access allowed');

class statistik extends CI_Controller
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
        $this->load->view('admin/statistik', $data);
        $this->load->view('template/footer');
    }
}
