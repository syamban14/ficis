<?php 
    class Customers_m extends MX_Controller{
        function __construct(){
            parent::__construct();
            $this->db  = $this->load->database('default', TRUE);
        }
        function data_customer()
        {
            $query=$this->db->query("SELECT * FROM ms_kustomer ORDER BY id_kustomer DESC");

            return $query->result();
        }
        function cek_name($initial)
        { 
            $query=$this->db->query("SELECT * FROM ms_kustomer WHERE kode_kustomer='".$initial."'");

            return $query;
        }
        function get_data_kustomer($id)
        { 
            $query=$this->db->query("SELECT * FROM ms_kustomer WHERE id_kustomer=$id");

            return $query->result();
        }
        public function data_lokasi($lokasi)
        {
            if($lokasi==''){
                $query=$this->db->query('SELECT
                                        ms_lokasi.id_lokasi,  
                                        ms_lokasi.nama_lokasi 
                                        FROM
                                        ms_lokasi
                                        WHERE ms_lokasi.nama_lokasi NOT IN (select ms_kustomer_warehouse.wh_designated FROM ms_kustomer_warehouse)  
                                        ');
            }else{
                $query=$this->db->query('SELECT
                                        ms_lokasi.id_lokasi,  
                                        ms_lokasi.nama_lokasi 
                                        FROM
                                        ms_lokasi ORDER BY nama_lokasi="'.$lokasi.'" DESC  
                                        ');
            }

            return $query->result();
        }
        public function data_lokasi_edit($kode_kustomer)
        {
            $query=$this->db->query("SELECT wh_designated FROM ms_kustomer_warehouse WHERE kode_kustomer='".$kode_kustomer."'");
            return $query->result();
        }
        
        public function data_lokasi_edit2()
        {
            $query=$this->db->query("SELECT 
                                        ms_lokasi.nama_lokasi 
                                    FROM
                                        ms_lokasi WHERE ms_lokasi.nama_lokasi NOT IN (SELECT 
                                        ms_lokasi.nama_lokasi 
                                    FROM
                                        ms_lokasi
                                    INNER JOIN ms_kustomer_warehouse ON ms_kustomer_warehouse.wh_designated=ms_lokasi.nama_lokasi)");
            return $query->result();
        }
        public function warehouse_kustomer($kodekustomer)
        {            
            $query=$this->db->query("SELECT
                                        wh_designated   
                                    FROM
                                        ms_kustomer_warehouse WHERE kode_kustomer='".$kodekustomer."' 
                                        ");
            return $query->result();
        }
        public function save_customer($statt, $id_kustomer, $cust_name,$wh_designated,$email,$customer_code,$password, $keterangan, $alamat, $telepon, $pic, $no_hp, $start_date, $due_date)
        {
            if ($statt=='insert'){
                $query=$this->db->query("INSERT ms_kustomer SET nama_kustomer='".$cust_name."', kode_kustomer='".$customer_code."', email='".$email."', password='".md5($password)."', keterangan='".$keterangan."',
                                        alamat ='".$alamat."', no_telepon='".$telepon."', pic='".$pic."', no_hp='".$no_hp."', start_date='".date('Y-m-d',strtotime($start_date))."', due_date='".date('Y-m-d',strtotime($due_date))."',
                                        create_date='".date('Y-m-d H:i:s')."', create_user='".$this->session->user_code."'");
                $query2=$this->db->query("INSERT user SET user_code='".$customer_code."', password='".md5($password)."', email='".$email."', grup=5, aktif=1, create_date='".date('Y-m-d H:i:s')."' ");
                foreach($wh_designated as $w)
                {
                    $query3=$this->db->query("INSERT ms_kustomer_warehouse SET kode_kustomer='".$customer_code."', wh_designated='".$w."', create_user='".$this->session->user_code."', create_date='".date('Y-m-d H:i:s')."'");
                }
            }else{
                $query=$this->db->query("UPDATE ms_kustomer SET nama_kustomer='".$cust_name."', kode_kustomer='".$customer_code."',  email='".$email."', password='".md5($password)."', keterangan='".$keterangan."',
                                            alamat ='".$alamat."', no_telepon='".$telepon."', pic='".$pic."', no_hp='".$no_hp."', start_date='".date('Y-m-d',strtotime($start_date))."', due_date='".date('Y-m-d',strtotime($due_date))."',
                                            modify_date='".date('Y-m-d H:i:s')."', modify_user='".$this->session->user_code."' WHERE id_kustomer=$id_kustomer");
                $query2=$this->db->query("DELETE FROM ms_kustomer_warehouse WHERE kode_kustomer='".$customer_code."'");
                foreach($wh_designated as $w)
                {         
                    $query3=$this->db->query("INSERT ms_kustomer_warehouse SET kode_kustomer='".$customer_code."', wh_designated='".$w."', create_user='".$this->session->user_code."', create_date='".date('Y-m-d H:i:s')."'");
                }    
            }
            if($query){ 
			    return true;
            }
        }
        public function delete_customer($id)
        {
            $cek_kode=$this->db->query("SELECT kode_kustomer FROM ms_kustomer WHERE id_kustomer='".$id."'"); 
			$kodekustomer=$cek_kode->row()->kode_kustomer;
            $query=$this->db->query("DELETE FROM ms_kustomer WHERE id_kustomer='".$id."'");
            $query2=$this->db->query("DELETE FROM user WHERE user_code='".$kodekustomer."'");
            $query3=$this->db->query("DELETE FROM ms_kustomer_warehouse WHERE kode_kustomer='".$kodekustomer."'");
            if($query){
            	return true; 
            }else{
                return false;
            }
        } 
    }