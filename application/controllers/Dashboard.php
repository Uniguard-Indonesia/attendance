<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['user_model']);

        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
        $this->load->model(['employee_model', 'employee_attandance_model',  'user_model', 'position_model']);

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
        $employee_attandances = $this->employee_attandance_model->groupby_date_employee();

        // Menggabungkan data absensi  dan employee
        $dates = array_unique(array_merge( array_column($employee_attandances, 'date')));

        // Mengurutkan tanggal secara ascending
        sort($dates);

        $data_employee = array();

        // Inisialisasi categories
        $categories = array();

        // Mengisi categories dengan tanggal
        foreach ($dates as $date) {
            $categories[] = $date;
        }
        foreach ($dates as $date) {
       

            // Mengisi data untuk employee
            $employee_total = 0;
            foreach ($employee_attandances as $attandance) {
                if ($attandance['date'] == $date) {
                    $employee_total = $attandance['total'];
                    break;
                }
            }
            $data_employee[] = $employee_total;
        }

        $date_now = date('Y-m-d');
       $nowemployee = $this->db->get_where('employee_attandances', array('date' => $date_now, 'status_hadir !=' => 'Alfa'))->result_array();

        $this->load->view('dashboard/index', [
            'title' => 'Dashboard',
            'nowemployee' => count($nowemployee),
            'users' => count($this->user_model->get_users()),
            'positions' => count($this->position_model->get_positions()),
            'employees' => count($this->employee_model->get_employees()),
            'employee_data' => json_encode($data_employee),
            'categories' => json_encode($categories),
        ]);
    }
}
