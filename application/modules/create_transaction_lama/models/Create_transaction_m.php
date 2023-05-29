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
        public function getDataInvoiceDetail($no_inv)
        {
            return $this->db->query("SELECT tr_invoice_penjualan_detail.*, 
                                            m_pajak.id AS id_pajak,
                                            m_pajak.nama_pajak,
                                            m_pajak.`value`,
                                            m_pajak.kode_pajak 
                                    FROM 
                                        tr_invoice_penjualan_detail
                                    LEFT JOIN m_pajak ON m_pajak.id = tr_invoice_penjualan_detail.pajak
                                    WHERE no_inv='$no_inv'")->result();
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
            return $this->db->query("SELECT * FROM m_pajak");
        }
        public function getDataBank()
        {
            return $this->db->query("SELECT * FROM m_bank");
        }
        public function save_transaction($customer, $department, $project, $akun_pendapatan, $akun_piutang, $tgl_inv, $no_inv, $nomor, $no_kontrak, $no_po_spk, $remark, $tgl_kirim_inv, $periode_kegiatan, $term_pembayaran, $status)
        {
            $query=$this->db->query("INSERT tr_invoice_penjualan SET 
                                            customer ='".$customer."',
                                            department ='".$department."',
                                            project ='".$project."',
                                            akun_pendapatan ='".$akun_pendapatan."',
                                            akun_piutang ='".$akun_piutang."',
                                            tgl_inv ='".$tgl_inv."',
                                            no_inv ='".$no_inv."',
                                            nomor ='".$nomor."',
                                            no_kontrak ='".$no_kontrak."',
                                            no_po_spk ='".$no_po_spk."',
                                            remark ='".$remark."',
                                            tgl_kirim_inv ='".$tgl_kirim_inv."',
                                            periode_kegiatan ='".$periode_kegiatan."',
                                            term_pembayaran ='".$term_pembayaran."',
                                            statusnya ='".$status."',
                                            create_date='".date('Y-m-d H:i:s')."', 
                                            create_user='".$_SESSION['payroll_id']."' ");
        
            return $query; 
        }
        public function save_transaction_detail($no_inv, $deskripsi, $id_akunPendapatan, $id_akunPiutang, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto)
        {

            $query=$this->db->query("INSERT tr_invoice_penjualan_detail SET  
                                            no_inv ='".$no_inv."',
                                            deskripsi_pesanan ='".$deskripsi."',
                                            akun_pendapatan ='".$id_akunPendapatan."',
                                            akun_piutang ='".$id_akunPiutang."',
                                            jumlah ='".$no_jumlah."',
                                            satuan ='".$satuan."',
                                            harga ='".$no_harga."',
                                            total ='".$no_total."',
                                            pajak ='".$id_pajak."',
                                            netto ='".$no_netto."',
                                            create_date='".date('Y-m-d H:i:s')."', 
                                            create_user='".$_SESSION['payroll_id']."' ");
        
            return $query; 
        }
        public function getDataTransaction($id)
        {
            return $this->db->query("SELECT *,
                                        m_akun_piutang.nama_akun AS nama_akun_piutang,
                                        m_akun_pendapatan.nama_akun AS nama_akun_pendapatan
                                    FROM 
                                        tr_invoice_penjualan                                     
                                    LEFT JOIN m_akun_piutang ON m_akun_piutang.kode_akun = tr_invoice_penjualan.akun_piutang
                                    LEFT JOIN m_akun_pendapatan ON m_akun_pendapatan.kode_akun = tr_invoice_penjualan.akun_pendapatan
                                    WHERE tr_invoice_penjualan.id_tr='$id'")->result();
        }
        public function getDataProject($project,$department)
        {
            return $this->db3->query("SELECT * FROM view_project WHERE dept_code='$department' ORDER BY project_code='$project' DESC ");
        }
        public function update_transaction($id_tr, $customer, $department, $project, $akun_pendapatan, $akun_piutang, $tgl_inv, $no_inv, $nomor, $no_kontrak, $no_po_spk, $remark, $tgl_kirim_inv, $periode_kegiatan, $term_pembayaran, $status)
        {
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
            $query=$this->db->query("UPDATE tr_invoice_penjualan SET 
                                            customer ='$customer',
                                            department ='$department',
                                            project ='$project',
                                            akun_pendapatan ='$akun_pendapatan',
                                            akun_piutang ='$akun_piutang',
                                            tgl_inv ='$tgl_inv',
                                            no_inv ='$no_inv',
                                            nomor ='$nomor',
                                            no_kontrak ='$no_kontrak',
                                            no_po_spk ='$no_po_spk',
                                            remark ='$remark',
                                            tgl_kirim_inv ='$tgl_kirim_inv',
                                            periode_kegiatan ='$periode_kegiatan',
                                            term_pembayaran ='$term_pembayaran',
                                            statusnya ='$status',
                                            modify_date='$date', 
                                            modify_user='$user' WHERE id_tr='$id_tr'");
        
            return $query; 
        }
        public function update_transaction_detail($id_tr_detail, $no_inv, $deskripsi, $no_jumlah, $satuan, $no_harga, $no_total, $id_pajak, $no_netto)
        {
            $date = date('Y-m-d H:i:s');
            $user = $this->session->userdata('payroll_id');
            $query=$this->db->query("UPDATE tr_invoice_penjualan_detail SET  
                                            no_inv ='$no_inv',
                                            deskripsi_pesanan ='$deskripsi',
                                            jumlah ='$no_jumlah',
                                            satuan ='$satuan',
                                            harga ='$no_harga',
                                            total ='$no_total',
                                            pajak ='$id_pajak',
                                            netto ='$no_netto',
                                            modify_date='$date', 
                                            modify_user='$user' WHERE id_tr_detail='$id_tr_detail'");
        
            return $query; 
        }
    }