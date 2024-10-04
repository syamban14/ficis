<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Cash_flow extends MX_Controller{
		function __construct(){
			parent::__construct();
			if($this->session->userdata('is_login')==FALSE)
	        {
	        	redirect('/','refresh');
	        }
			$this->load->model('Cash_flow_m');
		}

		public function index(){
			$x['data_bank'] = $this->Cash_flow_m->getDataBank();
			$x['data_akun'] = $this->Cash_flow_m->getDataAkun();
			$x['data_project'] = $this->Cash_flow_m->getDataProject();
			$this->load->view('commons/header');
			$this->load->view('cash_flow',$x);
			$this->load->view('commons/footer');
		}
	}