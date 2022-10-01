<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'Login Page';
            $this->load->view('template/auth_header');
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $user = $this->db->get_where('admin', ['username' => $username, 'password' => $password])->row_array();
        if ($user) {
            $this->session->set_userdata('username', $username);
            if ($user['level'] == '2') {
                redirect('owner');
            } else {
                redirect('admin');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau Kata Sandi Salah</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('usename');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Log Out</div>');
        redirect('auth');
    }
}
