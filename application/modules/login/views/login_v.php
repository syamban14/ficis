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
        <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

        <!-- font awesome -->
        <script src="https://kit.fontawesome.com/bca66f7098.js" crossorigin="anonymous"></script>

        <!-- wow animation -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- datatable bootstrap 5 -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.bootstrap5.min.css">

        <!-- Bootstrap-select plugin -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">

        <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Login Finance System</title>
        <style type="text/css">
            .bg-wh{
                background-image: url(<?php echo base_url('assets/img/bg-wh.jpg'); ?>);
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-blend-mode: darken;
                background-color: rgba(0,0,0,0.2);
            }
        </style>
    </head>
    <body class="bg-light bg-wh">
        <div class="container login-page">
            <div class="row justify-content-md-center d-flex align-items-center vh-100">
                <div class="col-md-8 col-lg-7">
                    <div class="card shadow-sm">
                        <div class="card-body p-xl-5 p-3">
                            <center>
                                <img src="<?php echo base_url();?>assets/img/logo.png" width="300px" class="pb-2">
                            </center>
                            <h3 class="text-center">Finance System</h3>
                            <div class="row justify-content-evenly pt-5 g-2 g-sm-0">
                                <div class="col-12 col-sm-5 col-lg-4">
                                    <a href="#loginModalNonStaff" data-bs-toggle="modal" class="text-decoration-none">
                                        <div class="card bg-primary shadow-sm overflow-hidden">
                                            <div class="card-body text-white text-center">
                                                <div class="front-layer">
                                                    <h3><i class="bi bi-box-arrow-in-right"></i></h3>
                                                    SPV, MGR, DIR
                                                </div>
                                            </div>
                                            <div class="back-layer text-white text-center d-flex align-items-center">
                                                Login sebagai Supervisor, Manager, atau Direktur
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-sm-5 col-lg-4">
                                    <a href="#loginModalStaff" data-bs-toggle="modal" class="text-decoration-none">
                                        <div class="card bg-warning shadow-sm overflow-hidden">
                                            <div class="card-body text-white text-center">
                                                <div class="front-layer">
                                                    <h3><i class="bi bi-box-arrow-in-right"></i></h3>
                                                    STAFF
                                                </div>
                                            </div>
                                            <div class="back-layer text-white text-center d-flex align-items-center">
                                                Login sebagai Staff Keuangan
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="loginModalNonStaff" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white"><i class="bi bi-box-arrow-in-right"></i> Login</h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div id="pesan"></div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nik" placeholder="NIK/ID" required="">
                                <label for="nik"><i class="bi bi-person"></i> NIK/ID</label>
                                <div class="invalid-feedback">Kolom harus terisi!</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Password" required="">
                                <label for="password"><i class="bi bi-key"></i> Password</label>
                                <div class="invalid-feedback">Kolom harus terisi!</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="title" placeholder="Title" readonly>
                                <label for="title"><i class="bi bi-person-check"></i> Title</label> 
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" id="login">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="loginModalStaff" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-white"><i class="bi bi-box-arrow-in-right"></i> Login</h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div id="pesan_cust"></div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nik_staff" placeholder="NIK/ID" required="">
                                <label for="nik_cust"><i class="bi bi-person"></i> NIK/ID</label>
                                <div class="invalid-feedback">Kolom harus terisi!</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password_staff" placeholder="Password" required="">
                                <label for="password_staff"><i class="bi bi-key"></i> Password</label>
                                <div class="invalid-feedback">Kolom harus terisi!</div>
                            </div>
                 
                            <div class="d-grid">
                                <button class="btn btn-warning text-white" id="login_staff">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){ 
                $('#login').click(function(){
                    var nik = $('#nik').val();
                    var password = $('#password').val();
                    if (nik!='' && password!='') {
                        $.ajax({
                            type: "POST",  
                            url:  "<?php echo base_url(); ?>login/ceklogin",  
                            data: {nik: nik, password: password},  
                            cache: false,  
                            success: function(result){
                                if (result!=0) {
                                    $('#login').append('<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
                                    $('#login').attr('disabled',true);
                                    Swal.fire({
                                      icon: 'success',
                                      title: 'Granted!',
                                      html: 'You are verified',
                                      showConfirmButton: false,
                                      timer: 1500
                                    }).then((result) => {
                                      if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location.reload(result);
                                      }
                                    });
                                } else {
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Oops!',
                                      html: 'Payroll ID/Username and password are not match!<br>or you are not in this role',
                                      showConfirmButton: false,
                                      timer: 2500
                                    });
                                }
                            }
                        });
                    } else {
                        if (nik=='') {$('#nik').addClass('is-invalid');}
                        if (password=='') {$('#password').addClass('is-invalid');}
                    }
                    return false;
                });

                $('#login_staff').click(function(){
                    var nik_staff = $('#nik_staff').val();
                    var password_staff = $('#password_staff').val();
                    if (nik_staff!='' && password_staff!='') {
                        $.ajax({
                            type: "POST",  
                            url:  "<?php echo base_url(); ?>login/ceklogin_staff",  
                            data: {nik_staff: nik_staff, password_staff: password_staff},  
                            cache: false,  
                            success: function(result){
                                if (result!=0) {
                                    $('#login_staff').append('<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
                                    $('#login_staff').attr('disabled',true);
                                    Swal.fire({
                                      icon: 'success',
                                      title: 'Granted!',
                                      html: 'You are verified',
                                      showConfirmButton: false,
                                      timer: 1500
                                    }).then((result) => {
                                      if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location.reload(result);
                                      }
                                    });
                                } else {
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Oops!',
                                      html: 'Payroll ID/Username and password are not match!<br>or you are not in this role',
                                      showConfirmButton: false,
                                      timer: 2500
                                    });
                                }
                            }
                        });
                    } else {
                        if (nik_staff=='') {$('#nik_staff').addClass('is-invalid');}
                        if (password_staff=='') {$('#password_staff').addClass('is-invalid');}
                    }
                    return false;
                });

                $('#nik').keydown(function(){
                    $('#nik').removeClass('is-invalid');
                });
                $('#password').keydown(function(){
                    $('#password').removeClass('is-invalid');
                });
                
                $('#nik_staff').keydown(function(){
                    $('#nik_staff').removeClass('is-invalid');
                });
                $('#password_staff').keydown(function(){
                    $('#password_staff').removeClass('is-invalid');
                });

                $('#nik').change(function(event) {
                    var nik = $('#nik').val();
                    if (nik!='') {
                        $.ajax({
                            url: '<?php echo base_url();?>login/get_title/'+nik,
                            type: 'GET',
                            dataType: 'html',
                            data: {nik: nik},
                            success: function (result) {
                                $('#title').val(result);
                            }
                        });
                    }else{
                        Swal.fire({
                          icon: 'warning',
                          title: 'Perhatian!',
                          html: 'NIK harus terisi!',
                          showConfirmButton: false,
                          timer: 2500
                        });
                    }
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>