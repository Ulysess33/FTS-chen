<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dbulanan extends CI_Model
{
    public function getdhbulanan($dhbulanan)
    {
        $data = $this->db->get($dhbulanan);
        return $data->result_array();
    }

    function insertDatabulanan($data)
    {
        $this->db->insert('data_bulanan', $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function editDataPenjualan($data)
    {
        $this->db->where('id_bulanan', $data['id_bulanan']);
        $this->db->update('data_bulanan', $data);
    }
}
