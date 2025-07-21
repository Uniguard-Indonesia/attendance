<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model(['user_model', 'role_model']);
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
            'title' => 'Users',
            'users' => $this->user_model->get_users()
        ];
        $this->load->view('dashboard/users/index', $data);
    }

    public function create()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Users',
            'roles' => $this->role_model->get_roles()
        ];


        $this->load->view('dashboard/users/create', $data);
    }

    public function store()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('nama', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

            $config['upload_path']          = './assets/img/uploads/users';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']             = 10000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');

            $this->user_model->insert([
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'id_role' => $this->input->post('role'),
                'deleted' => 0,
                'foto' => 'users/' . $this->upload->data('file_name'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('success', 'User Berhasil Ditambahkan!');
            redirect('dashboard/users');
        }
    }

    public function view($id_user)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Users',
            'user' => $this->user_model->get_user('id_user', $id_user)
        ];

        $this->load->view('dashboard/users/view', $data);
    }

    public function edit($id_user)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Users',
            'roles' => $this->role_model->get_roles(),
            'user' => $this->user_model->get_user('id_user', $id_user)
        ];

        $this->load->view('dashboard/users/edit', $data);
    }

    public function update()
    {

        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $user = $this->user_model->get_user('id_user', $this->input->post('id_user'));

        if ($this->input->post('username') == $user['username']) {
            $username_rules = 'required|trim';
        } else {
            $username_rules = 'required|trim|is_unique[users.username]';
        }

        $this->form_validation->set_rules('nama', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', $username_rules);
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($this->input->post('id_user'));
        } else {
            $config['upload_path']          = './assets/img/uploads/users';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']             = 10000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');

            if ($this->upload->data('file_name') == '') {
                $foto = $user['foto'];
            } else {
                unlink('/assets/img/uploads/' . $user['foto']);
                $foto = 'users/' . $this->upload->data('file_name');
            }
            if ($this->input->post('username') == $this->session->userdata('username')) {

                $this->session->set_userdata([
                    'foto' => $foto,
                ]);
            }

            if ($this->input->post('password') == '') {
                $password = $user['password'];
            } else {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->user_model->update($this->input->post('id_user'), [
                'id_role' => $this->input->post('role'),
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'foto' => $foto,
                'password' => $password,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('success', 'User Berhasil Diperbarui!');
            redirect('dashboard/users');
        }
    }

    public function delete($id_user)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $user = $this->user_model->get_user('id_user', $id_user);

        $this->user_model->delete($id_user);
        unlink('/assets/img/uploads/' . $user['foto']);
        $this->session->set_flashdata('success', 'User Berhasil Dihapus!');
        redirect('dashboard/users');
    }
}
