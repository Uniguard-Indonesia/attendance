<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron extends CI_Controller 
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['employee_attandance_model', 'employee_model']);
    }
    
    /**
     * This function is used to update the age of users automatically
     * This function is called by cron job once in a day at midnight 00:00
     */
    public function index()
    {    
        $date_now = date('Y-m-d');
        $day_now = date('l');

        $holiday_employee = $this->db->get_where('holidays', ['waktu' => $date_now, 'type' => 'employee'])->row_array();;
        if ((!$holiday_employee && ($day_now !== 'Saturday')) && (!$holiday_employee && ($day_now !== 'Sunday'))) {
            $employees = $this->employee_model->get_employees();
            foreach($employees as $employee) {
                $attandance = $this->employee_attandance_model->get_employee_attandace2('date', $date_now, 'employee_attandances.id_employee', $employee['id_employee']);
                if (!$attandance) {
                    $this->employee_attandance_model->insert([
                        'id_device' => 0,
                        'id_employee' => $employee['id_employee'],
                        'masuk' => 0,
                        'waktu_masuk' => "-",
                        'keluar' => 0,
                        'waktu_keluar' => "-",
                        'status_hadir' => 'Alfa',
                        'ket'  => 'Alfa',
                        'date' => $date_now,
                    ]);
                }
            }
        }
        
    }
}
