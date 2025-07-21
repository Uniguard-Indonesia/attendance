<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Device_facerecognition extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
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
            'title' => 'Device Absensi FaceRecognition',
            'devices' => $this->db->get('device_facerecognition')->result_array()
        ];

        $this->load->view('dashboard/device_facerecognition/index', $data);
    }

    public function create()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Device Absensi FaceRecognition',
        ];

        $this->load->view('dashboard/device_facerecognition/create', $data);
    }

    public function store()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('ip_address', 'IP Address', 'required|trim');
        $this->form_validation->set_rules('device', 'Device', 'required|trim|is_unique[device_facerecognition.device]');

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

            $this->db->insert('device_facerecognition', [
                'device' => $this->input->post('device'),
                'nama' => $this->input->post('nama'),
                'ip_address' => $this->input->post('ip_address'),
            ]);


            $this->session->set_flashdata('success', 'Devices Berhasil Ditambahkan!');
            redirect('device_facerecognition');
        }
    }


    public function edit($device_facerecognition)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'Device Absensi FaceRecognition',
            'device' =>  $this->db->get_where('device_facerecognition', ['id_device' => $device_facerecognition])->row_array()
        ];

        $this->load->view('dashboard/device_facerecognition/edit', $data);
    }

    public function update()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }

        $device = $this->db->get_where('device_facerecognition', ['id_device' => $this->input->post('id_device')])->row_array();
        if ($this->input->post('device') == $device['device']) {
            $device_rules = 'required|trim';
        } else {
            $device_rules = 'required|trim|is_unique[device_facerecognition.device]';
        }
        $this->form_validation->set_rules('device', 'ID Device', $device_rules);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('ip_address', 'IP Adress', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($this->input->post('id_device'));
        } else {
            $this->db->update('device_facerecognition', [
                'nama' => $this->input->post('nama'),
                'ip_address' => $this->input->post('ip_address'),
                'device' => $this->input->post('device'),
            ], ['id_device' => $this->input->post('id_device')]);

            $this->session->set_flashdata('success', 'Devices Berhasil Diperbarui!');
            redirect('device_facerecognition');
        }
    }

    public function delete($id_device)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $this->db->where('id_device', $id_device)->delete('device_facerecognition');

        $this->session->set_flashdata('success', 'Devices Berhasil Dihapus!');
        redirect('device_facerecognition');
    }

    public function emptyImage($id_device)
    {
        $device = $this->db->get_where('device_facerecognition', ['id_device' => $id_device])->row_array();
        $username = "admin";
        $password = "admin";
        $headers = array(
            "Authorization: Basic " . base64_encode("$username:$password"),
            'Content-Type: application/x-www-form-urlencoded'
        );
        $deleteData = json_encode([
            "operator" => "DeleteAllPerson",
            "info" => array(
                "DeleteAllPersonCheck" => 1,
            ),
        ], JSON_UNESCAPED_SLASHES);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $device['ip_address'] . '/action/DeleteAllPerson');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $deleteData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if ($result['code'] == 200) {

            $this->session->set_flashdata('success', 'Foto Member Berhasil Dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Foto Member Gagal Dihapus! ' . $res['info']['Detail']);
        }
        redirect('device_facerecognition');
    }
}
