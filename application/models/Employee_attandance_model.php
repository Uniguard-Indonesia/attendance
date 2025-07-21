<?php
class employee_attandance_model extends CI_Model
{
    public function get_employee_attandances()
    {
        // $this->db->where(['employees.deleted' => 0, 'id_employee_attandance !=' => 0]);
        // $this->db->join('employees', 'employees.id_employee = employee_attandances.id_employee');
        // $this->db->join('positions', 'positions.id_position = employees.id_position');
        // $this->db->select('employee_attandances.*, employees.nama as employee_nama,  jabatan as employee_jabatan');
        return $this->db->get('employee_attandances')->result_array();
    }
    public function get_employee_attandace($date, $id_employee)
    {
        // $this->db->join('employees', 'employees.id_employee = employees.id_employee');
        return $this->db->get_where('employee_attandances', array('employee_attandances.date' => $date, 'id_employee' => $id_employee))->row_array();
    }
    public function get_employee_attandace2($field, $id_employee_attandance, $field2, $id_attandance2)
    {
        // $this->db->join('employees', 'employees.id_employee = employee_attandances.id_employee');
        return $this->db->get_where('employee_attandances', array($field => $id_employee_attandance, $field2 => $id_attandance2))->row_array();
    }

    public function insert(...$data)
    {
        $this->db->insert('employee_attandances', $data[0]);
    }

    public function update($id_employee_attandance, ...$data)
    {
        $this->db->update('employee_attandances', $data[0], ['id_employee_attandance' => $id_employee_attandance]);
    }

    public function delete($id_employee_attandance)
    {
        // $this->db->where('id_employee_attandance', $id_employee_attandance);
        // $this->db->delete('employee_attandances');

        $this->db->update('employee_attandances', ['deleted' => 1], ['id_employee_attandance' => $id_employee_attandance]);
    }

    public function groupby_date_employee()
    {
        return $this->db->query('SELECT date, COUNT(*) AS total
        FROM employee_attandances
        WHERE status_hadir != "Alfa"
        GROUP BY date;
        ')->result_array();
    }
}
