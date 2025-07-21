<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operational_times extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(["form_validation", 'session']);
        $this->load->model(['operational_time_model']);
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

    public function update()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('waktu_masuk_awal', 'waktu_masuk_awal', 'required|trim');
        $this->form_validation->set_rules('waktu_masuk_akhir', 'waktu_masuk_akhir', 'required|trim');
        $this->form_validation->set_rules('telat', 'telat', 'required|trim');
        $this->form_validation->set_rules('waktu_keluar_awal', 'waktu_keluar_awal', 'required|trim');
        $this->form_validation->set_rules('waktu_keluar_akhir', 'waktu_keluar_akhir', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('settings');
        } else {
            $waktu_masuk = implode('-', [$this->input->post('waktu_masuk_awal'), $this->input->post('waktu_masuk_akhir')]);
            $waktu_keluar = implode('-', [$this->input->post('waktu_keluar_awal'), $this->input->post('waktu_keluar_akhir')]);
            $telat = $this->input->post('telat');

            $this->operational_time_model->update(1, [
                'waktu_masuk' => $waktu_masuk,
                'waktu_keluar' => $waktu_keluar,
                'telat' => $telat
            ]);
            $this->session->set_flashdata('success', 'Setting Waktu Operasinal Berhasil Diperbarui!');
            redirect('settings');
        }
    }
}
