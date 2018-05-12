<?php
// if ($_SERVER["SERVER_PORT"] != 443) {
//     $redir = "Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//     header($redir);
//     exit();
// }

if($this->session->userdata('logged_in') == FALSE){
  redirect(base_url('Auth/Login'));
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/faficon.png"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">

  <!-- Fungsi Memanggil DatePicker script datepicker -->
  <link href="<?php echo base_url();?>assets/alat/date_picker_bootstrap/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <!--end-->

  <!-- style css sendiri -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/my-style.css">
  <!--/ style css sendiri -->

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

  <style>
  .select2-container .select2-selection--single{
    height: 34px;
    width: 100%;
    border-radius: 0;
    border-left: 1px solid #ccc;
  }
  </style>

  <!-- Plugins data galler img -->
  <link href="<?php echo base_url('assets/gallery-img/jquery.bsPhotoGallery.css'); ?>" rel="stylesheet">
  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="<?php echo base_url('assets/gallery-img/jquery.bsPhotoGallery.js'); ?>"></script>
  <!--/ Plugins data galler img -->

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- script jalankan otomatis -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--/ script jalankan otomatis -->

<script type="text/javascript">
   $('<audio id="chatAudio"><source src="<?php echo base_url(); ?>assets/audio/notifikasi.ogg" type="audio/ogg"><source src="<?php echo base_url(); ?>assets/audio/otifikasi.mp3" type="audio/mpeg"><source src="<?php echo base_url(); ?>assets/audio/notifikasi.wav" type="audio/wav"></audio>').appendTo('body');

  $(document).ready(function(){
    //setTimeout(notif_bar_ganti_oli,1000);
    notif_bar_ganti_oli();
    data_user();
    notif_bar_komplen();
  });

  // daftar user
  function data_user(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/User/data_user'); ?>',
      dataType: "JSON",
      success: function(data){
        $('#form-notif-gantioli [name="id_peminta"]').html('');
        $('#form-notif-gantioli [name="id_peminta"]').append('<option value="">-- Pilih Nama --</option>');
        for (var i = 0; i < data.length; i++) {
          $('#form-notif-gantioli [name="id_peminta"]').append('<option value="'+data[i].id_user+'">'+data[i].nama+'</option>');
        }
      }
    });
  }

  /*function notifikasi_bar_remarks(){
    $.ajax({
      url: '?php echo ba<se_url('F_ajax/Ajax/bar_notifikasi_admin'); ?>',
      dataType: "JSON",
      success: function (result) {
        $('#remarks_looping').html('');
        for(i=0;i<result[0].length;i++){
          // sound bell
          if(result[0][i].cek_admin == '0'){
            $('#chatAudio')[0].play();
            $.ajax({url : "?php echo base_url();?>F_ajax/Ajax/ceksound/"+result[0][i].id_remarks+"/3"});
          }
          $('#remarks_looping').append('<li><a href="<php echo base_url('Admin/Home/Remarks/');?>'+result[0][i].id_report+'" style="padding:1px 10px;"><span><b>'+result[0][i].call_name+'</b> ('+result[0][i].nama_port+'/'+result[0][i].divisi+')<small class="pull-right"><i class="fa fa-clock-o text-blue"></i> '+result[0][i].time_remarks+'</small></span><br><span style="font-size:15px;">'+result[0][i].judul_pekerjaan+'</span><br><span>'+result[0][i].isi_remarks+'</span></a></li>');
        }
        $('#jmlRemarks').text(result[1]);
        if(result[1] == '0'){
          $('#cardRemarks').text('');
        }else {
          $('#cardRemarks').text(result[1]);
        }

      }
    });
    setTimeout(notifikasi_bar_remarks, 2000)
  }*/

  // jadawal ganti oli
  function notif_bar_ganti_oli() {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Notif_bar/jadwal_ganti_oli'); ?>',
      dataType: 'JSON',
      success: function (data){
        $('#d_notifBar_gantiOli').html('');
        $('#jml_notifBar_gantiOli').html('');
        if(data.list.length != 0){
          $('#jml_notifBar_gantiOli').text(data.list.length);
        }
        for (var i = 0; i < data.list.length; i++) {
         var aks = "'"+data.list[i].id_kendaraan+"',"+"'"+data.list[i].nomor_polisi+"',"+"'"+data.list[i].id_ganti_oli+"'";
         // sound bell
         if(data.list[i].notifikasi_sound == '0'){
           $('#chatAudio')[0].play();
           $.ajax({url : '<?php echo base_url('Admin/Data_Ajax/Notif_bar/update_bell_ganti_oli?id_ganti_oli=') ?>'+data.list[i].id_ganti_oli});
         }

         $('#d_notifBar_gantiOli').append(
          '<li><a><!--small class="pull-right"><i class="fa fa-clock-o"></i> 5 mins</small--><p style="margin:0;"><b class="text-black" style="font-size:15px;">'+data.list[i].nomor_polisi+'</b> Waktunya Ganti Oli' + ' ' + '<span class="text-red margin-l-5"> <i class="fa fa-clock-o"></i> ' + data.list[i].tgl_ganti_berikutnya + '</span></p><button type="button" class="btn btn-xs bg-green" onclick="modal_notifBar('+aks+')" data-toggle="modal" data-target="#Modalnofit-Spk">Buat Spk</button> <button type="button" class="btn btn-xs bg-aqua" onclick="update_notifOli('+data.list[i].id_ganti_oli+')">Lewati</button></a></li>'
         );
        }
      }
    });
    setTimeout(notif_bar_ganti_oli,20000);
  }

  // pemberitahuan komplen
  function notif_bar_komplen() {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Notif_bar/komplen'); ?>',
      dataType: 'JSON',
      success: function (data) {
        $('#jumlah_komplen_notifBar').html('');
        $('#daftar_komplen_notifBar').html('');
        if(data.length != 0){
          $('#jumlah_komplen_notifBar').text(data.length);
        }
        for (var i = 0; i < data.length; i++) {
          var action = "'"+data[i].id_komplen+"','"+data[i].nomor_polisi+"','"+data[i].nama+"'";
          // pembedaan untuk data yang baru masuk
          if(data[i].notif_bar_cek == '0'){
            var bg = '#efefef';
          }else {
            var bg = '';
          }
          // sound bell
          if(data[i].notif_suara == '0'){
            $('#chatAudio')[0].play();
            $.ajax({url : '<?php echo base_url('Admin/Data_Ajax/Notif_bar/update_bell_komplen?id_komplen=') ?>'+data[i].id_komplen});
          }
          // menampilkan data
          $('#daftar_komplen_notifBar').append('<li style="background:'+bg+';"><a><b class="text-black margin-r-5">'+data[i].nomor_polisi+' </b><small style="color:#989898;"><i class="fa fa-clock-o"></i> '+ data[i].waktu_komplen + ' - ' + data[i].tgl_komplen+'</small><button type="button" class="btn btn-xs bg-maroon pull-right" onclick="ambilData_keluhan('+action+')" data-toggle="modal" data-target="#ModalLIhatKomplen" style="margin-top:10px;">Lihat</button><p style="margin:0;">'+ data[i].nama +' mengajuakan Keluhan</p></a></li>');
        }
      }
    });
    setTimeout(notif_bar_komplen,20000);
  }
</script>

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <span class="logo-mini"><b>A</b></span>
      <span class="logo-lg"><b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notif bar Keluhan Pengguna -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bullhorn"></i>
              <span class="label bg-maroon" id="jumlah_komplen_notifBar"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header text-center">Keluhan Pengguna</li>
              <li>
                <ul class="menu" id="daftar_komplen_notifBar">
                </ul>
              </li>
            </ul>
          </li>

          <!-- Notif bar jadwal ganti oli-->
          <li class="dropdown messages-menu ">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-tint"></i>
              <span class="label label-success" id="jml_notifBar_gantiOli"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header text-center">Jadwal Ganti Oli</li>
              <li>
                <ul class="menu" id="d_notifBar_gantiOli">
                </ul>
              </li>
              <!-- <li class="footer"><a href="#"></a></li> -->
            </ul>
          </li>

          <!-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-clock-o"></i>
              <span class="label label-danger" id="cardRemarks"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">STNK <b id="jmlRemarks"></b></li>
              <li>
                <ul class="menu" id="remarks_looping">
                </ul>
              </li>
            </ul>
          </li> -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/dist/img/avatar.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nama']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/dist/img/avatar.png" class="img-circle" alt="User Image">
                <p><?php echo $_SESSION['nama']; ?></p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('Auth/Login/log_out'); ?>" class="btn btn-default btn-flat">Sign-Out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="<?php echo base_url('Admin/Dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="">
            <i class="fa fa-support"></i> <span>Master Kendaraan</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Admin/Info_kendaraan'); ?>"><i class="fa fa-circle-o"></i> Info Kendaraan</a></li>
            <li><a href="<?php echo base_url('Admin/Peminjaman_kendaraan'); ?>"><i class="fa fa-circle-o"></i> Peminjam Kendaraan</a></li>
            <li><a href="<?php echo base_url('Admin/Data_spk'); ?>"><i class="fa fa-circle-o"></i> Data SPK</a></li>
          </ul>
        </li>

        <!--li class="treeview">
          <a href="">
            <i class="fa fa-file"></i> <span>Master SPK</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

          </ul>
        </li-->

        <li class="treeview">
          <a href="">
            <i class="fa fa-tag"></i> <span>Master Barang</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Admin/Data_barang'); ?>"><i class="fa fa-circle-o"></i> Data Barang</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="">
            <i class="fa fa-cog"></i> <span>Pengaturan</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Admin/User'); ?>"><i class="fa fa-circle-o"></i> User</a></li>
          </ul>
        </li>

        <!--li class="treeview">
          <a href="#">
            <i class="fa  fa-random"></i> <span>Menu 1</span>
          </a>
        </li>

        <li class="treeview">
          <a href="">
            <i class="fa fa-gavel"></i> <span>Menu 2</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Opsi 1</a></li>
          </ul>
        </li-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <?php if($content !="") $this->load->view($content); ?>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>GXTV</b>
    </div>
    <strong>&copy; 2017 <a href="http://www.globalxtreme.tv">www.globalxtreme.tv</a></strong> All rights
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $(".example1").DataTable();
    $("#example3").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $(".table_more").DataTable({
      "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
    });
  });
</script>

<!--datepicker template-->
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!--/ datepicker template-->

<script type="text/javascript" src="<?php echo base_url();?>assets/alat/date_picker_bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/alat/date_picker_bootstrap/js/locales/bootstrap-datetimepicker.id.js"charset="UTF-8"></script>
<!-- End Datepicker jQuery Version 1.11.0 -->


<!-- Select2 where -->
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<!-- Page script -->
<script>
  $(function (){
    $(".select2").select2({
      widht: '100%'
    });
  });
</script>
<!--/ Select2 where -->


<!-- Fungsi datepickier yang digunakan -->
  <script type="text/javascript">
    $('.datepicker').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

    $('#monthPicker').datetimepicker({
      language:  'id',
      weekStart: 1,
      todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 3,
      minView: 3
    });

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
      window.location= '<?php echo base_url("Admin/Peminjaman_kendaraan?tanggal="); ?>'+tanggal_laporan;
    });
    /* reload data penggunaan kendaraan */

    /* reload data barang untuk rab */
    $('.dateRab').datepicker({
      language: "id",
      autoclose: true,
      startView: 1,
      minViewMode: 1
    });

    $('.dateRab').change(function () {
      // var tanggalRab = $(this).val();
      // window.location = '<?php echo base_url("Admin/Data_barang?tanggalRab=") ?>'+tanggalRab;
      tabelRAB();
    });
    /* reload data barang untuk rab */

    // rekapan rab
    $('.daterekapan_barang').datepicker({
      language: "id",
      autoclose: true,
      startView: 1,
      minViewMode: 1
    });

    $('.daterekapan_barang').change(function () {
      // var tanggalRab = $(this).val();
      // window.location = '<?php echo base_url("Admin/Data_barang?tanggalRab=") ?>'+tanggalRab;
      tabelRekapan();
    });
    // rekapan rab

    // datepicker untuk menampilkan spk perbulan
    $('.datpicker_spkperbulan').datepicker({
        language: "id",
        autoclose: true,
        startView: 1,
        minViewMode: 1
    });

    $('.datpicker_spkperbulan').change(function () {
        spklistperbulan();
    });

    //datepicker untuk menampilkan spk perbulan

    /* datepicker catatan ganti oli */
    $(document).ready(function () {
      $('.firstcal').datepicker({
        dateFormat: "dd/mm/yy",
        autoclose: true,
        onSelect: function(dateText, inst) { alert("Working");}
        // onSelect: function(dateText, instance) {
        //   date = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
        //   date.setMonth(date.getMonth() + 1);
        //   $(".secondcal").datepicker("setDate", date);
        // }
      });
      $(".secondcal").datepicker({
        dateFormat: "dd/mm/yy",
        autoclose: true,
        inline: true,
        onSelect: function (selected) {
            var dtMax = new Date(selected);
            dtMax.setDate(dtMax.getDate() - daysToAdd);
            var dd = dtMax.getDate();
            var mm = dtMax.getMonth() + 1;
            var y = dtMax.getFullYear();
            var dtFormatted = mm + '/'+ dd + '/'+ y;
            $(".firstcal").datepicker("option", "maxDate", dtFormatted)
        }
      });
    });
    /* datepicker catatan ganti oli*/

    // datepicker closed spk
    $('.PickerClosedSPK').datepicker({
      language: "id",
      autoclose: true,
      startView: 1,
      minViewMode: 1
    });

    $('.PickerClosedSPK').change(function (){
      closedSPK();
    });

    $('.datepicker_year').datepicker({
      language: "id",
      autoclose: true,
      startView: 2,
      minViewMode: 2
    });

  </script>
<!--- Tutup Fungsi DatePicker --->

<!-- form input spk kendaraan ganti oli -->
 <script>
  // form modal
  function modal_notifBar(id,no_pol,id_ganti_oli){
    $('#noplat-notif-gantioli').html('');
    $('#noplat-notif-gantioli').append(
      '<option value="'+id+'">'+no_pol+'</option>'
    );
    $('#form-notif-gantioli [name="id_ganti_oli"]').val(id_ganti_oli);
  }

  // update_notifOli : data di update untuk menunjukan notifikasi yang telah di cek oleh admin
  function update_notifOli(id_ganti_oli) {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Notif_bar/update_notifOli?id_ganti_oli=')?>'+id_ganti_oli,
      type: 'GET',
      dataType: 'JSON',
      success: function (data) {
        notif_bar_ganti_oli();
        //setTimeout(notif_bar_ganti_oli,10);
      }
    });
  }
 </script>
<!-- form input spk kendaraan ganti oli -->

<!-- Modal Membuat SPK dari Jadwa Ganti Oli -->
<div class="modal fade" id="Modalnofit-Spk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Buat SPK</h4>
      </div>
      <form id="form-notif-gantioli" action="<?php echo base_url('Admin/Data_Ajax/Spk/buat_spk_notif_bar'); ?>" method="post">
        <input type="hidden" name="id_ganti_oli">
      <div class="modal-body">
       <div class="row">
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Nomor Polisi</label>
          <select class="form-control " name="id_kendaraan" id="noplat-notif-gantioli" required>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Tanggal</label>
          <input type="tgl_spk" class="form-control" name="tgl_rab" value="<?php echo date('d/m/Y'); ?>" readonly>
        </div>

        <div class="form-group col-md-6">
          <label class="control-label">Jenis Pekerjaan</label>
          <select class="form-control " name="id_jenis_pekerjaan" required readonly>
            <option value="1">Rutin Nitas</option>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label class="control-label">Peminta</label>
          <select class="form-control " name="id_peminta" required>
          </select>
        </div>

        <div class="form-gorup col-md-12">
          <label class="control-label">Keluhan / Kerusakan</label>
          <textarea class="form-control" rows="4" placeholder="Catatan.." name="keluhan" required>Ganti Oli</textarea>
        </div>

       </div>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Buat</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal Membuat SPK dari Jadwa Ganti Oli -->

<!-- Lihat Hasil Komplen -->
<div class="modal fade bs-example-modal-sm" id="ModalLIhatKomplen" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-maroon">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-bullhorn"></i> Lihat Keluhan Pengguna</h4>
      </div>
      <form method="post" action="<?php echo base_url('Admin/Data_Ajax/Spk/buat_spk_notif_bar_Komplen'); ?>">
        <input type="hidden" name="Notif_bar_id_komplen">
        <div class="modal-body">
         <div class="row">
          <div class="col-md-12">
            <span>No Polisi :  </span> <b id="komplen_NoPolisi"></b> <br>
            <span>Nama Pengguna :  </span> <b id="nama_komplen"></b>
          </div>
          <div class="col-md-12">
            <span>Keluhan :</span>
            <div id="isi_dataKeluhan">
            </div>
          </div>
         </div>
        </div>
        <div class="modal-footer" style="text-align:center;">
          <button type="submit" class="btn bg-green">Jadikan SPK</button>
          <button type="button" class="btn bg-aqua" onclick="lewati_NotifBar_komplen()">Lewati</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--/ Modal Lihat komplen -->

<!-- Ambil Keluhan -->
<script>
function ambilData_keluhan(id,nomor_polisi,nama) {
  $('[name="Notif_bar_id_komplen"]').val(id);
  $('#komplen_NoPolisi').text(nomor_polisi);
  $('#nama_komplen').text(nama);
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Notif_bar/ambilData_keluhan?id_komplen='); ?>'+id,
    dataType: 'JSON',
    success: function (data) {
      notif_bar_komplen();
      $('#isi_dataKeluhan').html('');
      $('#isi_dataKeluhan').append('" ' + data[0].komplen + ' "');
    }
  });
}

function lewati_NotifBar_komplen() {
  var id_dataKomplen = $('[name="Notif_bar_id_komplen"]').val();
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Notif_bar/lewati?id_komplen='); ?>'+id_dataKomplen,
    dataType: 'JSON',
    success: function (data) {
     $('#ModalLIhatKomplen').modal('hide');
     notif_bar_komplen();
    }
  });
}
</script>

<!-- Ganti Password Admin pertama kali login -->
<?php if($_SESSION['ket_user'] == '0'){ ?>

  <!-- Dialog Modal -->
<div class="modal fade bs-example-modal-sm" id="Modalganti_passUser"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document" style="    width: 350px;">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">Ganti Password</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-12 alert bg-danger alert-dismissible" style="padding:6px;margin-bottom:8px;">
              <h4 style="margin-bottom: 3px;"><i class="icon fa fa-info"></i> Password Default!</h4>
              Harap di ganti terlebih dahulu
            </div>
          </div>

          <div class="form-group col-md-12">
            <span style="font-weight: 600;">Password</span>
            <span class="pull-right text-red" id="g-pw-admin"></span>
            <input type="password" class="form-control" name="pass_user_admin" placeholder="************">
          </div>
          <div class="col-md-12">
            <span style="font-weight: 600;">Ulangi Password</span>
            <span class="pull-right text-red" id="ug-pw-admin"></span>
            <input type="password" class="form-control" name="ulangi_pass_user_admin" placeholder="************">
          </div>

        </div>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn bg-green" id="btn-g-pw" onclick="ganti_password_admin()">Ganti</button>
      </div>
    </div>
  </div>
</div>

  <script>
    $('#Modalganti_passUser').modal('show');
    $('[name="ulangi_pass_user_admin"]').keyup(function(){
      if($(this).val() !== $('[name="pass_user_admin"]').val()){
        $('#ug-pw-admin').text('Belum cocok!');
        $('#btn-g-pw').attr({'disabled':true});
      }else {
        $('#ug-pw-admin').text('');
        $('#btn-g-pw').attr({'disabled':false});
      }
    });

    function ganti_password_admin() {
      var p_u_admin = $('[name="pass_user_admin"]').val();
      var gp_u_admin = $('[name="ulangi_pass_user_admin"]').val();
      if(p_u_admin == ''){
        $('#g-pw-admin').text('Data kosong!');
        $('#ug-pw-admin').text('');
      }else if (gp_u_admin == '') {
        $('#g-pw-admin').text('');
        $('#ug-pw-admin').text('Data kosong!');
      }else if (gp_u_admin !== p_u_admin) {
        $('#ug-pw-admin').text('Belum cocok!');
        $('#btn-g-pw').attr({'disabled':true});
      }else if (p_u_admin == '12345678') {
        $('#g-pw-admin').text('Password terlalu simpel!');
      }else if (p_u_admin.length <= 8) {
        $('#g-pw-admin').text('Min 8 text!');
      }else {
        $('#g-pw-admin').text('');
        $('#ug-pw-admin').text('');
        console.log(p_u_admin);
        $.ajax({
          url: '<?php echo base_url('Admin/Data_Ajax/User/update_pw_admin'); ?>',
          type: 'POST',
          dataType: 'JSON',
          data: {'p_u_admin':p_u_admin},
          success: function (data) {
            console.log(data);
            if(data == '1'){
              swal({
                title: 'Berhasil',
                text: 'Halam akan di Log-Out!',
                type: 'success',
                timer: 1700,
                showConfirmButton: false
              },function () {
                window.location = "<?php echo base_url('Auth/Login/log_out'); ?>";
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
      setTimeout(function () {
        $('#g-pw-admin').text('');
        $('#ug-pw-admin').text('');
      },2000);
    }
  </script>
<?php } ?>

</body>
</html>
