<?php
class Teacher_staff_attandance_model extends CI_Model
{
    public function get_teacher_staff_attandances()
    {
        $this->db->where(['deleted' => 0, 'id_teacher_staff_attandance !=' => 0]);        
        $this->db->join('teacher_staffs', 'teacher_staffs.id_teacher_staff = teacher_staff_attandances.id_teacher_staff');
        $this->db->select('teacher_staff_attandances.*, teacher_staffs.nama as teacher_staff_nama, teacher_staffs.jabatan as teacher_staff_jabatan');
        return $this->db->get('teacher_staff_attandances')->result_array();
    }
    public function get_teacher_staff_attandace($date, $id_teacher_staff)
    {
        // $this->db->join('teacher_staffs', 'teacher_staffs.id_teacher_staff = teacher_staffs.id_teacher_staff');
        return $this->db->get_where('teacher_staff_attandances', array('teacher_staff_attandances.date' => $date, 'id_teacher_staff' => $id_teacher_staff ))->row_array();
    }
    public function get_teacher_staff_attandace2($field, $id_teacher_staff_attandance, $field2, $id_teacher_staff_attandance2)
    {
        $this->db->join('teacher_staffs', 'teacher_staffs.id_teacher_staff = teacher_staff_attandances.id_teacher_staff');
        return $this->db->get_where('teacher_staff_attandances', array($field => $id_teacher_staff_attandance, $field2 => $id_teacher_staff_attandance2))->row_array();
    }
    public function insert(...$data)
    {
        $this->db->insert('teacher_staff_attandances', $data[0]);
    }
    public function update($id_teacher_staff_attandance, ...$data)
    {
        $this->db->update('teacher_staff_attandances', $data[0], ['id_teacher_staff_attandance' => $id_teacher_staff_attandance]);
    }
    public function delete($id_teacher_staff_attandance)
    {
        // $this->db->where('id_teacher_staff_attandance', $id_teacher_staff_attandance);
        // $this->db->delete('teacher_staff_attandances');
        $this->db->update('teacher_staff_attandances', ['deleted' => 1], ['id_teacher_staff_attandance' => $id_teacher_staff_attandance]);
    }

    public function groupby_date_teacher_staff()
    {
        return $this->db->query('SELECT date, COUNT(*) AS total
        FROM teacher_staff_attandances
        WHERE status_hadir != "Alfa"
        GROUP BY date;
        ')->result_array();
    }
}