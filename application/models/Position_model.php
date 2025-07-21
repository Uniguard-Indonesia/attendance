<?php
class position_model extends CI_Model
{
    public function get_positions()
    {
        $this->db->where(['deleted' => 0, 'id_position !=' => 0]);
        return $this->db->get('positions')->result_array();
    }

    public function get_position($field, $id_position)
    {
        return $this->db->get_where('positions', array($field => $id_position))->result_array();
    }

    public function insert(...$data)
    {
        $this->db->insert('positions', $data[0]);
    }

    public function update($id_position, ...$data)
    {
        $this->db->update('positions', $data[0], ['id_position' => $id_position]);
    }

    public function delete($id_position)
    {
        // $this->db->where('id_position', $id_position);
        // $this->db->delete('positions');

        $this->db->update('positions', ['deleted' => 1], ['id_position' => $id_position]);
    }
}
