<?php
// if ($_SERVER["SERVER_PORT"] != 443) {
//   $redir = "Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//   header($redir);
//   exit();
// }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Pages</title>
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/faficon.png"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

    <!--** Sweet Alert **-->
    <script src="<?php echo base_url();?>assets/sweet-alert/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/sweet-alert/sweetalert.css">
    <!-- tutup -->

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!--div class="login-logo">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/img/logo/logo.png'); ?>"></a>
    </div-->
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h2 class="login-box-msg"><b>Login</b></h2>

        <form id="form_login">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Username" name="user">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Password" name="pass">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox"> Remember Me
                  </label>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="checkbox icheck">
                  <label>
                   <a href="#">I forgot my password</a>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-12">
                <button type="button" onclick="auth_login()" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>

<script>
// proses login page
function auth_login(){
  $.ajax({
    url: '<?php echo base_url('Auth/Login/proses_login'); ?>',
    type: "POST",
    data: $('#form_login').serialize(),
    dataType: "JSON",
    success: function (data){
        console.log(data);
        console.log('hello');
     if (data == '1') {
      swal({
        title: 'Berhasil',
        text: 'User dan Pass cocok!',
        type: 'success',
        timer: 1200,
        showConfirmButton: false
      },function () {
        window.location = "<?php echo base_url('Admin/Dashboard'); ?>";
      });
     }else {
       swal({
         title: 'Kesalahan!',
         text: data,
         type: 'warning',
         timer: 1300,
         showConfirmButton: false
       });
     }
    }
  });
}
</script>

</body>
</html>
