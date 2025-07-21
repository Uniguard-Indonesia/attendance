<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class employees extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model(['employee_model', 'position_model']);
        $this->load->helper(['form', 'url', 'encryption']);
        if (!$this->session->userdata('status')) {
            $this->session->set_flashdata('message', '<div position="alert alert-danger alert-dismissible" role="alert">
            <div position="alert-message">
            Login terlebih dahulu!
            </div>
        </div>');
            redirect('auth/login');
        }
    }



    public function export_excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // set Header
        $sheet->SetCellValue('A1', 'ID Card')->getColumnDimension('A')->setAutoSize(true);
        $sheet->SetCellValue('B1', 'Nama')->getColumnDimension('B')->setAutoSize(true);
        $sheet->SetCellValue('C1', 'Jenis Kelamin')->getColumnDimension('C')->setAutoSize(true);
        $sheet->SetCellValue('D1', 'Tempat Lahir')->getColumnDimension('D')->setAutoSize(true);
        $sheet->SetCellValue('E1', 'Tanggal Lahir')->getColumnDimension('E')->setAutoSize(true);
        $sheet->SetCellValue('F1', 'Alamat')->getColumnDimension('F')->setAutoSize(true);
        $sheet->SetCellValue('G1', 'No HP')->getColumnDimension('G')->setAutoSize(true);
        $sheet->SetCellValue('H1', 'No HP Ortu')->getColumnDimension('H')->setAutoSize(true);
        // set Row
        $employees = $this->employee_model->get_employees();
        $rowCount = 2;
        foreach ($employees as $employee) {
            $sheet->SetCellValue('A' . $rowCount, $employee['id_card'])->getColumnDimension('A')->setAutoSize(true);
            $sheet->SetCellValue('B' . $rowCount, $employee['nama'])->getColumnDimension('B')->setAutoSize(true);
            $sheet->SetCellValue('C' . $rowCount, $employee['jenis_kelamin'])->getColumnDimension('C')->setAutoSize(true);
            $sheet->SetCellValue('D' . $rowCount, $employee['tempat_lahir'])->getColumnDimension('D')->setAutoSize(true);
            $sheet->SetCellValue('E' . $rowCount, $employee['tanggal_lahir'])->getColumnDimension('E')->setAutoSize(true);
            $sheet->SetCellValue('F' . $rowCount, $employee['alamat'])->getColumnDimension('F')->setAutoSize(true);
            $sheet->SetCellValue('G' . $rowCount, $employee['no_hp'])->getColumnDimension('G')->setAutoSize(true);
            $sheet->SetCellValue('H' . $rowCount, $employee['no_hp_ortu'])->getColumnDimension('H')->setAutoSize(true);
            $rowCount++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $filename = date('D-M-Y');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output'); // download file 

    }


    // checkFileValidation
    public function checkFileValidation($string)
    {
        $file_mimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        if (isset($_FILES['fileURL']['name'])) {
            $arr_file = explode('.', $_FILES['fileURL']['name']);
            $extension = end($arr_file);
            if (($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)) {
                return true;
            } else {
                $this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }

    public function index()
    {
        if ($this->session->userdata('role') !== 'admin_absensi' && $this->session->userdata('role') !== 'Viewer' && $this->session->userdata('role') !== 'operator_absensi') {
            show_404();
        }
        $data = [
            'title' => 'karyawan',
            'employees' => $this->employee_model->get_employees(),
            'devices' => $this->db->get('device_facerecognition')->result_array()

        ];

        $this->load->view('dashboard/employees/index', $data);
    }

    public function create()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'karyawan',
            'positions' => $this->position_model->get_positions()
        ];

        $this->load->view('dashboard/employees/create', $data);
    }

    public function store()
    {

        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $this->form_validation->set_rules('position', 'position', 'required|trim');
        $this->form_validation->set_rules('nama', 'Name', 'required|trim');
        $this->form_validation->set_rules('id_card', 'ID Card', 'required|trim|is_unique[employees.id_card]');
        $this->form_validation->set_rules('jenis_kelamin', 'Gender', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Place of Birth', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Date of Birth', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Address', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('no_hp_ortu', 'Phone Number', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

            $config['upload_path']          = 'assets/img/uploads/employees';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']             = 10000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');

            $encryption =  encryption('0', en_iv(), $this->input->post('id_card'));
            $this->employee_model->insert([
                'id_position' => $this->input->post('position'),
                'nama' => $this->input->post('nama'),
                'id_card' => $this->input->post('id_card'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'saldo' => $encryption,
                'deleted' => 0,
                'pin' => password_hash('000000', PASSWORD_DEFAULT),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'no_hp_ortu' => $this->input->post('no_hp_ortu'),
                'foto' => 'employees/' . $this->upload->data('file_name'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('success', 'karyawan Berhasil Ditambahkan!');
            redirect('dashboard/employees');
        }
    }

    public function view($id_employee)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'karyawan',
            'employee' => $this->employee_model->get_employee('id_employee', $id_employee)
        ];

        $this->load->view('dashboard/employees/view', $data);
    }

    public function edit($id_employee)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $data = [
            'title' => 'karyawan',
            'positions' => $this->position_model->get_positions(),
            'employee' => $this->employee_model->get_employee('id_employee', $id_employee)
        ];

        $this->load->view('dashboard/employees/edit', $data);
    }

    public function update()
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $employee = $this->employee_model->get_employee('id_employee', $this->input->post('id_employee'));

        if ($this->input->post('id_card') == $employee['id_card']) {
            $nis_rules = 'required|trim';
        } else {
            $nis_rules = 'required|trim|is_unique[employees.id_card]';
        }

        $this->form_validation->set_rules('position', 'position', 'required|trim');
        $this->form_validation->set_rules('nama', 'Name', 'required|trim');
        $this->form_validation->set_rules('id_card', 'ID Card', $nis_rules);
        $this->form_validation->set_rules('jenis_kelamin', 'Gender', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Place of Birth', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Date of Birth', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Address', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('no_hp_ortu', 'Parent Phone Number', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($this->input->post('id_employee'));
        } else {
            $config['upload_path']          = 'assets/img/uploads/employees';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']             = 10000;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');

            if ($this->upload->data('file_name') == '') {
                $foto = $employee['foto'];
            } else {
                unlink('assets/img/uploads/' . $employee['foto']);
                $foto = 'employees/' . $this->upload->data('file_name');
            }
            $decrypt_saldo =  decryption($employee['saldo'], de_iv(), $employee['id_card']);
            $encrypt_saldo = encryption($decrypt_saldo, en_iv(), $this->input->post('id_card'));

            $this->employee_model->update($this->input->post('id_employee'), [
                'id_position' => $this->input->post('position'),
                'nama' => $this->input->post('nama'),
                'id_card' => $this->input->post('id_card'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'saldo' => $encrypt_saldo,
                'pin' => $employee['pin'],
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'no_hp_ortu' => $this->input->post('no_hp_ortu'),
                'foto' => $foto,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('success', 'karyawan Berhasil Diperbarui!');
            redirect('dashboard/employees');
        }
    }

    public function delete($id_employee)
    {
        if ($this->session->userdata('role') !== 'admin_absensi') {
            show_404();
        }
        $employee = $this->employee_model->get_employee('id_employee', $id_employee);

        $this->employee_model->delete($id_employee);
        unlink('assets/img/uploads/' . $employee['foto']);
        $this->session->set_flashdata('success', 'karyawan Berhasil Dihapus!');
        redirect('dashboard/employees');
    }


    public function export_images()
    {
        $device = $this->db->get_where('device_facerecognition', ['id_device' => $this->input->post('id_device')])->row_array();

        $employees = $this->db->get_where('employees', ['deleted' => 0])->result_array();

        // var_dump("data:image/jpeg;base64," . base64_encode(base_url('/assets/img/uploads/' . 'employees/Screenshot_(5)2.png')));
        // var_dump( base_url('/assets/img/uploads/' .'employees/Screenshot_(5)2.png') );
        // Load the image file into a variable
        // $image_data = file_get_contents(base_url('/assets/img/uploads/' . $employees[0]['foto']));

        // // Convert the image data to Base64-encoded string
        // $base64_image = "data:image/jpeg;base64," . base64_encode($image_data);

        // // Output the Base64-encoded string
        // echo $base64_image;

        // die;

        $username = "admin";
        $password = "admin";
        $headers = array(
            "Authorization: Basic " . base64_encode("$username:$password"),
            'Content-Type: application/x-www-form-urlencoded'
        );


        $personInfo = [];
        // Create new array
        $newArray = [
            "operator" => "AddPersons",
            "DeviceID" => $device['device'],
            "Total" => count($employees),
        ];
        // Iterate through original array
        foreach ($employees as $i => $employee) {

            $personInfo = [
                "Name" => $employee["nama"],
                "CustomizeID" => $employee["id_employee"] . '-employees',
                "PersonUUID" => $employee["id_employee"] . '-employees',
                "picinfo" => "data:image/jpeg;base64," . base64_encode(file_get_contents(base_url('/assets/img/uploads/' . $employee['foto'])))
            ];
            // Add personInfo to newArray
            $newArray["Personinfo_$i"] = $personInfo;
        }
        // Encode newArray to json format
        $json = json_encode($newArray, JSON_UNESCAPED_SLASHES);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $device['ip_address'] . '/action/AddPersons');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        // Tutup cURL


        if ($result['code'] == 200) {

            $this->session->set_flashdata('success', 'Foto Member Berhasil Ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Foto Member Gagal Ditambahkan! ' . $result['info']['Detail']);
        }
        redirect('employees');
    }
}
