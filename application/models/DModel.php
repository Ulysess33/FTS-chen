<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DModel extends CI_Model
{
    public function getdatmod($datamodel)
    {
        $data = $this->db->get($datamodel);
        return $data->result_array();
    }

    function insertDataModel($data)
    {
        $this->db->insert('tmodel', $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function EditDataModel($data)
    {
        $this->db->where('idmodel', $data['id_barang']);
        $this->db->update('tmodel', array_slice($data, 1));
    }
}
