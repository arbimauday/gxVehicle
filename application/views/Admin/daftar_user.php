<div class="content-wrapper">
  <!-- Info Kendaraan -->
  <section class="content-header">
    <h1>User <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#Modaltambahuser" onclick="reset_form_user()">Tambahkan</button></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i> Pengaturan</a></li>
      <li>User</li>
    </ol>
  </section>

  <section class="content">
   <div class="row">
    <div class="col-lg-12 connectedSortable">
     <div class="box box-info">
       <div class="box-header table-responsive">
         <table class="table table-bordered table-striped tbl-user">
          <thead>
           <tr>
             <th>#</th>
             <th>Nama</th>
             <th>Level</th>
             <th>Divisi</th>
             <th>Port</th>
             <th>Email</th>
             <th>Aksi</th>
           </tr>
          </thead>
         </table>
       </div>
     </div>
    </div>
   </div>
  </section>

</div>

<!-- Modal User -->
<div class="modal fade" id="Modaltambahuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah User</h4>
      </div>
      <form id="form_user" method="post">
      <div class="modal-body">
       <div class="row">
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Nama</label>
          <span id="notif_nama" class="pull-right text-red"></span>
          <input type="text" class="form-control" name="nama" placeholder="-- Nama --" onkeyup="cek_nama()">
        </div>
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Divisi</label>
          <select class="form-control" name="id_divisi">
            <?php foreach ($divisi as $u) { ?>
              <option value="<?php echo $u->id_divisi; ?>"><?php echo $u->divisi; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Port</label>
          <select class="form-control" name="id_port">
            <?php foreach ($port as $u) { ?>
              <option value="<?php echo $u->id_port; ?>"><?php echo $u->port; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Level</label>
          <select class="form-control" name="id_level">
            <?php foreach ($level_user as $u) { ?>
              <option value="<?php echo $u->id_level; ?>"><?php echo $u->level; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Username</label>
          <span id="notif_user" class="text-red pull-right"></span>
          <input type="text" class="form-control" name="user" placeholder="Username" >
        </div>
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Password</label>
          <span id="notif_pass" class="text-red pull-right"></span>
          <input type="password" class="form-control" name="pass" placeholder="*************" onkeyup="cek_pass()">
        </div>

        <div class="form-group col-md-12">
          <label for="recipient-name" class="control-label">Email</label>
          <span id="notif_email" class="text-red pull-right"></span>
          <input type="email" class="form-control" name="email" placeholder="@contoh">
        </div>

       </div>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" onclick="input_user()" class="btn btn-success">Buat</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal user -->

<!-- Modal Ubah user -->
<div class="modal fade" id="ModalUbahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah</h4>
      </div>
      <form id="form_ubahUser">
        <input type="hidden" name="id_user_ubah_user">
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label">Nama</label>
              <input type="text" class="form-control" name="nama_ubah_user">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">User</label>
              <input type="text" class="form-control" name="user_ubah_user">
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Port</label>
              <select class="form-control" name="id_port_ubah_user"></select>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Divisi</label>
              <select class="form-control" name="id_divisi_ubah_user"></select>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Level</label>
              <select class="form-control" name="id_level_ubah_user"></select>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Email</label>
              <input type="email" class="form-control" name="email_ubah_user">
            </div>

          </div>
        </div>
        <div class="modal-footer" style="background: #efefef;text-align:center;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" onclick="update_userPengguna()" class="btn btn-success">Perbarui</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--/ Modal Ubah user -->


<script>
// list tabel user
$(document).ready(function(){
  usertabel = $('.tbl-user').DataTable({
    ordering: true,
    destroy: true,
    order: [[1, "asc"]],
    processing: false,
    serverSide: false,
    ajax: {
      url: "<?php echo base_url('Admin/Data_Ajax/User/data_tbl'); ?>",
    }
  });
});

//reset form input user
function reset_form_user() {
  $('#form_user')[0].reset('');
}

// cek nama user yg gk ke duplikat
function cek_nama() {
  var nama = $('[name="nama"]').val();
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/User/cek_nama'); ?>',
    data: {'nama': nama},
    type: 'POST',
    dataType: 'JSON',
    success: function (data) {
      if(data > 0){
        $('#form_user input').attr('readonly',true);
        $('#notif_nama').text('Sudah terdaftar');
      }else {
        $('#form_user input').attr('readonly',false);
        $('#notif_nama').text('');
      }
      $('[name="nama"]').attr('readonly',false);
    }
  });
}

// onkeyup untuk cek password
function cek_pass(){
  pass = $('[name="pass"]').val();
  console.log(pass.length);
  if(pass.length < 6 || pass == '1234567' || pass == '12345678' || pass == '123456789' || pass == '12345678910' || pass == '1234567890'){
    $('#notif_pass').text('PW Terlalu Simpel');
  }else {
    $('#notif_pass').text('');
  }

}

// input user name yang baru
function input_user() {
  var nama  = $('[name="nama"]').val();
  var user  = $('[name="user"]').val();
  var pass  = $('[name="pass"]').val();
  var email = $('[name="email"]').val();
  var notif = 'Data Kosong';
  if(nama == ''){
    $('#notif_nama').text(notif);
    setTimeout(function() {
      $('#notif_nama').text('');
    },3000);
  }else if (user == '') {
    $('#notif_user').text(notif);
    setTimeout(function() {
      $('#notif_user').text('');
    },3000);
  }else if (pass == '') {
    $('#notif_pass').text(notif);
    setTimeout(function() {
      $('#notif_pass').text('');
    },3000);
  }else if (email == '') {
    $('#notif_email').text(notif);
    setTimeout(function() {
      $('#notif_email').text('');
    },3000);
  }else {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/User/input_user'); ?>',
      type: 'POST',
      dataType: 'JSON',
      data: $('#form_user').serialize(),
      success: function (data){
        usertabel.ajax.reload(null, false);
        $('#Modaltambahuser').modal('hide');
        swal({
          title: "",
          text: "Berhasil!",
          type: "success",
          timer: 1300,
          showConfirmButton: false
        });
      }
    });
  }
}

// get data user untuk update
function ubah_userPengguna(idUser) {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/User/ubah_userPengguna?id_user=');?>'+idUser,
    type: 'GET',
    dataType: 'JSON',
    success: function (data) {
      $('[name="id_user_ubah_user"]').val(data.user[0].id_user);
      $('[name="nama_ubah_user"]').val(data.user[0].nama);
      $('[name="user_ubah_user"]').val(data.user[0].user);
      $('[name="email_ubah_user"]').val(data.user[0].email);
      // daftar port
      $('[name="id_port_ubah_user"]').html('');
      $('[name="id_port_ubah_user"]').append('<option value="'+data.user[0].id_port+'">'+data.user[0].port+'</option>');
      for (var i = 0; i < data.port.length; i++) {
        $('[name="id_port_ubah_user"]').append('<option value="'+data.port[i].id_port+'">'+data.port[i].port+'</option>');
      }
      // daftar divisi
      $('[name="id_divisi_ubah_user"]').html('');
      $('[name="id_divisi_ubah_user"]').append('<option value="'+data.user[0].id_divisi+'">'+data.user[0].divisi+'</option>');
      for (var i = 0; i < data.divisi.length; i++) {
        $('[name="id_divisi_ubah_user"]').append('<option value="'+data.divisi[i].id_divisi+'">'+data.divisi[i].divisi+'</option>');
      }
      // daftar level
      $('[name="id_level_ubah_user"]').html('');
      $('[name="id_level_ubah_user"]').append('<option value="'+data.user[0].id_level+'">'+data.user[0].level+'</option>');
      for (var i = 0; i < data.level.length; i++) {
        $('[name="id_level_ubah_user"]').append('<option value="'+data.level[i].id_level+'">'+data.level[i].level+'</option>');
      }


    }
  });
}

// update data user yg di ubah
function update_userPengguna() {
  if($('[name="nama_ubah_user"]').val() == ''){
    $('.nama_ubah_user').text('Data kosong!');
  }else if ($('[name="user_ubah_user"]').val() == '') {
    $('.user_ubah_user').text('Data kosong!');
  }else if ($('[name="email_ubah_user"]').val() == '') {
    $('.email_ubah_user').text('Data kosong!');
  }else {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/User/update_userPengguna'); ?>',
      type: 'post',
      dataType: 'JSON',
      data: $('#form_ubahUser').serialize(),
      success: function (data) {
        usertabel.ajax.reload(null, false);
        $('#ModalUbahUser').modal('hide');
        swal({
          title: "",
          text: "Berhasil!",
          type: "success",
          timer: 1300,
          showConfirmButton: false
        });
      }
    });
  }

  setTimeout(function (){
    $('.nama_ubah_user').text('Data kosong!');
    $('.user_ubah_user').text('Data kosong!');
    $('.email_ubah_user').text('Data kosong!');
  },2000);
}

// reset password
function reset_pw_user(id_user) {
  swal({
    title: "Reset Pasword?",
    text: "Pasword Dafaul = '12345678'",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#007fd6",
    confirmButtonText: "Okey",
    closeOnConfirm: false,
    cancelButtonText: "Batal"
  }, function(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/User/reset_password?id_user='); ?>'+id_user,
      type: 'GET',
      dataType: 'JSON',
      success: function (data) {
        usertabel.ajax.reload(null, false);
        swal({
          title: "",
          text: "Berhasil!",
          type: "success",
          timer: 1300,
          showConfirmButton: false
        });
      }
    });
  });
}

</script>
