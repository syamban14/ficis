<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Create_transaction extends MX_Controller{
		function __construct(){
			parent::__construct();
			if($this->session->userdata('is_login')==FALSE)
	        {
	        	redirect('/','refresh');
	        }
			$this->load->model('Create_transaction_m');
			$this->load->model('Master_data/Master_data_m');
		}

		public function index(){
			$this->load->view('commons/header');
			if ($this->session->userdata('role')=='1') {
				$this->load->view('trans_admin');
			}else{
				$info = '<div class="alert alert-warning alert-dismissible fade show border-warning shadow-sm" role="alert">
						  <i class="bi bi-exclamation-square"></i> Oops!, Your role is not Admin.
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
				$this->session->set_flashdata('info', $info);
				redirect('home','refresh');
			}
			// elseif ($this->session->userdata('role')=='2') {
			// 	$this->load->view('trans_ar');
			// }elseif ($this->session->userdata('role')=='3') {
			// 	$this->load->view('trans_ap');
			// }elseif ($this->session->userdata('role')=='4') {
			// 	$this->load->view('trans_ga');
			// }elseif ($this->session->userdata('role')=='5') {
			// 	$this->load->view('trans_ca');
			// }elseif ($this->session->userdata('role')=='6') {
			// 	$this->load->view('trans_inv',$x);
			// }
			$this->load->view('commons/footer');
		}
		public function form_invoice_penjualan()
		{
			$nomor=0;
			$nomor_txt='';
			$trans_test=$this->Create_transaction_m->getDataInvoice(); 
			foreach ($trans_test->result() as $t) 
			{
				$nomor=$t->nomor; 
			}  
			$nomor=$nomor+1;
			if (strlen($nomor) == 1) {
				$x['nomor_txt'] = '0000'.$nomor;
			}elseif (strlen($nomor) == 2) {
				$x['nomor_txt'] = '000'.$nomor;
			}elseif (strlen($nomor) == 3) {
				$x['nomor_txt'] = '00'.$nomor;
			}elseif (strlen($nomor) == 4) {
				$x['nomor_txt'] = '0'.$nomor;
			}elseif (strlen($nomor) > 4) {
				$x['nomor_txt'] = $nomor;
			}

			$x['data_customer'] = $this->Master_data_m->getDataCustomer();
			$x['data_vendor'] = $this->Master_data_m->getDataCustomerVendor();
			$x['data_department'] = $this->Master_data_m->getDataDepartment();
			$x['data_department_hris'] = $this->Master_data_m->getDataDepartmentHris();
			$x['data_akun_pendapatan'] = $this->Create_transaction_m->getDataAkunPendapatan();
			$x['data_akun_piutang'] = $this->Create_transaction_m->getDataAkunPiutang();
			$x['data_satuan'] = $this->Create_transaction_m->getDataSatuan();
			$x['data_pajak'] = $this->Create_transaction_m->getDataPajak();
			$x['data_bank'] = $this->Create_transaction_m->getDataBank();
			$this->load->view('commons/header');
			$role = array('1','6');
			if ( in_array($this->session->userdata('role'), $role) ) {
				$this->load->view('trans_inv',$x);
			}else{
				$info = '<div class="alert alert-warning alert-dismissible fade show border-warning shadow-sm" role="alert">
						  <i class="bi bi-exclamation-square"></i> Oops!, Your role is not INV.
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
				$this->session->set_flashdata('info', $info);
				redirect('home','refresh');
			}
			$this->load->view('commons/footer');
		}
		public function save_transaction()
		{
			$customer = $this->input->post('customer'); 
			$department = $this->input->post('department'); 
			$project = $this->input->post('project'); 
			$akun_pendapatan = $this->input->post('akun_pendapatan'); 
			$akun_piutang = $this->input->post('akun_piutang'); 
			$tgl_inv = $this->input->post('tgl_inv'); 
			$no_inv = $this->input->post('no_inv');
			$nomor = $this->input->post('nomor');  
			$no_kontrak = $this->input->post('no_kontrak');  
			$no_po_spk = $this->input->post('no_po_spk');  
			$remark = $this->input->post('remark');  
			$tgl_kirim_inv = $this->input->post('tgl_kirim_inv');  
			$periode_kegiatan = $this->input->post('periode_kegiatan'); 
			$term_pembayaran = $this->input->post('term_pembayaran');
			$rowCountnya = $this->input->post('rowCountnya'); 
			$status = $this->input->post('status'); 
			// echo $rowCountnya;
			// for($i=1;$i<=$rowCountnya;$i++)
			// {
			// 	echo 's'.$i.'<br>';
			// 	echo $this->input->post('deskripsi'.$i); 	
			// }
			$data = $this->Create_transaction_m->save_transaction($customer, $department, $project, $akun_pendapatan, $akun_piutang, $tgl_inv, $no_inv, $nomor, $no_kontrak, $no_po_spk, $remark, $tgl_kirim_inv, $periode_kegiatan, $term_pembayaran, $status);
			echo json_encode($data); 
		} 
		public function save_transaction_detail()
		{
			$no_inv = $this->input->post('no_inv'); 
			$deskripsi = $this->input->post('deskripsi'); 
			$id_akunPendapatan = $this->input->post('id_akunPendapatan'); 
			$id_akunPiutang = $this->input->post('id_akunPiutang');
			$satuan = $this->input->post('satuan');
			$no_jumlah = $this->input->post('no_jumlah'); 
			$no_harga = $this->input->post('no_harga');
			$no_total = $this->input->post('no_total');  
			$id_pajak = $this->input->post('id_pajak');  
			$no_netto = $this->input->post('no_netto');    
			$data = $this->Create_transaction_m->save_transaction_detail($no_inv, $deskripsi, $id_akunPendapatan, $id_akunPiutang, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto);
			echo json_encode($data); 
		}
		public function edit_transaction()
		{
			$id=$this->uri->segment('3'); 
			$x['data_transaction'] = $this->Create_transaction_m->getDataTransaction($id);
			$x['data_customer'] = $this->Master_data_m->getDataCustomer();
			$x['data_vendor'] = $this->Master_data_m->getDataCustomerVendor();
			$x['data_department'] = $this->Master_data_m->getDataDepartment();
			$x['data_department_hris'] = $this->Master_data_m->getDataDepartmentHris();
			$x['data_akun_pendapatan'] = $this->Create_transaction_m->getDataAkunPendapatan();
			$x['data_akun_piutang'] = $this->Create_transaction_m->getDataAkunPiutang();
			$x['data_satuan'] = $this->Create_transaction_m->getDataSatuan();
			$x['data_pajak'] = $this->Create_transaction_m->getDataPajak();
			$this->load->view('commons/header');
			$this->load->view('edit_trans_inv',$x);
			$this->load->view('commons/footer');
		}
		public function update_transaction()
		{
			$id_tr = $this->input->post('id_tr'); 
			$customer = $this->input->post('customer'); 
			$department = $this->input->post('department'); 
			$project = $this->input->post('project'); 
			$akun_pendapatan = $this->input->post('akun_pendapatan'); 
			$akun_piutang = $this->input->post('akun_piutang'); 
			$tgl_inv = $this->input->post('tgl_inv'); 
			$no_inv = $this->input->post('no_inv');
			$nomor = $this->input->post('nomor');  
			$no_kontrak = $this->input->post('no_kontrak');  
			$no_po_spk = $this->input->post('no_po_spk');  
			$remark = $this->input->post('remark');  
			$tgl_kirim_inv = $this->input->post('tgl_kirim_inv');  
			$periode_kegiatan = $this->input->post('periode_kegiatan'); 
			$term_pembayaran = $this->input->post('term_pembayaran');
			$rowCountnya = $this->input->post('rowCountnya'); 
			$status = $this->input->post('status');

			$data = $this->Create_transaction_m->update_transaction($id_tr, $customer, $department, $project, $akun_pendapatan, $akun_piutang, $tgl_inv, $no_inv, $nomor, $no_kontrak, $no_po_spk, $remark, $tgl_kirim_inv, $periode_kegiatan, $term_pembayaran, $status);
			echo json_encode($data);
		}
		public function update_transaction_detail()
		{
			$id_tr_detail = $this->input->post('id_tr_detail');
			$no_inv = $this->input->post('no_inv'); 
			$deskripsi = $this->input->post('deskripsi'); 
			$satuan = $this->input->post('satuan');
			$no_jumlah = $this->input->post('no_jumlah'); 
			$no_harga = $this->input->post('no_harga');
			$no_total = $this->input->post('no_total');  
			$id_pajak = $this->input->post('id_pajak');  
			$no_netto = $this->input->post('no_netto');    
			$data = $this->Create_transaction_m->update_transaction_detail($id_tr_detail, $no_inv, $deskripsi, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto);
			echo json_encode($data); 
		}
		public function account_receivable()
		{
			$this->load->view('commons/header');
			$this->load->view('commons/footer');
		}
		public function account_payable()
		{
			$this->load->view('commons/header');
			$this->load->view('commons/footer');
		}
		public function general_accounting()
		{
			$this->load->view('commons/header');
			$this->load->view('commons/footer');
		}
		public function cash_advance()
		{
			$this->load->view('commons/header');
			$this->load->view('commons/footer');
		}
	}