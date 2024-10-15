<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'application/libraries/tcpdf/tcpdf.php';
class Create_transaction extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') == FALSE) {
			redirect('/', 'refresh');
		}
		$this->load->model('Create_transaction_m');
		$this->load->model('Master_data/Master_data_m');
	}

	public function index()
	{
		$this->load->view('commons/header');
		$this->load->view('trans_admin');
		$this->load->view('commons/footer');
	}
	public function form_invoice_penjualan()
	{
		$nomor = 0;
		$nomor_txt = '';
		$id = 0;
		$trans_test = $this->Create_transaction_m->getDataInvoice();
		foreach ($trans_test->result() as $t) {
			$nomor = $t->nomor;
		}
		$nomor = $nomor + 1;
		if (strlen($nomor) == 1) {
			$x['nomor_txt'] = '0000' . $nomor;
		} elseif (strlen($nomor) == 2) {
			$x['nomor_txt'] = '000' . $nomor;
		} elseif (strlen($nomor) == 3) {
			$x['nomor_txt'] = '00' . $nomor;
		} elseif (strlen($nomor) == 4) {
			$x['nomor_txt'] = '0' . $nomor;
		} elseif (strlen($nomor) > 4) {
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
		$role = array('1', '6');
		if (in_array($this->session->userdata('role'), $role)) {
			$this->load->view('trans_inv', $x);
		} else {
			$info = '<div class="alert alert-warning alert-dismissible fade show border-warning shadow-sm" role="alert">
						  <i class="bi bi-exclamation-square"></i> Oops!, Your role is not INV.
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
			$this->session->set_flashdata('info', $info);
			redirect('home', 'refresh');
		}
		$this->load->view('commons/footer');
	}
	public function save_transaction()
	{
		$current = 0;
		$data = $this->Create_transaction_m->getDataIdLastInvoice();
		foreach ($data->result() as $t) {
			$current = $t->id_tr;
		}
		$current += 1;
		$prefix = "00000";
		$formattedNumber = $prefix . $current;
		$customer = $this->input->post('customer');
		$tgl_inv = $this->input->post('tgl_inv');
		$no_inv = substr($formattedNumber, -strlen($prefix)) . substr($this->input->post('no_inv'), 5);
		$nomor = substr($formattedNumber, -strlen($prefix));
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
		// echo json_encode($data);
		echo json_encode(array('result' => $no_inv));
	}
	public function save_transaction_detail()
	{
		$no_inv = $this->input->post('no_inv');
		$id_customer_dn = $this->input->post('id_customer_dn');
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
		$data = $this->Create_transaction_m->save_transaction_detail($no_inv, $id_customer_dn, $deskripsi, $department, $project, $id_akunPendapatan, $id_akunPiutang, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto);
		echo json_encode($data);
	}
	public function edit_transaction()
	{
		$id = $this->uri->segment('3');
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
		$this->load->view('edit_trans_inv', $x);
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
		$x['data_invoice_penjualan'] = $this->Create_transaction_m->getDataInvoice_ar();
		$x['data_bank'] = $this->Create_transaction_m->getDataBank();
		$this->load->view('commons/header');
		$this->load->view('account_receivable', $x);
		$this->load->view('commons/footer');
	}
	public function ar_correction()
	{
		$this->load->view('commons/header');
		$this->load->view('ar_correction');
		$this->load->view('commons/footer');
	}
	public function ar_correction_result_by_date()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$x['start_date'] = $start_date;
		$x['end_date'] = $end_date;
		$x['data'] = $this->Create_transaction_m->getDataClosingInvoice($start_date, $end_date);
		$this->load->view('commons/header');
		$this->load->view('ar_correction_result', $x);
		$this->load->view('commons/footer');
	}
	// new function for sales advance
	public function sales_advance()
	{
		$this->load->view('commons/header');
		$this->load->view('sales_advance');
		$this->load->view('commons/footer');
	}

	public function account_payable()
	{
		$val = 'AP';
		$x = '';
		$x['data_akun_setting'] = $this->Create_transaction_m->getDataAkunSetting($val);
		$x['data_invoice_penjualan'] = $this->Create_transaction_m->getDataInvoice_ar();
		$x['data_bank'] = $this->Create_transaction_m->getDataBank();
		$x['data_vendor'] = $this->Master_data_m->getDataCustomerVendor();
		$this->load->view('commons/header');
		$this->load->view('account_payable', $x);
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
		$pdf = new TCPDF('P', 'mm', 'A4', 'true');
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->setMargins(10, 18, 10);

		$pdf->AddPage();
		$pdf->SetFont('times', '', 14);
		$pdf->setHeaderMargin(false);
		$pdf->setFooterMargin(false);

		$pdf->Ln(1);
		$pdf->Ln(0);
		$no_inv = $this->uri->segment('3') . '/' . $this->uri->segment('4') . '/' . $this->uri->segment('5') . '/' . $this->uri->segment('6') . '/' . $this->uri->segment('7') . '/' . $this->uri->segment('8');
		$data = $this->Create_transaction_m->getDataInvoiceRpt($no_inv);

		$customer = '';
		$npwp = '';
		$alamat = '';
		$no_invoice = '';
		$nospk = '';
		$kode_project = '';
		$namabank = '';
		$kurs = 'WKD';
		$no_rekening = '9898989';
		$dp = 0;
		$netto = 0;
		foreach ($data as $x) {
			$customer = $x->nama_kustomer;
			$npwp = '';
			$alamat = $x->alamat;
			$no_invoice = $x->no_inv;
			$nokontrak = $x->no_of_contract_help;
			$nospk = $x->no_po_spk;
			$kode_project = $x->project;
			$namabank = $x->nama_bank;
			$kurs = '';
			$no_rekening = $x->bank;
			$dp = $x->dp;
		}

		$html = ' 
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
					.renggang{
						line-height: 1.5;
					}
				</style>
				<body>
					<br/>
					<br/>
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
							<td style="width:30%;">: ' . $customer . '</td>
							<td style="width:18%;"></td>
							<td style="width:15%;">No Invoice</td>
							<td style="width:40%;">: ' . $no_invoice . '</td>
						</tr> 
						<tr>
							<td>NPWP</td>
							<td>: ' . $npwp . '</td>
							<td></td>
							<td>No. Kontrak</td>
							<td>: ' . $nokontrak . '</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>: ' . $alamat . '</td>
							<td></td>
							<td>No PO/SPK</td>
							<td>: ' . $nospk . '</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>Kode Project</td>
							<td>: ' . $kode_project . '</td>
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
		$i = 1;
		$subtotal = 0;
		$diskon = 0;
		$pengantaran = 0;
		$ppn = 0;
		$ppn_total = 0;
		$data2 = $this->Create_transaction_m->getDataInvoiceRptDet($no_inv);
		foreach ($data2 as $y) {
			$html .= '<tr>
										<td>' . $i . '</td>
										<td>' . $y->deskripsi_pesanan . '</td>
										<td>' . $y->jumlah . '</td>
										<td>' . $y->satuan . '</td>
										<td align="right">' . number_format($y->harga, 0) . '</td>
										<td align="right">' . number_format($y->total, 2) . '</td>
									</tr>';
			$i++;
			$subtotal += $y->total;
			$ppn = floor($y->total * $y->value_pajak);
			$ppn_total += $ppn;
		}
		$subtotalndp = $subtotal - $dp;
		$dpp = $subtotal + $diskon + $pengantaran;
		$total = $dpp + $ppn_total;
		$total_amount = $total - $dp;

		function terbilang($angka)
		{
			// Array kata bilangan dalam Bahasa Indonesia
			$bilangan = array(
				'',
				'Satu',
				'Dua',
				'Tiga',
				'Empat',
				'Lima',
				'Enam',
				'Tujuh',
				'Delapan',
				'Sembilan',
				'Sepuluh',
				'Sebelas'
			);

			// Mengubah angka menjadi string dan menghilangkan tanda desimal
			$angka = number_format($angka, 0, '', '');

			// Menghandle angka 0 hingga 11
			if ($angka < 12) {
				return $bilangan[$angka];
			}
			// Menghandle angka 12 hingga 19
			elseif ($angka < 20) {
				return $bilangan[$angka - 10] . ' Belas';
			}
			// Menghandle angka puluhan (20-99)
			elseif ($angka < 100) {
				return $bilangan[substr($angka, 0, 1)] . ' Puluh ' . $bilangan[substr($angka, 1, 1)];
			}
			// Menghandle angka ratusan (100-999)
			elseif ($angka < 1000) {
				// Modifikasi bagian ini untuk menghindari "Satu Ratus"
				if (substr($angka, 0, 1) == '1') {
					return 'Seratus ' . terbilang(substr($angka, 1));
				} else {
					return $bilangan[substr($angka, 0, 1)] . ' Ratus ' . terbilang(substr($angka, 1));
				}
			}
			// Menghandle angka ribuan (1000-999999)
			elseif ($angka < 1000000) {
				return terbilang(substr($angka, 0, -3)) . ' Ribu ' . terbilang(substr($angka, -3));
			}
			// Menghandle angka ribuan (1000-999999)
			elseif ($angka < 1000000000) {
				return terbilang(substr($angka, 0, -6)) . ' Juta ' . terbilang(substr($angka, -6));
			}
			// Menghandle angka ribuan (1000-999999)
			elseif ($angka < 1000000000000) {
				return terbilang(substr($angka, 0, -9)) . ' Milyar ' . terbilang(substr($angka, -9));
			}
			// Menghandle angka jutaan (1000000-999999999)
			else {
				return terbilang(substr($angka, 0, -12)) . ' Trilyun ' . terbilang(substr($angka, -12));
			}
		}

		$terbilang = terbilang($total_amount);
		$html .= ' 
					</table>
					<br/><br/><br/><br/><br/><br/>
					<hr>
					<table border="0">
						<tr>
							<td rowspan="3" colspan="2" style="width:62%;"><b>Terbilang : </b> <i>' . $terbilang . ' Rupiah</i></td>
							<td style="width:15%;">Sub Total</td>
							<td style="text-align:center; width:3%;">:</td>
							<td align="right">' . number_format($subtotal, 2) . '</td>
						</tr>
						<tr>
							<td>Diskon</td>
							<td style="text-align:center; width:3%;">:</td>
							<td align="right">' . number_format($diskon, 2) . '</td>
						</tr>
						<tr>
							<td>Biaya Pengantaran</td>
							<td style="text-align:center; width:3%;">:</td>
							<td align="right">' . number_format($pengantaran, 2) . '</td>
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
							<td align="right">' . number_format($dpp, 2) . '</td>
						</tr>
						<tr>
							<td>PT. Buana Centra Swakarsa</td>
							<td></td>
							<td>PPN</td>
							<td style="text-align:center; width:3%;">:</td>
							<td align="right">' . number_format($ppn_total, 2) . '</td>
						</tr>
						<tr style="line-height: 0.3;">
							<td colspan="2"> </td> 
							<td colspan="3"><hr></td>
						</tr>
						<tr>
							<td>' . $namabank . ' - ' . $kurs . '</td>
							<td></td>
							<td>Total</td>
							<td style="text-align:center; width:3%;">:</td>
							<td align="right">' . number_format($total, 2) . '</td>
						</tr>
						<tr>
							<td rowspan="3">' . $no_rekening . '</td>
							<td rowspan="3"></td>
							<td>Uang Muka</td>
							<td style="text-align:center; width:3%;">:</td>
							<td align="right">' . number_format($dp, 2) . '</td>
						</tr>
						<tr style="line-height: 0.3;">
							<td colspan="3"><hr></td>
						</tr>
						<tr>
							<td><b>TOTAL AMOUNT</b></td>
							<td style="text-align:center; width:3%;">:</td>
							<td align="right">' . number_format($total_amount, 0) . '</td>
						</tr>
						<tr style="line-height: 0.3;">
							<td colspan="2"> </td> 
							<td colspan="3"><hr><br style="line-height:0.1;"/><hr></td>
						</tr>
						<tr>
							<td colspan="5"><br/><br/><b>Konfirmasi Pembayaran :</b></td>
						</tr>
						<tr>
							<td colspan="2">Pembayaran via transfer bank, ATM atau setoran tunai akan dianggap lunas jika dana telah diterima di rekening  kami a.n PT. Buana Centra Swakarsa dan adanya konfirmasi pembayaran melalui :<br/></td>
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
					<br>
					<br>
					<br>
					<table>
						<tr>
							<td rowspan="5" colspan="2" style="width:62%;"></td>
						</tr>
						<tr>
							<td align="center">Cilegon, ' . date("d F Y") . '</td>
						</tr>
						<tr>
							<td align="center"><strong>PT. BUANA CENTRA SWAKARSA<br><br><br><br><br><br><br><br></strong></td>
						</tr>
						<tr>
							<td align="center"><u>Farjuni Sofyato</u></td>
						</tr>
						<tr>
							<td align="center"><em>Direktur Administrasi & Keuangan</em></td>
						</tr>
					</table>
					
					
				</body>  
					';

		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('invoice_penjualan' . '.pdf', 'I');
	}
	public function kwi_invoice_penjualan()
	{
		$pdf = new TCPDF('P', 'mm', 'A4', 'true');
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->setMargins(10, 18, 10);

		$pdf->AddPage();
		$pdf->SetFont('times', '', 14);
		$pdf->setHeaderMargin(false);
		$pdf->setFooterMargin(false);

		$pdf->Ln(1);
		$pdf->Ln(0);
		$no_inv = $this->uri->segment('3') . '/' . $this->uri->segment('4') . '/' . $this->uri->segment('5') . '/' . $this->uri->segment('6') . '/' . $this->uri->segment('7') . '/' . $this->uri->segment('8');
		$data = $this->Create_transaction_m->getDataInvoiceRpt($no_inv);

		$customer = '';
		$npwp = '';
		$alamat = '';
		$no_invoice = '';
		$nospk = '';
		$nokontrak = '';
		$kode_project = '';
		$terbilang = '';
		$namabank = '';
		$kurs = 'WKD';
		$no_rekening = '9898989';
		$dp = 0;
		$netto = '';
		foreach ($data as $x) {
			$customer = $x->nama_kustomer;
			$npwp = '';
			$alamat = $x->alamat;
			$no_invoice = $x->no_inv;
			// $nokontrak=$x->no_of_contract_help.'<br>'.$x->title_contract;
			$nokontrak = $x->no_of_contract_help;
			$nospk = $x->no_po_spk;
			$kode_project = $x->project;
			$terbilang = '';
			$namabank = $x->nama_bank;
			$kurs = '';
			$no_rekening = $x->bank;
			$dp = $x->dp;
			$remark = $x->remark;
		}
		$subtotal = 0;
		$diskon = 0;
		$pengantaran = 0;
		$ppn = 0;
		$ppn_total = 0;
		$data2 = $this->Create_transaction_m->getDataInvoiceRptDet($no_inv);
		foreach ($data2 as $y) {
			$subtotal += $y->total;
			$ppn = floor($y->total * $y->value_pajak);
			$ppn_total += $ppn;
		}
		$subtotalndp = $subtotal - $dp;
		$dpp = $subtotal + $diskon + $pengantaran;
		$total = $dpp + $ppn_total;
		$total_amount = $total - $dp;
		function terbilang($angka)
		{
			// Array kata bilangan dalam Bahasa Indonesia
			$bilangan = array(
				'',
				'Satu',
				'Dua',
				'Tiga',
				'Empat',
				'Lima',
				'Enam',
				'Tujuh',
				'Delapan',
				'Sembilan',
				'Sepuluh',
				'Sebelas'
			);

			// Mengubah angka menjadi string dan menghilangkan tanda desimal
			$angka = number_format($angka, 0, '', '');

			// Menghandle angka 0 hingga 11
			if ($angka < 12) {
				return $bilangan[$angka];
			}
			// Menghandle angka 12 hingga 19
			elseif ($angka < 20) {
				return $bilangan[$angka - 10] . ' Belas';
			}
			// Menghandle angka puluhan (20-99)
			elseif ($angka < 100) {
				return $bilangan[substr($angka, 0, 1)] . ' Puluh ' . $bilangan[substr($angka, 1, 1)];
			}
			// Menghandle angka ratusan (100-999)
			elseif ($angka < 1000) {
				// Modifikasi bagian ini untuk menghindari "Satu Ratus"
				if (substr($angka, 0, 1) == '1') {
					return 'Seratus ' . terbilang(substr($angka, 1));
				} else {
					return $bilangan[substr($angka, 0, 1)] . ' Ratus ' . terbilang(substr($angka, 1));
				}
			}
			// Menghandle angka ribuan (1000-999999)
			elseif ($angka < 1000000) {
				return terbilang(substr($angka, 0, -3)) . ' Ribu ' . terbilang(substr($angka, -3));
			}
			// Menghandle angka ribuan (1000-999999)
			elseif ($angka < 1000000000) {
				return terbilang(substr($angka, 0, -6)) . ' Juta ' . terbilang(substr($angka, -6));
			}
			// Menghandle angka ribuan (1000-999999)
			elseif ($angka < 1000000000000) {
				return terbilang(substr($angka, 0, -9)) . ' Milyar ' . terbilang(substr($angka, -9));
			}
			// Menghandle angka jutaan (1000000-999999999)
			else {
				return terbilang(substr($angka, 0, -12)) . ' Trilyun ' . terbilang(substr($angka, -12));
			}
		}
		$terbilang = terbilang($total_amount);
		$html = ' 
				<style>
					body{
						font-size:9px;
						font-family: Arial, Helvetica, sans-serif;
					}
					.content{
  						padding: 3px;
					}

				</style>
				<body>
					<br/>
					<br/>
					<br/>
					<br/>
					<table style="width:100%;" border="0" class="center"> 
						<tr>
							<td colspan="2" style="width:30%;">&nbsp;</td>
							<td style="width:40%;"></td>
							<td colspan="2" style="width:30%;">&nbsp;</td>
						</tr> 
						<tr>
							<td colspan="5" style="text-align:center;"><h2><i>KWITANSI</i></h2>
							</td>
						</tr> 
						<tr>
							<td colspan="5" style="text-align:center;"></td>
						</tr>
						<tr>
							<td colspan="5" style="text-align:center;"></td>
						</tr>
						<tr>
							<td style="width:8%;"></td>
							<td style="width:30%;"></td>
							<td style="width:20%;"></td>
							<td style="width:13%;">No</td>
							<td style="width:40%;">: ' . $no_invoice . '</td>
						</tr> 
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>Kontrak</td>
							<td>: ' . $nokontrak . '</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>PO/SPK</td>
							<td>: ' . $nospk . '</td>
						</tr>
					</table>
					<br/><br/>
					<table border="0" class="content">
						<tr>
							<th style="width:20%;">Telah terima dari</th>
							<th style="width:3%;">:</th>
							<th style="width:77%;font-style:italic;font-weight:bold;"><h3>' . $customer . '</h3></th>
						</tr>
						<tr>
							<th style="width:20%;"></th>
							<th style="width:3%;"></th>
							<th style="width:77%;"></th>
						</tr>
						<tr>
							<th style="width:20%;"></th>
							<th style="width:3%;"></th>
							<th style="width:77%;"><hr></th>
						</tr>

						<tr>
							<th style="width:20%;">Sebesar</th>
							<th style="width:3%;">:</th>
							<th style="width:77%;font-style:italic;font-weight:bold;">' . $terbilang . ' Rupiah</th>
						</tr>
						<tr>
							<th style="width:20%;"></th>
							<th style="width:3%;"></th>
							<th style="width:77%;"></th>
						</tr>
						<tr>
							<th style="width:20%;"></th>
							<th style="width:3%;"></th>
							<th style="width:77%;"><hr></th>
						</tr>
						<tr>
							<th style="width:20%;">Untuk pembayaran</th>
							<th style="width:3%;">:</th>
							<th style="width:77%;font-style:italic;font-weight:bold;">' . $remark . '</th>
						</tr>
						<tr>
							<th style="width:20%;"></th>
							<th style="width:3%;"></th>
							<th style="width:77%;"></th>
						</tr>
						<tr>
							<th style="width:20%;"></th>
							<th style="width:3%;"></th>
							<th style="width:77%;"><hr></th>
						</tr>
					</table>
					<br/><br/><br/><br/><br/><br/>
					<table border="0">
						<tr>
							<td style="width:4%;font-style:italic;font-weight:bold;">IDR</td>
							<td style="width:32%;">
								<h3><strong>' . number_format($total_amount, 0) . '</strong></h3><br><br>
								Pembayaran ditransfer ke:<br><br>
								PT. BUANA CENTRA SWAKARSA<br><br>
								<strong>BANK BNI Cab. KK Serang City (IDR)<br><br>
								No Rek 254-570-444-6</strong>
							</td>
							<td style="text-align:center; width:39%;"></td>
							<td style="text-align:center; width:25%;">
								Cilegon, ' . date('d F Y') . '<br><br><br><br><br><br><br><br><br>
								<span style="text-decoration:underline;">FARJUNI SOFIYANTO</span><br>
								Direktur Keuangan
							</td>
						</tr>
					</table>
				</body>  
					';

		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('invoice_penjualan' . '.pdf', 'I');
	}
	public function get_invoice($cust)
	{
		$data = $this->Create_transaction_m->get_invoice($cust);
		$result = '';
		$no = 1;
		foreach ($data->result() as $x) {
			$result .= '<tr>
								<td><input class="cekbok" type="checkbox" id="cek' . $no . '" name="invoice_item[]" value="' . $x->no_inv . '~' . $x->amount . '"> ' . $no . '</td>
								<td><label for="cek' . $no . '">' . $x->no_inv . '</label></td>
								<td align="right">Rp ' . number_format($x->amount, 0) . '</td>
								<td>' . date('d F Y', strtotime($x->tgl_kirim_inv)) . '</td>
								<td>' . $x->term_pembayaran . ' hari</td>
							</tr>';
			$no++;
		}
		echo $result;
	}
	public function add_to_closing()
	{
		$invoice_item 	= $this->input->post('invoice_item');
		$cust 			= $this->input->post('txt_cust');
		$tgl_closing 	= $this->input->post('txt_tgl_closing');
		$bank 	  		= $this->input->post('txt_bank');
		$remark 	  	= $this->input->post('txt_remark');
		$data_header 	= $this->db->query("SELECT * FROM tr_closing_ar")->num_rows();
		$id_tr 			= $data_header + 1;
		// for ($i=0; $i < count($invoice_item) ; $i+){
		$this->Create_transaction_m->add_to_closing($invoice_item, $id_tr, $cust, $tgl_closing, $bank, $remark);
		// }
		$info = '<div class="alert alert-success alert-dismissible f/ade show" role="alert">
	                    <strong>Success!</strong> Your data is submitted successfully. 
	                </div>';
		$this->session->set_flashdata('info', $info);
		redirect('create_transaction/closing_ar/' . $id_tr);
	}
	public function closing_ar($id_tr)
	{
		$x['data_invoice_penjualan'] = $this->Create_transaction_m->getDataInvoice_ar();
		$val = 'AR';
		$x['data_akun_setting'] = $this->Create_transaction_m->getDataAkunSetting($val);
		$x['data_bank'] = $this->Create_transaction_m->getDataBank2($val);
		$x['data_closing_hd'] = $this->Create_transaction_m->getDataClosingHD($id_tr);
		$x['data_closing_dt'] = $this->Create_transaction_m->getDataClosingDT($id_tr);
		$this->load->view('commons/header');
		$this->load->view('closing_ar', $x);
		$this->load->view('commons/footer');
	}
	public function close_invoice()
	{
		$id_tr = $this->input->post('id_tr');
		$no_inv = $this->input->post('no_inv');
		$akun_bank = $this->input->post('akun_bank');
		$akun_pph = $this->input->post('akun_pph');
		$akun_ppn = $this->input->post('akun_ppn');
		$akun_adminbank = $this->input->post('akun_adminbank');
		$akun_bungafactoring = $this->input->post('akun_bungafactoring');
		$saldoawal = $this->input->post('saldoawal');
		$bank = $this->input->post('bank');
		$pph = $this->input->post('pph');
		$ppn = $this->input->post('ppn');
		$adminbank = $this->input->post('adminbank');
		$bungafactoring = $this->input->post('bungafactoring');
		$saldoakhir = $this->input->post('saldoakhir');
		$revisi = $this->input->post('revisi');
		$this->Create_transaction_m->close_invoice($id_tr, $no_inv, $akun_bank, $akun_pph, $akun_ppn, $akun_adminbank, $akun_bungafactoring, $saldoawal, $bank, $pph, $ppn, $adminbank, $bungafactoring, $saldoakhir, $revisi);
		echo 1;
	}

	public function form_account_payable()
	{
		$nomor = 0;
		$id = 0;
		$val = 'AP';
		$x['data_akun_setting'] = $this->Create_transaction_m->getDataAkunSetting($val);
		$x['data_vendor'] = $this->Master_data_m->getDataCustomerVendor();
		$x['data_project'] = $this->Master_data_m->getDataProject($id);
		$x['data_department_hris'] = $this->Master_data_m->getDataDepartmentHris();
		$x['data_satuan'] = $this->Create_transaction_m->getDataSatuan();
		$x['data_procurement'] = $this->Create_transaction_m->getProcurementOff();
		$x['data_pajak'] = $this->Create_transaction_m->getDataPajak();

		$this->load->view('commons/header');
		$role = array('1', '3');
		if (in_array($this->session->userdata('role'), $role)) {
			$this->load->view('trans_ap', $x);
		} else {
			$info = '<div class="alert alert-warning alert-dismissible fade show border-warning shadow-sm" role="alert">
						  <i class="bi bi-exclamation-square"></i> Oops!, Your role is not INV.
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
			$this->session->set_flashdata('info', $info);
			redirect('home', 'refresh');
		}
		$this->load->view('commons/footer');
	}
	public function getKontrak()
	{
		$customer = $this->input->post('customer');
		$data = $this->Create_transaction_m->getDataKontrak($customer);
		echo json_encode($data);
	}

	public function getPo()
	{
		$vendor_id = $this->input->post('vendor_id');
		$data = $this->Create_transaction_m->getPo($vendor_id);
		echo json_encode($data);
	}
	public function getPodetail()
	{
		$no_po = $this->input->post('no_po');
		$data = $this->Create_transaction_m->getPodetail($no_po);
		echo json_encode($data);
	}
	public function getHeaderDn()
	{
		$customer = $this->input->post('customer');
		$data = $this->Create_transaction_m->getDataHeaderDn($customer);
		echo json_encode($data);
	}
	public function purchase_advance()
	{
		$val = 'AP';
		$x = '';
		$id = 0;
		$id_vendor = 0;
		$x['data_akun_setting'] = $this->Create_transaction_m->getDataAkunSetting($val);
		$x['data_vendor'] = $this->Master_data_m->getDataCustomerVendor();
		$x['data_project'] = $this->Master_data_m->getDataProject($id);
		$x['data_department_hris'] = $this->Master_data_m->getDataDepartmentHris();
		$x['data_purchase_advance'] = $this->Create_transaction_m->getDataPurchaseAdvance($id_vendor);
		$this->load->view('commons/header');
		$this->load->view('purchase_advance', $x);
		$this->load->view('commons/footer');
	}

	public function getPurchaseAdvance()
	{
		$id_vendor = $this->input->post('vendor_id');
		$data = $this->Create_transaction_m->getDataPurchaseAdvance($id_vendor);
		echo json_encode($data);
	}
	public function save_transaction_ap()
	{
		$vendor		 	 = $this->input->post('vendor');
		$no_inv 	 	 = $this->input->post('no_inv');
		$no_po 		 	 = $this->input->post('no_po');
		$tgl_input 	 	 = $this->input->post('tgl_input');
		$tax_number  	 = $this->input->post('tax_number');
		$tax_date 		 = $this->input->post('tax_date');
		$department 	 = $this->input->post('department');
		$project		 = $this->input->post('project');
		$dp				 = $this->input->post('dp');
		$term_pembayaran = $this->input->post('term_pembayaran');
		$delivery_date 	 = $this->input->post('delivery_date');
		$purchasing_dept = $this->input->post('purchasing_dept');
		$status			 = $this->input->post('status');
		$data			 = $this->Create_transaction_m->save_transaction_ap($vendor, $no_inv, $no_po, $tgl_input, $tax_number, $tax_date, $department, $project, $dp, $term_pembayaran, $delivery_date, $purchasing_dept, $status);
		echo json_encode($data);
	}

	public function save_transaction_ap_detail()
	{
		$no_inv 	  = $this->input->post('no_inv');
		$no_po 		  = $this->input->post('no_po');
		$description  = $this->input->post('description');
		$kode_akun 	  = $this->input->post('kode_akun');
		$received 	  = $this->input->post('received');
		$unit 		  = $this->input->post('unit');
		$price 		  = $this->input->post('price');
		$diskon 	  = $this->input->post('diskon');
		$id_pajak 	  = $this->input->post('id_pajak');
		$nilai 		  = $this->input->post('nilai');
		$id_pajak_dua = $this->input->post('id_pajak_dua');
		$nilai_dua 	  = $this->input->post('nilai_dua');
		$subtotal 	  = $this->input->post('subtotal');
		$data 		  = $this->Create_transaction_m->save_transaction_ap_detail($no_inv, $no_po, $description, $kode_akun, $received, $unit, $price, $diskon, $id_pajak, $nilai, $id_pajak_dua, $nilai_dua, $subtotal);
		echo json_encode($data);
	}

	public function edit_transaction_ap()
	{
		$id = $this->uri->segment('3');
		$val = 'AP';
		$x = '';
		$x['data_pajak'] = $this->Create_transaction_m->getDataPajak();
		$x['data_akun_setting'] = $this->Create_transaction_m->getDataAkunSetting($val);
		$x['data_procurement'] = $this->Create_transaction_m->getProcurementOff();
		$x['data_account_payable'] = $this->Create_transaction_m->getDataAkunPayable($id);
		$x['data_vendor'] = $this->Master_data_m->getDataCustomerVendor();

		$this->load->view('commons/header');
		$this->load->view('edit_transaction_ap', $x);
		$this->load->view('commons/footer');
	}
	public function update_transaction_ap()
	{
		$vendor_id 	 	  = $this->input->post('vendor_id');
		$purchase_no 	  = $this->input->post('purchase_no');
		$po_no 		 	  = $this->input->post('po_no');
		$tgl_input 		  = $this->input->post('tgl_input');
		$invoice_date 	  = $this->input->post('invoice_date');
		$tax_number 	  = $this->input->post('tax_number');
		$tax_date 		  = $this->input->post('tax_date');
		$department 	  = $this->input->post('department');
		$project 		  = $this->input->post('project');
		$dp 			  = $this->input->post('dp');
		$term_pembayaran  = $this->input->post('term_pembayaran');
		$delivery_date 	  = $this->input->post('delivery_date');
		$purchasing_dept  = $this->input->post('purchasing_dept');
		$status 		  = $this->input->post('status');
		$data 		 	  = $this->Create_transaction_m->update_transaction_ap($vendor_id, $purchase_no, $po_no, $tgl_input, $invoice_date, $tax_number, $tax_date, $department, $project, $dp, $term_pembayaran, $delivery_date, $purchasing_dept, $status);
		echo json_encode($data);
	}
	public function update_transaction_ap_detail()
	{
		$description 	  = $this->input->post('description');
		$code_account 	  = $this->input->post('code_account');
		$received 	 	  = $this->input->post('received');
		$unit 	 	 	  = $this->input->post('unit');
		$price 	 	  	  = $this->input->post('price');
		$discount_amount  = $this->input->post('discount_amount');
		$id_pajak 	 	  = $this->input->post('id_pajak');
		$nilai 	 	   	  = $this->input->post('nilai');
		$id_pajak_dua 	  = $this->input->post('id_pajak_dua');
		$nilai_dua 	 	  = $this->input->post('nilai_dua');
		$subtotal 	 	  = $this->input->post('subtotal');
		$purchase_no 	  = $this->input->post('purchase_no');
		$po_no 	 		  = $this->input->post('po_no');
		$id_ap_detail	  = $this->input->post('id_ap_detail');
		$data 		 	  = $this->Create_transaction_m->update_transaction_ap_detail($description, $code_account, $received, $unit, $price, $discount_amount, $id_pajak, $nilai, $id_pajak_dua, $nilai_dua, $subtotal, $purchase_no, $po_no, $id_ap_detail);
		echo json_encode($data);
	}
	public function save_purchase_advance()
	{
		$cash_account = $this->input->post('cash_account');
		$vendor 	  = $this->input->post('vendor');
		$nilai 	 	  = $this->input->post('nilai');
		$ref_no 	  = $this->input->post('ref_no');
		$tanggal 	  = $this->input->post('tanggal');
		$department	  = $this->input->post('department');
		$project	  = $this->input->post('project');
		$memo	  	  = $this->input->post('memo');
		$data 		  = $this->Create_transaction_m->save_purchase_advance($cash_account, $vendor, $nilai, $ref_no, $tanggal, $department, $project, $memo);
		echo json_encode($data);
	}
	public function delete_purchase_advance()
	{
		$id = $this->input->post('id_delete');
		$this->Create_transaction_m->delete_purchase_advance($id);
		$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data Purchase Advance.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		$this->session->set_flashdata('info', $info);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function edit_purchase_advance()
	{
		$id_purchase_advance = $this->input->post('id_purchase_advance');
		$cash_account_edit   = $this->input->post('cash_account_edit');
		$vendor_edit 	 	 = $this->input->post('vendor_edit');
		$department_edit 	 = $this->input->post('department_edit');
		$project_edit 	  	 = $this->input->post('project_edit');
		$nilai_edit	  		 = $this->input->post('nilai_edit');
		$ref_number_edit	 = $this->input->post('ref_number_edit');
		$tanggal_edit	  	 = $this->input->post('tanggal_edit');
		$memo_edit	  	     = $this->input->post('memo_edit');
		$data 		         = $this->Create_transaction_m->edit_purchase_advance($id_purchase_advance, $cash_account_edit, $vendor_edit, $department_edit, $project_edit, $nilai_edit, $ref_number_edit, $tanggal_edit, $memo_edit);
		echo json_encode($data);

		$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
						<i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data purchase advance.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
		$this->session->set_flashdata('info', $info);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getVendorByIdCashAccount()
	{
		$id_cash_account = $this->input->post('id_cash_account');
		$data = $this->Create_transaction_m->getVendorByIdCashAccount($id_cash_account);
		echo json_encode($data);
	}

	public function getDataPurchaseInvoice()
	{
		$id_vendor = $this->input->post('id_vendor');
		$data = $this->Create_transaction_m->getDataPurchaseInvoice($id_vendor);
		echo json_encode($data);
	}

	public function close_purchase_invoice()
	{
		// $max_id = $this->db->query("SELECT count(id) as jml FROM tr_closing_ap");
		// $get_max_id = $max_id->row()->jml;
		// $curr_id = $get_max_id+1;
		$curr_id = $this->input->post('curr_id');
		$code_account = $this->input->post('code_account');
		$received_by_vendor = $this->input->post('received_by_vendor');
		$department = $this->input->post('department');
		$project = $this->input->post('project');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$status = $this->input->post('status');
		$total_value = $this->input->post('total_value');

		$this->Create_transaction_m->close_purchase_invoice($curr_id, $code_account, $received_by_vendor, $department, $project, $tgl_pembayaran, $status, $total_value);
		echo 1;
	}

	public function close_purchase_invoice_detail()
	{
		$curr_id = $this->input->post('curr_id');
		$purchase_number = $this->input->post('purchase_number');
		$saldo = $this->input->post('saldo');
		$jumlah_bayar = $this->input->post('jumlah_bayar');
		$statusnya = $this->input->post('statusnya');

		$this->Create_transaction_m->close_purchase_invoice_detail($curr_id, $purchase_number, $saldo, $jumlah_bayar, $statusnya);
		echo 1;
	}
}
