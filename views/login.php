<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo base_url(); ?>/assets/images/favicon.png" type="image/icon" sizes="16x16">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo base_url(); ?>/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body class="amplifyLogin">
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card login-pagecard">
            
            <div class="card-header text-center p-t-50 login-textlogo"><img class="logo-img" src="<?php echo base_url(); ?>/assets/images/am_logo.png" alt="logo"></div>
            <div class="card-body">
              <?php $this->load->helper('form'); ?>
              <div class="row">
                  <div class="col-md-12">
                      <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                  </div>
              </div>
                  <?php
                      $this->load->helper('form');
                      $error = $this->session->flashdata('error');
                      if($error)
                      {
                  ?>
              <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $error; ?>                    
              </div>
                  <?php }
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                  ?>
                  <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $success; ?>                    
                  </div>
                  <?php } ?>
                <form action="<?php echo base_url(); ?>login/loginCheck" method="post">
                    <div class="form-group">
                        <label>Email Address:</label>
                        <input class="form-control form-control-lg" id="emailaddress" type="email" placeholder="Email" name="email" required >
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="col-sm-12 amplifylogin-btn">
						<button type="submit" class="btn btn-rounded btn-block bg-info">Login</button>
					</div>
                </form>
            </div>
            <div class="card-footer bg-white text-center">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="<?php echo base_url() ?>forgotPassword" class="text-muted">Forgot Password</a>
                </div>
                <!-- <div class="card-footer-item card-footer-item-bordered">
                    <a href="<?php echo base_url() ?>registration" class="text-muted">Registration Instructions</a>
                </div> -->
            </div>
        </div>
		<p class="copyright-footer">Copyright © Amplify CRM - All Rights Reserved.</p>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="<?php echo base_url(); ?>/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>