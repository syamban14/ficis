<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Reports extends MX_Controller{
		function __construct(){
			parent::__construct();
			if($this->session->userdata('is_login')==FALSE)
	        {
	        	redirect('/','refresh');
	        }
			// $this->load->model('Reports_m');
		}

		public function index(){
			$this->load->view('commons/header');
			$this->load->view('reports');
			$this->load->view('commons/footer');
		}
	}