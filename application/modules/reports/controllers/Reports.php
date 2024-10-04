<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Reports extends MX_Controller{
		function __construct(){
			parent::__construct();
			if($this->session->userdata('is_login')==FALSE)
	        {
	        	redirect('/','refresh');
	        }
			$this->load->model('Reports_m');
		}

		public function index(){
			$this->load->view('commons/header');
			$this->load->view('reports');
			$this->load->view('commons/footer');
		}
		public function account_receivable()
		{
			$ples1 = 1;
			$periode_start = $this->input->post('periode_start');
			$periode_end = $this->input->post('periode_end');
			if ($periode_start=='' && $periode_end=='') {
				$x['periode_start']='';
				$x['periode_end']='';
				$p_start = $periode_start;
				$p_end = $periode_start;
			}elseif ($periode_start!='' && $periode_end==''){
				$x['periode_start']=$periode_start;
				$x['periode_end']=$periode_start;
				$p_start = $periode_start;
				$p_end = date('Y-m-d',strtotime($periode_start.'+'.$ples1.'days'));
			}elseif ($periode_start!='' && $periode_end!='') {
				$x['periode_start']=$periode_start;
				$x['periode_end']=$periode_end;
				$p_start = $periode_start;
				$p_end = date('Y-m-d',strtotime($periode_end.'+'.$ples1.'days'));
			}
			$x['data_reports']=$this->Reports_m->getDataReports($p_start,$p_end);
			$this->load->view('commons/header');
			$this->load->view('account_receivable',$x);
			$this->load->view('commons/footer');
		}
	}