<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attandance_devices extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model(['attandance_device_model']);
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
            'title' => 'Device Absensi',
            'devices' => $this->attandance_device_model->get_attandance_devices()
        ];

        $this->load->view('dashboard/attandance_devices/index', $data);
    }

    public function create()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Device Absensi',
        ];

        $this->load->view('dashboard/attandance_devices/create', $data);
    }

    public function store()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('lokasi', 'Location', 'required|trim');
        $this->form_validation->set_rules('device', 'Device', 'required|trim|is_unique[attandance_devices.device]');

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

            $config['upload_path']          = './assets/img/uploads/attandance_devices';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']             = 10000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');

            $this->attandance_device_model->insert([
                'device' => $this->input->post('device'),
                'deleted' => 0,
                'lokasi' => $this->input->post('lokasi'),
                'gambar' => 'attandance_devices/' . $this->upload->data('file_name'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('success', 'Devices Berhasil Ditambahkan!');
            redirect('dashboard/attandance_devices');
        }
    }

    public function view($attandance_device)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Device Absensi',
            'device' => $this->attandance_device_model->get_attandance_device('id_attandance_device', $attandance_device)[0]
        ];

        $this->load->view('dashboard/attandance_devices/view', $data);
    }

    public function edit($attandance_device)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Device Absensi',
            'device' => $this->attandance_device_model->get_attandance_device('id_attandance_device', $attandance_device)[0]
        ];

        $this->load->view('dashboard/attandance_devices/edit', $data);
    }

    public function update()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }

        $device = $this->attandance_device_model->get_attandance_device('id_attandance_device', $this->input->post('id_attandance_device'))[0];

        if ($this->input->post('device') == $device['device']) {
            $device_rules = 'required|trim';
        } else {
            $device_rules = 'required|trim|is_unique[attandance_devices.device]';
        }

        $this->form_validation->set_rules('lokasi', 'Location', 'required|trim');
        $this->form_validation->set_rules('device', 'Device', $device_rules);

        if ($this->form_validation->run() == false) {
            $this->edit($this->input->post('attandance_device'));
        } else {
            $config['upload_path']          = './assets/img/uploads/attandance_devices';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']             = 10000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $this->session->set_userdata([
                'gambar' => 'attandance_devices/' . $this->upload->data('file_name'),
            ]);

            if ($this->upload->data('file_name') == '') {
                $gambar = $device['gambar'];
            } else {
                unlink('/assets/img/uploads/' . $device['gambar']);
                $gambar = 'attandance_devices/' . $this->upload->data('file_name');
            }

            $this->attandance_device_model->update($this->input->post('id_attandance_device'), [
                'device' => $this->input->post('device'),
                'lokasi' => $this->input->post('lokasi'),
                'gambar' => $gambar,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('success', 'Devices Berhasil Diperbarui!');
            redirect('dashboard/attandance_devices');
        }
    }

    public function delete($attandance_device)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $device = $this->attandance_device_model->get_attandance_device('device', $attandance_device)[0];
        $this->attandance_device_model->delete($attandance_device);
        unlink('/assets/img/uploads/' . $device['gambar']);
        $this->session->set_flashdata('success', 'Devices Berhasil Dihapus!');

        redirect('dashboard/attandance_devices');
    }
}
