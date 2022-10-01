<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modbarang extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Pusat Rompi Bandung';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/mdlbarang', $data);
        $this->load->view('template/footer');
    }

    public function tambahmodel()
    {
        $this->load->model('DModel');
        $idmodel = $this->input->post('idmodel');
        $modelbarang = $this->input->post('modelbarang');
        $ukuran = $this->input->post('ukuran');

        $ArrInsert  = array(
            'idmodel' => $idmodel,
            'modelbarang' => $modelbarang,
            'ukuran' => $ukuran
        );

        $this->DModel->insertDataModel($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <div>
          Data Berhasil Ditambah
        </div>
      </div>');
        redirect('databarang');
    }

    public function edit($idmodel)
    {
        $this->load->model('DModel');
        $id_barang = $this->input->post('id_barang');
        $modelbarang = $this->input->post('modelbarang');
        $ukuran = $this->input->post('ukuran');

        $ArrEdit  = array(
            'id_barang' => $id_barang,
            'modelbarang' => $modelbarang,
            'ukuran' => $ukuran
        );

        $this->DModel->editDataModel($ArrEdit);
        $this->session->set_flashdata('pesan2', '<div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Data Berhasil Diubah
        </div>
      </div>');
        redirect('databarang');
    }

    public function delete($id)
    {
        $this->load->model('DModel');
        $where = array('idmodel' => $id);
        $this->DModel->delete($where, 'tmodel');
        $this->session->set_flashdata('pesan1', '<div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Data Berhasil Dihapus
        </div>
      </div>');
        redirect('databarang');
    }
}
