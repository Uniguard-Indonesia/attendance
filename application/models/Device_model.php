<?php
class Device_model extends CI_Model
{
    public function get_devices()
    {
        $this->db->where(['deleted' => 0]);
        return $this->db->get('devices')->result_array();
    }

    public function get_device($field, $data)
    {
        return $this->db->get_where('devices', [$field => $data])->result_array();
    }

    public function insert(...$data)
    {
        $this->db->insert('devices', $data[0]);
    }

    public function update($id_device, ...$data)
    {
        $this->db->update('devices', $data[0], ['id_device' => $id_device]);
    }

    public function delete($id_device)
    {
        // $this->db->where('id_device', $id_device);
        // $this->db->delete('devices');
        $this->db->update('devices', ['deleted' => 1, 'device' => ''], ['id_device' => $id_device]);

    }
}
