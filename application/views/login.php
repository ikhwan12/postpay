<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <link rel="shortcut icon" href="<?=base_url('assets/img/nihaoindotrans.png');?>" />

    <title>Post Count Payment Application</title>

    <!-- vendor css -->
    <link href="<?=base_url('assets/lib/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/lib/Ionicons/css/ionicons.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css');?>" rel="stylesheet">

    <!-- Amanda CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/css/amanda.css');?>">
    <?php echo $script_captcha; ?>
  </head>

  <body>
    <div class="am-signin-wrapper">
      <div class="am-signin-box">
        <div class="row no-gutters" >
            <div class="col-lg-5">
                <div>
                  <h2>Nihao Indo</h2>
                  <p>Post Count Payment Application</p>

                  <hr>
                </div>
              </div>
          <div class="col-lg-7">
            <h5 class="tx-gray-800 mg-b-25">Signin to Your Account</h5>
            <div style="color: red">
            <?php
                if($this->session->flashdata('login_error')){
                    echo '<i>'.$this->session->flashdata('login_error_message').'</i>';
                }
            ?>
            </div>
            <form id="signin-form" action="<?=  site_url('login/CheckLogin');?>" method="post">    
            <div class="form-group">
              <label class="form-control-label">Username or Email:</label>
              <input type="text" name="login-id" class="form-control" placeholder="Enter Your Username or Email" required>
            </div><!-- form-group -->

            <div class="form-group">
              <label class="form-control-label">Password:</label>
              <input type="password" name="login-password" class="form-control" placeholder="Enter your password" required>
            </div><!-- form-group -->
            <div class="form-group">
                <?php echo $captcha // tampilkan recaptcha ?>
            </div>
            <div style="margin-top: 20px;"></div>
            
            <button type="submit" class="btn btn-block">Sign In</button>
            </form>
          </div><!-- col-7 -->
        </div><!-- row -->
        <p class="tx-center tx-white-5 tx-12 mg-t-15">Copyright &copy; 2017. All Rights Reserved. Powered by ThemePixels</p>
      </div><!-- signin-box -->
    </div><!-- am-signin-wrapper -->

    <script src="<?=base_url('assets/lib/jquery/jquery.js');?>"></script>
    <script src="<?=base_url('assets/lib/popper.js/popper.js');?>"></script>
    <script src="<?=base_url('assets/lib/bootstrap/bootstrap.js');?>"></script>
    <script src="<?=base_url('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js');?>"></script>

    <script src="<?=base_url('assets/js/amanda.js');?>"></script>
  </body>
</html>
