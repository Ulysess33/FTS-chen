<?php
defined('BASEPATH') or exit('No direct script access allowed');

class editprofilowner extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Pusat Rompi Bandung';
        $data_user = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        $data['admin'] = $data_user;
        $data['dtprofil'] = $data_user;
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarowner', $data);
        $this->load->view('template/topbarowner', $data);
        $this->load->view('owner/editprofilowner', $data);
        $this->load->view('template/footer');
    }

    public function edit($id)
    {
        $this->load->model('dprofil');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');

        $ArrEdit  = array(
            'id' => $id,
            'nama' => $nama,
            'username' => $username,
            'level' => $level,
        );

        if (!empty($password)) {
            $ArrEdit['password'] = md5($password);
        }

        // print_r($ArrEdit);
        $update = $this->dprofil->editDataProfil($ArrEdit);

        redirect('cOwner/editprofilowner');
    }
}
