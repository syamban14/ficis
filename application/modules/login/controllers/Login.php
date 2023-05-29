<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login extends MX_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('Login_m');
		}

		public function index(){ 
			if($this->session->userdata('is_login')==TRUE){     
				redirect('/home'); 
			}else{
				$this->load->view('login_v'); 
			}
		}

		public function ceklogin(){
			$payroll_id = htmlspecialchars($_POST['nik']);
		    $password = htmlspecialchars(md5($_POST['password']));
		    $res = $this->Login_m->islogin($payroll_id,$password);
		    if($res->num_rows() > 0){
		    	foreach ($res->result() as $row){
		    		$payroll_id = $row->payroll_id;
		    		$username = $row->username;
		    		$grup = $row->grup;
		    		$role = $row->kode_role;
		    	}
		    	$data_hris = $this->db->query("SELECT * FROM hris.m_karyawan WHERE hris.m_karyawan.payroll_id='$payroll_id'");
		    	if ($grup=='2') {
			    	$data_session = array(
						'payroll_id' => $payroll_id,
						'username' => $username,
						'grup' => $grup,
						'role' => $role,
						'nama_karyawan' => $data_hris->row()->nama_karyawan,
						'is_login' => 'TRUE'
					);
					$this->session->set_userdata($data_session);
					echo 1;
		    	} else {
		    		echo 0;
		    	}
		    }
		    else{
		    	echo 0;
		    }
		}

		public function ceklogin_staff(){
			$payroll_id = htmlspecialchars($_POST['nik_staff']);
		    $password = htmlspecialchars(md5($_POST['password_staff']));
		    $res = $this->Login_m->islogin($payroll_id,$password);
		    if($res->num_rows() > 0){
		    	foreach ($res->result() as $row){
		    		$payroll_id = $row->payroll_id;
		    		$username = $row->username;
		    		$grup = $row->grup;
		    		$role = $row->kode_role;
		    	}
		    	$data_hris = $this->db->query("SELECT * FROM hris.m_karyawan WHERE hris.m_karyawan.payroll_id='$payroll_id'");
		    	if ($grup=='1') {
			    	$data_session = array(
						'payroll_id' => $payroll_id,
						'username' => $username,
						'grup' => $grup,
						'role' => $role,
						'nama_karyawan' => $data_hris->row()->nama_karyawan,
						'is_login' => 'TRUE'
					);
					$this->session->set_userdata($data_session);
					echo 1;
		    	} else {
		    		echo 0;
		    	}
		    }
		    else{
		    	echo 0;
		    }
		}
		public function get_title($nik)
		{
			$data = $this->Login_m->get_title($nik);
			if ($data->num_rows() > 0) {
				echo $data->row()->nama_title;
			}else{
				echo 'NIK tidak valid';
			}
		}

		public function logout(){
		    $this->session->sess_destroy();
		    redirect('/','refresh');
		}
	}