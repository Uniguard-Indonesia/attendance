<?php
class Holiday_model extends CI_Model
{
    public function get_holidays()
    {
      
        return $this->db->get('holidays')->result_array();
    }

    public function get_holiday($field, $id_holiday)
    {
        return $this->db->get_where('holidays', array($field => $id_holiday))->row_array();
    }

    public function insert(...$data)
    {
        return $this->db->insert('holidays', $data[0]);
    }

    public function update($id_holiday, ...$data)
    {
        return $this->db->update('holidays', $data[0], ['id_holiday' => $id_holiday]);
    }

    public function delete($id_holiday)
    {
        $this->db->where('id_holiday', $id_holiday);
        $this->db->delete('holidays');
    }
}