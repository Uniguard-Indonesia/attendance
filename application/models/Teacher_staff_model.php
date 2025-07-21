<?php
class Teacher_staff_model extends CI_Model
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
        $this->db->insert_batch('teacher_staffs', $data);
    }
    // get employee list
   

    public function get_teacher_staffs()
    {
        $this->db->where(['teacher_staffs.deleted' => 0]);
        return $this->db->get('teacher_staffs')->result_array();
    }

    public function get_teacher_staff($field, $data)
    {
        return $this->db->get_where('teacher_staffs', [$field => $data])->row_array();
    }

    public function insert(...$data)
    {
        $this->db->insert('teacher_staffs', $data[0]);
    }

    public function update($id_teacher_staff, ...$data)
    {
        $this->db->update('teacher_staffs', $data[0], ['id_teacher_staff' => $id_teacher_staff]);
    }

    public function delete($id_teacher_staff)
    {
        // $this->db->where('id_teacher_staff', $id_teacher_staff);
        // $this->db->delete('teacher_staffs');
        $this->db->update('teacher_staffs', ['deleted' => 1], ['id_teacher_staff' => $id_teacher_staff]);
    }

}
