<?php
class Attandance_device_model extends CI_Model
{
    public function get_attandance_devices()
    {
        $this->db->where(['deleted' => 0]);
        return $this->db->get('attandance_devices')->result_array();
    }

    public function get_attandance_device($field, $data)
    {
        return $this->db->get_where('attandance_devices', [$field => $data])->result_array();
    }

    public function insert(...$data)
    {
        $this->db->insert('attandance_devices', $data[0]);
    }

    public function update($id_attandance_device, ...$data)
    {
        $this->db->update('attandance_devices', $data[0], ['id_attandance_device' => $id_attandance_device]);
    }

    public function delete($id_attandance_device)
    {
        // $this->db->where('id_attandance_device', $id_attandance_device);
        // $this->db->delete('attandance_devices');
        $this->db->update('attandance_devices', ['deleted' => 1, 'device' => ''], ['id_attandance_device' => $id_attandance_device]);

    }
}
