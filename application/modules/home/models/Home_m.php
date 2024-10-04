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
                                    INNER JOIN ims.xx_mstr_kustomer ON ims.xx_mstr_kustomer.inisial1 = db_finance.tr_invoice_penjualan.customer
                                    WHERE db_finance.tr_invoice_penjualan.statusnya <> 'del'
                                    ORDER BY
                                    db_finance.tr_invoice_penjualan.id_tr DESC");
            return $quwery;
        }
        public function getPurchaseInvoice(){
            $query=$this->db->query("SELECT
                                            db_finance.tr_purchase_invoice.id_ap, 
                                            db_finance.tr_purchase_invoice.nomor, 
                                            db_finance.tr_purchase_invoice.vendor, 
                                            test_bcspurchase.vendor.vendor AS vendor_name, 
                                            db_finance.tr_purchase_invoice.purchase_number, 
                                            db_finance.tr_purchase_invoice.po_no, 
                                            db_finance.tr_purchase_invoice.invoice_date, 
                                            db_finance.tr_purchase_invoice.tax_number, 
                                            db_finance.tr_purchase_invoice.tax_date, 
                                            db_finance.tr_purchase_invoice.department, 
                                            db_finance.tr_purchase_invoice.project, 
                                            db_finance.tr_purchase_invoice.dp as id_dp, 
                                            db_finance.purchase_advance.nilai as dp,
                                            db_finance.tr_purchase_invoice.modify_user, 
                                            db_finance.tr_purchase_invoice.modify_date, 
                                            db_finance.tr_purchase_invoice.statusnya
                                        FROM
                                            db_finance.tr_purchase_invoice
                                            INNER JOIN
                                            test_bcspurchase.vendor
                                            ON 
                                                db_finance.tr_purchase_invoice.vendor = test_bcspurchase.vendor.id_vendor
                                            LEFT JOIN
                                            db_finance.purchase_advance
                                            ON 
                                                db_finance.tr_purchase_invoice.dp = db_finance.purchase_advance.id
                                        ORDER BY
                                            db_finance.tr_purchase_invoice.id_ap DESC");
             return $query;
        }
        public function getHistory()
        {
            return $this->db->query("SELECT * FROM tr_history ORDER BY id DESC LIMIT 20");
        }
        public function get_detail_inv($noinv)
        {
            return $this->db->query("SELECT
                                        hris.m_dept.dept_name,
                                        ims.view_project.project,
                                        ( SELECT db_finance.m_account.description FROM db_finance.m_account WHERE db_finance.m_account.id = db_finance.tr_invoice_penjualan_detail.akun_pendapatan ) AS akun_pd,
                                        ( SELECT db_finance.m_account.description FROM db_finance.m_account WHERE db_finance.m_account.id = db_finance.tr_invoice_penjualan_detail.akun_piutang ) AS akun_pu,
                                        db_finance.tr_invoice_penjualan_detail.id_customer_dn,
                                        db_finance.tr_invoice_penjualan_detail.deskripsi_pesanan,
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
        public function get_detail_pur($Pnno){
            return $this->db->query("SELECT
                                        tr_purchase_invoice_detail.id_ap_detail,
                                        tr_purchase_invoice_detail.purchase_number,
                                        tr_purchase_invoice_detail.order_description,
                                        tr_purchase_invoice_detail.code_account,
                                        m_account.description AS account_name,
                                        tr_purchase_invoice_detail.received,
                                        tr_purchase_invoice_detail.unit,
                                        tr_purchase_invoice_detail.unit_price,
                                        tr_purchase_invoice_detail.discount,
                                        tr_purchase_invoice_detail.tax_one,
                                        tr_purchase_invoice_detail.tax_two,
                                        tr_purchase_invoice_detail.total 
                                    FROM
                                        tr_purchase_invoice_detail
                                        LEFT JOIN m_account ON tr_purchase_invoice_detail.code_account = m_account.id 
                                    WHERE
                                        tr_purchase_invoice_detail.purchase_number = '$Pnno'");
        }
    }