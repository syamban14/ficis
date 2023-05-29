<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url('assets/img/favicon-32x32.png');?>" type="image/png" size="32x32">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <!-- font awesome -->
        <script src="https://kit.fontawesome.com/bca66f7098.js" crossorigin="anonymous"></script>

        <!-- wow animation -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- datatable bootstrap 5 -->
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.bootstrap5.min.css"> -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/DataTables/datatables.min.css">

        <!-- Bootstrap-select plugin -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url();?>assets/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
        
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
        <!-- Sweet Alert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Bootstrap 4 Datepicker Plugin -->
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

        <title>WMS Advanced</title>
    </head>
    <body class="bg-light">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow-sm py-2 border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand p-0 me-4" href="<?php echo base_url();?>">
                    <img src="<?= base_url();?>assets/img/logo_wms.png" height="56px" width="auto">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item">
                            <h6>
                                <small>Your designated area : </small>
                                <span class="text-primary animate__animated animate__flash animate__infinite animate__slow" id="designated_area">
                                <?php
                                    $user_code=$this->session->user_code;
                                    $render='';
                                    $used_space = 0;
                                    $total_used_space_inb = 0;
                                    $total_used_space_rep = 0;
                                    $this->load->model('Home/Home_m');
                                    $data_lokasi = $this->Home_m->data_lokasi($user_code);
                                    foreach($data_lokasi->result() as $x){
                                        $render .= $x->wh_designated.', ';
                                        // $data_inb = $this->Home_m->get_data_inbound($x->wh_designated);
                                        // foreach($data_inb->result() as $y){
                                        //     $used_space_inb = $y->used_space;
                                        //     $total_used_space_inb += $used_space_inb;
                                        // }
                                        // $data_rep = $this->Home_m->get_data_reposisi($x->wh_designated,$user_code);
                                        // foreach($data_rep->result() as $y){
                                        //     $used_space_rep = $y->used_space;
                                        //     $total_used_space_rep += $used_space_rep;
                                        // }
                                    }
                                    echo rtrim($render, ", ");
                                ?>
                                </span>
                            </h6>
                            <h6 class="mb-0">
                                <!-- <small>Total used : </small><span id="total_used"><?= $total_used_space_inb+$total_used_space_rep;?> m<sup>2</sup></span> -->
                                <small>Total used : </small><span id="total_used">
                                <?php
                                    $user_code=$this->session->user_code;
                                    $jum_tot='';
                                    $this->load->model('Home/Home_m');
                                    $data_satuan_per_customer = $this->Home_m->data_satuan_per_customer($user_code);

                                    foreach ($data_satuan_per_customer->result() as $row) {
                                        $data_qty_persatuan_inb = $this->Home_m->data_qty_persatuan_inb($user_code,$row->nama_satuan);
                                        $data_qty_persatuan_rep = $this->Home_m->data_qty_persatuan_rep($user_code,$row->nama_satuan);
                                        $jum_akh_ind=0;
                                        $jum_akh_rep=0;
                                        $jum_total=0;
                                        foreach ($data_qty_persatuan_inb->result() as $row2) {
                                            // echo $renders .= $row2->jumlah_akhir.' '.$row2->nama_satuan.', ';
                                            $jum_akh_ind=$row2->jumlah_akhir;
                                        }
                                        foreach ($data_qty_persatuan_rep->result() as $row3) {
                                            // $renders .= $row->jumlah_akhir.' '.$row->nama_satuan.', ';
                                            $jum_akh_rep=$row3->jumlah_akhir;
                                        }
                                        $jum_total=$jum_akh_ind+$jum_akh_rep;
                                        $jum_tot .= $jum_total.' '.$row->nama_satuan.', ';
                                    }

                                    echo rtrim($jum_tot, ", ");
                                ?>
                                </span>
                            </h6>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link text-center" href="#" role="button" id="dropdownMenuTransaction" data-bs-toggle="dropdown" aria-expanded="false">
                                   <i class="fas fa-book fa-fw"></i> Reports
                                </a>
                                <ul class="dropdown-menu animate__animated animate__zoomIn animate__faster" aria-labelledby="dropdownMenuTransaction">
                                    <li><a class="dropdown-item" href="<?php echo base_url('inbound/get_data/'.$this->session->user_code);?>"><i class="fas fa-sign-in-alt text-primary fa-fw"></i> Inbound</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('stock_on_hand/get_data/'.$this->session->user_code);?>"><i class="fas fa-cubes text-info fa-fw"></i> Stock on Hand</a></li>
                                    <!-- <li><a class="dropdown-item" href="<?php echo base_url();?>warehouse"><i class="fas fa-random text-warning fa-fw"></i> Warehousing/Reposition</a></li> -->
                                    <li><a class="dropdown-item" href="<?php echo base_url('outbound/get_data/'.$this->session->user_code);?>"><i class="fas fa-box fa-sign-out-alt text-success fa-fw"></i> Outbound</a></li> 
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-lg-0">
                        <li class="nav-item">
                            <h6 class="border-bottom border-dark text-end">
                                Welcome, <span class="font-weight-bold text-primary"><?= $this->session->user_code?></span>
                            </h6>
                            <div class="d-flex align-items-center float-end">
                                <div class="mb-0 border-end border-secondary pe-2">
                                    Updated at<br>
                                    <span id="Update_date" class="text-danger">17/08/2021</span>
                                </div>
                                <div class="ps-2">
                                    <a class="btn btn-danger" href="<?php echo base_url();?>login/logout"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid py-3 cust">
            <div class="info">
                <?php echo $this->session->flashdata('info'); ?>
            </div>