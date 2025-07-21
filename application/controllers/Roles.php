<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model('role_model');
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
            'title' => 'Roles',
            'roles' => $this->role_model->get_roles()
        ];

        $this->load->view('dashboard/roles/index', $data);
    }

    public function create()
    {

      
    }

    public function store()
    {
        
    }

    public function view($id_roles)
    {

    }

    public function edit($id_roles)
    {

    }

    public function update()
    {

    }

    public function delete($id_roles)
    {
       
    }
}
