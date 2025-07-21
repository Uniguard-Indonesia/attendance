<?php
class Operational_time_model extends CI_Model
{
    public function get_operational_times()
    {
        return $this->db->get('operational_times')->result_array();
    }

    public function get_operational_time($type)
    {
        return $this->db->get_where('operational_times', array('type' => $type))->row_array();
    }

    public function insert(...$data)
    {
        $this->db->insert('operational_times', $data[0]);
    }

    public function update($id_operational_time, ...$data)
    {
        $this->db->update('operational_times', $data[0], ['id_operational_time' => $id_operational_time]);
    }

    public function delete($id_operational_time)
    {
        // $this->db->where('id_operational_time', $id_operational_time);
        // $this->db->delete('operational_times');

        $this->db->update('operational_times', ['deleted' => 1], ['id_operational_time' => $id_operational_time]);
    }
}
