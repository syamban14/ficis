<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Master_data extends MX_Controller{
		function __construct(){
			parent::__construct();
			if($this->session->userdata('is_login')==FALSE){
	        	redirect('/','refresh');
	        }else{
		        if ($this->session->userdata('role')!='1') {
					$info = '<div class="alert alert-warning alert-dismissible fade show border-warning shadow-sm" role="alert">
							  <i class="bi bi-exclamation-square"></i> Oops!, Your role is not Admin.
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
					$this->session->set_flashdata('info', $info);
					redirect('home','refresh');
				}
	        }
			$this->load->model('Master_data_m');
		} 

		public function index(){
			$this->load->view('commons/header');
			$this->load->view('master_data_v');
			$this->load->view('commons/footer');
		}

 		public function customer()
 		{
 			$x['title'] = 'customer'; 
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_customer'] = $this->Master_data_m->getDataCustomer();
			$x['data_vendor'] = $this->Master_data_m->getDataCustomerVendor();
 			$this->load->view('commons/header');
			$this->load->view('customer_v',$x);
			$this->load->view('commons/footer');
 		}
 		public function add_customer()
 		{
 			$kode_kustomer 		= $this->input->post('kode_kustomer');
 			$nama_kustomer 		= $this->input->post('nama_kustomer');
 			$alamat 			= $this->input->post('alamat');
 			$contact_person 	= $this->input->post('contact_person');
 			$jabatan 			= $this->input->post('jabatan');
 			$tlp 				= $this->input->post('tlp');
 			$inisial 			= $this->input->post('inisial');
 			$phone 				= $this->input->post('phone');
 			$negara 			= $this->input->post('negara');
 			$category 			= $this->input->post('category');
 			$this->Master_data_m->add_customer($kode_kustomer, $nama_kustomer, $alamat, $contact_person, $jabatan, $tlp,$inisial,$phone,$negara,$category);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data kustomer baru.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		} 
 		public function edit_customer()
 		{
 			$id					= $this->input->post('id_edit'); 
 			$kode 				= $this->input->post('kode_edit');
 			$nama 				= $this->input->post('nama_edit');
 			$alamat 			= $this->input->post('alamat_edit');
 			$contact_person		= $this->input->post('contact_person_edit');
 			$tlp 				= $this->input->post('tlp_edit');
 			$kategori 			= $this->input->post('kategori_edit');
 			$status 			= $this->input->post('status_edit');

 			$this->Master_data_m->edit_customer($id, $kode, $nama, $alamat, $contact_person, $tlp, $kategori, $status); 
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data customer.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
		public function delete_customer()
		{
			$id = $this->input->post('id_delete');
			$kategori = $this->input->post('kategori_delete');
			$this->Master_data_m->delete_customer($id, $kategori);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data customer.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);	
		}
 		public function department()
 		{
 			$x['title'] = 'department';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			// $x['data_department'] = $this->Master_data_m->getDataDepartment();
			$x['data_department_hris'] = $this->Master_data_m->getDataDepartmentHris();
 			$this->load->view('commons/header');
			$this->load->view('dept_v',$x);
			$this->load->view('commons/footer');
 		}
 		public function add_department()
 		{
 			$kode 				= $this->input->post('kode_add');
 			$nama 				= $this->input->post('nama_add');
 			$status 			= $this->input->post('status');
 			$this->Master_data_m->add_department($kode, $nama, $status);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data department baru.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		} 
 		public function edit_department()
 		{
 			$id					= $this->input->post('id_edit'); 
 			$kode 				= $this->input->post('kode_edit');
 			$nama 				= $this->input->post('nama_edit');
 			$status 			= $this->input->post('status_edit');
 			$this->Master_data_m->edit_department($id, $kode, $nama, $status); 
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data department.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function delete_department()
 		{
 			$id = $this->input->post('id_delete');
 			$this->Master_data_m->delete_department($id);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data department.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
		public function getdepartment()
		{
			$pc=$this->input->post('pcode');
			$data=$this->Master_data_m->getDataDepartment_2($pc);
			echo json_encode($data);
		}
 		public function region()
 		{
 			$x['title'] = 'region';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_region'] = $this->Master_data_m->getDataRegion();
 			$this->load->view('commons/header');
			$this->load->view('region_v',$x);
			$this->load->view('commons/footer');
 		}
 		public function add_region()
 		{
 			$kode = $this->input->post('kode_add');
 			$nama = $this->input->post('nama_add');
 			$this->Master_data_m->add_region($kode,$nama);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data region baru.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function edit_region()
 		{
 			$id = $this->input->post('id_edit');
 			$kode = $this->input->post('kode_edit');
 			$nama = $this->input->post('nama_edit');
 			$status = $this->input->post('status_edit');
 			$this->Master_data_m->edit_region($id,$kode,$nama,$status);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data region.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function delete_region()
 		{
 			$id = $this->input->post('id_delete');
 			$this->Master_data_m->delete_region($id);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data region.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function project()
 		{
			$id = '0';
 			$x['title'] = 'project';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_department'] = $this->Master_data_m->getDataDepartmentHris();
			$x['data_project'] = $this->Master_data_m->getDataProject($id);
			$x['data_akun'] = $this->Master_data_m->getDataAkun($id);
 			$this->load->view('commons/header');
			$this->load->view('project_v',$x);
			$this->load->view('commons/footer');
 		}
		public function getproject()
		{
			$id=$this->input->post('id');
			$data=$this->Master_data_m->getDataProject($id);
			echo json_encode($data);
		}
		public function getprojectAkun()
		{
			$id=$this->input->post('id');
			$data=$this->Master_data_m->getDataProjectAkun($id);
			echo json_encode($data);
		}
		public function add_project()
		{
			$department = $this->input->post('department');
			$project_code = $this->input->post('project_code');
			$project_name = $this->input->post('project_name');
			$site_alias = $this->input->post('site_alias');
			$remark = $this->input->post('remark');
			$site = $this->input->post('site');
			$contact_person = $this->input->post('contact_person');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			$this->Master_data_m->add_project($department, $project_code,$project_name,$site_alias,$remark,$site,$contact_person,$address,$phone);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data project baru.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		public function edit_project()
		{
			
			$id = $this->input->post('id_edit');
			$department = $this->input->post('department_edit');
			$project_code = $this->input->post('kode_edit');
			$project_name = $this->input->post('nama_edit');
			$site_alias = $this->input->post('site_alias_edit');
			$remark = $this->input->post('remarks_edit');
			$site = $this->input->post('site_edit');
			$contact_person = $this->input->post('contact_perso_editn');
			$address = $this->input->post('address_edit');
			$phone = $this->input->post('phone_edit');
			$this->Master_data_m->edit_project($id,$department,$project_code,$project_name,$site_alias,$remark,$site,$contact_person,$address,$phone);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data project.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		public function delete_project()
		{
			$id = $this->input->post('id_delete');
			$this->Master_data_m->delete_project($id);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data Project.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		public function add_project_akun()
		{			
			$project_code = $this->input->post('project_code_akun');
			$akun = $this->input->post('akun');

			$this->Master_data_m->add_project_akun($project_code, $akun);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data project akun baru.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		public function delete_project_akun()
		{
			$id = $this->uri->segment('3');
			$this->Master_data_m->delete_project_akun($id);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data Project akun.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		/*----------------------------------------------------------------------*/
 		public function akun_pendapatan()
 		{
			$id = '0';
 			$x['title'] = 'akun pendapatan';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_akun_pendapatan'] = $this->Master_data_m->getDataAkunPendapatan($id);
			$x['data_project'] = $this->Master_data_m->getDataProject($id);
 			$this->load->view('commons/header');
			$this->load->view('pendapatan_v',$x);
			$this->load->view('commons/footer');
 		}
		public function getpendapatan()
		{
			$id=$this->input->post('id');
			$data=$this->Master_data_m->getDataAkunPendapatan($id);
			echo json_encode($data);
		}
		public function add_akun_pendapatan()
 		{
 			$kode = $this->input->post('kode_add');
 			$nama = $this->input->post('nama_add');
 			$project = $this->input->post('project_add');
 			$this->Master_data_m->add_akun_pendapatan($kode,$nama,$project);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data akun pendapatan baru.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function edit_akun_pendapatan()
 		{
 			$id = $this->input->post('id_edit');
 			$kode = $this->input->post('kode_edit');
 			$nama = $this->input->post('nama_edit');
 			$project = $this->input->post('project_edit');
 			$status = $this->input->post('status_edit');
 			$this->Master_data_m->edit_akun_pendapatan($id,$kode,$nama,$project,$status);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data akun pendapatan.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function delete_akun_pendapatan()
 		{
 			$id = $this->input->post('id_delete');
 			$this->Master_data_m->delete_akun_pendapatan($id);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data akun pendapatan.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function akun_piutang()
 		{
			$id = '0';
 			$x['title'] = 'akun piutang';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_akun_piutang'] = $this->Master_data_m->getDataAkunPiutang($id);
			$x['data_project'] = $this->Master_data_m->getDataProject($id);
 			$this->load->view('commons/header');
			$this->load->view('piutang_v',$x);
			$this->load->view('commons/footer');
 		}
		public function getpiutang()
		{
			$id=$this->input->post('id');
			$data=$this->Master_data_m->getDataAkunPiutang($id);
			echo json_encode($data);
		}
		public function add_akun_piutang()
 		{
 			$kode = $this->input->post('kode_add');
 			$nama = $this->input->post('nama_add');
 			$project = $this->input->post('project_add');
 			$this->Master_data_m->add_akun_piutang($kode,$nama,$project);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data akun piutang baru.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function edit_akun_piutang()
 		{
 			$id = $this->input->post('id_edit');
 			$kode = $this->input->post('kode_edit');
 			$nama = $this->input->post('nama_edit');
 			$project = $this->input->post('project_edit');
 			$status = $this->input->post('status_edit');
 			$this->Master_data_m->edit_akun_piutang($id,$kode,$nama,$project,$status);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data akun piutang.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function delete_akun_piutang()
 		{
 			$id = $this->input->post('id_delete');
 			$this->Master_data_m->delete_akun_piutang($id);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data akun piutang.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		
 		public function pajak()
 		{
 			$x['title'] = 'pajak';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_pajak'] = $this->Master_data_m->getDataPajak();
 			$this->load->view('commons/header');
			$this->load->view('pajak_v',$x);
			$this->load->view('commons/footer');
 		}
 		public function add_pajak()
 		{
 			$kode = $this->input->post('kode_add');
 			$nama = $this->input->post('nama_add');
 			$nilai = $this->input->post('nilai_add');
 			$this->Master_data_m->add_pajak($kode,$nama,$nilai);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data pajak baru.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function edit_pajak()
 		{
 			$id = $this->input->post('id_edit');
 			$kode = $this->input->post('kode_edit');
 			$nama = $this->input->post('nama_edit');
 			$nilai = $this->input->post('nilai_edit');
 			$status = $this->input->post('status_edit');
 			$this->Master_data_m->edit_pajak($id,$kode,$nama,$nilai,$status);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data pajak.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function delete_pajak()
 		{
 			$id = $this->input->post('id_delete');
 			$this->Master_data_m->delete_pajak($id);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data pajak.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
 		public function satuan()
 		{
 			$x['title'] = 'satuan';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_satuan'] = $this->Master_data_m->getDataSatuan();
 			$this->load->view('commons/header');
			$this->load->view('satuan_v',$x);
			$this->load->view('commons/footer');
 		}
 		public function add_satuan()
 		{
 			$satuan 	= $this->input->post('satuan');
 			$this->Master_data_m->add_satuan($satuan);
 			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					  <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data satuan baru.
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			$this->session->set_flashdata('info', $info);
			redirect($_SERVER['HTTP_REFERER']);
 		}
		public function edit_satuan()
		{
			$id 		= $this->input->post('id_edit');
			$satuan 	= $this->input->post('satuan_edit');
			$this->Master_data_m->edit_satuan($id, $satuan);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data satuan.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		} 
		public function delete_satuan()
		{
			$id = $this->input->post('id_delete');
			$this->Master_data_m->delete_satuan($id);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data satuan.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}

		
		public function bank()
		{
			$x['title'] = 'bank';
		   	$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
		   	$x['data_bank'] = $this->Master_data_m->getDataBank();
			$this->load->view('commons/header');
			$this->load->view('bank_v',$x);
			$this->load->view('commons/footer');
		}
		public function add_bank()
		{
			$bank_name	 	= $this->input->post('bank_name');
			$bank_account 	= $this->input->post('bank_account');
			$this->Master_data_m->add_bank($bank_name, $bank_account);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data bank baru.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
	   public function edit_bank()
	   {
		   $id 				= $this->input->post('id_edit');
		   $bank_name	 	= $this->input->post('bank_name_edit');
		   $bank_account 	= $this->input->post('bank_account_edit');
		   $this->Master_data_m->edit_bank($id, $bank_name, $bank_account);
		   $info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					<i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data bank.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div>';
		  $this->session->set_flashdata('info', $info);
		  redirect($_SERVER['HTTP_REFERER']);
	   } 
	   public function delete_bank()
	   {
		   $id = $this->input->post('id_delete');
		   $this->Master_data_m->delete_bank($id);
		   $info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					<i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data bank.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div>';
		  $this->session->set_flashdata('info', $info);
		  redirect($_SERVER['HTTP_REFERER']);
	   }
	   /*-------------------------------------------------------------------------------*/
	    public function account()
	    {
			$id = '0';
			$x['title'] = 'akun';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_akun'] 	= $this->Master_data_m->getDataAkun($id);
			$x['data_akun_1']	= $this->Master_data_m->getDataAkun1();
			$x['data_akun_2']	= $this->Master_data_m->getDataAkun2();
			$x['data_akun_3']	= $this->Master_data_m->getDataAkun3();
			// $x['data_project'] = $this->Master_data_m->getDataProject($id);
			$this->load->view('commons/header');
			$this->load->view('account_v',$x);
			$this->load->view('commons/footer');
	    }
		public function add_akun()
		{
			$acc_no = $this->input->post('acc_no');
			$description = $this->input->post('description');
			$currency = $this->input->post('currency');
			$acc_lev_1 = $this->input->post('acc_lev1');
			$acc_lev_2 = $this->input->post('acc_lev2');
			$acc_lev_3 = $this->input->post('acc_lev3');
			$this->Master_data_m->add_akun($acc_no,$description,$currency,$acc_lev_1,$acc_lev_2,$acc_lev_3);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data Akun.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}			
		public function edit_akun()
		{
			$id = $this->input->post('id_edit');
			$acc_no = $this->input->post('kode_edit');
			$description = $this->input->post('nama_edit');
			$currency = $this->input->post('currency_edit');
			$acc_lev_1 = $this->input->post('acc_lev1_edit');
			$acc_lev_2 = $this->input->post('acc_lev2_edit');
			$acc_lev_3 = $this->input->post('acc_lev3_edit');
			$this->Master_data_m->edit_akun($id, $acc_no,$description,$currency,$acc_lev_1,$acc_lev_2,$acc_lev_3);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
						<i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data akun.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}		
		public function edit_akun_setting()
		{
			$id = $this->input->post('id_edit');
			$acc_no = $this->input->post('akun_edit');
			$menu = $this->input->post('menu_edit');
			$this->Master_data_m->edit_akun_setting($id, $acc_no, $menu);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
						<i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data akun setting.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		public function delete_akun()
		{
			$id = $this->input->post('id_delete');
			$this->Master_data_m->delete_akun($id);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data Akun.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);	
		}	
		public function delete_akun_setting()
		{
			$id = $this->input->post('id_delete');
			$this->Master_data_m->delete_akun_setting($id);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data Akun setting.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);	
		}			
		public function getAkunpendapatan()
		{
			$pc=$this->input->post('pcode');
			$data=$this->Master_data_m->getDataAkunPendapatan_2($pc);
			echo json_encode($data);
		}
		public function getAkunpiutang()
		{
			$pc=$this->input->post('pcode');
			$data=$this->Master_data_m->getDataAkunPiutang_2($pc);
			echo json_encode($data);
		}
		
		public function add_akun_setting()
		{
			$account_id = $this->input->post('account_id');
			$menu = $this->input->post('menu');
			$this->Master_data_m->add_akun_setting($account_id,$menu);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data Akun setting.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		/*--------------------------------------------------------------------------------------------------------------*/
		public function agreement_contract()
		{
			$id = '0';
			$x['title'] = 'Agreement Contract';			
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_agreement_contract'] = $this->Master_data_m->getDataAgreement_contract($id);
			$this->load->view('commons/header');
			$this->load->view('agreement_contract_v',$x);
			$this->load->view('commons/footer');
		}
		public function add_agreement()
		{
			$description = $this->input->post('description');
			$this->Master_data_m->add_agreement($description);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menambahkan data agreement kontrak baru.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		public function edit_agreement()
		{
			$id = $this->input->post('id_edit');
			$description = $this->input->post('description_edit');
			$this->Master_data_m->edit_agreement($id,$description);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja mengubah data agreement.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);
		}
		public function delete_agreement()
		{
			$id = $this->input->post('id_delete');
			$this->Master_data_m->delete_agreement($id);
			$info = '<div class="alert alert-success alert-dismissible fade show border-success shadow-sm" role="alert">
					 <i class="bi bi-check2-circle"></i> Sukses!, Anda baru saja menghapus data agreement contract.
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				   </div>';
		   $this->session->set_flashdata('info', $info);
		   redirect($_SERVER['HTTP_REFERER']);	
		}
		/*----------------------------------------------------------------------------------------------------*/
		public function akun_setting()
		{			$id = '0';
			$x['title'] = 'Akun Setting';
			$x['menu'] = array('customer','department','region','project','account','akun_pendapatan','akun_piutang','pajak','satuan','bank','agreement_contract');
			$x['data_akun'] 		= $this->Master_data_m->getDataAkun($id);
			$x['data_akun_setting']	= $this->Master_data_m->getDataAkunSetting();			
			$x['data_akun_1']		= $this->Master_data_m->getDataAkun1();
			$x['data_akun_2']		= $this->Master_data_m->getDataAkun2();
			$x['data_akun_3']		= $this->Master_data_m->getDataAkun3();
			$x['data_project'] 		= $this->Master_data_m->getDataProject($id);
			$this->load->view('commons/header');
			$this->load->view('akun_setting_v',$x);
			$this->load->view('commons/footer');
		}
	}