<?php 
    class Create_transaction_m extends MX_Controller{
        function __construct(){
            parent::__construct();
            $this->db  = $this->load->database('default', TRUE);
            $this->db2 = $this->load->database('db2', TRUE); //hris 
            $this->db3 = $this->load->database('db3', TRUE); //fms 
            $this->db4 = $this->load->database('db4', TRUE); //pms 
        }
        
        public function getDataInvoice()
        {
            return $this->db->query("SELECT * FROM tr_invoice_penjualan");
        }
        public function getDataAkunPendapatan()
        {
            return $this->db->query("SELECT * FROM m_akun_pendapatan");
        }
        public function getDataAkunPiutang()
        {
            return $this->db->query("SELECT * FROM m_akun_piutang");
        }
        public function getDataSatuan()
        { 
            return $this->db3->query("SELECT * FROM xx_mstr_satuan");
        }
        public function getDataPajak()
        {
            return $this->db->query("SELECT * FROM m_pajak WHERE nama_pajak LIKE '%PPN%'");
        }
        public function getDataBank()
        {
            return $this->db->query("SELECT * FROM m_bank");
        }
        public function getDataBank2()
        {
            return $this->db->query("SELECT id,acc_no,description,acc_lev_1,acc_lev_2,acc_lev_3 FROM m_account WHERE acc_lev_2='1200'");
        }
        public function getDataAkunSetting()
        {
            return $this->db->query("SELECT
                                        m_account_setting.id, 
                                        m_account_setting.acc_no as id_akun, 
                                        m_account.acc_no, 
                                        m_account.description, 
                                        m_account.currency, 
                                        m_account_setting.menu, 
                                        m_account_setting.`status`
                                    FROM
                                        m_account_setting
                                    INNER JOIN
                                        m_account
                                    ON 
                                        m_account_setting.acc_no = m_account.id");
        }
        public function save_transaction($customer, $tgl_inv, $no_inv, $nomor, $no_kontrak, $no_po_spk, $remark, $bank, $uang_muka, $tgl_kirim_inv, $periode_kegiatan, $term_pembayaran, $status)
        {
            $date=date('Y-m-d H:i:s');
            $user=$this->session->userdata('payroll_id');
            $this->db->query("INSERT tr_invoice_penjualan SET 
                                            customer ='$customer',
                                            tgl_inv ='$tgl_inv',
                                            no_inv ='$no_inv',
                                            nomor ='$nomor',
                                            no_kontrak ='$no_kontrak',
                                            no_po_spk ='$no_po_spk',
                                            remark ='$remark',
                                            bank ='$bank',
                                            dp ='$uang_muka',
                                            tgl_kirim_inv ='$tgl_kirim_inv',
                                            periode_kegiatan ='$periode_kegiatan',
                                            term_pembayaran ='$term_pembayaran',
                                            statusnya ='$status',
                                            create_date='$date', 
                                            create_user='$user' ");
            if ($status!=0) {
                $this->db->query("INSERT tr_history SET create_date='$date', keterangan='Invoice dengan nomor <b>$no_inv</b> baru saja dibuat oleh <b>$user</b>'");
            }
        }
        public function save_transaction_detail($no_inv, $deskripsi, $department, $project, $id_akunPendapatan, $id_akunPiutang, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto)
        {
            $date=date('Y-m-d H:i:s');
            $user=$this->session->userdata('payroll_id');
            $query=$this->db->query("INSERT tr_invoice_penjualan_detail SET  
                                            no_inv ='$no_inv',
                                            deskripsi_pesanan ='$deskripsi',
                                            department ='$department',
                                            project ='$project',
                                            akun_pendapatan ='$id_akunPendapatan',
                                            akun_piutang ='$id_akunPiutang',
                                            jumlah ='$no_jumlah',
                                            satuan ='$satuan',
                                            harga ='$no_harga',
                                            total ='$no_total',
                                            pajak ='$id_pajak',
                                            netto ='$no_netto',
                                            create_date='$date', 
                                            create_user='$user' ");
            return $query;
        }
        public function getDataTransaction($id)
        {
            return $this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.id_tr,
                                        db_finance.tr_invoice_penjualan.nomor,
                                        db_finance.tr_invoice_penjualan.customer,
                                        db_finance.tr_invoice_penjualan.tgl_inv,
                                        db_finance.tr_invoice_penjualan.no_inv,
                                        db_finance.tr_invoice_penjualan.no_kontrak,
                                        db_finance.tr_invoice_penjualan.no_po_spk,
                                        db_finance.tr_invoice_penjualan.remark,
                                        db_finance.tr_invoice_penjualan.bank,
                                        db_finance.tr_invoice_penjualan.dp,
                                        db_finance.tr_invoice_penjualan.tgl_kirim_inv,
                                        db_finance.tr_invoice_penjualan.periode_kegiatan,
                                        db_finance.tr_invoice_penjualan.term_pembayaran,
                                        db_finance.tr_invoice_penjualan.statusnya
                                    FROM
                                        db_finance.tr_invoice_penjualan
                                        INNER JOIN db_finance.m_bank ON db_finance.tr_invoice_penjualan.bank = db_finance.m_bank.bank_account
                                        INNER JOIN ims.xx_mstr_kustomer ON db_finance.tr_invoice_penjualan.customer = ims.xx_mstr_kustomer.kode_kustomer
                                    WHERE
                                        db_finance.tr_invoice_penjualan.id_tr ='$id'")->result();
        }
        public function getDataInvoiceDetail($no_inv)
        {
            return $this->db->query("SELECT tr_invoice_penjualan_detail.*,
                                        ( SELECT m_account.description FROM m_account INNER JOIN m_project_akun ON m_account.acc_no = m_project_akun.kode_akun WHERE m_project_akun.id = tr_invoice_penjualan_detail.akun_pendapatan ) AS akun_pendapatannya,
                                        ( SELECT m_account.description FROM m_account INNER JOIN m_project_akun ON m_account.acc_no = m_project_akun.kode_akun WHERE m_project_akun.id = tr_invoice_penjualan_detail.akun_piutang ) AS akun_piutangnya,
                                        ( SELECT m_account.acc_no FROM m_account INNER JOIN m_project_akun ON m_account.acc_no = m_project_akun.kode_akun WHERE m_project_akun.id = tr_invoice_penjualan_detail.akun_pendapatan ) AS kode_akun_pendapatannya,
                                        ( SELECT m_account.acc_no FROM m_account INNER JOIN m_project_akun ON m_account.acc_no = m_project_akun.kode_akun WHERE m_project_akun.id = tr_invoice_penjualan_detail.akun_piutang ) AS kode_akun_piutangnya,
                                        m_pajak.id AS id_pajak,
                                        m_pajak.nama_pajak,
                                        m_pajak.`value`,
                                        m_pajak.kode_pajak 
                                    FROM 
                                        tr_invoice_penjualan_detail
                                    LEFT JOIN m_pajak ON m_pajak.id = tr_invoice_penjualan_detail.pajak
                                    WHERE no_inv='$no_inv'")->result();
        }
        public function getDataProject($project,$department)
        {
            return $this->db3->query("SELECT * FROM view_projectt WHERE dept_code='$department' ORDER BY project_code='$project' DESC ");
        }
        public function update_transaction($id_tr, $customer, $tgl_inv, $no_inv, $nomor, $no_kontrak, $no_po_spk, $remark, $bank, $dp,$tgl_kirim_inv, $periode_kegiatan, $term_pembayaran, $status)
        {
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
            $this->db->query("UPDATE tr_invoice_penjualan SET 
                                            customer ='$customer',
                                            tgl_inv ='$tgl_inv',
                                            no_inv ='$no_inv',
                                            nomor ='$nomor',
                                            no_kontrak ='$no_kontrak',
                                            no_po_spk ='$no_po_spk',
                                            remark ='$remark',
                                            bank ='$bank',
                                            dp='$dp',
                                            tgl_kirim_inv ='$tgl_kirim_inv',
                                            periode_kegiatan ='$periode_kegiatan',
                                            term_pembayaran ='$term_pembayaran',
                                            statusnya ='$status',
                                            modify_date='$date', 
                                            modify_user='$user' WHERE id_tr='$id_tr'");
        
            if ($status!=0) {
                $this->db->query("INSERT tr_history SET create_date='$date', keterangan='Invoice dengan nomor <b>$no_inv</b> baru saja diubah oleh <b>$user</b>'");
            }
        }
        public function update_transaction_detail($id_tr_detail, $no_inv, $deskripsi,  $department, $project, $akun_pendapatan, $akun_piutang, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto)
        {
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
            $cek=$this->db->query("SELECT id_tr_detail FROM tr_invoice_penjualan_detail WHERE id_tr_detail='$id_tr_detail'")->num_rows();
            // if($cek > 0 || $deskripsi!=''){
            if($cek > 0){
                $query=$this->db->query("UPDATE tr_invoice_penjualan_detail SET  
                                                no_inv ='$no_inv',
                                                deskripsi_pesanan ='$deskripsi',
                                                department='$department',
                                                project='$project',
                                                akun_pendapatan='$akun_pendapatan',
                                                akun_piutang='$akun_piutang',
                                                jumlah ='$no_jumlah',
                                                satuan ='$satuan',
                                                harga ='$no_harga',
                                                total ='$no_total',
                                                pajak ='$id_pajak',
                                                netto ='$no_netto',
                                                modify_date='$date', 
                                                modify_user='$user' WHERE id_tr_detail='$id_tr_detail'");
            }else{
                $query=$this->db->query("INSERT tr_invoice_penjualan_detail SET  
                                                no_inv ='$no_inv',
                                                deskripsi_pesanan ='$deskripsi',
                                                department='$department',
                                                project='$project',
                                                akun_pendapatan='$akun_pendapatan',
                                                akun_piutang='$akun_piutang',
                                                jumlah ='$no_jumlah',
                                                satuan ='$satuan',
                                                harga ='$no_harga',
                                                total ='$no_total',
                                                pajak ='$id_pajak',
                                                netto ='$no_netto',
                                                create_date='$date', 
                                                create_user='$user'");
            }

        
            return $query; 
        }
        public function getDataInvoiceRpt($no_inv)
        {
           $query=$this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.id_tr,
                                        db_finance.tr_invoice_penjualan.nomor,
                                        ims.xx_mstr_kustomer.kode_kustomer,
                                        ims.xx_mstr_kustomer.nama_kustomer,
                                        (SELECT db_finance.tr_invoice_penjualan_detail.project FROM db_finance.tr_invoice_penjualan_detail WHERE db_finance.tr_invoice_penjualan_detail.no_inv=db_finance.tr_invoice_penjualan.no_inv limit 0,1) AS project,
                                        db_finance.tr_invoice_penjualan.tgl_inv,
                                        db_finance.tr_invoice_penjualan.no_inv,
                                        ims.xx_mstr_kustomer.alamat,
                                        db_finance.tr_invoice_penjualan.no_kontrak,
                                        db_finance.tr_invoice_penjualan.no_po_spk,
                                        db_finance.tr_invoice_penjualan.remark,
                                        db_finance.tr_invoice_penjualan.bank,
                                        db_finance.m_bank.bank_name AS nama_bank,
                                        db_finance.tr_invoice_penjualan.dp,
                                        db_finance.tr_invoice_penjualan.tgl_kirim_inv,
                                        db_finance.tr_invoice_penjualan.periode_kegiatan,
                                        db_finance.tr_invoice_penjualan.term_pembayaran,
                                        db_finance.tr_invoice_penjualan.statusnya
                                    FROM
                                        db_finance.tr_invoice_penjualan
                                    INNER JOIN ims.xx_mstr_kustomer ON ims.xx_mstr_kustomer.kode_kustomer = db_finance.tr_invoice_penjualan.customer
                                    INNER JOIN db_finance.m_bank ON db_finance.m_bank.bank_account = db_finance.tr_invoice_penjualan.bank
                                    WHERE db_finance.tr_invoice_penjualan.no_inv='".$no_inv."'
                                        GROUP BY db_finance.tr_invoice_penjualan.no_inv");
           return $query->result();
        }
        public function getDataInvoiceRptDet($no_inv)
        {
            $query=$this->db->query("SELECT
                                        tr_invoice_penjualan_detail.no_inv,
                                        tr_invoice_penjualan_detail.deskripsi_pesanan,
                                        tr_invoice_penjualan_detail.jumlah,
                                        tr_invoice_penjualan_detail.satuan,
                                        tr_invoice_penjualan_detail.harga,
                                        tr_invoice_penjualan_detail.total
                                    FROM
                                        tr_invoice_penjualan_detail
                                    WHERE tr_invoice_penjualan_detail.no_inv='$no_inv'");
            return $query->result();
        }
        public function getDataInvoice_ar()
        {   
            $query=$this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.id_tr,
                                        db_finance.tr_invoice_penjualan.nomor,
                                        ims.xx_mstr_kustomer.kode_kustomer,
                                        ims.xx_mstr_kustomer.nama_kustomer,
                                        (
                                            SELECT
                                                db_finance.tr_invoice_penjualan_detail.project
                                            FROM
                                                db_finance.tr_invoice_penjualan_detail
                                            WHERE
                                                db_finance.tr_invoice_penjualan_detail.no_inv = db_finance.tr_invoice_penjualan.no_inv
                                            LIMIT 0,
                                            1
                                        ) AS project,
                                        db_finance.tr_invoice_penjualan.tgl_inv,
                                        db_finance.tr_invoice_penjualan.no_inv,
                                        ims.xx_mstr_kustomer.alamat,
                                        db_finance.tr_invoice_penjualan.no_kontrak,
                                        db_finance.tr_invoice_penjualan.no_po_spk,
                                        db_finance.tr_invoice_penjualan.remark,
                                        db_finance.tr_invoice_penjualan.bank,
                                        db_finance.m_bank.bank_name AS nama_bank,
                                        db_finance.tr_invoice_penjualan.dp,
                                        db_finance.tr_invoice_penjualan.tgl_kirim_inv,
                                        db_finance.tr_invoice_penjualan.periode_kegiatan,
                                        db_finance.tr_invoice_penjualan.term_pembayaran,
                                        sum(db_finance.tr_invoice_penjualan_detail.netto) AS netto,
                                        db_finance.tr_invoice_penjualan.statusnya
                                    FROM
                                        db_finance.tr_invoice_penjualan
                                    INNER JOIN ims.xx_mstr_kustomer ON ims.xx_mstr_kustomer.kode_kustomer = db_finance.tr_invoice_penjualan.customer
                                    INNER JOIN db_finance.m_bank ON db_finance.m_bank.bank_account = db_finance.tr_invoice_penjualan.bank
                                    INNER JOIN db_finance.tr_invoice_penjualan_detail ON db_finance.tr_invoice_penjualan_detail.no_inv = db_finance.tr_invoice_penjualan.no_inv
                                    WHERE
                                        db_finance.tr_invoice_penjualan.statusnya = '1'
                                    GROUP BY ims.xx_mstr_kustomer.kode_kustomer");
            return $query;
        }
        public function get_invoice($cust)
        {   
            $query=$this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.id_tr,
                                        db_finance.tr_invoice_penjualan.nomor,
                                        ims.xx_mstr_kustomer.kode_kustomer,
                                        ims.xx_mstr_kustomer.nama_kustomer,
                                        (
                                            SELECT
                                                db_finance.tr_invoice_penjualan_detail.project
                                            FROM
                                                db_finance.tr_invoice_penjualan_detail
                                            WHERE
                                                db_finance.tr_invoice_penjualan_detail.no_inv = db_finance.tr_invoice_penjualan.no_inv
                                            LIMIT 0,
                                            1
                                        ) AS project,
                                        db_finance.tr_invoice_penjualan.tgl_inv,
                                        db_finance.tr_invoice_penjualan.no_inv,
                                        ims.xx_mstr_kustomer.alamat,
                                        db_finance.tr_invoice_penjualan.no_kontrak,
                                        db_finance.tr_invoice_penjualan.no_po_spk,
                                        db_finance.tr_invoice_penjualan.remark,
                                        db_finance.tr_invoice_penjualan.bank,
                                        db_finance.m_bank.bank_name AS nama_bank,
                                        db_finance.tr_invoice_penjualan.dp,
                                        db_finance.tr_invoice_penjualan.tgl_kirim_inv,
                                        db_finance.tr_invoice_penjualan.periode_kegiatan,
                                        db_finance.tr_invoice_penjualan.term_pembayaran,
                                        sum(db_finance.tr_invoice_penjualan_detail.netto) AS netto,
                                        (sum(db_finance.tr_invoice_penjualan_detail.netto))-(db_finance.tr_invoice_penjualan.dp) AS amount,
                                        db_finance.tr_invoice_penjualan.statusnya
                                    FROM
                                        db_finance.tr_invoice_penjualan
                                    INNER JOIN ims.xx_mstr_kustomer ON ims.xx_mstr_kustomer.kode_kustomer = db_finance.tr_invoice_penjualan.customer
                                    INNER JOIN db_finance.m_bank ON db_finance.m_bank.bank_account = db_finance.tr_invoice_penjualan.bank
                                    INNER JOIN db_finance.tr_invoice_penjualan_detail ON db_finance.tr_invoice_penjualan_detail.no_inv = db_finance.tr_invoice_penjualan.no_inv
                                    WHERE
                                        db_finance.tr_invoice_penjualan.statusnya = '1' AND ims.xx_mstr_kustomer.kode_kustomer = '$cust'
                                    GROUP BY db_finance.tr_invoice_penjualan.no_inv
                                    ORDER BY db_finance.tr_invoice_penjualan.tgl_kirim_inv");
            return $query;
            
            $this->db->query("INSERT tr_closing_ar
                                SET id_tr='$id_tr',
                                    tgl_closing='$tgl_closing',
                                    customer='$cust',
                                    remark='$remark',
                                    statusnya='0',
                                    create_date='$date',
                                    create_user='$user'
                                    ");

            for ($i=0; $i < count($invoice_item) ; $i++){
                $x = explode('~',$invoice_item[$i]);
                $no_inv = $x[0];
                $amount = $x[1];
                // $this->db->query("UPDATE tr_invoice_penjualan SET remark='$remark' WHERE no_inv = '$no_inv[$i]'");
                $this->db->query("INSERT tr_closing_ar_detail
                                SET id_tr='$id_tr',
                                    no_inv='$no_inv',
                                    bank='$bank',
                                    amount='$amount',
                                    statusnya='0',
                                    create_date='$date',
                                    create_user='$user'
                                    ");
            }
        }
        public function getDataClosingHD($id_tr)
        {
            $query=$this->db->query("SELECT * FROM tr_closing_ar WHERE id_tr='$id_tr'");
            return $query;
        }
        public function getDataClosingDT($id_tr)
        {
            $query=$this->db->query("SELECT tr_closing_ar_detail.*, tr_invoice_penjualan.dp FROM tr_invoice_penjualan INNER JOIN tr_closing_ar_detail ON tr_invoice_penjualan.no_inv = tr_closing_ar_detail.no_inv  WHERE tr_closing_ar_detail.id_tr='$id_tr'");
            return $query;
        }
        public function close_invoice($no_inv,$akun_bank,$akun_pph,$akun_ppn,$akun_adminbank,$akun_bungafactoring,$saldoawal,$bank,$pph,$ppn,$adminbank,$bungafactoring,$saldoakhir)
        {
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
            if($saldoakhir==0){
                $this->db->query("UPDATE tr_invoice_penjualan SET statusnya='2' WHERE no_inv = '$no_inv'");
            }else{
                $this->db->query("UPDATE tr_invoice_penjualan SET statusnya='1' WHERE no_inv = '$no_inv'");
            }
            $this->db->query("UPDATE tr_closing_ar_detail SET akun_bank='$akun_bank', 
                                                              akun_pph='$akun_pph',
                                                              akun_ppn='$akun_ppn',
                                                              akun_admin_bank='$akun_adminbank',
                                                              akun_bunga_factoring='$akun_bungafactoring',
                                                              amount='$saldoawal',
                                                              bank='$bank',
                                                              pph='$pph',
                                                              ppn='$ppn',
                                                              admin_bank='$adminbank',
                                                              bunga_factoring='$bungafactoring',
                                                              saldoakhir='$saldoakhir',
                                                              statusnya='1' WHERE no_inv = '$no_inv'");
                                                              
            $this->db->query("INSERT tr_history SET create_date='".date('Y-m-d H:i:s')."', keterangan='Invoice dengan nomor <b>$no_inv</b> baru saja diclose oleh <b>$user</b>'");
        }
    }