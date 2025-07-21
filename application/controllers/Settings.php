<?php
defined('BASEPATH') or exit('No direct script access allowed');

class settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(["form_validation", 'session']);
        $this->load->model(['setting_model', 'operational_time_model']);
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
        $operational_times = $this->operational_time_model->get_operational_times();

        $data = [
            'title' => 'Setting',
            'settings_secret_key' => $this->setting_model->get_setting('name', 'secret_key'),
            'settings_school_name' => $this->setting_model->get_setting('name', 'school_name'),
            'settings_school_address' => $this->setting_model->get_setting('name', 'school_address'),
            'settings_wabot' => $this->setting_model->get_setting('name', 'wabot'),
            'settings_message_employee' => $this->setting_model->get_setting('name', 'whatsapp_message_employee'),
            'settings_logo' => $this->setting_model->get_setting('name', 'school_logo'),
            'settings_wallpaper' => $this->setting_model->get_setting('name', 'wallpaper'),
            'settings_weekend_attendance' => $this->setting_model->get_setting('name', 'weekend_attendance'),
            'operational_time' => $operational_times
        ];


        $this->load->view('dashboard/settings/index', $data);
    }


    public function update()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $config['upload_path']          = './assets/img/uploads/contents';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);
        $settings_wallpaper = $this->setting_model->get_setting('name', 'wallpaper');
        if (!$this->upload->do_upload('wallpaper')) {
            $wallpaperFile = $settings_wallpaper['value'];
        } else {
            unlink('/assets/img/uploads/' . $settings_wallpaper['value']);
            $uploaded = $this->upload->data();
            $wallpaperFile = 'contents/' . $uploaded['file_name'];
        }

        $this->setting_model->update(5, [
            'value' => $wallpaperFile
        ]);
        $settings_logo = $this->setting_model->get_setting('name', 'school_logo');
        if (!$this->upload->do_upload('logo')) {
            $logoFile = $settings_logo['value'];
        } else {
            unlink('/assets/img/uploads/' . $settings_logo['value']);
            $uploaded = $this->upload->data();
            $logoFile = 'contents/' . $uploaded['file_name'];
        }

        $this->setting_model->update(4, [
            'value' => $logoFile
        ]);

     
        $this->operational_time_model->update(1, [
            'waktu_masuk' => implode('-', [$this->input->post('waktu_employee_masuk1'), $this->input->post('waktu_employee_masuk2')]),
            'waktu_keluar' => implode('-', [$this->input->post('waktu_employee_keluar1'), $this->input->post('waktu_employee_keluar2')]),
            'telat' => $this->input->post('telat_employee'),
        ]);

        $this->setting_model->update(6, [
            'value' => $this->input->post('school_address'),
        ]);
        $this->setting_model->update(3, [
            'value' => $this->input->post('school_name'),
        ]);

        $this->setting_model->update(1, [
            'value' => $this->input->post('secret_key'),
        ]);

        $this->setting_model->update(2, [
            'value' => $this->input->post('message_employee'),
        ]);


        $this->setting_model->update(8, [
            'value' => $this->input->post('weekend_attendance'),
        ]);

        $this->session->set_flashdata('success', 'Setting Secret Key Berhasil Diperbarui!');
        redirect('settings');
    }

    public function upload_images()
    {
        // Load the upload library
        $this->load->library('upload');

        // Set the upload path and other configuration options
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048;

        // Initialize the upload library with the configuration options
        $this->upload->initialize($config);

        // Upload the first image
        if (!$this->upload->do_upload('image1')) {
            // Handle the upload error
            $error = $this->upload->display_errors();
            echo $error;
        } else {
            // Get the uploaded file data
            $image1_data = $this->upload->data();

            // Upload the second image
            if (!$this->upload->do_upload('image2')) {
                // Handle the upload error
                $error = $this->upload->display_errors();
                echo $error;
            } else {
                // Get the uploaded file data
                $image2_data = $this->upload->data();

                // Handle the uploaded images
                // ...

                // Redirect or show a success message
            }
        }
    }
}
