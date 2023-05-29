<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url('assets/img/logo.png');?>" type="image/png" size="32x32">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

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
        <title>Finance Integrated System</title>
    </head>
    <body class="bg-light">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container-fluid">
                <a class="navbar-brand p-0" href="<?php echo base_url();?>">
                    <img src="<?= base_url();?>assets/img/logo.png" height="40px" width="auto">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item d-flex align-items-center">
                            <?php
                                $rolenya='';
                                $session_role=$this->session->userdata('role');
                                if ($session_role=='1') {$rolenya='ADM';}
                                if ($session_role=='2') {$rolenya='AR';}
                                if ($session_role=='3') {$rolenya='AP';}
                                if ($session_role=='4') {$rolenya='GA';}
                                if ($session_role=='5') {$rolenya='CA';}
                                if ($session_role=='6') {$rolenya='INV';}
                            ?>
                            <span class="navbar-text">
                                Welcome, <b><?= $this->session->userdata('nama_karyawan').' ('.$this->session->userdata('payroll_id').')';?></b>
                                <span class="small p-1 border border-primary rounded text-primary"><?= $rolenya;?></span>
                            </span>
                        </li>
                        <!-- <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link" href="#" role="button" id="dropdownMenuMaster" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-database fa-fw"></i> Master
                                </a>
                                <ul class="dropdown-menu animate__animated animate__zoomIn animate__faster" aria-labelledby="dropdownMenuMaster">
                                    <li><a class="dropdown-item" href="<?php echo base_url();?>customers"><i class="fas fa-users fa-fw text-primary"></i> Customers</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url();?>transporter"><i class="fas fa-truck-moving fa-fw text-warning"></i> Transporters</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url();?>product"><i class="fas fa-box fa-fw text-success"></i> Product</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url();?>satuan"><i class="fas fa-balance-scale fa-fw text-danger"></i> Satuan</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url();?>lokasi"><i class="fas fa-search-location fa-fw text-info"></i> Lokasi</a></li>
                                </ul>
                            </div>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item d-flex align-items-center mb-2 mb-lg-0 me-lg-2">
                            <span class="navbar-text" id="time"></span>
                        </li>
                        <li class="nav-item mb-2 mb-lg-0 me-lg-2">
                            <div class="dropdown">
                                <a class="nav-link btn btn-primary text-white position-relative" href="#" role="button" id="dropdownMenuNotif" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell"></i> Reminder <span class="badge bg-danger">4</span>
                                </a>
                                <div class="dropdown-menu py-0 dropdown-menu-lg-end animate__animated animate__zoomIn animate__faster" aria-labelledby="dropdownMenuNotif" style="width:300px;">
                                    <div class="dropdown-content p-3">Test aja ini mah yah</div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger nav-link text-white" data-bs-toggle="modal" href="#modalLogout"><i class="bi bi-box-arrow-right"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid py-3" id="main">
            <div class="info">
                <?php echo $this->session->flashdata('info'); ?>
            </div>