<?php 
    class Login_m extends MX_Controller{
        function __construct(){
            parent::__construct();
            $this->db  = $this->load->database('default', TRUE);
            $this->db_hris = $this->load->database('db2', TRUE);
        }
        public function islogin($payroll_id,$password){
            return $this->db->query("SELECT * FROM user
                                     WHERE payroll_id = '$payroll_id' AND password='$password'");
        }
        public function get_title($nik){
            return $this->db_hris->query("SELECT 
                                            m_karyawan.title AS kode_title, 
                                            m_title.title AS nama_title
                                          FROM m_karyawan INNER JOIN m_title ON m_karyawan.title=m_title.title_code
                                          WHERE m_karyawan.payroll_id = '$nik'");
        }
    }