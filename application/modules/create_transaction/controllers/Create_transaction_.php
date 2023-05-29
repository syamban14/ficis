<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	require_once 'application/libraries/tcpdf/tcpdf.php';
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
			$id=0;
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
			$x['data_project'] = $this->Master_data_m->getDataProject($id);
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
			$tgl_inv = $this->input->post('tgl_inv'); 
			$no_inv = $this->input->post('no_inv');
			$nomor = $this->input->post('nomor');  
			$no_kontrak = $this->input->post('no_kontrak');  
			$no_po_spk = $this->input->post('no_po_spk');  
			$remark = $this->input->post('remark');  
			$bank = $this->input->post('bank');
			$uang_muka = $this->input->post('uang_muka');
			$tgl_kirim_inv = $this->input->post('tgl_kirim_inv');  
			$periode_kegiatan = $this->input->post('periode_kegiatan'); 
			$term_pembayaran = $this->input->post('term_pembayaran');
			$status = $this->input->post('status'); 
			$data = $this->Create_transaction_m->save_transaction($customer, $tgl_inv, $no_inv, $nomor, $no_kontrak, $no_po_spk, $remark, $bank, $uang_muka, $tgl_kirim_inv, $periode_kegiatan, $term_pembayaran, $status);
			echo json_encode($data); 
		} 
		public function save_transaction_detail()
		{
			$no_inv = $this->input->post('no_inv'); 
			$deskripsi = $this->input->post('deskripsi'); 
			$department = $this->input->post('department'); 
			$project = $this->input->post('project'); 
			$id_akunPendapatan = $this->input->post('id_akunPendapatan'); 
			$id_akunPiutang = $this->input->post('id_akunPiutang');
			$satuan = $this->input->post('satuan');
			$no_jumlah = $this->input->post('no_jumlah');
			$no_harga = $this->input->post('no_harga');
			$no_total = $this->input->post('no_total');
			$id_pajak = $this->input->post('id_pajak');
			$no_netto = $this->input->post('no_netto');
			$data = $this->Create_transaction_m->save_transaction_detail($no_inv, $deskripsi, $department, $project, $id_akunPendapatan, $id_akunPiutang, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto);
			echo json_encode($data);
		}
		public function edit_transaction()
		{
			$id=$this->uri->segment('3'); 
			$x['data_transaction'] = $this->Create_transaction_m->getDataTransaction($id);
			$x['data_customer'] = $this->Master_data_m->getDataCustomer();
			$x['data_vendor'] = $this->Master_data_m->getDataCustomerVendor();
			$x['data_department_hris'] = $this->Master_data_m->getDataDepartmentHris();
			$x['data_akun_pendapatan'] = $this->Create_transaction_m->getDataAkunPendapatan();
			$x['data_akun_piutang'] = $this->Create_transaction_m->getDataAkunPiutang();
			$x['data_satuan'] = $this->Create_transaction_m->getDataSatuan();
			$x['data_pajak'] = $this->Create_transaction_m->getDataPajak();
			$x['data_bank'] = $this->Create_transaction_m->getDataBank();
			$x['data_project'] = $this->Master_data_m->getDataProject(0);
			$this->load->view('commons/header');
			$this->load->view('edit_trans_inv',$x);
			$this->load->view('commons/footer');
		}
		public function update_transaction()
		{
			$id_tr = $this->input->post('id_tr'); 
			$customer = $this->input->post('customer'); 
			$tgl_inv = $this->input->post('tgl_inv'); 
			$no_inv = $this->input->post('no_inv');
			$nomor = $this->input->post('nomor');  
			$no_kontrak = $this->input->post('no_kontrak');  
			$no_po_spk = $this->input->post('no_po_spk');  
			$remark = $this->input->post('remark');  
			$bank = $this->input->post('bank');  
			$dp = $this->input->post('dp');  
			$tgl_kirim_inv = $this->input->post('tgl_kirim_inv');  
			$periode_kegiatan = $this->input->post('periode_kegiatan'); 
			$term_pembayaran = $this->input->post('term_pembayaran');
			$rowCountnya = $this->input->post('rowCountnya'); 
			$status = $this->input->post('status');

			$data = $this->Create_transaction_m->update_transaction($id_tr, $customer, $tgl_inv, $no_inv, $nomor, $no_kontrak, $no_po_spk, $remark, $bank, $dp, $tgl_kirim_inv, $periode_kegiatan, $term_pembayaran, $status);
			echo json_encode($data);
			die();
		}
		public function update_transaction_detail()
		{
			$id_tr_detail = $this->input->post('id_tr_detail');
			$no_inv = $this->input->post('no_inv'); 
			$deskripsi = $this->input->post('deskripsi'); 
			$department = $this->input->post('department'); 
			$project = $this->input->post('project'); 
			$akun_pendapatan = $this->input->post('akun_pendapatan'); 
			$akun_piutang = $this->input->post('akun_piutang'); 
			$satuan = $this->input->post('satuan');
			$no_jumlah = $this->input->post('no_jumlah'); 
			$no_harga = $this->input->post('no_harga');
			$no_total = $this->input->post('no_total');  
			$id_pajak = $this->input->post('id_pajak');  
			$no_netto = $this->input->post('no_netto');    
			$data = $this->Create_transaction_m->update_transaction_detail($id_tr_detail, $no_inv, $deskripsi, $department, $project, $akun_pendapatan, $akun_piutang, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto);
			echo json_encode($data); 
		}
		public function account_receivable()
		{
			$x['data_invoice_penjualan']=$this->Create_transaction_m->getDataInvoice_ar();
			$x['data_bank'] = $this->Create_transaction_m->getDataBank();
			$this->load->view('commons/header');
			$this->load->view('account_receivable',$x);
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
		public function rpt_invoice_penjualan()
		{
			$pdf =new TCPDF('P', 'mm','A4', 'true');
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->setMargins(2,2,2);
			
			$pdf->AddPage();
			$pdf->SetFont('times', '', 14);
			$pdf->setHeaderMargin(false);
			$pdf->setFooterMargin(false); 
	
			$pdf->Ln(1);
			$pdf->Ln(0);
			$no_inv=$this->uri->segment('3').'/'.$this->uri->segment('4').'/'.$this->uri->segment('5').'/'.$this->uri->segment('6').'/'.$this->uri->segment('7').'/'.$this->uri->segment('8');
			$data=$this->Create_transaction_m->getDataInvoiceRpt($no_inv);

			$customer='';
			$npwp='';
			$alamat='';
			$no_invoice='';
			$nospk='';
			$kode_project='';
			$terbilang='';
			$namabank='';
			$kurs='WKD';
			$no_rekening='9898989';
			$dp='';
			$netto='';
			foreach($data as $x){		
				$customer=$x->nama_kustomer;
				$npwp='';
				$alamat=$x->alamat;
				$no_invoice=$x->no_inv;
				$nospk=$x->no_po_spk;
				$kode_project=$x->project;
				$terbilang='';
				$namabank=$x->nama_bank;
				$kurs='';
				$no_rekening=$x->bank;
				$dp=$x->dp;
			}

				$html =' 
				<style>
					body{
						font-size:9px;
						font-family: Arial, Helvetica, sans-serif;
					}
					.content{
  						padding: 3px;
					}
					th{
						text-align:center;
					}

				</style>
				<body>
					&nbsp;
					<br/>
					<table style="width:100%;" border="0" class="center"> 
						<tr>
							<td colspan="2" style="width:30%;">&nbsp;</td>
							<td style="width:40%;"></td>
							<td colspan="2" style="width:30%;">&nbsp;</td>
						</tr> 
						<tr>
							<hr>
							<td colspan="5" style="text-align:center;"><h3><i>INVOICE</i></h3>
							</td>
							<hr style="margin-bottom:10px;"><br/>
							<hr>
						</tr> 
						<tr>
							<td style="width:8%;">Kepada</td>
							<td style="width:30%;">: '.$customer.'</td>
							<td style="width:20%;"></td>
							<td style="width:13%;">No Invoice</td>
							<td style="width:40%;">: '.$no_invoice.'</td>
						</tr> 
						<tr>
							<td>NPWP</td>
							<td>: '.$npwp.'</td>
							<td></td>
							<td>No. SPK/Kontrak</td>
							<td>: '.$nospk.'</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>: '.$alamat.'</td>
							<td></td>
							<td>No PO</td>
							<td>:</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>Kode Project</td>
							<td>: '.$kode_project.'</td>
						</tr>
					</table>
					<i style="font-weight:bold;">Attn : Finance Department</i><br/>
					Kami sampaikan tagihan pekerjaan sebagai berikut :&nbsp;<br/><br/>
					<table border="1" class="content">
						<tr>
							<th style="width:5%;">No</th>
							<th style="width:40%;">Nama Barang</th>
							<th style="width:7%;">Jumlah</th>
							<th style="width:8%;">Satuan</th>
							<th style="width:18%;">Harga Satuan</th>
							<th style="width:22%;">Jumlah</th>
						</tr>';
						$i=1;
						$data2=$this->Create_transaction_m->getDataInvoiceRptDet($no_inv);
						foreach($data2 AS $y){
							$html .='<tr>
										<td>'.$i.'</td>
										<td>'.$y->deskripsi_pesanan.'</td>
										<td>'.$y->jumlah.'</td>
										<td>'.$y->satuan.'</td>
										<td align="right">'.number_format($y->harga,0).'</td>
										<td align="right">'.number_format($y->total,0).'</td>
									</tr>';
							$i++;
						}
						$html .=' 
					</table>
					<br/><br/><br/><br/><br/><br/>
					<hr>
					<table border="0">
						<tr>
							<td rowspan="3" colspan="2" style="width:62%;"><b>Terbilang : </b> <i>'.$terbilang.'</i></td>
							<td style="width:15%;">Sub Total</td>
							<td style="text-align:center; width:3%;">:</td>
							<td></td>
						</tr>
						<tr>
							<td>Diskon</td>
							<td style="text-align:center; width:3%;">:</td>
							<td></td>
						</tr>
						<tr>
							<td>Biaya Pengantaran</td>
							<td style="text-align:center; width:3%;">:</td>
							<td>
							</td>
						</tr>
						<tr style="line-height: 0.3;">
							<td colspan="2"> </td> 
							<td colspan="3"><hr></td>
						</tr>
						<tr>
							<td><b>Pembayaran dapat di transfer :</b></td>
							<td></td>
							<td>DPP</td>
							<td style="text-align:center; width:3%;">:</td>
							<td></td>
						</tr>
						<tr>
							<td>PT. Buana Centra Swakarsa</td>
							<td></td>
							<td>PPN</td>
							<td style="text-align:center; width:3%;">:</td>
							<td></td>
						</tr>
						<tr style="line-height: 0.3;">
							<td colspan="2"> </td> 
							<td colspan="3"><hr></td>
						</tr>
						<tr>
							<td>'.$namabank.' - '.$kurs.'</td>
							<td></td>
							<td>Total</td>
							<td style="text-align:center; width:3%;">:</td>
							<td></td>
						</tr>
						<tr>
							<td rowspan="3">'.$no_rekening.'</td>
							<td rowspan="3"></td>
							<td>Uang Muka</td>
							<td style="text-align:center; width:3%;">:</td>
							<td>'.number_format($dp,0).'</td>
						</tr>
						<tr style="line-height: 0.3;">
							<td colspan="3"><hr></td>
						</tr>
						<tr>
							<td><b>TOTAL AMOUNT</b></td>
							<td style="text-align:center; width:3%;">:</td>
							<td></td>
						</tr>
						<tr style="line-height: 0.3;">
							<td colspan="2"> </td> 
							<td colspan="3"><hr><br style="line-height:0.1;"/><hr></td>
						</tr>
						<tr>
							<td colspan="5"><b>Konfirmasi Pembayaran :</b></td>
						</tr>
						<tr>
							<td colspan="2">Pembayaran via transfer bank, ATM atau setoran tunai akan dianggap lunas jika dana telah diterima di rekening  kami a.n PT. Buana Centra Swakarsa dan adanya konfirmasi pembayaran melalui :
							&nbsp;<br/></td>
						</tr>
						<tr>
							<td>Email : finance@bcs-logistics.co.id</td>
						</tr>
						<tr>
							<td>Fax	  : 0254-570666</td>
						</tr>
						<tr>
							<td>WA	  : 0877-8926-8117</td>
						</tr>
					</table>
					
					
				</body>  
					';
			
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('invoice_penjualan'.'.pdf','I');  
		}
		public function get_invoice($cust)
		{
			$data = $this->Create_transaction_m->get_invoice($cust);
			$result = '';
			$no = 1;
			foreach ($data->result() as $x) {
				$result .= '<tr>
								<td><input type="checkbox" id="cek'.$no.'"> '.$no.'</td>
								<td><label for="cek'.$no.'">'.$x->no_inv.'</label></td>
								<td>'.number_format($x->netto,0).'</td>
								<td>'.$x->term_pembayaran.' hari</td>
							</tr>';
				$no++;
			}
			echo $result;
		}
	}