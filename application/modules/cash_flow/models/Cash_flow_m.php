<?php 
    class Cash_flow_m extends MX_Controller{
        function __construct(){
            parent::__construct();
            $this->db  = $this->load->database('default', TRUE);
            $this->db2 = $this->load->database('db2', TRUE); //hris
            $this->db3 = $this->load->database('db3', TRUE); //fms
        }
        public function getDataBank()
        {
            return $this->db->query("SELECT * FROM m_bank WHERE status='1'");
        }
        public function getDataAkun()
        {
            return $this->db->query("SELECT
                                        m_account.id,
                                        m_account.acc_no,
                                        m_account.description,
                                        m_account.currency,
                                        m_account.acc_lev_1 AS acclev1,
                                        (SELECT CONCAT(m_account_level.acc_no,' - ',m_account_level.description) FROM m_account_level WHERE m_account_level.acc_no=m_account.acc_lev_1) AS acc_lev_1,
                                        m_account.acc_lev_2 AS acclev2,
                                        (SELECT CONCAT(m_account_level.acc_no,' - ',m_account_level.description) FROM m_account_level WHERE m_account_level.acc_no=m_account.acc_lev_2) AS acc_lev_2,
                                        m_account.acc_lev_3 AS acclev3,
                                        (SELECT CONCAT(m_account_level.acc_no,' - ',m_account_level.description) FROM m_account_level WHERE m_account_level.acc_no=m_account.acc_lev_3) AS acc_lev_3,
                                        m_account.project,
                                        m_account.modul,
                                        m_account.status,
                                        m_account.create_date,
                                        m_account.create_user
                                    FROM m_account");
        }
        public function getDataProject()
        { 
            return $this->db3->query("SELECT * FROM view_project");
        }
    }