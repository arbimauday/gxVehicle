<!-- Full Width Column -->
<div class="content-wrapper">
 <div class="container">
  <section class="content-header">
    <h1>Penggunaan Kendaraan<small></small></h1>
    <ol class="breadcrumb" style="list-style-type: none;">
      <li><button type="button" class="btn bg-maroon btn-sm" data-toggle="modal" data-target="#ModalKomplen" onclick="user()"><i class="fa fa-bullhorn"></i> Keluhan</button></li>
      <li><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ModalPengembalianKunci" onclick="kendaraan_keluar()"><i class="fa fa-key"></i> Pengembalian Kunci</button></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
   <div class="row">
    <section class="col-lg-12 connectedSortable">
     <div class="box box-info">
      <div class="box-body">
       <div class="form-group col-md-12">
        <div style="border-radius:1%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
          <div class="box-header bg-info">
            <h3 class="box-title"><i class="fa fa-arrow-circle-right text-blue margin-r-5"></i> Kendaraan Yang Ada</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped table_kendaraan">
             <thead>
              <tr style="background:#d4d4d4;">
                <th width="1px">#</th>
                <th>Nomor Polisi</th>
                <th>Jenis</th>
                <th>Divisi</th>
                <th>Keadaan</th>
                <th>Km Saat Ini</th>
                <th>Action</th>
              </tr>
             </thead>
            </table>
          </div>
        </div>
       </div>
      </div>
     </div>
    </section>

    <section class="col-lg-12 connectedSortable">
      <div class="box box-danger">
        <!-- box-header -->
        <div class="box-header">
         <div class="col-md-2">
           <div class="input-group">
            <input class="form-control datepicker223" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" type="text" name="data_tgl" value="<?php echo $tanggal; ?>" readonly style="cursor:pointer">
            <span class="input-group-addon bg-maroon" style="border-radius:0;"><i class="fa fa-calendar"></i></span>
           </div>
         </div>

         <div class="col-md-3">
          <div class="btn-group">
            <div class="dropdown-toggle btn bg-info" data-toggle="dropdown" style="font-size:15px;">Penggunaan > 1 hari <i class="fa fa-caret-down"></i> <span class="label label-info" id="jumlah_blm_pulang"></span></div>
            <ul class="dropdown-menu" role="menu" id="daftar_blm_pulang"></ul>
          </div>
         </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
         <div class="form-group col-md-12">
          <div style="border-radius:1%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
           <div class="box-header bg-danger">
            <h3 class="box-title"><i class="fa fa-minus-circle text-red margin-r-5"></i> Kendaraan Yang Keluar</h3>
           </div>
           <div class="box-body">
            <table class="table table-bordered table-striped table-ajax">
             <thead>
              <tr style="background:#d4d4d4;">
               <th width="1px">#</th>
               <th>Nomor Polisi</th>
               <th>Jenis</th>
               <th>Divisi</th>
               <th>Peminjam</th>
               <th>Waktu Keluar</th>
               <th>Km Keluar</th>
               <th>Keadaan Keluar</th>
               <th>Ket Kembali</th>
               <th>Km Penggunaan</th>
               <th>Action</th>
              </tr>
             </thead>
            </table>
           </div>

          </div>

         </div>

        </div>
      </div>
    </section>

   </div>

      <!-- /.box -->
  </section>
 </div>
</div>


<!-- Modal Pengambilan Kunci -->
<div class="modal fade bs-example-modal-lg" id="ModalPeminjam"  role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-green" style="/*background: #efefef;*/text-align:center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Form Peminjaman</h4>
      </div>

     <form id="formPeminjaman">
      <div class="modal-body">
       <div class="row">
         <input type="hidden" name="idkendaraan">
         <!--nama peminjaman-->
         <div class="form-group col-md-6">
           <span>Nama Peminjam</span>
           <span id="nama_peminjam" class="text-red pull-right" style="display:none;">Data kosong*</span>
           <div class="input-group">
             <span class="input-group-addon border-lingkaran"><i class="fa fa-user" style="color:#ababab;"></i></span>
             <select class="form-control border-input select2 data-user" name="v_iduser">
             </select>
           </div>
         </div>
         <!--password peminjaman-->
         <div class="form-group col-md-6">
           <span>Password</span>
           <span id="pass_peminjam" class="text-red pull-right" style="display:none;">Data kosong*</span>
           <div class="input-group">
             <span class="input-group-addon border-circle"><i class="fa fa-lock" style="color:#ababab;"></i></span>
             <input type="password" class="form-control border-input" placeholder="************" name="pass">
           </div>
         </div>

         <div class="form-group col-md-12">
           <span>Tujuan Penggunaan</span>
           <span id="notif_tujuanPenggunaan" class="text-red pull-right" style="display:none;">Data kosong*</span>
           <div class="input-group">
             <span class="input-group-addon border-lingkaran"><i class="fa fa-mail-forward" style="color:#ababab;"></i></span>
             <select class="form-control border-input data-keperluan" name="id_tujuan" onchange="cekcatatan()">
             </select>
           </div>
         </div>

         <div class="form-group col-md-12" id="dataCatatan" style="display:none;">
         </div>

         <div class="col-md-12" id="infodari-teknisi">
            <div class="box box-info box-solid collapsed-box" style="margin-bottom:0px;">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Info dari Teknisi</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body" style="display: none;">
                <div id="dataInfo" style="/*border:1px solid #000;padding:5px 8px;*/">
                </div>
              </div>
            </div>

         </div>

       </div>
      </div>

      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-success" onclick="pinjam_kendaraan()">Okey!</button>
      </div>
     </form>

    </div>
  </div>
</div>

<!-- Modal Kembalikan Kunci -->
<div class="modal fade bs-example-modal-lg" id="ModalPengembalianKunci"  role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-aqua" style="text-align:center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-key text-white margin-r-5"></i> Pengembalian Kunci</h4>
      </div>

    <form id="formPengembalikan_kunci">
      <div class="modal-body" style="padding-top:6px;">
       <div class="row">
         <div class="form-group col-md-12">
           <div class="box-body" style="background:#f4f4f4;">
             <div class="form-group col-md-6">
               <span>No. Polisi</span>
               <span id="icon-search" class="pull-right text-red" style="display:none;">data kosong*</span>
               <div class="input-group">
                 <span class="input-group-addon border-circle"><i class="fa fa-search" style="color:#ababab;"></i></span>
                 <select class="form-control border-input select2" name="id_aktifitas" onchange="data_kendaraan_keluar()">
                 </select>
               </div>
             </div>

             <div class="form-group col-md-6">
               <span>Km Masuk</span>
               <span id="icon-km" class="pull-right text-red" style="display:none;">data kosong*</span>
               <span id="notif_kminput" class="pull-right text-red"></span>
               <div class="input-group">
                 <span class="input-group-addon border-circle"><i class="fa fa-tachometer" style="color:#ababab;"></i></span>
                 <input type="number" class="form-control border-input" placeholder="Km. Masuk" name="km_masuk">
               </div>
             </div>

             <div class="form-group col-md-6">
               <span>Nama Pengembali</span>
               <span id="icon-user" class="pull-right text-red" style="display:none;">data kosong*</span>
               <div class="input-group">
                 <span class="input-group-addon border-circle"><i class="fa fa-user" style="color:#ababab;"></i></span>
                 <select class="form-control border-input select2 data-user" name="id_user">
                 </select>
               </div>
             </div>
             <div class="form-group col-md-6">
              <span>Password</span>
              <span id="icon-pass" class="pull-right text-red" style="display:none;">data kosong*</span>
              <div class="input-group">
                <span class="input-group-addon border-circle"><i class="fa fa-lock" style="color:#ababab;"></i></span>
                <input type="password" class="form-control border-input" placeholder="************" name="pass_pengembali">
              </div>
             </div>

             <!--div class="form-group col-md-12">
               <span class="margin-r-5">Sertakan Nota Bensin??</span>
                 <span class="margin-r-5"><input type="radio" name="datanota" value=""> Ya</span>
                <span class="margin-r-5"><input type="radio" name="datanota"> Tidak</span>
             </div-->

           </div>
         </div>

         <div class="col-md-12">
          <div class="box-header" style="background:#f2dede;">
            <i class="fa fa-minus-circle text-red margin-r-5"></i> Info Waktu Keluar
          </div>
          <ul class="list-group" id="data_kendaraan_keluar"></ul>
         </div>

       </div>
      </div>

      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn bg-aqua" onclick="kembalikan_kunci()">Okey!</button>
      </div>

    </form>

    </div>
  </div>
</div>

<!-- Modal Info peminjam  -->
<div class="modal fade bs-example-modal-lg" id="Modaldetail"  role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Peminjaman Kendaraan</h4>
      </div>
      <div class="modal-body" style="padding-top:0;">
       <div class="row">
        <div class="form-group col-md-12 text-center" style="background:#f4f4f4;">
          <h4><strong id="no_pls"></strong></h4>
        </div>

        <div class="col-md-6">
          <div class="box-header" style="background:#f2dede;">
            <i class="fa fa-minus-circle text-red margin-r-5"></i> Keluar
          </div>
          <ul class="list-group" id="detail_keluar"></ul>
        </div>

        <div class="col-md-6">
          <div class="box-header" style="background:#d9edf7;">
            <i class="fa fa-arrow-circle-right text-blue margin-r-5"></i>Masuk
          </div>
          <ul class="list-group" id="detail_masuk"></ul>
        </div>

        <div class="col-md-6">
          <div class="box-header" style="background:#66ffb9;">
            <i class="fa fa-check-circle text-green margin-r-5"></i> Catatan Pengecekan Kendaraan (<b>Masuk</b>)
          </div>
          <ul class="list-group" id="catatan_pengecekan_masuk"></ul>
        </div>

       </div>
      </div>
      <div class="modal-footer" style="background:#f7f7f7;text-align:center;">
        <button type="button" class="btn bg-blue" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Komplen Kerusahkan kendaraan -->
<div class="modal fade bs-example-modal-lg" id="ModalKomplen"  role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-maroon" style="/*background: #efefef;*/text-align:center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa  fa-bullhorn"></i> Keluhan / Komplen / Laporan Kerusakan</h4>
      </div>

      <div class="modal-body">
       <div class="row">
        <form id="formKomplen">
         <div class="form-group col-md-12">
           <span>No. Polisi</span>
           <span id="komplen_kendaraan" class="text-red pull-right" style="display:none;">Data kosong*</span>
           <div class="input-group">
             <span class="input-group-addon border-lingkaran"><i class="fa fa-search" style="color:#ababab;"></i></span>
             <select class="form-control border-input select2 data-kendaraan" name="id_kendaraan_komplen">
             </select>
           </div>
         </div>

         <div class="form-group col-md-6">
           <span>Nama</span>
           <span id="nama_komplen" class="text-red pull-right" style="display:none;">Data kosong*</span>
           <div class="input-group">
             <span class="input-group-addon border-lingkaran"><i class="fa fa-user" style="color:#ababab;"></i></span>
             <select class="form-control border-input select2 data-user" name="id_user_komplen">
             </select>
           </div>
         </div>
         <div class="form-group col-md-6">
          <span>Password</span>
          <span id="notif_pass_komplen" class="text-red pull-right" style="display:none;">Data kosong*</span>
          <div class="input-group">
            <span class="input-group-addon border-circle"><i class="fa fa-lock" style="color:#ababab;"></i></span>
            <input type="password" class="form-control border-input" placeholder="************" name="pass_komplen">
          </div>
         </div>

         <div class="col-md-12">
          <span>Keluhan</span>
          <span id="notif_keluhan" class="text-red pull-right" style="display:none;">Data kosong*</span>
          <textarea class="form-control" rows="3" placeholder="Text.." name="komplen" style="border-radius: 8px;"></textarea>
         </div>
        </form>
       </div>
      </div>

      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn bg-maroon" onclick="input_komplen()">Komplen</button>
      </div>

    </div>
  </div>
</div>
<!--/ Modal Komple Kerusahkan kendaraan -->

<script type="text/javascript">
// menampilkan data user
function user() {
  $('#formKomplen')[0].reset();
  daftar_kendaraan();
  // $("#formPengembalikan_kunci")[0].reset();
  // $('#formPeminjaman')[0].reset();
  //$('#data_kendaraan_keluar').html('');

  $.ajax({
    url: '<?php echo base_url('Pengguna/Data_Ajax/Daftar/user'); ?>',
    dataType: "JSON",
    success: function(data) {
      $('.data-user').html('');
      $('.data-user').append('<option value="">Daftar. Nama</option>');
      for (var i = 0; i < data.length; i++){
        $('.data-user').append('<option value="'+data[i].id_user+'">'+data[i].nama+'</option>');
      }
    }
  });
}

// daftar kendaraan dalam select option
function daftar_kendaraan(){
  $.ajax({
    url: '<?php echo base_url('Pengguna/Data_Ajax/Daftar/kendaraan'); ?>',
    dataType: 'JSON',
    success: function (data){
      $('.data-kendaraan').html('');
      $('.data-kendaraan').append('<option value="">No. Polisi</option>');
      for (var i = 0; i < data.length; i++) {
        $('.data-kendaraan').append('<option value="'+data[i].id_kendaraan+'">'+data[i].nomor_polisi+'</option>');
      }
    },
  });
}

// daftar keperluan
function keperluan() {
  $.ajax({
    url: '<?php echo base_url('Pengguna/Data_Ajax/Komplen/dataTujuan'); ?>',
    dataType: 'JSON',
    success: function (data) {
      $('.data-keperluan').html('');
      $('.data-keperluan').append('<option value="">-- Tujuan --</option>');
      for (var i = 0; i < data.length; i++) {
        $('.data-keperluan').append('<option value="'+data[i].id_tujuan+'">'+data[i].tujuan+'</option>');
      }
    }
  });
}
//menampilkan catatan penggunaan
function cekcatatan(){
  $('#dataCatatan').addClass('form-group');
  var idTujuan = $('[name="id_tujuan"]').val();
  if(idTujuan != ''){
    $('#dataCatatan').css({'display':'block'});
    $('#dataCatatan').html('');
    $('#dataCatatan').append('<span>Catatan</span><span id="notif_catatan_keluar" class="text-red pull-right" style="display:none;">Data kosong*</span><textarea class="form-control" rows="2" placeholder="Text.." name="catatan_keluar" style="border-radius: 8px;"></textarea>');
  }else {
    $('#dataCatatan').html('');
    $('#dataCatatan').css({'display':'none'});
  }
}

// proses pengembalian kunci
function kembalikan_kunci() {
  var id_aktifitas = $('[name="id_aktifitas"]').val();
  var datakm_masuk  = $('[name="km_masuk"]').val();
  var minNumber_km_masuk = $('[name="km_masuk"]').attr("min");
  var id_user   = $('[name="id_user"]').val();
  var pass      = $('[name="pass_pengembali"]').val();
  // cek km
  if(parseInt(datakm_masuk) >= parseInt(minNumber_km_masuk)){
    $('#notif_kminput').text('');
    if(id_aktifitas == ""){
      $('#icon-search').css({'display': 'block'});
      $('#icon-km').css({'display': 'none'});
      $('#icon-user').css({'display': 'none'});
      $('#icon-pass').css({'display': 'none'});
      setTimeout(function(){
        $('#icon-search').css({'display': 'none'});
      },3000);
    }else if (datakm_masuk == "") {
      $('#icon-km').css({'display': 'block'});
      $('#icon-search').css({'display': 'none'});
      $('#icon-user').css({'display': 'none'});
      $('#icon-pass').css({'display': 'none'});
      setTimeout(function hidenotif(){
        $('#icon-km').css({'display': 'none'});
      },3000);
    }else if (id_user == "") {
      $('#icon-user').css({'display': 'block'});
      $('#icon-km').css({'display': 'none'});
      $('#icon-search').css({'display': 'none'});
      $('#icon-pass').css({'display': 'none'});
      setTimeout(function(){
        $('#icon-user').css({'display': 'none'});
      },3000);
    }else if (pass == "") {
      $('#icon-pass').css({'display': 'block'});
      $('#icon-km').css({'display': 'none'});
      $('#icon-user').css({'display': 'none'});
      $('#icon-search').css({'display': 'none'});
      setTimeout(function(){
        $('#icon-pass').css({'display': 'none'});
      },3000);
    }else {

       $.ajax({
         url: '<?php echo base_url('Pengguna/Data_Ajax/Daftar/pengembalian_kunci'); ?>',
         type: 'POST',
         data: $('#formPengembalikan_kunci').serialize(),
         dataType: "JSON",
         success: function(data) {
           if(data == '1'){
             $("#formPengembalikan_kunci")[0].reset();
             $('#data_kendaraan_keluar').html('');
             $('#ModalPengembalianKunci').modal('hide');
               kendaraan_standBy.ajax.reload(null, false);
               datatable.ajax.reload(null, false);
               info_jumlah();
             swal({
             title: "",
             text: "Okey.. Proses Selesai!",
             type: "success",
             timer: 1500,
             showConfirmButton: false
             });
           }else {
             swal({
             title: "",
             text: "Password Salah!",
             type: "error",
             timer: 1500,
             showConfirmButton: false
             });
           }
         },
         error: function () {
           swal({
           title: "",
           text: "Password Salah!",
           type: "error",
           timer: 1500,
           showConfirmButton: false
           });
         }
       });
    }
  }else{
    $('#notif_kminput').text('Minal KM '+minNumber_km_masuk+'*');
    setTimeout(function(){
      $('#notif_kminput').text('');
    },3000);
  }
}

// daftar kendaraan keluar
function kendaraan_keluar() {
  user();
  $('#data_kendaraan_keluar').html('');
  $("#formPengembalikan_kunci")[0].reset();
  $.ajax({
    url: '<?php echo base_url('Pengguna/Data_Ajax/Daftar/cari_noKendaraan'); ?>',
    dataType: "JSON",
    success: function(data){
      $('[name="id_aktifitas"]').html('');
      $('[name="id_aktifitas"]').append('<option value="">No. Polisi</option>');
      for (var i = 0; i < data.length; i++) {
        $('[name="id_aktifitas"]').append('<option value="'+data[i].id_atf_keluar+'">'+data[i].nomor_polisi+'</option>');
      }
    }
  });
}

// menampilkan data kendaraan keluar
function data_kendaraan_keluar() {
  var id_keluar = $('#formPengembalikan_kunci [name="id_aktifitas"]').val();
  if(id_keluar == ''){
    $('#data_kendaraan_keluar').html('');
  }else{
    $.ajax({
      url: "<?php echo base_url('Pengguna/Data_Ajax/Daftar/modalDetail_Peminjam/'); ?>"+id_keluar,
      dataType: "JSON",
      success: function (data) {
        // menampilkan catatan
        //if(data.keluar[0].id_tujuan == '2'){
          var info_catatan = '<br><b>Catatan : </b>'
          +data.keluar[0].catatan_keluar;
        // }else {
        //   var info_catatan = '';
        // }
        $('#data_kendaraan_keluar').html('');
        $('#data_kendaraan_keluar').append('<li class="list-group-item">Peminjam : ' + data.keluar[0].nama +'</li><li class="list-group-item">Waktu : ' + data.keluar[0].tgl_keluar + ' - ' + data.keluar[0].waktu_keluar + '</li><li class="list-group-item">Km : ' + data.keluar[0].km_keluar + '</li><li class="list-group-item">Tujuan Pengguna : '+ data.keluar[0].tujuan +info_catatan+'</li>');
        $('[name="km_masuk"]').html('');
        var min_km = data.keluar[0].data_km;
        if(min_km == false){
          var datamin_km = '0';
        }else {
          var datamin_km = data.keluar[0].data_km;
        }
        $('[name="km_masuk"]').attr("min", datamin_km);

        // $('[name="km_masuk"]').val(data.keluar[0].km_keluar);
      },error: function(iwoep, iudsp, saiu) {
        $('#data_kendaraan_keluar').html('');
        $('[name="km_masuk"]').html('');
        $('[name="km_masuk"]').attr("min", "0");
      }
    });
  }
}

// menampilkan id kendaraan
function idKendaraan(id) {
  $('#dataCatatan').css({'display':'none'});
  user();
  $('[name="idkendaraan"]').val(id);
  $('#dataCatatan').html('');
  $.ajax({
    url: '<?php echo base_url('Pengguna/Data_Ajax/Daftar/info?id_kendaraan='); ?>'+id,
    type: 'GET',
    dataType: 'JSON',
    success: function (data) {
       if(data == false){
         $('#infodari-teknisi').css({'display':'none'});
         $('#dataInfo').html('');
       }else {
        $('#infodari-teknisi').css({'display':'block'});
        $('#dataInfo').html('');
        $('#dataInfo').append(data[0].info);
      }
    },
    error: function (error,dataempty,erleo) {
      $('#infodari-teknisi').css({'display':'none'});
      $('#dataInfo').html('');
    }
  });
}

// cek user dan password peminjam
function pinjam_kendaraan() {
  var id_user = $('[name="v_iduser"]').val();
  var pass = $('[name="pass"]').val();
  var option = $('[name="id_tujuan"').val();
  console.log(option);
  if(id_user == ''){
    $('#nama_peminjam').css({'display':'block'});
    $('#pass_peminjam').css({'display':'none'});
    $('#notif_tujuanPenggunaan').css({'display':'none'});
    setTimeout(function () {
      $('#nama_peminjam').css({'display':'none'});
    },3000);
  }else if (pass == '') {
    $('#pass_peminjam').css({'display':'block'});
    $('#nama_peminjam').css({'display':'none'});
    $('#notif_tujuanPenggunaan').css({'display':'none'});
    setTimeout(function () {
      $('#pass_peminjam').css({'display':'none'});
    },3000);
  }else if (option == '') {
    $('#notif_tujuanPenggunaan').css({'display':'block'});
    $('#nama_peminjam').css({'display':'none'});
    $('#pass_peminjam').css({'display':'none'});
    setTimeout(function () {
      $('#notif_tujuanPenggunaan').css({'display':'none'});
    },3400);
  }else {
    $.ajax({
      url: '<?php echo base_url('Pengguna/Data_Ajax/Daftar/pinjam_kendaraan'); ?>',
      type: 'POST',
      dataType: "JSON",
      data: $('#formPeminjaman').serialize(),
      success: function(data){
        if(data == '1'){
          $('#formPeminjaman')[0].reset();
          $('#ModalPeminjam').modal('hide');
          $('[name="v_iduser"]').val('');
          $('[name="pass"]').val('');
          swal({
          title: "",
          text: "Okey.. Silahkan mengambil kunci!",
          type: "success",
          timer: 1500,
          showConfirmButton: false
          });
            kendaraan_standBy.ajax.reload(null, false);
            datatable.ajax.reload(null, false);
        }else if (data == '2') {
          swal({
          title: "",
          text: "Password salah!",
          type: "error",
          timer: 1500,
          showConfirmButton: false
          });
        }else if (data == '3') {
          $('#notif_catatan_keluar').css({'display':'block'});
          setTimeout(function () {
            $('#notif_catatan_keluar').css({'display':'none'});
          },5000);
        }else {
          $('[name="v_iduser"]').val('');
          $('[name="pass"]').val('');
          $('#ModalPeminjam').modal('hide');
          swal({
          title: "",
          text: "Kendaraan Ini Masih digunakan!",
          type: "warning",
          timer: 1500,
          showConfirmButton: false
          });
        }
      },
      error: function(jqXHR, dfxvxxzc, errorThrown) {
        console.log('gagal');
      }
    });

  }
}

$(document).ready(function(){
  setTimeout(user); // daftar user pengguna
  //setTimeout(daftar_kendaraan); // daftar kendaraan
  daftar_kendaraan();
  info_jumlah();
  keperluan();
  // kendaraan yang tidak keluar
  kendaraan_standBy = $('.table_kendaraan').DataTable({
    //lengthMenu: [[25,50,100,-1], [25,50,100, "All"]],
    ordering: true,
    processing: false,
    scrollX: true,
    serverSide: false,
    ajax: {
      url: "<?php echo base_url('Pengguna/Data_Ajax/Daftar/kendaraan_standBy'); ?>",
    }
  });
  setInterval(function(){
    kendaraan_standBy.ajax.reload(null, false);
  },30000);

  // kendaraan yang keluar
  datatable = $('.table-ajax').DataTable({
    destroy: true,
    lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
    order: [[0, "desc"]],
    ordering: true,
    scrollX: true,
    processing: false,
    serverSide: false,
    ajax: {
      url: "<?php echo base_url('Pengguna/Data_Ajax/Daftar/kendaraan_keluar'); ?>",
      type: 'POST',
      data: {data_tgl: $('[name="data_tgl"]').val()},
    },
  });
  setInterval(function (){
    datatable.ajax.reload(null, false);
  },30000);
});

// info jumlah peminjaman
function info_jumlah() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/info_jumlah'); ?>',
    dataType: 'JSON',
    success: function (data) {
      $('#jumlah_blm_pulang').text(data.jumlah);
      $('#daftar_blm_pulang').html('');
      for (var i = 0; i < data.daftar.length; i++) {
        $('#daftar_blm_pulang').append('<li style="border-bottom:1px solid #dadada;"><a class="btn bg-aqua btn-sm" data-toggle="modal" data-target="#Modaldetail" onclick="aksi_detail('+data.daftar[i].id_atf_keluar+')">'+data.daftar[i].nomor_polisi+'</a></li>');
      }
    }
  });
}

// menampilkan data detail
function aksi_detail(id_keluar) {
  $.ajax({
    url: "<?php echo base_url('Pengguna/Data_Ajax/Daftar/modalDetail_Peminjam/'); ?>"+id_keluar,
    dataType: "JSON",
    success: function(data){
      $('#no_pls').html('');
      $('#no_pls').append('<i class="fa ' + data.keluar[0].icon + ' "></i> ' +  data.keluar[0].nomor_polisi);

      // info penggunaan kendaraan keluar
      $('#detail_keluar').html('');
      // menampilkan catatan
      //if(data.keluar[0].id_tujuan == '2'){
        var info_catatan = '<br><b>Catatan : </b>'
        +data.keluar[0].catatan_keluar;
      // }else {
      //   var info_catatan = '';
      // }
      $('#detail_keluar').append('<li class="list-group-item">Peminjam : ' + data.keluar[0].nama +'</li><li class="list-group-item">Waktu : ' + data.keluar[0].tgl_keluar + ' - ' + data.keluar[0].waktu_keluar + '</li><li class="list-group-item">Km : ' + data.keluar[0].km_keluar + '</li><li class="list-group-item">Tujuan Pengguna : '+ data.keluar[0].tujuan +info_catatan+'</li>');

      // info penggunaan kendaraan masuk
      $('#detail_masuk').html('');
      if(data.notif[0] == '1'){
        $('#detail_masuk').append('<li class="list-group-item">Pengembali : ' + data.masuk[0].nama + '</li><li class="list-group-item">Waktu : ' + data.masuk[0].tgl_masuk + ' - ' + data.masuk[0].waktu_masuk + '</li><li class="list-group-item">Km : ' + data.masuk[0].km_masuk + '</li>');
      }else{
        $('#detail_masuk').append('<li class="list-group-item" style="border-radius:0px;">Belum Ada Laporan </li>');
      }

      // info pengecekan teknisi
      $('#catatan_pengecekan_masuk').html('');
      if(data.ifcatatan[0] == '1'){
        $('#catatan_pengecekan_masuk').append('<li class="list-group-item">Teknis : '+data.pengecekan[0].nama+'</li><li class="list-group-item">keadaan : '+data.pengecekan[0].keadaan+'</li><li class="list-group-item"><b>Catatan :</b> '+data.pengecekan[0].notes_cek+'</li>');
      }else {
        $('#catatan_pengecekan_masuk').append('<li class="list-group-item" style="border-radius:0px;">Belum Ada Pengecekan</li>');
      }
    }
  });
}

// input data komplen
function input_komplen() {
  var idKendaraan = $('[name="id_kendaraan_komplen"]').val();
  var user_komplen = $('[name="id_user_komplen"]').val();
  var pass_komplen = $('[name="pass_komplen"]').val();
  var catatan_komplen = $('[name="komplen"]').val();
  if(idKendaraan == ''){
    $('#komplen_kendaraan').css({'display':'block'});
    $('#nama_komplen').css({'display':'none'});
    $('#notif_pass_komplen').css({'display':'none'});
    $('#notif_keluhan').css({'display':'none'});
    setTimeout(function () {
      $('#komplen_kendaraan').css({'display':'none'});
    },3000);
  }else if (user_komplen == '') {
    $('#nama_komplen').css({'display':'block'});
    $('#komplen_kendaraan').css({'display':'none'});
    $('#notif_pass_komplen').css({'display':'none'});
    $('#notif_keluhan').css({'display':'none'});
    setTimeout(function () {
      $('#nama_komplen').css({'display':'none'});
    },3000);
  }else if (pass_komplen == '') {
    $('#notif_pass_komplen').css({'display':'block'});
    $('#komplen_kendaraan').css({'display':'none'});
    $('#nama_komplen').css({'display':'none'});
    $('#notif_keluhan').css({'display':'none'});
    setTimeout(function () {
      $('#notif_pass_komplen').css({'display':'none'});
    },3000);
  }else if (catatan_komplen == '') {
    $('#notif_keluhan').css({'display':'block'});
    $('#komplen_kendaraan').css({'display':'none'});
    $('#nama_komplen').css({'display':'none'});
    $('#notif_pass_komplen').css({'display':'none'});
    setTimeout(function () {
      $('#notif_keluhan').css({'display':'none'});
    },3000);
  }else {
    $.ajax({
      url: '<?php echo base_url('Pengguna/Data_Ajax/Komplen/input_komplen'); ?>',
      type: 'POST',
      data: $('#formKomplen').serialize(),
      dataType: 'JSON',
      success: function (data) {
        if(data == '0'){
          swal({
          title: "",
          text: "Password salah!",
          type: "error",
          timer: 1500,
          showConfirmButton: false
          });
        }else {
          $('#ModalKomplen').modal('hide');
          $('#formKomplen')[0].reset();
          swal({
          title: "",
          text: "Okey..",
          type: "success",
          timer: 1500,
          showConfirmButton: false
          });
        }
      }
    });
  }
}

</script>
