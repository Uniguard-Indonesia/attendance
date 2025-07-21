<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Reader\Csv;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Holidays extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(["form_validation", 'session']);
        $this->load->model(['holiday_model']);
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

    public function index()
    {
        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'Viewer' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Libur',
            'holidays' => $this->holiday_model->get_holidays(),
            'weekly_holidays' => $this->db->get('weekly_holidays')->result_array(),
        ];

        $this->load->view('dashboard/holidays/index', $data);
    }

    public function create()
    {
        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'Viewer' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Libur',
        ];

        $this->load->view('dashboard/holidays/create', $data);
    }

    public function store()
    {
        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'Viewer' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('nama', 'Holiday Name', 'required|trim');
        $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');
        $this->form_validation->set_rules('type', 'Type', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

            $this->holiday_model->insert([
                'name' => $this->input->post('nama'),
                'waktu' => $this->input->post('waktu'),
                'type' => $this->input->post('type'),
            ]);

            $this->session->set_flashdata('success', 'jabatan Berhasil Ditambahkan!');
            redirect('holidays');
        }
    }

    public function view($id_holiday)
    {
        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'Viewer' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Libur',
            'holiday' => $this->holiday_model->get_holiday('id_holiday', $id_holiday)
        ];

        $this->load->view('dashboard/holidays/view', $data);
    }

    public function edit($id_holiday)
    {
        if ($this->session->userdata('role') !== 'admin_absensi'  && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }

        $data = [
            'title' => 'Libur',
            'holiday' => $this->holiday_model->get_holiday('id_holiday', $id_holiday)
        ];
        $this->load->view('dashboard/holidays/edit', $data);
    }

    public function update()
    {
        if ($this->session->userdata('role') !== 'admin_absensi'  && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('nama', 'Holiday Name', 'required|trim');
        $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($this->input->post('id_holiday'));
        } else {
            $this->holiday_model->update($this->input->post('id_holiday'), [
                'name' => $this->input->post('nama'),
                'waktu' => $this->input->post('waktu'),
                'type' => $this->input->post('type'),
            ]);
            $this->session->set_flashdata('success', 'jabatan Berhasil Diperbarui!');
            redirect('holidays');
        }
    }

    public function delete($id_holiday)
    {
        if ($this->session->userdata('role') !== 'admin_absensi'  && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $this->holiday_model->delete($id_holiday);
        $this->session->set_flashdata('success', 'jabatan Berhasil Dihapus!');

        redirect('holidays');
    }

    public function employees($id_holiday)
    {

        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $employee = $this->employee_model->get_employees_where('employees.id_holiday', $id_holiday);
        $data = [
            'title' => 'Libur',
            'holidays' => $this->holiday_model->get_holidays(),
            'holiday' => $this->holiday_model->get_holiday('id_holiday', $id_holiday)[0],
            'employees' => $employee
        ];



        $this->load->view('dashboard/holidays/employees', $data);
    }

    public function employee_update()
    {
        if ($this->input->post('chkbox[]') !== null) {
            foreach ($this->input->post('chkbox[]') as $chkbox) {
                $this->employee_model->update($chkbox, [
                    'id_holiday' => $this->input->post('position'),
                ]);
            }
            $this->employees($this->input->post('id_holiday'));
        } else {
            $this->employees($this->input->post('id_holiday'));
        }
    }

    public function weekly_holidays()
    {

        $this->db->truncate('weekly_holidays');
        if ($this->input->post('days[]')) {
            $data = $this->input->post('days[]');
            $newData = array();
            foreach ($data as $day) {
                $newData[] = array(
                    'hari' => $day
                );
            }
            $this->db->insert_batch('weekly_holidays', $newData);
        }
        redirect('holidays');
    }
}
