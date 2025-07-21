<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Reader\Csv;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class positions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(["form_validation", 'session']);
        $this->load->model(['position_model', 'employee_model']);
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
            'title' => 'Jabatan',
            'positions' => $this->position_model->get_positions()
        ];

        $this->load->view('dashboard/positions/index', $data);
    }

    public function create()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Jabatan',
        ];

        $this->load->view('dashboard/positions/create', $data);
    }

    public function store()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $this->position_model->insert([
                'jabatan' => $this->input->post('jabatan'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted' => 0,
            ]);
            $this->session->set_flashdata('success', 'jabatan Berhasil Ditambahkan!');
            redirect('dashboard/positions');
        }
    }

    public function view($id_position)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Jabatan',
            'position' => $this->position_model->get_position('id_position', $id_position)
        ];

        $this->load->view('dashboard/positions/view', $data);
    }

    public function edit($id_position)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Jabatan',
            'position' => $this->db->get_where('positions', array('id_position' => $id_position))->row_array()
        ];
        $this->load->view('dashboard/positions/edit', $data);
    }

    public function update()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($this->input->post('id_position'));
        } else {
            $this->position_model->update($this->input->post('id_position'), [
                'jabatan' => $this->input->post('jabatan'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $this->session->set_flashdata('success', 'jabatan Berhasil Diperbarui!');
            redirect('dashboard/positions');
        }
    }

    public function delete($id_position)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }

        $employees = $this->employee_model->get_employee('employees.id_position', $id_position);
        if (!$employees) {
            $this->position_model->delete($id_position);
            $this->session->set_flashdata('success', 'jabatan Berhasil Dihapus!');
        } else {
            $this->session->set_flashdata('error', 'jabatan Gagal Dihapus!');
        }
        redirect('dashboard/positions');
    }

    public function employees($id_position)
    {

        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $employee = $this->employee_model->get_employees_where('employees.id_position', $id_position);
        $data = [
            'title' => 'Jabatan',
            'positions' => $this->position_model->get_positions(),
            'position' => $this->position_model->get_position('id_position', $id_position)[0],
            'employees' => $employee
        ];



        $this->load->view('dashboard/positions/employees', $data);
    }

    public function employee_update()
    {
        if ($this->input->post('chkbox[]') !== null) {
            foreach ($this->input->post('chkbox[]') as $chkbox) {
                $this->employee_model->update($chkbox, [
                    'id_position' => $this->input->post('position'),
                ]);
            }
            $this->employees($this->input->post('id_position'));
        } else {
            $this->employees($this->input->post('id_position'));
        }
    }
}
