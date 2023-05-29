<?php 
    class Master_data_m extends MX_Controller{
        function __construct(){
            parent::__construct();
            $this->db  = $this->load->database('default', TRUE);
            $this->db2 = $this->load->database('db2', TRUE); //hris 
            $this->db3 = $this->load->database('db3', TRUE); //fms 
            $this->db4 = $this->load->database('db4', TRUE); //pms 
        }
        public function getDataRegion()
        {
            return $this->db->query("SELECT * FROM m_region");
        }
        public function add_region($kode,$nama)
        {
            return $this->db->query("INSERT m_region SET kode_region='$kode', nama_region='$nama'");
        }
        public function edit_region($id,$kode,$nama,$status)
        {
            $statusnya = '';
            if ($status=='on') {
                $statusnya = 'aktif';
            }else{
                $statusnya = 'nonaktif';
            }
            return $this->db->query("UPDATE m_region SET kode_region='$kode', nama_region='$nama', status='$statusnya' WHERE id='$id'");
        }
        public function delete_region($id)
        {
            return $this->db->query("DELETE FROM m_region WHERE id='$id'");
        }
        /*----------------------------------------------------------------------------------------------------*/
        public function getDataPajak()
        {
            return $this->db->query("SELECT * FROM m_pajak");
        }
        public function add_pajak($kode,$nama,$nilai)
        {
            return $this->db->query("INSERT m_pajak SET kode_pajak='$kode', nama_pajak='$nama', value='$nilai'");
        }
        public function edit_pajak($id,$kode,$nama,$nilai,$status)
        {
            $statusnya = '';
            if ($status=='on') {
                $statusnya = 'aktif';
            }else{
                $statusnya = 'nonaktif';
            }
            return $this->db->query("UPDATE m_pajak SET kode_pajak='$kode', nama_pajak='$nama', value='$nilai', status='$statusnya' WHERE id='$id'");
        }
        public function delete_pajak($id)
        {
            return $this->db->query("DELETE FROM m_pajak WHERE id='$id'");
        }
        /*----------------------------------------------------------------------------------------------------*/
        public function getDataAkunPiutang($id)
        { 
            if($id=='0'){
                return $this->db->query("SELECT
                                            db_finance.m_akun_piutang.id,
                                            db_finance.m_akun_piutang.id_project,
                                            db_finance.m_akun_piutang.kode_akun,
                                            db_finance.m_akun_piutang.nama_akun,
                                            db_finance.m_akun_piutang.`status`,
                                            db_finance.m_akun_piutang.create_date,
                                            db_finance.m_akun_piutang.create_user,
                                            db_finance.m_akun_piutang.modify_date,
                                            db_finance.m_akun_piutang.modify_user,
                                            test_bcspurchase.project.project
                                        FROM
                                            db_finance.m_akun_piutang
                                        LEFT JOIN test_bcspurchase.project ON test_bcspurchase.project.project_code = db_finance.m_akun_piutang.id_project
                                        ");
            }else{

                return $this->db->query("SELECT
                                            db_finance.m_akun_piutang.id,
                                            db_finance.m_akun_piutang.id_project,
                                            db_finance.m_akun_piutang.kode_akun,
                                            db_finance.m_akun_piutang.nama_akun,
                                            db_finance.m_akun_piutang.`status`,
                                            db_finance.m_akun_piutang.create_date,
                                            db_finance.m_akun_piutang.create_user,
                                            db_finance.m_akun_piutang.modify_date,
                                            db_finance.m_akun_piutang.modify_user,
                                            test_bcspurchase.project.project
                                        FROM
                                            db_finance.m_akun_piutang
                                        LEFT JOIN test_bcspurchase.project ON test_bcspurchase.project.project_code = db_finance.m_akun_piutang.id_project
                                        WHERE db_finance.m_akun_piutang.id_project='$id'
                                        ")->result();
            }
        }
        public function add_akun_piutang($kode,$nama,$project)
        {
            return $this->db->query("INSERT m_akun_piutang SET kode_akun='$kode', nama_akun='$nama', id_project='$project'");
        }
        public function edit_akun_piutang($id,$kode,$nama,$project,$status)
        {
            $statusnya = '';
            if ($status=='on') {
                $statusnya = 'aktif';
            }else{
                $statusnya = 'nonaktif';
            }
            return $this->db->query("UPDATE m_akun_piutang SET kode_akun='$kode', nama_akun='$nama', id_project='$project', status='$statusnya' WHERE id='$id'");
        }
        public function delete_akun_piutang($id)
        {
            return $this->db->query("DELETE FROM m_akun_piutang WHERE id='$id'");
        }
        /*----------------------------------------------------------------------------------------------------*/
        public function getDataAkunPendapatan($id)
        { 
            if($id=='0'){
                return $this->db->query("SELECT
                                            db_finance.m_akun_pendapatan.id,
                                            db_finance.m_akun_pendapatan.id_project,
                                            db_finance.m_akun_pendapatan.kode_akun,
                                            db_finance.m_akun_pendapatan.nama_akun,
                                            db_finance.m_akun_pendapatan.`status`,
                                            db_finance.m_akun_pendapatan.create_date,
                                            db_finance.m_akun_pendapatan.create_user,
                                            db_finance.m_akun_pendapatan.modify_date,
                                            db_finance.m_akun_pendapatan.modify_user,
                                            test_bcspurchase.project.project
                                        FROM
                                            db_finance.m_akun_pendapatan
                                        LEFT JOIN test_bcspurchase.project ON test_bcspurchase.project.project_code = db_finance.m_akun_pendapatan.id_project
                                        ");
            }else{
                return $this->db->query("SELECT
                                            db_finance.m_akun_pendapatan.id,
                                            db_finance.m_akun_pendapatan.id_project,
                                            db_finance.m_akun_pendapatan.kode_akun,
                                            db_finance.m_akun_pendapatan.nama_akun,
                                            db_finance.m_akun_pendapatan.`status`,
                                            db_finance.m_akun_pendapatan.create_date,
                                            db_finance.m_akun_pendapatan.create_user,
                                            db_finance.m_akun_pendapatan.modify_date,
                                            db_finance.m_akun_pendapatan.modify_user,
                                            test_bcspurchase.project.project
                                        FROM
                                            db_finance.m_akun_pendapatan
                                        LEFT JOIN test_bcspurchase.project ON test_bcspurchase.project.project_code = db_finance.m_akun_pendapatan.id_project
                                        WHERE db_finance.m_akun_pendapatan.id_project='$id'
                                        ")->result();
            }
        }
        public function add_akun_pendapatan($kode,$nama,$project)
        {
            return $this->db->query("INSERT m_akun_pendapatan SET kode_akun='$kode', nama_akun='$nama', id_project='$project'");
        }
        public function edit_akun_pendapatan($id,$kode,$nama,$project,$status)
        {
            $statusnya = '';
            if ($status=='on') {
                $statusnya = 'aktif';
            }else{
                $statusnya = 'nonaktif';
            }
            return $this->db->query("UPDATE m_akun_pendapatan SET kode_akun='$kode', nama_akun='$nama', id_project='$project', status='$statusnya' WHERE id='$id'");
        }
        public function delete_akun_pendapatan($id)
        {
            return $this->db->query("DELETE FROM m_akun_pendapatan WHERE id='$id'");
        }
        public function add_akun_setting($account_id,$menu)
        {
            return $this->db->query("INSERT m_account_setting SET acc_no='$account_id', menu='$menu', status=0, create_date='".date('Y-m-d H:i:s')."'");
        }
        /*----------------------------------------------------------------------------------------------------*/ 
        public function getDataProject($id)
        { 
            if($id=='0'){
                return $this->db3->query("SELECT * FROM view_project");
            }else{
                return $this->db3->query("SELECT * FROM view_project WHERE dept_code='$id'")->result();
            }
        } 
        public function getDataProjectAkun($id)
        { 
            if($id=='0'){
                return $this->db->query("SELECT
                                            m_project_akun.id,
                                            m_project_akun.kode_project,
                                            ims.view_project.project,
                                            m_account.acc_no,
                                            m_account.description,
                                            m_project_akun.`status`,
                                            m_project_akun.create_date,
                                            m_project_akun.create_user
                                        FROM
                                            m_project_akun
                                        INNER JOIN m_account ON m_account.acc_no = m_project_akun.kode_akun
                                        INNER JOIN ims.view_project ON ims.view_project.project_code=m_project_akun.kode_project
                                        WHERE m_project_akun.status='aktif'");
            }else{
                return $this->db->query("SELECT
                                            m_project_akun.id,
                                                m_project_akun.kode_project,
                                                ims.view_project.project,
                                                m_account.acc_no,
                                                m_account.description,
                                                m_project_akun.`status`,
                                                m_project_akun.create_date,
                                                m_project_akun.create_user
                                            FROM
                                                 m_project_akun
                                            INNER JOIN m_account ON m_account.acc_no = m_project_akun.kode_akun
                                            INNER JOIN ims.view_project ON ims.view_project.project_code=m_project_akun.kode_project
                                            WHERE m_project_akun.status='aktif' AND m_project_akun.kode_project='$id'")->result();
            }
        } 
        public function add_project($department, $project_code,$project_name,$site_alias,$remark,$site,$contact_person,$address,$phone)
        {
            return $this->db4->query("INSERT project SET dept_code='$department', 
                                                        project_code='$project_code', 
                                                        project='$project_name',
                                                        project_name='$project_name',
                                                        site_alias='$site_alias',
                                                        remarks='$remark',
                                                        site='$site',
                                                        cp_name='$contact_person',
                                                        address='$address',
                                                        phone='$phone',
                                                        created_date='".date('Y-m-d H:i:s')."',
                                                        created_by='admin' ");
        } 

        public function add_project_akun($project_code, $akun)
        {
            return $this->db->query("INSERT m_project_akun SET kode_project='$project_code', 
                                                               kode_akun='$akun', 
                                                               status='aktif',
                                                               create_date='".date('Y-m-d H:i:s')."',
                                                               create_user='admin' ");
        }

        public function edit_project($id,$department, $project_code,$project_name,$site_alias,$remark,$site,$contact_person,$address,$phone)
        {
            return $this->db4->query("UPDATE project SET dept_code='$department', 
                                                        project='$project_name',
                                                        project_name='$project_name',
                                                        site_alias='$site_alias',
                                                        remarks='$remark',
                                                        site='$site',
                                                        cp_name='$contact_person',
                                                        address='$address',
                                                        phone='$phone',
                                                        modified_date='".date('Y-m-d H:i:s')."'
                                    WHERE id='$id'");
        } 

        public function delete_project($id)
        {
            return $this->db4->query("UPDATE project SET project.status='Not Active',
                                                        project.modified_date='".date('Y-m-d H:i:s')."',
                                                        project.modified_by='finance'  
                                    WHERE id='$id'");
        } 
        public function delete_project_akun($id)
        {
            return $this->db->query("UPDATE m_project_akun SET m_project_akun.status='nonaktif',
                                                        m_project_akun.modify_date='".date('Y-m-d H:i:s')."',
                                                        m_project_akun.modify_user='admin'  
                                    WHERE m_project_akun.id='$id'");
        } 
        /*----------------------------------------------------------------------------------------------------*/
        public function getDataCustomer()
        { 
            return $this->db3->query("SELECT * FROM xx_mstr_kustomer WHERE status=0");
        } 
        public function getDataCustomerVendor()
        { 
            return $this->db4->query("SELECT * FROM vendor");
        }
        public function add_customer($kode_kustomer, $nama_kustomer, $alamat, $contact_person, $jabatan, $tlp,$inisial,$phone,$negara,$category)
        {
            if($category=='Customer'){
                return $this->db3->query("INSERT xx_mstr_kustomer SET kode_kustomer='$kode_kustomer', 
                                                                        nama_kustomer='$nama_kustomer',
                                                                        alamat='$alamat',
                                                                        contact_person='$contact_person',
                                                                        jabatan='$jabatan',
                                                                        tlp='$tlp',
                                                                        inisial='$inisial',
                                                                        inisial1='$inisial',
                                                                        create_date='".date('Y-m-d H:i:s')."',
                                                                        create_user='admin' ");
            }else{
                return $this->db4->query("INSERT vendor SET vendor_id='$kode_kustomer', 
                                                                        vendor='$nama_kustomer',
                                                                        address1='$alamat',
                                                                        cp='$contact_person',
                                                                        phone='$phone',
                                                                        alias='$inisial',
                                                                        country='$negara',
                                                                        active='Y',
                                                                        last_update='".date('Y-m-d')."' ");
            }
        }
        public function edit_customer($id, $kode, $nama, $alamat, $contact_person, $tlp, $kategori, $status)
        {
            if($kategori=='customer'){
                return $this->db3->query("UPDATE xx_mstr_kustomer SET kode_kustomer='$kode', 
                                                    nama_kustomer='$nama',
                                                    alamat='$alamat',
                                                    contact_person='$contact_person',
                                                    tlp='$tlp',
                                                    modify_date='".date('Y-m-d H:i:s')."',
                                                    modify_user='finance'
                            WHERE nid='".$id."'");
            }else{
                return $this->db4->query("UPDATE vendor SET vendor_id='$kode', 
                                                vendor='$nama',
                                                address1='$alamat',
                                                cp='$contact_person',
                                                phone='$tlp',
                                                last_update='".date('Y-m-d')."'
                                        WHERE id_vendor='".$id."'");
            }
        }
        public function delete_customer($id, $kategori)
        {
            if($kategori=='customer'){
                return $this->db3->query("UPDATE xx_mstr_kustomer SET xx_mstr_kustomer.status='1',
                                                            xx_mstr_kustomer.modify_date='".date('Y-m-d H:i:s')."',
                                                            xx_mstr_kustomer.modify_user='admin'  
                                        WHERE nid='$id'");
            }else{
                return $this->db4->query("UPDATE vendor SET active='Y',
                                                            last_update='".date('Y-m-d')."' 
                                        WHERE id_vendor='$id'");
            }
        } 
        /*----------------------------------------------------------------------------------------------------*/
        public function getDataSatuan()
        { 
            return $this->db3->query("SELECT * FROM xx_mstr_satuan WHERE status='0'");
        } 
        public function add_satuan($satuan)
        {
            return $this->db3->query("INSERT xx_mstr_satuan SET satuan='$satuan'");
        }
        public function edit_satuan($id, $satuan)
        {
            return $this->db3->query("UPDATE xx_mstr_satuan SET satuan='$satuan' WHERE id='$id'");
        }
        public function delete_satuan($id)
        {
            return $this->db3->query("UPDATE xx_mstr_satuan SET status='1' WHERE id='$id'");
        } 
        /*----------------------------------------------------------------------------------------------------*/
        
        public function getDataDepartment()
        {
            return $this->db->query("SELECT * FROM m_dept ");
            // return $this->db2->query("SELECT * FROM m_dept WHERE active='Y'");
        } 
        public function getDataDepartmentHris()
        { 
            return $this->db2->query("SELECT * FROM m_dept WHERE app='finance_system' AND active<>'X'");
        }
        public function getDataDepartment_2($pc)
        {
            return $this->db->query("SELECT * FROM v_project_department WHERE project_code='$pc'")->result();         
        }        
        public function add_department($kode, $nama, $status)
        {
            return $this->db2->query("INSERT m_dept SET dept_code='$kode', 
                                                        dept_name='$nama',
                                                        active='$status',
                                                        app='finance_system',
                                                        create_date='".date('Y-m-d H:i:s')."',
                                                        create_user='finance'");
        } 
        public function edit_department($id, $kode, $nama, $status)
        {
            $statusnya = '';
            if ($status=='on') {
                $statusnya = 'Y';
            }else{
                $statusnya = 'N';
            }
            return $this->db2->query("UPDATE m_dept SET dept_code='$kode', 
                                                        dept_name='$nama',
                                                        active='$statusnya',
                                                        app='finance_system',
                                                        modify_date='".date('Y-m-d H:i:s')."',
                                                        modify_user='admin' 
                                    WHERE id='$id'");
        }
        public function delete_department($id)
        {
            return $this->db2->query("UPDATE m_dept SET active='X',
                                                        modify_date='".date('Y-m-d H:i:s')."',
                                                        modify_user='admin'  
                                    WHERE id='$id'");
        }
        /*----------------------------------------------------------------------------------------------------*/
        public function getDataBank()
        {
            return $this->db->query("SELECT * FROM m_bank ");
        }
        public function add_bank($bank_name, $bank_account)
        {
            return $this->db->query("INSERT m_bank SET bank_name='$bank_name', bank_account='$bank_account'");
        }
        public function edit_bank($id, $bank_name, $bank_account){
            return $this->db->query("UPDATE m_bank SET bank_name='$bank_name', bank_account='$bank_account' WHERE id='$id'");
        }
        public function delete_bank($id){          
            return $this->db->query("DELETE FROM m_bank WHERE id='$id'");
        }
        /*----------------------------------------------------------------------------------------------------*/
        public function getDataAkun($id)
        { 
            if($id=='0'){
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
                                            m_account.`status`,
                                            m_account.create_date,
                                            m_account.create_user
                                            FROM
                                            m_account");
            }else{
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
                                            m_account.`status`,
                                            m_account.create_date,
                                            m_account.create_user
                                        FROM
                                            m_account
                                        WHERE m_account.id='$id'
                                        ")->result();
            }
        }
        public function getDataAkun1(){
            return $this->db->query("SELECT
                                        m_account_level.id,
                                        m_account_level.acc_no,
                                        m_account_level.description
                                        FROM
                                        m_account_level
                                        WHERE
                                        m_account_level.`level` = 1
                                        ")->result(); 
        }
        public function getDataAkun2(){
            return $this->db->query("SELECT
                                        m_account_level.id,
                                        m_account_level.acc_no,
                                        m_account_level.description
                                        FROM
                                        m_account_level
                                        WHERE
                                        m_account_level.`level` = 2
                                        ")->result(); 
        }
        public function getDataAkun3(){
            return $this->db->query("SELECT
                                        m_account_level.id,
                                        m_account_level.acc_no,
                                        m_account_level.description
                                        FROM
                                        m_account_level
                                        WHERE
                                        m_account_level.`level` = 3
                                        ")->result(); 
        }
        public function getDataAkunSetting()
        {   
            return $this->db->query("SELECT
                                        m_account_setting.id, 
                                        m_account.id AS id_akun, 
                                        m_account.acc_no, 
                                        m_account.description, 
                                        m_account_setting.menu,
                                        CASE WHEN m_account_setting.menu='AR' THEN 'Account Receivable'
                                            WHEN m_account_setting.menu='AP' THEN 'Account Payable'
                                            WHEN m_account_setting.menu='GA' THEN 'General Account'
                                            ELSE 'Cash Advance'
                                        END AS menuname
                                    FROM
                                        m_account_setting
                                        INNER JOIN
                                        m_account
                                        ON 
                                            m_account_setting.acc_no = m_account.id");
        } 
        
        public function add_akun($acc_no,$description,$currency,$acc_lev_1,$acc_lev_2,$acc_lev_3)
        {
            return $this->db->query("INSERT m_account SET acc_no='$acc_no', 
                                                            description='$description', 
                                                            currency='$currency',
                                                            acc_lev_1='$acc_lev_1',
                                                            acc_lev_2='$acc_lev_2',
                                                            acc_lev_3='$acc_lev_3',
                                                            create_date='".date('Y-m-d H:i:s')."', 
                                                            create_user='Admin'");
        }        
        public function edit_akun($id, $acc_no,$description,$currency,$acc_lev_1,$acc_lev_2,$acc_lev_3)
        {
            return $this->db->query("UPDATE m_account SET acc_no='$acc_no', 
                                                            description='$description', 
                                                            currency='$currency',
                                                            acc_lev_1='$acc_lev_1',
                                                            acc_lev_2='$acc_lev_2',
                                                            acc_lev_3='$acc_lev_3',
                                                            modify_date='".date('Y-m-d H:i:s')."', 
                                                            modify_user='Admin'
                                    WHERE id='$id'");
        }   
        public function edit_akun_setting($id, $acc_no, $menu)
        {
            return $this->db->query("UPDATE m_account_setting SET acc_no='$acc_no', 
                                                            menu='$menu', 
                                                            modify_date='".date('Y-m-d H:i:s')."', 
                                                            modify_user='Admin'
                                    WHERE id='$id'");
        }
        public function delete_akun($id)
        {
            return $this->db->query("DELETE FROM m_account WHERE id='$id'");
        } 
        public function delete_akun_setting($id)
        {
            return $this->db->query("DELETE FROM m_account_setting WHERE id='$id'");
        } 
               
        public function getDataAkunPendapatan_2($pc)
        {
            return $this->db->query("SELECT
                                        test_bcspurchase.project.id,
                                        test_bcspurchase.project.project_code,
                                        test_bcspurchase.project.project,
                                        db_finance.m_project_akun.id as id_akun,
                                        db_finance.m_project_akun.kode_akun,
                                        db_finance.m_account.acc_no,
                                        db_finance.m_account.description
                                    FROM
                                        test_bcspurchase.project
                                    INNER JOIN db_finance.m_project_akun ON db_finance.m_project_akun.kode_project = test_bcspurchase.project.project_code
                                    INNER JOIN db_finance.m_account ON db_finance.m_account.acc_no = db_finance.m_project_akun.kode_akun
                                    WHERE db_finance.m_account.description LIKE'%Pendapatan%' AND test_bcspurchase.project.project_code='$pc' AND db_finance.m_project_akun.status='aktif'")->result();         
        }     
        public function getDataAkunPiutang_2($pc)
        {
            return $this->db->query("SELECT
                                        test_bcspurchase.project.id,
                                        test_bcspurchase.project.project_code,
                                        test_bcspurchase.project.project,
                                        db_finance.m_project_akun.id as id_akun,
                                        db_finance.m_project_akun.kode_akun,
                                        db_finance.m_account.acc_no,
                                        db_finance.m_account.description
                                    FROM
                                        test_bcspurchase.project
                                    INNER JOIN db_finance.m_project_akun ON db_finance.m_project_akun.kode_project = test_bcspurchase.project.project_code
                                    INNER JOIN db_finance.m_account ON db_finance.m_account.acc_no = db_finance.m_project_akun.kode_akun
                                    WHERE db_finance.m_account.description LIKE'%Piutang%' AND test_bcspurchase.project.project_code='$pc' AND db_finance.m_project_akun.status='aktif'")->result();         
        }       
        /*---------------------------------------------------------------------------------*/
        public function getDataAgreement_contract(){
            return $this->db->query("SELECT
                                        m_agreement_contract.id,
                                        m_agreement_contract.description
                                        FROM
                                        m_agreement_contract
                                        ")->result(); 
        }
        public function add_agreement($description)
        {
            return $this->db->query("INSERT m_agreement_contract SET description='$description', create_date='".date('Y-m-d H:i:s')."', create_user='Admin'");
        }
        public function edit_agreement($id,$description)
        {
            return $this->db->query("UPDATE m_agreement_contract SET description='$description'
                                        WHERE id='".$id."'");
        }
        public function delete_agreement($id)
        {
            return $this->db->query("DELETE FROM m_agreement_contract WHERE id='$id'");
        }
    }