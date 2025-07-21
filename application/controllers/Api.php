<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model(['employee_model', 'holiday_model', 'employee_attandance_model', 'attandance_device_model', 'operational_time_model', 'setting_model']);
        $this->load->helper(['form', 'url']);
    }

    public function operational_get()
    {
        $date = $this->input->get('date') ?? date('Y-m-d');

        $attendance = $this->db->query("SELECT * FROM employee_attandances WHERE date = ?", [$date])->result_array();

        $operational_time = $this->db->query("SELECT * FROM operational_times WHERE type = 'employee'")->row_array();

        if ($attendance) {
            $this->response([
                'status' => 'success',
                'date' => $date,
                'attendance' => $attendance,
                'operational_time' => $operational_time
            ], 200);
        } else {
            $this->response([
                'status' => 'error',
                'message' => 'No attendance data found',
                'date' => $date,
                'attendance' => [],
                'operational_time' => $operational_time
            ], 404);
        }
    }

    public function inject_attendance_post()
    {
        $postData = json_decode(file_get_contents("php://input"), true);

        if (!$postData || !isset($postData['deviceRecognitionData'])) {
            $this->response([
                'status' => 'error',
                'message' => 'Invalid or missing data'
            ], 400);
            return;
        }

        $date = $postData['date'];
        $deviceData = $postData['deviceRecognitionData'];

        foreach ($deviceData as $entry) {
            $rfid = $entry['RFIDCard'];
            $name = $entry['Name'];
            $firstEntryTime = $entry['FirstEntryTime'];
            $lastEntryTime = !empty($entry['LastEntryTime']) ? $entry['LastEntryTime'] : null;


            $existing = $this->db->query("SELECT * FROM employee_attandances WHERE id_employee = ? AND date = ?", [$rfid, $date])->row_array();

            if ($existing) {
                $updateData = [
                    'id_device' => 0,
                    'id_employee' => $rfid,
                    'masuk' => $firstEntryTime ? 1 : 0,
                    'waktu_masuk' => $firstEntryTime,
                    'waktu_keluar' => $lastEntryTime,
                    'keluar' => $lastEntryTime ? 1 : 0,
                    'status_hadir' => 'Hadir',
                    'date' => $date,
                    'name' => $name,
                ];

                $this->db->where('id_employee_attandance', $existing['id_employee_attandance']);
                $this->db->where('date', $date);
                $this->db->update('employee_attandances', $updateData);
            } else {
                $this->db->insert('employee_attandances', [
                    'id_device' => 0,
                    'id_employee' => $rfid,
                    'masuk' => $firstEntryTime ? 1 : 0,
                    'waktu_masuk' => $firstEntryTime,
                    'waktu_keluar' => $lastEntryTime,
                    'keluar' => $lastEntryTime ? 1 : 0,
                    'status_hadir' => 'Hadir',
                    'date' => $date,
                    'name' => $name,
                ]);
            }
        }

        $this->response([
            'status' => 'success',
            'message' => 'Attendance data processed successfully'
        ], 200);
    }



    public function verify_post()
    {
        $post = json_decode($this->input->raw_input_stream);

        $device = $this->db->get_where('device_facerecognition', ['device' => $post->info->DeviceID])->row_array();


        if ($device) {
         
            // $id_type = explode('-', $post->info->PersonUUID);

            // $type = null;
            // if ($id_type[1] == 'employees') {
            $type = 'employee';
            //     $typeUser = 'karyawan';
            //     $employee = $this->db->join('positions', 'positions.id_position = employees.id_position')->get_where('employees', ['id_employee' => $id_type[0]])->row_array();
            // }

            // $this->db->update('attandance_devices', [
            //     'time' => date('Y-m-d H:i:s')
            // ], ['id_attandance_device' => $this->input->post('id_device')]);

            // if ($type) {
            $date_now = date('Y-m-d');
            $day_now = date('l');


            $holiday = $this->db->get_where('holidays', ['waktu' => $date_now, 'type' => $type])->row_array();
            $weekly_holiday = $this->db->get('weekly_holidays')->result_array();
            $weekend_attendance = $this->db->get_where('settings', array('name' => 'weekend_attendance'))->row_array();

            if (!$holiday && !in_array($day_now, array_column($weekly_holiday, 'hari'))) {

                $operational_time = $this->operational_time_model->get_operational_time($type);


                $masuk = explode('-', $operational_time['waktu_masuk']);
                $keluar = explode('-', $operational_time['waktu_keluar']);

                $masuk_awal = $masuk[0];
                $masuk_akhir = $masuk[1];
                $keluar_awal = $keluar[0];
                $keluar_akhir = $keluar[1];
                $telat = $operational_time['telat'];
                $time_now = date("H:i");
                   if($post->info->RFIDCard == 0){
                                     $this->db->update('device_facerecognition', [
                            'operator' => $post->operator,
                            'time' => date('Y-m-d H:i:s'),
                            'user' => $post->info->PersonUUID,
                            'image' => $post->SanpPic,
                            'employee_name' => $post->info->Name,
                            'attendance_status' => 'ID Card harus diisi',
                            'attendance_time' => $time_now
                        ], ['device' => $post->info->DeviceID]);

                    $this->response(['ket' => 'ID CARD HARUS DIISI', 'status' => 'error']);
            }
                // $time_now = "10:22";
                // var_dump($operational_time);
                if ($time_now < $masuk_akhir && $time_now > $masuk_awal) {


                    // $user = $employee;
                    $attandance = $this->employee_attandance_model->get_employee_attandace($date_now, $post->info->RFIDCard);

                    if (!$attandance) {
                        if ($time_now < $telat) {
                            $ket = 'Hadir - Tepat waktu';
                        } else {
                            $ket = 'Hadir - Telat';
                        }
                        $this->db->insert('employee_attandances', [
                            'id_device' => $device['id_device'],
                            'id_employee' => $post->info->RFIDCard,
                            'masuk' => 1,
                            'waktu_masuk' => $time_now,
                            'keluar' => 0,
                            'status_hadir' => 'Hadir',
                            'ket'  => $ket,
                            'date' => $date_now,
                            'name' => $post->info->Name,
                        ]);
                        $this->db->update('device_facerecognition', [
                            'operator' => $post->operator,
                            'time' => date('Y-m-d H:i:s'),
                            'user' => $post->info->PersonUUID,
                            'image' => $post->SanpPic,
                            'employee_name' => $post->info->Name,
                            'attendance_status' => 'Masuk',
                            'attendance_time' => $time_now
                        ], ['device' => $post->info->DeviceID]);

                        // $this->send_employee_wa($employee, $time_now, $date_now, $day_now, $ket);
                        $this->response(['ket' => $ket, 'status' => 'success', 'waktu' => date('H:i:s d/m/Y')]);
                    } else {
                        $this->db->update('device_facerecognition', [
                            'operator' => $post->operator,
                            'time' => date('Y-m-d H:i:s'),
                            'user' => $post->info->PersonUUID,
                            'image' => $post->SanpPic,
                            'employee_name' => $post->info->Name,
                            'attendance_status' => 'Sudah Absen',
                            'attendance_time' => $attandance['waktu_masuk']

                        ], ['device' => $post->info->DeviceID]);

                        // var_dump($);


                        $this->response(['ket' => 'Sudah Absen', 'status' => 'success', 'waktu' => '-']);
                    }
                } else if ($time_now > $keluar_awal && $time_now < $keluar_akhir) {

                    // $user = $employee;
                    $attandance = $this->employee_attandance_model->get_employee_attandace($date_now, $post->info->RFIDCard);
                    if ($attandance) {
                        $this->db->update('device_facerecognition', [
                            'operator' => $post->operator,
                            'time' => date('Y-m-d H:i:s'),
                            'user' => $post->info->PersonUUID,
                            'image' => $post->SanpPic,
                            'employee_name' => $post->info->Name,
                            'attendance_status' => 'Pulang',
                            'attendance_time' => $time_now
                        ], ['device' => $post->info->DeviceID]);

                        $ket = 'pulang';
                        $this->employee_attandance_model->update($attandance['id_employee_attandance'], [
                            'keluar' => 1,
                            'waktu_keluar' => $time_now,
                        ]);

                        // $this->send_employee_wa($employee, $time_now, $date_now, $day_now, $ket);
                        $this->response(['ket' => $ket, 'status' => 'success', 'waktu' => date('H:i:s d/m/Y')]);
                    } else {
                        $this->db->update('device_facerecognition', [
                            'operator' => $post->operator,
                            'time' => date('Y-m-d H:i:s'),
                            'user' => $post->info->PersonUUID,
                            'image' => $post->SanpPic,
                            'employee_name' => $post->info->Name,
                            'attendance_status' => 'Tidak Absen Masuk',
                            'attendance_time' => $time_now

                        ], ['device' => $post->info->DeviceID]);

                        $this->db->insert('employee_attandances', [
                            'id_device' => $device['id_device'],
                            'id_employee' => $post->info->RFIDCard,
                            'masuk' => 1,
                            'waktu_masuk' => $time_now,
                            'waktu_keluar' => $time_now,
                            'keluar' => 1,
                            'status_hadir' => 'Hadir',
                            'ket'  => 'Tidak Absen Masuk',
                            'date' => $date_now,
                            'name' => $post->info->Name,
                        ]);

                        $this->response(['ket' => 'Absensi Gagal', 'status' => 'error']);
                    }
                } else {
                     $this->db->update('device_facerecognition', [
                            'operator' => $post->operator,
                            'time' => date('Y-m-d H:i:s'),
                            'user' => $post->info->PersonUUID,
                            'image' => $post->SanpPic,
                            'employee_name' => $post->info->Name,
                            'attendance_status' => 'Error Waktu Operasional',
                            'attendance_time' => $time_now
                        ], ['device' => $post->info->DeviceID]);

                    $this->response(['ket' => 'Error waktu operasional', 'status' => 'error']);
                }
            } else {
                if ($weekend_attendance['value'] == 'on') {
                    $operational_time = $this->operational_time_model->get_operational_time($type);
                    $masuk = explode('-', $operational_time['waktu_masuk']);
                    $keluar = explode('-', $operational_time['waktu_keluar']);
                    $masuk_awal = $masuk[0];
                    $masuk_akhir = $masuk[1];
                    $keluar_awal = $keluar[0];
                    $keluar_akhir = $keluar[1];
                    $telat = $operational_time['telat'];
                    $time_now = date("H:i");
                    // $time_now = "07:30";
                    if ($time_now < $masuk_akhir && $time_now > $masuk_awal) {
                        $user = $employee;
                        $attandance = $this->employee_attandance_model->get_employee_attandace($date_now, $employee['id_employee']);
                        if (!$attandance) {
                            if ($time_now < $telat) {
                                $ket = 'Hadir - Tepat waktu';
                            } else {
                                $ket = 'Hadir - Telat';
                            }
                            $this->db->insert('employee_attandances', [
                                'id_device' => $device[0]['id_attandance_device'],
                                'id_employee' => $employee['id_employee'],
                                'masuk' => 1,
                                'waktu_masuk' => $time_now,
                                'keluar' => 0,
                                'status_hadir' => 'Hadir',
                                'ket'  => $ket,
                                'date' => $date_now,
                            ]);
                            // $this->send_employee_wa($employee, $time_now, $date_now, $day_now, $ket);
                            $this->response(['ket' => $ket, 'status' => 'success', 'type' => $typeUser, $typeUser => $user, 'waktu' => date('H:i:s d/m/Y')]);
                        } else {
                            $this->response(['ket' => 'Sudah Absen', 'status' => 'error']);
                        }
                    } else if ($time_now > $keluar_awal && $time_now < $keluar_akhir) {
                        $user = $employee;
                        $attandance = $this->employee_attandance_model->get_employee_attandace($date_now, $employee['id_employee']);
                        if ($attandance) {
                            $ket = 'pulang';
                            $this->employee_attandance_model->update($attandance['id_employee_attandance'], [
                                'keluar' => 1,
                                'waktu_keluar' => $time_now,
                            ]);
                            // $this->send_employee_wa($employee, $time_now, $date_now, $day_now, $ket);
                            $this->response(['ket' => $ket, 'status' => 'success', 'type' => $typeUser, $typeUser => $user, 'waktu' => date('H:i:s d/m/Y')]);
                        } else {
                            $this->response(['ket' => 'Absensi Gagal', 'status' => 'error']);
                        }
                    } else {
                        $this->response(['ket' => 'Error waktu operasional', 'status' => 'error']);
                    }
                } else {
                    $this->response(['ket' => 'Hari Libur', 'status' => 'error']);
                }
            }
            // } else {
            //     $this->response(['ket' => 'user tidak ditemukan', 'status' => 'error']);
            // }
        } else {
            $this->response(['ket' => 'id_device tidak ditemukan', 'status' => 'error']);
        }
    }
    public function snap_post($id = null)
    {
              
        $post = json_decode($this->input->raw_input_stream);
        $this->db->update('device_facerecognition', [
            'operator' => $post->operator,
            'time' => date('Y-m-d H:i:s'),
            'image' => $post->SanpPic,
            'attendance_status' => 'Unknown',
            'attendance_time' => '',
            'employee_name' => '',

        ], ['device' => $post->info->DeviceID]);
    }
    public function heartbeat_post($id = null)
    {
        $post = json_decode($this->input->raw_input_stream);

        $this->db->update('device_facerecognition', [
            'time_heartbeat' => date('Y-m-d H:i:s'),
        ], ['device' => $post->info->DeviceID]);
    }
    public function send_employee_wa($karyawan, $waktu, $tanggal, $day, $ket)
    {
        $message_data = $this->setting_model->get_setting('name', 'whatsapp_message_employee');
        // convert message
        $pesans = explode(' ', $message_data['value']);
        $message = '';
        foreach ($pesans as $pesan) {
            if (strpos($pesan, '$') !== false) {
                if ($pesan == '$nama') {
                    $message .= ' ' . $karyawan['nama'];
                } else if ($pesan == '$jabatan') {
                    $message .= ' ' . $karyawan['jabatan'];
                } else if ($pesan == '$waktu') {
                    $message .= ' ' . $waktu;
                } else if ($pesan == '$keterangan') {
                    $message .= ' ' . $ket;
                } else if ($pesan == '$tanggal') {
                    $message .= ' ' . $tanggal;
                } else if ($pesan == '$hari') {
                    $message .= ' ' . $day;
                } else {
                    $message .= ' ' . $pesan;
                }
            } else {
                $message .= ' ' . $pesan;
            }
        }
        $message = trim($message);
        if ($karyawan['no_hp_ortu'] && (strlen($karyawan['no_hp_ortu']) > 0 && $karyawan['no_hp_ortu'][0] !== "0")) {

            $data = array(
                "nama" => $karyawan['nama'],
                "telp" => '62' . $karyawan['no_hp_ortu'],
                "message" => $message
            );

            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );

            $url = $this->setting_model->get_setting('name', 'wabot')['value'];
            // $url = 'http://wabot.tytomulyono.com/api/insert';
            $context  = stream_context_create($options);

            return file_get_contents($url, false, $context);
        }
    }

    public function last_log_get($id = null)
    {

        $log = $this->db->get_where('device_facerecognition', ['device' => $id])->row_array();

        if ($log) {
            // $id_type = explode('-', $log['user']);
            // if ($id_type[1] == 'employees') {
            // $typeUser = 'karyawan';
            // $user = $this->db->join('positions', 'positions.id_position = employees.id_position')->get_where('employees', ['id_employee' => $id_type[0]])->row_array();
            // }
            $this->response(['msg' => 'success', 'type' => 'karyawan', 'data' => ['data'], 'device' => $log]);
        } else {
            $this->response(['msg' => 'success', 'logs' => 'id-tidak-terdaftar', 'data_user' => '']);
        }
    }
}