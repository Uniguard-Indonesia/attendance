<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(['user_model']);
	}

	public function index()
	{

		if ($this->session->userdata('role') == 'admin_absensi') {
			redirect('dashboard');
		} 

		$data['title'] = 'Login';
		$this->load->view('auth/admin_login', $data);
	}

	public function login()
	{
		if ($this->session->userdata('role') == 'admin_absensi') {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user =  $this->user_model->get_user('username', $username);

			if ($user) {
			
				if(($user['role'] == 'admin_absensi' || $user['role'] == 'Viewer' || $user['role'] == 'operator_absensi' ) && password_verify($password, $user['password'])){
					$this->session->set_userdata([
						'id_user' => $user['id_user'],
						'username' => $user['username'],
						'name' => $user['nama'],
						'foto' => $user['foto'],
						'id_role' => $user['id_role'],
						'role' => $user['role'],
						'table' => 'user',
						'status' => true
					]);
					redirect('dashboard');
				}else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
					<div class="alert-message">
					Akun Tidak diizinkan!
					</div>
				</div>');
					redirect('auth/login');
				}
				
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
				<div class="alert-message">
				Username tidak terdaftar!
				</div>
			</div>');
				redirect('auth/login');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Berhasil Logout!
			  </div>');
		redirect('/');
	}

	public function user_profile()
	{
		if ($this->session->userdata('table') !== 'user') {
			show_404();
		}
		$data = [
			'title' => 'Profile',
			'user' => $this->user_model->get_user('id_user', $this->session->userdata('id_user'))[0]
		];

		$this->load->view('auth/profile_user', $data);
	}

	public function user_profile_update()
	{
		if ($this->session->userdata('table') !== 'user') {
			show_404();
		}
		$user = $this->user_model->get_user('id_user', $this->input->post('id_user'))[0];

		if ($this->input->post('username') == $user['username']) {
			$username_rules = 'required|trim';
		} else {
			$username_rules = 'required|trim|is_unique[users.username]';
		}

		$this->form_validation->set_rules('nama', 'Name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', $username_rules);

		if ($this->form_validation->run() == false) {
			$this->user_profile();
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
				unlink('assets/img/uploads/' . $user['foto']);
				$foto = 'users/' . $this->upload->data('file_name');
			}

			$this->session->set_userdata([
				'username' => $this->input->post('username'),
				'name' => $this->input->post('nama'),
				'foto' => $foto,
			]);

			// if ($this->input->post('password') == '') {
			// 	$password = $user['password'];
			// } else {
			// 	$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			// }

			$this->user_model->update($this->input->post('id_user'), [
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'foto' => $foto,
				// 'password' => $password,
				'updated_at' => date('Y-m-d H:i:s')
			]);

			$this->session->set_flashdata('success', 'User Berhasil Diperbarui!');
			redirect('auth/user_profile');
		}
	}


	public function user_password()
	{
		if ($this->session->userdata('table') !== 'user') {
			show_404();
		}
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password', 'New  Password', 'required|trim');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim');
		$user = $this->user_model->get_user('id_user', $this->input->post('id_user'))[0];
		if (password_verify($this->input->post('current_password'), $user['password'])) {
			if ($this->input->post('new_password') == $this->input->post('confirm_password')) {

				$this->user_model->update($this->input->post('id_user'), [
					'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT),
					'updated_at' => date('Y-m-d H:i:s')
				]);
				$this->session->set_flashdata('success', 'Password Berhasil Diubah.');
				redirect('auth/user_profile');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
				<div class="alert-message">
				Konfirmasi Password Tidak Sama!
				</div>
			</div>');
				redirect('auth/user_profile');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
				<div class="alert-message">
				Password Salah!
				</div>
			</div>');
			redirect('auth/user_profile');
		}
	}

	
}
