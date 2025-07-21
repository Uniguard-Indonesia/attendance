<?php
class User_model extends CI_Model
{
    public function get_users()
    {
        $this->db->join('roles', 'roles.id_role = users.id_role');
        $this->db->where(['deleted' => 0]);
        return $this->db->get('users')->result_array();
    }

    public function get_user($field, $data)
    {
        $this->db->join('roles', 'roles.id_role = users.id_role');
        return $this->db->get_where('users', [$field => $data])->row_array();
    }

    public function insert(...$data)
    {
        $this->db->insert('users', $data[0]);
    }

    public function update($id_user, ...$data)
    {
        $this->db->update('users', $data[0], ['id_user' => $id_user]);
    }

    public function delete($id_user)
    {

        $this->db->update('users', ['deleted' => 1], ['id_user' => $id_user]);

    }
}

