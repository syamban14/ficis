<?php 
    class Reports_m extends MX_Controller{
        function __construct(){
            parent::__construct();
            $this->db  = $this->load->database('default', TRUE);
            $this->db2 = $this->load->database('db2', TRUE); //hris 
        }

        public function getDataReports($p_start,$p_end)
        {
            return $this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.no_inv, 
                                        db_finance.tr_invoice_penjualan.customer,
                                        ims.xx_mstr_kustomer.nama_kustomer, 
                                        db_finance.tr_invoice_penjualan.tgl_inv,
                                        db_finance.tr_invoice_penjualan.tgl_kirim_inv,
                                        db_finance.tr_invoice_penjualan.periode_kegiatan,
                                        db_finance.tr_invoice_penjualan.create_date
                                    FROM
                                        db_finance.tr_invoice_penjualan INNER JOIN ims.xx_mstr_kustomer
                                        ON db_finance.tr_invoice_penjualan.customer = ims.xx_mstr_kustomer.kode_kustomer
                                    WHERE
                                        db_finance.tr_invoice_penjualan.create_date BETWEEN LEFT('$p_start',10) AND LEFT('$p_end',10)");
        }
    }