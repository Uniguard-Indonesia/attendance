<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class employee_attandances extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(["form_validation", 'session']);
        $this->load->model(['employee_attandance_model', 'employee_model']);
        $this->load->helper(['form', 'url']);
        if (!$this->session->userdata('status')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
            <div class="alert-message">
            Login terlebih dahulu!
            </div>
        </div>');
            redirect('auth/login');
        }
    }

    public function report()
    {
        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'Viewer' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        if ($this->input->get('startDate') && $this->input->get('endDate')) {
            $attendances = $this->db->where('employee_attandances.date >=', $this->input->get('startDate'));
            $attendances = $this->db->where('employee_attandances.date <=', $this->input->get('endDate'));
        }
        $attendances = $this->db->order_by('employee_attandances.date', 'desc');
        $attendances = $this->employee_attandance_model->get_employee_attandances();

        $attendance_by_name = array();
        $dates = array();
        foreach ($attendances as $attendance) {
            $name = $attendance["id_employee"];
            $position = $attendance["id_device"];
            $date = $attendance["date"];
            $status = $attendance["status_hadir"];
            $ket = $attendance["ket"];
            $attendance_by_name[$name][$date]["status"] = $status;
            $attendance_by_name[$name][$date]["ket"] = $ket;
            $attendance_by_name[$name]["position"] = $position;
                        $attendance_by_name[$name]["real_name"] = $attendance['name'];

            if (!in_array($date, $dates)) {
                $dates[] = $date;
            }
        }


        $data = [
            'title' => 'Absensi karyawan',
            'dates' => $dates,
            'attendance_by_name' => $attendance_by_name
        ];

        $this->load->view('dashboard/employee_attandances/report', $data);
    }
    public function index()
    {
        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'Viewer' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        if ($this->input->get('startDate') && $this->input->get('endDate')) {
            $attandances = $this->db->where('employee_attandances.date >=', $this->input->get('startDate'));
            $attandances = $this->db->where('employee_attandances.date <=', $this->input->get('endDate'));
        }
        $attandances = $this->db->order_by('employee_attandances.date', 'desc');
        $attandances = $this->employee_attandance_model->get_employee_attandances();

        $data = [
            'title' => 'Absensi karyawan',
            'attandances' => $attandances
        ];

        $this->load->view('dashboard/employee_attandances/index', $data);
    }

    public function edit($id_employee_attandance)
    {
        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'Viewer' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $attandance = $this->db->join('employees', 'employees.id_employee = employee_attandances.id_employee');
        $attandance = $this->db->join('positions', 'positions.id_position = employees.id_position');
        $attandance = $this->db->get_where('employee_attandances', array('id_employee_attandance' => $id_employee_attandance))->row_array();
        $data = [
            'title' => 'Absensi karyawan',
            'employee_attandance' => $attandance
        ];

        $this->load->view('dashboard/employee_attandances/edit', $data);
    }

    public function update()
    {
        if ($this->session->userdata('role') == 'viewer') {
            show_404();
        }

        if ($this->session->userdata('role') == 'operator_absensi' && $this->input->post('is_updated') == 1) {
            show_404();
        }

        $this->form_validation->set_rules('masuk', 'Masuk', 'required|trim');
        $this->form_validation->set_rules('keluar', 'Keluar', 'required|trim');
        $this->form_validation->set_rules('status_hadir', 'Status Hadir', 'required|trim');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($this->input->post('id_employee_attandance'));
        } else {
            $this->employee_attandance_model->update($this->input->post('id_employee_attandance'), [
                'is_updated' => 1,
                'masuk' => $this->input->post('masuk'),
                'keluar' => $this->input->post('keluar'),
                'status_hadir' => $this->input->post('status_hadir'),
                'ket' => $this->input->post('ket'),
            ]);
            $this->session->set_flashdata('success', 'jabatan Berhasil Diperbarui!');
            redirect('employee_attandances');
        }
    }
}
