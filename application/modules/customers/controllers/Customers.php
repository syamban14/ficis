<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Customers extends MX_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('Customers_m');
		}

		public function index(){
			$data['master_customer']=$this->Customers_m->data_customer();
			$lokasi='';
			$data['master_lokasi']=$this->Customers_m->data_lokasi($lokasi);
			$this->load->view('commons/header.php');
			$this->load->view('customers_v',$data);
			$this->load->view('commons/footer.php');
		}
		public function cek_name()
		{
			$initial=$this->input->post('acronym');
			$cek=$this->Customers_m->cek_name($initial);
			echo $cek->num_rows();
		}
		public function save_customer()
		{
			$statt=$this->input->post('statt');
			$id_kustomer=$this->input->post('id_kustomer');
			$cust_name=strtoupper($this->input->post('cust_name'));
			$wh_designated=$this->input->post('wh_designated'); 
			$email =$this->input->post('email');
			$customer_code = strtoupper($this->input->post('customer_code'));
			$password =$this->input->post('password');
			$keterangan =$this->input->post('keterangan');
			$alamat =$this->input->post('alamat');
			$telepon =$this->input->post('telepon');
			$pic =$this->input->post('pic');
			$no_hp =$this->input->post('no_hp');
			$start_date =$this->input->post('start_date');
			$due_date =$this->input->post('due_date'); 
			
			$data = $this->Customers_m->save_customer($statt, $id_kustomer, $cust_name,$wh_designated,$email,$customer_code,$password, $keterangan, $alamat, $telepon, $pic, $no_hp, $start_date, $due_date);
			echo json_encode($data);

            // $this->send_mail($customer_code, $password, $email);

			$info = '<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
	                    <strong>Success!</strong> Your data is submitted successfully. 
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </div>';
	        $this->session->set_flashdata('info',$info);
		}
		public function edit_kustomer(){
			$id=$this->uri->segment('3');
			$data['kustomer']=$this->Customers_m->get_data_kustomer($id); 
			$this->load->view('commons/header.php');
			$this->load->view('edit_kustomer_v',$data);
			$this->load->view('commons/footer.php');
		}
		
		public function delete_kustomer(){
			$id=$this->uri->segment('3'); 
			$data = $this->Customers_m->delete_customer($id);
			// echo json_encode($data);   
			$info = '<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
	                    <strong>Success!</strong> Your data is deleted successfully. 
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </div>';
			if ($data==true){ 
				$this->session->set_flashdata('info',$info);
				redirect('customers'); 
			}  
		}		
        public function send_mail($customer_code, $password, $email){
            // Konfigurasi email
            $config = [
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_user' => 'bcs.itc.cilegon@gmail.com',  // Email gmail
                'smtp_pass'   => 'bcs2017lebihberkelas',  // Password gmail
                'smtp_crypto' => 'ssl',
                'smtp_port'   => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
            ];  
    
            $this->load->library('email', $config);
    
            // Email dan nama pengirim
            $this->email->from('no-reply@bcs-logistics.co.id', 'BCS Warehouse Management System');
    
            // Email penerima
            $this->email->to($email); // Ganti dengan email tujuan 
    
            // Subject email
            $this->email->subject('Registrasi Member Warehouse Management System (WMS) PT. BCS Logistics');
    
            // Isi email
            $this->email->message('Terima Kasih telah menjadi customer warehouse PT.BCS Logistics, Untuk username & password sebagai berikut <br/> <br/>
									Username : '.$customer_code.' <br/>
									Password : '.$password.' <br/>
									<br/>  Untuk membuka WMS sistem silahkan buka link dibawah ini : <br/>
									<a href="cilegon.bcs-logistics.co.id/wms" target="_blank">cilegon.bcs-logistics.co.id/wms</a><br/>
									(segera ganti password anda setelah berhasil akses sistem)');
            $this->email->send(); 
        }
	}