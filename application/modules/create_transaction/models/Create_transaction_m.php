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
        public function getDataIdLastInvoice()
        {
            return $this->db->query("SELECT count(id_tr) AS id_tr FROM tr_invoice_penjualan");
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
        public function getDataBank2($val)
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
                                        m_account_setting.acc_no = m_account.id
                                    WHERE m_account_setting.menu='$val' AND m_account.acc_lev_2='1200'");
        }
        public function getDataAkunSetting($val)
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
                                        m_account_setting.acc_no = m_account.id
                                    WHERE m_account_setting.menu='$val'");
        }
        public function getDataAkun($id_akun)
        {
            return $this->db->query("SELECT
                                        m_account.id, 
                                        m_account.acc_no, 
                                        m_account.description, 
                                        m_account.currency
                                    FROM
                                        m_account
                                   ");
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
        public function save_transaction_detail($no_inv, $id_customer_dn, $deskripsi, $department, $project, $id_akunPendapatan, $id_akunPiutang, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto)
        {
            $date=date('Y-m-d H:i:s');
            $user=$this->session->userdata('payroll_id');
            $query=$this->db->query("INSERT tr_invoice_penjualan_detail SET  
                                            no_inv ='$no_inv',
                                            id_customer_dn = '$id_customer_dn',
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
                                        dms.contract_header.no_of_contract_help,
                                        dms.contract_header.title_contract,
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
                                        INNER JOIN ims.xx_mstr_kustomer ON db_finance.tr_invoice_penjualan.customer = ims.xx_mstr_kustomer.inisial1
                                        INNER JOIN dms.contract_header ON db_finance.tr_invoice_penjualan.no_kontrak = dms.contract_header.id_contract
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
                if ($deskripsi!='') {
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
            }

        
            return $query; 
        }
        public function getDataInvoiceRpt($no_inv)
        {
           $query=$this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.id_tr,
                                        db_finance.tr_invoice_penjualan.nomor,
                                        ims.xx_mstr_kustomer.kode_kustomer,
                                        ims.xx_mstr_kustomer.inisial1,
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
                                        db_finance.tr_invoice_penjualan.statusnya,
                                        dms.contract_header.title_contract,
                                        dms.contract_header.no_of_contract_help 
                                    FROM
                                        db_finance.tr_invoice_penjualan
                                        INNER JOIN ims.xx_mstr_kustomer ON ims.xx_mstr_kustomer.inisial1 = db_finance.tr_invoice_penjualan.customer
                                        INNER JOIN db_finance.m_bank ON db_finance.m_bank.bank_account = db_finance.tr_invoice_penjualan.bank
                                        INNER JOIN dms.contract_header ON db_finance.tr_invoice_penjualan.no_kontrak = dms.contract_header.id_contract 
                                    WHERE db_finance.tr_invoice_penjualan.no_inv='$no_inv'
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
                                        tr_invoice_penjualan_detail.netto,
                                        tr_invoice_penjualan_detail.total,
                                        ( m_pajak.value / 100 ) AS value_pajak 
                                    FROM
                                        tr_invoice_penjualan_detail INNER JOIN m_pajak ON tr_invoice_penjualan_detail.pajak = m_pajak.id
                                    WHERE tr_invoice_penjualan_detail.no_inv='$no_inv'");
            return $query->result();
        }
        public function getDataInvoice_ar()
        {   
            $query=$this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.id_tr,
                                        db_finance.tr_invoice_penjualan.nomor,
                                        ims.xx_mstr_kustomer.kode_kustomer,
                                        ims.xx_mstr_kustomer.inisial1,
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
                                    INNER JOIN ims.xx_mstr_kustomer ON ims.xx_mstr_kustomer.inisial1 = db_finance.tr_invoice_penjualan.customer
                                    INNER JOIN db_finance.m_bank ON db_finance.m_bank.bank_account = db_finance.tr_invoice_penjualan.bank
                                    INNER JOIN db_finance.tr_invoice_penjualan_detail ON db_finance.tr_invoice_penjualan_detail.no_inv = db_finance.tr_invoice_penjualan.no_inv
                                    WHERE
                                        db_finance.tr_invoice_penjualan.statusnya = '1'
                                    GROUP BY ims.xx_mstr_kustomer.inisial1");
            return $query;
        }
        public function get_invoice($cust)
        {   
            $query=$this->db->query("SELECT
                                        db_finance.tr_invoice_penjualan.id_tr,
                                        db_finance.tr_invoice_penjualan.nomor,
                                        ims.xx_mstr_kustomer.kode_kustomer,
                                        ims.xx_mstr_kustomer.inisial1,
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
                                    INNER JOIN ims.xx_mstr_kustomer ON ims.xx_mstr_kustomer.inisial1 = db_finance.tr_invoice_penjualan.customer
                                    INNER JOIN db_finance.m_bank ON db_finance.m_bank.bank_account = db_finance.tr_invoice_penjualan.bank
                                    INNER JOIN db_finance.tr_invoice_penjualan_detail ON db_finance.tr_invoice_penjualan_detail.no_inv = db_finance.tr_invoice_penjualan.no_inv
                                    WHERE
                                        db_finance.tr_invoice_penjualan.statusnya = '1' AND ims.xx_mstr_kustomer.inisial1 = '$cust'
                                    GROUP BY db_finance.tr_invoice_penjualan.no_inv
                                    ORDER BY db_finance.tr_invoice_penjualan.tgl_kirim_inv");
            return $query;    
        }
        public function add_to_closing($invoice_item,$id_tr,$cust,$tgl_closing,$bank,$remark)
        {        
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
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
            $query=$this->db->query("SELECT
                                        tr_closing_ar_detail.*, 
                                        tr_invoice_penjualan.dp,
                                        tr_invoice_penjualan_detail.total
                                    FROM
                                        tr_invoice_penjualan
                                        INNER JOIN tr_closing_ar_detail ON tr_invoice_penjualan.no_inv = tr_closing_ar_detail.no_inv
                                        INNER JOIN tr_invoice_penjualan_detail ON tr_invoice_penjualan.no_inv = tr_invoice_penjualan_detail.no_inv
                                    WHERE tr_closing_ar_detail.id_tr='$id_tr'");
            return $query;
        }
        public function close_invoice($id_tr,$no_inv,$akun_bank,$akun_pph,$akun_ppn,$akun_adminbank,$akun_bungafactoring,$saldoawal,$bank,$pph,$ppn,$adminbank,$bungafactoring,$saldoakhir,$revisi)
        {
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
            if($saldoakhir==0){
                $this->db->query("UPDATE tr_invoice_penjualan SET statusnya='2' WHERE no_inv = '$no_inv'");
                $this->db->query("UPDATE tr_closing_ar SET statusnya='1' WHERE id_tr='$id_tr'");
            }else{
                $this->db->query("UPDATE tr_invoice_penjualan SET statusnya='1' WHERE no_inv = '$no_inv'");
                $this->db->query("UPDATE tr_closing_ar SET statusnya='0' WHERE id_tr='$id_tr'");
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
            if ($revisi=='revisi') {
                $this->db->query("INSERT tr_history SET create_date='$date', keterangan='Closing Invoice dengan nomor <b>$no_inv</b> baru saja direvisi oleh <b>$user</b>'");
            }else{
                $this->db->query("INSERT tr_history SET create_date='$date', keterangan='Invoice dengan nomor <b>$no_inv</b> baru saja diclose oleh <b>$user</b>'");
            }
        }
        public function getDataKontrak($customer){            
            $query=$this->db->query("SELECT
                                        dms.contract_header.id_contract, 
                                        dms.contract_header.id_customer, 
                                        ims.xx_mstr_kustomer.nid, 
                                        ims.xx_mstr_kustomer.kode_kustomer, 
                                        ims.xx_mstr_kustomer.nama_kustomer,
                                        ims.xx_mstr_kustomer.inisial1,
                                        dms.contract_header.no_of_contract_help, 
                                        dms.contract_header.title_contract, 
                                        dms.contract_header.sign_date, 
                                        dms.contract_header.pic, 
                                        dms.contract_header.`value`, 
                                        dms.contract_header.filing_status, 
                                        dms.contract_header.renewal, 
                                        dms.contract_header.scope, 
                                        dms.contract_header.progress, 
                                        dms.contract_header.remarks 
                                    FROM
                                        dms.contract_header
                                    INNER JOIN
                                        ims.xx_mstr_kustomer
                                    ON 
                                        dms.contract_header.id_customer = ims.xx_mstr_kustomer.nid
                                    WHERE ims.xx_mstr_kustomer.inisial1='$customer'
                                    ORDER BY dms.contract_header.id_contract DESC");
            return $query->result();
        }
        public function getDataHeaderDn($customer){   
           $query=$this->db3->query("SELECT
                                        trans_transaksi_dn_header_new.id,
                                        trans_transaksi_dn_header_new.no_proyek,
                                        trans_transaksi_dn_header_new.no_kontrak,
                                        trans_transaksi_dn_header_new.no_dokumen,
	                                    v_proyek.nama_proyek,
                                        trans_transaksi_dn_header_new.kode_kustomer,
                                        xx_mstr_kustomer.inisial1,
                                        trans_transaksi_dn_header_new.total,
                                        trans_transaksi_dn_header_new.created_date 
                                    FROM
                                        trans_transaksi_dn_header_new
                                    INNER JOIN xx_mstr_kustomer ON trans_transaksi_dn_header_new.kode_kustomer= xx_mstr_kustomer.kode_kustomer
	                                INNER JOIN v_proyek ON trans_transaksi_dn_header_new.no_dokumen=v_proyek.id_proyek
                                    WHERE xx_mstr_kustomer.inisial1='$customer'
                                    ORDER BY
                                        trans_transaksi_dn_header_new.created_date DESC LIMIT 5");
            return $query->result();
        }

        public function getDataClosingInvoice($start_date,$end_date)
        {
            return $this->db->query("SELECT
                                        db_finance.tr_closing_ar.id_tr,
                                        db_finance.tr_closing_ar_detail.no_inv,
                                        ims.xx_mstr_kustomer.nama_kustomer,
                                        db_finance.tr_closing_ar_detail.amount,
                                        db_finance.tr_closing_ar_detail.saldoakhir,
                                        db_finance.tr_closing_ar.tgl_closing,
                                        db_finance.tr_closing_ar.statusnya 
                                    FROM
                                        db_finance.tr_closing_ar
                                        INNER JOIN db_finance.tr_closing_ar_detail ON db_finance.tr_closing_ar.id_tr = db_finance.tr_closing_ar_detail.id_tr
                                        INNER JOIN ims.xx_mstr_kustomer ON db_finance.tr_closing_ar.customer = ims.xx_mstr_kustomer.inisial1 
                                    WHERE
                                        db_finance.tr_closing_ar.tgl_closing BETWEEN '$start_date' AND '$end_date' 
                                    GROUP BY
                                        db_finance.tr_closing_ar_detail.no_inv
                                    ORDER BY db_finance.tr_closing_ar.id_tr DESC");
        }
        
        public function getPo($vendor_id)
        {    
            $query=$this->db4->query("SELECT
                                            po.po_id,   
                                            po.po_no, 
                                            po.id_project,
                                            project.project_code,
                                            project.project,
                                            project.dept_code,
                                            hris.m_dept.dept_name,
                                            po.po_date
                                    FROM
                                            po
                                    INNER JOIN project ON project.id=po.id_project
                                    INNER JOIN hris.m_dept ON hris.m_dept.dept_code=project.dept_code
                                    WHERE po.id_vendor='".$vendor_id."' 
                                    AND MONTH(po.po_date)=MONTH(CURDATE()) AND YEAR(po.po_date)=YEAR(CURDATE()) 
                                    OR 
                                    po.id_vendor='".$vendor_id."' 
                                    AND (
                                        (YEAR(po.po_date) = YEAR(CURDATE()) AND MONTH(po.po_date) = MONTH(CURDATE()) - 1)
                                        OR
                                        (YEAR(po.po_date) = YEAR(CURDATE()) - 1 AND MONTH(po.po_date) = 12 AND MONTH(CURDATE()) = 1)
                                    )
                                    ORDER BY po_date DESC LIMIT 30");
            return $query->result();
        }
        public function getPodetail($no_po)
        {
            $query=$this->db4->query("SELECT
                                        po_item.id,
                                        po_item.po_no,
                                        po_item.id_pr,
                                        ROUND(po_item.qty) AS qty,
                                        po_item.price,
	                                    round(po_item.discount_amount,0) as discount_amount,
                                        po_item.subtotal,
                                        po.po_date,
                                        po.id_vendor ,
                                        pr_detail.material_id,
                                        pr_detail.qty_po,
                                        pr_detail.lpb_qty,
                                        m_description.description,
                                        m_description.unit,
	                                    lpb.lpb_date 
                                    FROM
                                        po_item
                                    INNER JOIN po ON po_item.id_header = po.po_id
                                    INNER JOIN pr_detail ON pr_detail.id = po_item.id_pr 
                                    INNER JOIN m_description ON m_description.id=pr_detail.id_material
                                    INNER JOIN lpb ON lpb.id_po=po_item.id_header
                                    WHERE
                                        po.po_id = '".$no_po."' 
                                        AND MONTH ( po.po_date )= MONTH (
                                        CURDATE()) 
                                        AND YEAR ( po.po_date )= YEAR (
                                        CURDATE()) 
                                        OR po.po_id = '".$no_po."' 
                                        AND (
                                            ( YEAR ( po.po_date ) = YEAR ( CURDATE()) AND MONTH ( po.po_date ) = MONTH ( CURDATE()) - 1 ) 
                                            OR (
                                                YEAR ( po.po_date ) = YEAR (
                                                CURDATE()) - 1 
                                                AND MONTH ( po.po_date ) = 12 
                                                AND MONTH (
                                                CURDATE()) = 1 
                                            ) 
                                        )");
            return $query->result(); 
        }
        public function getPodetailedit($purchase_number){
            $query=$this->db->query("SELECT
                                        tr_purchase_invoice_detail.id_ap_detail, 
                                        tr_purchase_invoice_detail.id_ap, 
                                        tr_purchase_invoice_detail.purchase_number, 
                                        tr_purchase_invoice_detail.po_no, 
                                        tr_purchase_invoice_detail.order_description, 
                                        tr_purchase_invoice_detail.code_account, 
                                        tr_purchase_invoice_detail.received, 
                                        tr_purchase_invoice_detail.unit, 
                                        tr_purchase_invoice_detail.unit_price, 
                                        tr_purchase_invoice_detail.discount, 
                                        tr_purchase_invoice_detail.tax_one, 
                                        tr_purchase_invoice_detail.tax_two, 
                                        tr_purchase_invoice_detail.total
                                    FROM
                                        tr_purchase_invoice_detail
                                    WHERE tr_purchase_invoice_detail.purchase_number='$purchase_number'");

            return $query->result();
        }
		public function getProcurementOff(){
			return $this->db2->query("SELECT
										m_karyawan.id,
										m_karyawan.payroll_id,
										m_karyawan.nama_karyawan,
										m_title.title,
										m_karyawan.dept_id,
										m_karyawan.div_id,
										m_karyawan.dir_id,
										m_karyawan.cost_sales_id,
										m_cost_sales.cost_sales 
									FROM
										m_karyawan
										INNER JOIN m_title ON m_karyawan.title = m_title.title_code
										INNER JOIN m_cost_sales ON m_karyawan.cost_sales_id = m_cost_sales.cost_sales_code 
									WHERE
										m_karyawan.dept_id = 'D_19' 
										AND m_karyawan.dir_id = 'DR_13' 
										AND m_karyawan.div_id = 'DV_36' 
										AND m_karyawan.aktif = 'Y' 
										AND m_karyawan.cost_sales_id = 'CC_23'");
		}

        public function save_transaction_ap($vendor, $no_inv, $no_po, $tgl_input, $tax_number, $tax_date, $department, $project, $dp, $term_pembayaran, $delivery_date, $purchasing_dept, $status){
            $user=$this->session->userdata('payroll_id');
            $this->db->query("INSERT tr_purchase_invoice SET 
                                vendor='$vendor',
                                purchase_number='$no_inv',
                                po_no='$no_po',
                                invoice_date='$tgl_input',
                                tax_number='$tax_number',
                                tax_date='$tax_date',
                                department='$department',
                                project='$project',
                                dp='$dp',
                                payment_terms='$term_pembayaran',
                                delivery_date='$delivery_date',
                                purchasing_dept='$purchasing_dept',
                                statusnya='$status',
                                create_date='".date('Y-m-d H:i:s')."',
                                create_user='".$user."'                                
                            ");
        }
        public function save_transaction_ap_detail($no_inv, $no_po, $description, $kode_akun, $received, $unit, $price, $diskon, $id_pajak, $nilai, $id_pajak_dua, $nilai_dua, $subtotal){
            $user=$this->session->userdata('payroll_id');
            // Validate required fields
            if (empty($description) || empty($kode_akun)) {
                // Handle the validation error, for example, you can return an error message or log it.
                return false;
            }else{
                $this->db->query("INSERT tr_purchase_invoice_detail SET 
                                        id_ap='0',
                                        purchase_number='$no_inv',
                                        po_no='$no_po',
                                        order_description='$description',
                                        code_account='$kode_akun',
                                        received='$received',
                                        unit='$unit',
                                        unit_price='$price',
                                        discount='$diskon',
                                        tax_one='$nilai',
                                        tax_one_id='$id_pajak',
                                        tax_two='$nilai_dua',
                                        tax_two_id='$id_pajak_dua',
                                        total='$subtotal',
                                        create_date='".date('Y-m-d H:i:s')."',
                                        create_user='".$user."'   
                ");
             }
        }
        public function getDataAkunPayable($id){
            $data=$this->db->query("SELECT
                                        db_finance.tr_purchase_invoice.id_ap,
                                        db_finance.tr_purchase_invoice.nomor,
                                        db_finance.tr_purchase_invoice.vendor AS vendor_id,
                                        test_bcspurchase.vendor.vendor AS vendor_name,
                                        db_finance.tr_purchase_invoice.purchase_number,
                                        test_bcspurchase.po.po_id,
                                        test_bcspurchase.po.po_no,
                                        test_bcspurchase.po.po_date,
                                        db_finance.tr_purchase_invoice.invoice_date,
                                        db_finance.tr_purchase_invoice.tax_number,
                                        db_finance.tr_purchase_invoice.tax_date,
                                        db_finance.tr_purchase_invoice.department,
                                        hris.m_dept.dept_code,
                                        hris.m_dept.dept_name,
                                        db_finance.tr_purchase_invoice.project AS project_id,
                                        test_bcspurchase.project.project_code,
                                        test_bcspurchase.project.project,
                                        test_bcspurchase.project.remarks,
                                        db_finance.tr_purchase_invoice.dp,
                                                                                db_finance.purchase_advance.nilai,																				
                                        db_finance.tr_purchase_invoice.payment_terms,
                                        db_finance.tr_purchase_invoice.delivery_date,
                                        db_finance.tr_purchase_invoice.purchasing_dept,
                                        db_finance.tr_purchase_invoice.statusnya 
                                    FROM
                                        db_finance.tr_purchase_invoice
                                        INNER JOIN test_bcspurchase.vendor ON db_finance.tr_purchase_invoice.vendor = test_bcspurchase.vendor.id_vendor
                                        INNER JOIN test_bcspurchase.po ON db_finance.tr_purchase_invoice.po_no = test_bcspurchase.po.po_id
                                        INNER JOIN hris.m_dept ON db_finance.tr_purchase_invoice.department = hris.m_dept.id
                                        INNER JOIN test_bcspurchase.project ON db_finance.tr_purchase_invoice.project = test_bcspurchase.project.id
                                                                                INNER JOIN db_finance.purchase_advance ON db_finance.purchase_advance.id=db_finance.tr_purchase_invoice.dp
                                    WHERE db_finance.tr_purchase_invoice.id_ap='$id'");
                                    
            return $data->result();    
        }
        public function update_transaction_ap($vendor_id, $purchase_no, $po_no, $tgl_input, $invoice_date, $tax_number, $tax_date, $department, $project, $dp, $term_pembayaran, $delivery_date, $purchasing_dept, $status) {
            $query=$this->db->query("UPDATE tr_purchase_invoice SET 
                                           invoice_date='".date('Y-m-d',strtotime($invoice_date))."', 
                                           tax_number='$tax_number',
                                           tax_date='$tax_date',
                                           dp='$dp',
                                           payment_terms='$term_pembayaran',
                                           delivery_date='".date('Y-m-d',strtotime($delivery_date))."',
                                           purchasing_dept='$purchasing_dept', 
                                           statusnya='$status' 
                                    WHERE vendor='$vendor_id' AND purchase_number='$purchase_no' AND po_no='$po_no'");
            
            return $query; 
        }
        
		public function update_transaction_ap_detail($description, $code_account, $received, $unit, $price, $discount_amount, $id_pajak, $nilai, $id_pajak_dua, $nilai_dua, $subtotal, $purchase_no, $po_no, $id_ap_detail){
            $query=$this->db->query("UPDATE tr_purchase_invoice_detail SET 
                                            order_description='$description',
                                            code_account='$code_account',
                                            received='$received',
                                            unit='$unit',
                                            unit_price='$price',
                                            discount='$discount_amount',
                                            tax_one='$nilai',
                                            tax_one_id='$id_pajak',
                                            tax_two='$nilai_dua',
                                            tax_two_id='$id_pajak_dua',
                                            total='$subtotal',
                                            modify_date='".date('Y-m-d H:i:s')."',
                                            modify_user='admin'
                                    WHERE purchase_number='$purchase_no' AND po_no='$po_no' AND id_ap_detail='".$id_ap_detail."'");
            return $query; 
		}
        public function save_purchase_advance($cash_account, $vendor, $nilai, $ref_no, $tanggal, $department, $project, $memo) {
            $query=$this->db->query("INSERT purchase_advance SET 
                                            cash_account='$cash_account',
                                            vendor='$vendor',
                                            nilai='$nilai',
                                            ref_no='$ref_no',
                                            tanggal='$tanggal',
                                            department='$department',
                                            project='$project',
                                            memo='$memo',
                                            create_date='".date('Y-m-d H:i:s')."',
                                            create_user='admin'");
                return $query;  
        }
        public function getDataPurchaseAdvance($id_vendor){ 
            if($id_vendor=='0'){
                $data=$this->db->query("SELECT
                                            db_finance.purchase_advance.id, 
                                            db_finance.purchase_advance.cash_account, 
                                            db_finance.m_account.acc_no, 
                                            db_finance.m_account.description AS account_desc,
                                            test_bcspurchase.vendor.id_vendor, 
                                            test_bcspurchase.vendor.alias, 
                                            test_bcspurchase.vendor.vendor, 
                                            db_finance.purchase_advance.nilai, 
                                            db_finance.purchase_advance.ref_no, 
                                            db_finance.purchase_advance.tanggal, 
                                            hris.m_dept.id AS id_dept, 
                                            hris.m_dept.dept_code, 
                                            hris.m_dept.dept_name, 
                                            ims.view_project.id AS id_project, 
                                            ims.view_project.project_code, 
                                            ims.view_project.project, 
                                            ims.view_project.Site, 
                                            db_finance.purchase_advance.memo, 
                                            db_finance.purchase_advance.`status`, 
                                            db_finance.purchase_advance.create_date, 
                                            db_finance.purchase_advance.create_user
                                        FROM
                                            db_finance.purchase_advance
                                            INNER JOIN
                                            test_bcspurchase.vendor
                                            ON 
                                                db_finance.purchase_advance.vendor = test_bcspurchase.vendor.id_vendor
                                            INNER JOIN
                                            hris.m_dept
                                            ON 
                                                db_finance.purchase_advance.department = hris.m_dept.id
                                            INNER JOIN
                                            ims.view_project
                                            ON 
                                                db_finance.purchase_advance.project = ims.view_project.id
                                            INNER JOIN
                                            db_finance.m_account
                                            ON 
                                                db_finance.purchase_advance.cash_account = db_finance.m_account.id
                                        ORDER BY
                                            db_finance.purchase_advance.id DESC");
            }else{
                $data=$this->db->query("SELECT
                                            db_finance.purchase_advance.id, 
                                            db_finance.purchase_advance.cash_account, 
                                            db_finance.m_account.acc_no, 
                                            db_finance.m_account.description AS account_desc,
                                            test_bcspurchase.vendor.id_vendor, 
                                            test_bcspurchase.vendor.alias, 
                                            test_bcspurchase.vendor.vendor, 
                                            db_finance.purchase_advance.nilai, 
                                            db_finance.purchase_advance.ref_no, 
                                            db_finance.purchase_advance.tanggal, 
                                            hris.m_dept.id AS id_dept, 
                                            hris.m_dept.dept_code, 
                                            hris.m_dept.dept_name, 
                                            ims.view_project.id AS id_project, 
                                            ims.view_project.project_code, 
                                            ims.view_project.project, 
                                            ims.view_project.Site, 
                                            db_finance.purchase_advance.memo, 
                                            db_finance.purchase_advance.`status`, 
                                            db_finance.purchase_advance.create_date, 
                                            db_finance.purchase_advance.create_user
                                        FROM
                                            db_finance.purchase_advance
                                            INNER JOIN
                                            test_bcspurchase.vendor
                                            ON 
                                                db_finance.purchase_advance.vendor = test_bcspurchase.vendor.id_vendor
                                            INNER JOIN
                                            hris.m_dept
                                            ON 
                                                db_finance.purchase_advance.department = hris.m_dept.id
                                            INNER JOIN
                                            ims.view_project
                                            ON 
                                                db_finance.purchase_advance.project = ims.view_project.id
                                            INNER JOIN
                                            db_finance.m_account
                                            ON 
                                                db_finance.purchase_advance.cash_account = db_finance.m_account.id
                                        WHERE test_bcspurchase.vendor.id_vendor='".$id_vendor."'
                                        ORDER BY
                                            db_finance.purchase_advance.id DESC");
                                            
            }           
                                    
            return $data->result(); 
        }
        public function delete_purchase_advance($id){            
            return $this->db->query("DELETE FROM purchase_advance WHERE id='$id'");
        }
        public function edit_purchase_advance($id_purchase_advance, $cash_account_edit, $vendor_edit,$department_edit, $project_edit, $nilai_edit, $ref_number_edit, $tanggal_edit, $memo_edit){
            $query=$this->db->query("UPDATE purchase_advance SET 
                                cash_account='$cash_account_edit',
                                vendor='$vendor_edit',
                                nilai='$nilai_edit',
                                ref_no='$ref_number_edit',
                                tanggal='$tanggal_edit',
                                department='$department_edit',
                                project='$project_edit',
                                memo='$memo_edit',
                                modify_date='".date('Y-m-d H:i:s')."',
                                modify_user='admin'
                                WHERE id='$id_purchase_advance'");
            return $query;
        }

        public function getVendorByIdCashAccount($id_cash_account)
        {    
            $query=$this->db4->query("SELECT
                                        test_bcspurchase.vendor.id_vendor,
                                        test_bcspurchase.vendor.alias,
                                        test_bcspurchase.vendor.vendor,
                                        db_finance.purchase_advance.cash_account 
                                    FROM
                                        test_bcspurchase.vendor
                                        INNER JOIN db_finance.purchase_advance ON test_bcspurchase.vendor.id_vendor = db_finance.purchase_advance.vendor 
                                    WHERE
                                        db_finance.purchase_advance.cash_account = '$id_cash_account'");
            return $query->result();
        }

        public function getDataPurchaseInvoice($id_vendor)
        {    
            $query=$this->db->query("SELECT
                                        tr_purchase_invoice.purchase_number,
                                        tr_purchase_invoice.invoice_date,
                                        SUM(tr_purchase_invoice_detail.total) AS total
                                    FROM
                                        tr_purchase_invoice
                                        INNER JOIN tr_purchase_invoice_detail ON tr_purchase_invoice.purchase_number = tr_purchase_invoice_detail.purchase_number 
                                        AND tr_purchase_invoice.purchase_number = tr_purchase_invoice_detail.purchase_number
                                    WHERE
                                        tr_purchase_invoice.vendor = '$id_vendor' AND tr_purchase_invoice.statusnya = '1'
                                    GROUP BY
                                        tr_purchase_invoice.purchase_number");
            return $query->result();
        }

        public function close_purchase_invoice($curr_id,$code_account,$received_by_vendor,$department,$project,$tgl_pembayaran,$status,$total_value)
        {
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
            return $this->db->query("INSERT tr_closing_ap SET
                                     id = '$curr_id',
                                     code_account = '$code_account',
                                     vendor = '$received_by_vendor',
                                     department = '$department',
                                     project = '$project',
                                     tgl_pembayaran = '$tgl_pembayaran',
                                     total_value = '$total_value',
                                     status = '$status',
                                     create_user = '$user',
                                     create_date = '$date'");
        }

        public function close_purchase_invoice_detail($curr_id,$purchase_number,$saldo,$jumlah_bayar,$statusnya)
        {
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
            $this->db->query("UPDATE tr_purchase_invoice SET
                             statusnya = '2',
                             modify_user = '$user',
                             modify_date = '$date'
                             WHERE purchase_number='$purchase_number'");
            return $this->db->query("INSERT tr_closing_ap_detail SET
                                     id_header = '$curr_id',
                                     purchase_number = '$purchase_number',
                                     saldo = '$saldo',
                                     jumlah_bayar = '$jumlah_bayar',
                                     status = '$statusnya',
                                     create_user = '$user',
                                     create_date = '$date'");
        }
    }