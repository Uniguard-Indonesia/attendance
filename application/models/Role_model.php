<?php
class Role_model extends CI_Model
{
    public function get_roles()
    {
        return $this->db->get('roles')->result_array();
    }

    public function get_role($field, $id_roles)
    {
        return $this->db->get_where('roles', array($field => $id_roles))->result_array();
    }

}
