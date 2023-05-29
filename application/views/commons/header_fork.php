<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url('assets/img/favicon-32x32.png');?>" type="image/png" size="32x32">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

        <!-- font awesome -->
        <script src="https://kit.fontawesome.com/bca66f7098.js" crossorigin="anonymous"></script>

        <!-- wow animation -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- datatable bootstrap 5 -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.bootstrap5.min.css">

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

        <title>WMS Advanced</title>
    </head>
    <body class="bg-light">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container-fluid">
                <a class="navbar-brand p-0" href="<?php echo base_url();?>">
                    <img src="<?= base_url();?>assets/img/logo_wms.png" height="40px" width="auto">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link" href="#" role="button" id="dropdownMenuNotif" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="far fa-bell text-warning"></i> Notification
                                </a>
                                <div class="dropdown-menu py-0 dropdown-menu-lg-end animate__animated animate__zoomIn animate__faster" aria-labelledby="dropdownMenuNotif" style="width:300px;">
                                    <div class="dropdown-content p-3">Test aja ini mah yah</div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link" href="#" role="button" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="far fa-user text-primary"></i> Profile
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg-end animate__animated animate__zoomIn animate__faster" aria-labelledby="dropdownMenuUser">
                                    <li><span class="dropdown-item text-center" href="#">Hi, <?php echo $this->session->email; ?></span></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog text-primary fa-fw"></i> Settings</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-lock-open text-warning fa-fw"></i> Change password</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url();?>login/logout"><i class="fas fa-sign-out-alt fa-fw text-danger"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>