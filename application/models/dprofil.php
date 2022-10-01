<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dprofil extends CI_Model
{
    public function getdataprofil($dtprofil)
    {
        $data = $this->db->get($dtprofil);
        return $data->result_array();
    }

    function editDataProfil($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        return $this->db->update('admin', $data);
    }
}
