<?php 
    class Home_m extends MX_Controller{
        function __construct(){
            parent::__construct();
            $this->db  = $this->load->database('default', TRUE);
            $this->db2 = $this->load->database('db2', TRUE); //hris 
        }
        public function getInvoicePenjualan()
        {
           $quwery=$this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.id_tr,
                                        db_finance.tr_invoice_penjualan.nomor,
                                        db_finance.tr_invoice_penjualan.no_inv,
                                        db_finance.tr_invoice_penjualan.customer,
                                        ims.xx_mstr_kustomer.nama_kustomer,
                                        db_finance.tr_invoice_penjualan.statusnya,
                                        db_finance.tr_invoice_penjualan.remark,
                                        db_finance.tr_invoice_penjualan.alasan,
                                        db_finance.tr_invoice_penjualan.modify_user
                                    FROM
                                        db_finance.tr_invoice_penjualan
                                    INNER JOIN ims.xx_mstr_kustomer ON ims.xx_mstr_kustomer.kode_kustomer = db_finance.tr_invoice_penjualan.customer
                                    WHERE db_finance.tr_invoice_penjualan.statusnya <> 'del'
                                    ORDER BY
                                    db_finance.tr_invoice_penjualan.id_tr DESC");
            return $quwery;
        }
        public function getHistory()
        {
            return $this->db->query("SELECT * FROM tr_history ORDER BY id DESC LIMIT 20");
        }
        public function get_detail_inv($noinv)
        {
            return $this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan_detail.deskripsi_pesanan,
                                        hris.m_dept.dept_name,
                                        ims.view_project.project,
                                        ( SELECT db_finance.m_account.description FROM db_finance.m_account WHERE db_finance.m_account.id = db_finance.tr_invoice_penjualan_detail.akun_pendapatan ) AS akun_pd,
                                        ( SELECT db_finance.m_account.description FROM db_finance.m_account WHERE db_finance.m_account.id = db_finance.tr_invoice_penjualan_detail.akun_piutang ) AS akun_pu,
                                        db_finance.tr_invoice_penjualan_detail.satuan,
                                        db_finance.tr_invoice_penjualan_detail.jumlah,
                                        db_finance.tr_invoice_penjualan_detail.harga,
                                        db_finance.tr_invoice_penjualan_detail.total,
                                        db_finance.m_pajak.nama_pajak,
                                        db_finance.tr_invoice_penjualan_detail.netto 
                                    FROM
                                        db_finance.tr_invoice_penjualan_detail
                                        INNER JOIN ims.view_project ON db_finance.tr_invoice_penjualan_detail.project = ims.view_project.project_code
                                        INNER JOIN hris.m_dept ON db_finance.tr_invoice_penjualan_detail.department = hris.m_dept.dept_code
                                        INNER JOIN db_finance.m_pajak ON db_finance.tr_invoice_penjualan_detail.pajak = db_finance.m_pajak.id
                                    WHERE db_finance.tr_invoice_penjualan_detail.no_inv = '$noinv'");
        }
        public function deleteInvPenjualan($nomor,$alasan)
        {
            return $this->db->query("UPDATE tr_invoice_penjualan SET statusnya='3', alasan='$alasan' WHERE nomor='$nomor'");
        } 
        public function postInvPenjualan($nomor)
        {
            return $this->db->query("UPDATE tr_invoice_penjualan SET statusnya='1' WHERE nomor='$nomor'");
        } 
        public function closeInvPenjualan($nomor)
        {
            return $this->db->query("UPDATE tr_invoice_penjualan SET statusnya='2' WHERE nomor='$nomor'");
        } 
    }