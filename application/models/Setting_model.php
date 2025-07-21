<?php
class Setting_model extends CI_Model
{
    public function get_settings()
    {
        return $this->db->get('settings')->result_array();
    }

    public function get_setting($field, $id_setting)
    {
        return $this->db->get_where('settings', array($field => $id_setting))->row_array();
    }

    public function update($id_setting, ...$data)
    {
        $this->db->update('settings', $data[0], ['id_setting' => $id_setting]);
    }
}
