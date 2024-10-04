<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Home extends MX_Controller{
		function __construct(){
			parent::__construct();
			if($this->session->userdata('is_login')==FALSE)
	        {
	        	redirect('/','refresh');
	        }
			$this->load->model('Home_m');
		}

		public function index(){
			$x['dataInv'] = $this->Home_m->getInvoicePenjualan();
			$x['dataAp'] = $this->Home_m->getPurchaseInvoice();
			$x['dataHistory'] = $this->Home_m->getHistory();
			$this->load->view('commons/header');
			if ($this->session->userdata('grup')=='1') {
				$this->load->view('home_staff',$x);
			}elseif ($this->session->userdata('grup')=='2') {
				$this->load->view('home_non_staff');
			}
			$this->load->view('commons/footer');
		}
		public function get_detail_inv()
		{
			$noinv = $this->input->post('noinv');
			$html = '<table class="table table-bordered table-sm">
					 	<tr>
					 		<th>No.</th>
					 		<th>Department</th>
					 		<th>Project</th>
					 		<th>Akun pendapatan</th>
					 		<th>Akun piutang</th>
					 		<th>ID Cust. DN</th>
					 		<th>Deskripsi pesanan</th>
					 		<th>Satuan</th>
					 		<th>Jumlah</th>
					 		<th>Harga</th>
					 		<th>Total</th>
					 		<th>Pajak</th>
					 		<th>Netto</th>
					 	</tr>';
			$data = $this->Home_m->get_detail_inv($noinv);
			$i = 1;
			foreach ($data->result() as $x) {
				$html .= '<tr>
							<td>'.$i.'</td>
							<td>'.$x->dept_name.'</td>
							<td>'.$x->project.' '.$x->dept_name.'</td>
							<td>'.$x->akun_pd.'</td>
							<td>'.$x->akun_pu.'</td>
							<td>'.$x->id_customer_dn.'</td>
							<td>'.$x->deskripsi_pesanan.'</td>
							<td>'.$x->satuan.'</td>
							<td>'.$x->jumlah.'</td>
							<td align="right">Rp&nbsp;'.number_format($x->harga,2).'</td>
							<td align="right">Rp&nbsp;'.number_format($x->total,2).'</td>
							<td>'.$x->nama_pajak.'</td>
							<td align="right">Rp&nbsp;'.number_format($x->netto,2).'</td>
						  </tr>';
				$i++;
			}
			$html .= '</table>';
			echo $html;
		}
		public function deleteInvPenjualan()
		{
			$nomor = $this->input->post('nomor');
			$alasan = $this->input->post('alasan');
			$this->Home_m->deleteInvPenjualan($nomor,$alasan);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Success! You have just been deleted the data.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
		}
		public function postInvPenjualan()
		{
			$nomor = $this->input->post('nomorPost');
			$this->Home_m->postInvPenjualan($nomor);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Success! You have just been posted the data.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
		}
		public function closeInvPenjualan()
		{
			$nomor = $this->input->post('nomorClose');
			$this->Home_m->closeInvPenjualan($nomor);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Success! You have just been closed the data.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
		}
 
		public function get_detail_pur()
		{
			$Pnno = $this->input->post('Pnno');
			$html = '<table class="table table-bordered table-sm">
					 	<tr>
					 		<th>No.</th>
					 		<th>Order Description</th>
					 		<th>Account</th>
					 		<th>Received</th>
					 		<th>Unit</th>
					 		<th>Unit Price</th>
					 		<th>Discount</th>
					 		<th>Tax 1</th>
					 		<th>Tax 2</th>
					 		<th>Subtotal</th>
					 	</tr>';
			$data = $this->Home_m->get_detail_pur($Pnno);
			$i = 1;
			foreach ($data->result() as $x) {
				$html .= '<tr>
							<td>'.$i.'</td>
							<td>'.$x->order_description.'</td>
							<td>'.$x->account_name.'</td>
							<td>'.$x->received.'</td>
							<td>'.$x->unit.'</td>
							<td align="right">Rp&nbsp;'.number_format($x->unit_price,2).'</td>
							<td align="right">Rp&nbsp;'.number_format($x->discount,2).'</td>
							<td align="right">'.$x->tax_one.' %</td>
							<td align="right">'.$x->tax_two.' %</td>
							<td align="right">Rp&nbsp;'.number_format($x->total,2).'</td>
						  </tr>';
				$i++;
			}
			$html .= '</table>';
			echo $html;
		}
	}