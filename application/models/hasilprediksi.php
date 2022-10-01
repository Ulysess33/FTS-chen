<?php
defined('BASEPATH') or exit('No direct script access allowed');

class hasilprediksi extends CI_Model
{
    public function gethasilprediksi($hasilprediksi)
    {
        $data = $this->db->get($hasilprediksi);
        return $data->result_array();
    }

    public function getdatapredik($datapredik)
    {
        $data = $this->db->get($datapredik);
        return $data->result_array();
    }

    function insertHasilprediksi($data)
    {
        $this->db->insert('hpredik', $data);
    }
}
