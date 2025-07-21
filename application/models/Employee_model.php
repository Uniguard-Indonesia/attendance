<?php
class employee_model extends CI_Model
{
    private $_batchImport;

    public function setBatchImport($batchImport)
    {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData()
    {
        $data = $this->_batchImport;
        $this->db->insert_batch('employees', $data);
    }
    // get employee list


    public function get_employees()
    {
        $this->db->join('positions', 'positions.id_position = employees.id_position');
        $this->db->where(['employees.deleted' => 0]);
        return $this->db->get('employees')->result_array();
    }
    public function get_employees_where($field, $data)
    {
        $this->db->join('positions', 'positions.id_position = employees.id_position');
        $this->db->where(['employees.deleted' => 0]);
        return $this->db->get_where('employees', [$field => $data])->result_array();
    }

    public function get_employee($field, $data)
    {
        $this->db->join('positions', 'positions.id_position = employees.id_position');
        $this->db->where(['employees.deleted' => 0]);
        return $this->db->get_where('employees', [$field => $data])->row_array();
    }

    public function insert(...$data)
    {
        $this->db->insert('employees', $data[0]);
    }

    public function update($id_employee, ...$data)
    {
        $this->db->update('employees', $data[0], ['id_employee' => $id_employee]);
    }

    public function delete($id_employee)
    {
        // $this->db->where('id_employee', $id_employee);
        // $this->db->delete('employees');
        $this->db->update('employees', ['deleted' => 1, 'id_card' => '',], ['id_employee' => $id_employee]);
    }

    public function search_employee($filter)
    {
        $this->db->where('nama', $filter)->where('deleted', 0);
        $this->db->or_where('id_card', $filter)->where('deleted', 0);
        return $this->db->get('employees')->result_array();
    }
}
