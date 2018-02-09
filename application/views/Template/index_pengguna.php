<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/faficon.png"/>
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!--link rel="stylesheet" href="<?php echo base_url(); ?>assets/search_option/style.css"-->
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">

  <!-- style css sendiri -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/my-style.css">
  <!--/ style css sendiri -->

  <!-- Fungsi Memanggil DatePicker script datepicker -->
  <link href="<?php echo base_url();?>assets/alat/date_picker_bootstrap/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <!--end-->

  <!--** Sweet Alert **-->
  <script src="<?php echo base_url();?>assets/sweet-alert/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/sweet-alert/sweetalert.css">
  <!-- tutup -->

  <script>

   // block text untuk angka
	function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

  return false;
  return true;
  }
  </script>
  
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav" style="background:#000;">

  <!-- script jalankan otomatis -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url(); ?>" class="navbar-brand"><b>Global</b>Xtreme</a>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <?php if($content !="") $this->load->view($content); ?>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2017- <?php echo date('Y'); ?> <a href="http://globalxtreme.net">GlobalXtreme</a>.</strong>
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper ->


<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>


<!-- Select2 where -->
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<!-- Page script -->
<script>
  $(function (){
    $(".select2").select2({
      width: '100%'
    });
  });
</script>
<!--/ Select2 where -->


<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- Datepicker jQuery Version 1.11.0 -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/alat/date_picker_bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/alat/date_picker_bootstrap/js/locales/bootstrap-datetimepicker.id.js"charset="UTF-8"></script>
<!-- End Datepicker jQuery Version 1.11.0 -->

<script>
  /* reload data penggunaan kendaraan */
  $('.datepicker223').datetimepicker({
      language:  'id',
      weekStart: 1,
      todayBtn:  1,
      autoclose: true,
      todayHighligh: true,
      startView: 2,
      minView: 2,
      forceParse: 0
  });

  $('.datepicker223').change(function (){
    var tanggal_laporan = $(this).val();
    window.location= '<?php echo base_url("Pengguna/Home?tanggal="); ?>'+tanggal_laporan;
  });
  /* reload data penggunaan kendaraan */
</script>

</body>
</html>
