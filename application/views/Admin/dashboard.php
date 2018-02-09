<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
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
                  <th>Km Saat Ini</th>
                  <th>Keadaan</th>
                  <th>Aksi</th>
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
           <div class="col-md-12">
             <div class="col-md-3 col-xs-12">
              <div class="input-group">
               <input class="form-control datepicker223" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" type="text" name="data_tgl" value="<?php echo $tanggal; ?>" readonly>
               <span class="input-group-addon bg-red" style="border-radius:0;"><i class="fa fa-calendar"></i></span>
              </div>
             </div>

             <div class="col-md-1 col-sm-4 btn-group">
                <div class="dropdown-toggle btn bg-info" data-toggle="dropdown">Penggunaan > 1 hari <i class="fa fa-caret-down"></i> <span class="label label-info" id="jumlah_blm_pulang"></span></div>
                <ul class="dropdown-menu" role="menu" id="daftar_blm_pulang" style="border: 0px solid #000;padding: 0px;margin-left:15px;"></ul>
             </div>

             <div class="pull-right">
               <a target="_blank" class="btn bg-purple btn-md" href="<?php echo base_url('Pdf/Laporan_peminjaman?date='.$tanggal); ?>">Convert to PDF  <i class="fa fa-file"></i></a>
             </div>


           </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
           <div class="form-group col-md-12">
            <div style="border-radius:1%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
             <div class="box-header bg-danger">
              <h3 class="box-title"><i class="fa fa-minus-circle text-red margin-r-5"></i> Kendaraan Keluar</h3>
             </div>
             <div class="box-body">
              <table class="table table-bordered table-striped tbl_kendaraan_Keluar">
               <thead>
                <tr style="background:#d4d4d4;">
                  <th width="1px">#</th>
                  <th>Nomor Polisi</th>
                  <th>Jenis</th>
                  <th>Divisi</th>
                  <th>Peminjam</th>
                  <th>Waktu Keluar</th>
                  <th>Km Keluar</th>
                  <th>Keadaan</th>
                  <th>Ket Kembali</th>
                  <th>Ket Cek</th>
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

  </section>
</div>

<!-- Modal Stasus Keadaan -->
<div class="modal fade bs-example-modal-sm" id="ModalPerbaruiKeadaan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-aqua">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tijau Keadaan</h4>
      </div>
      <div class="modal-body">
       <div class="row">
        <form id="form_update_keadaan">
          <input type="hidden" name="id_kendaraan">
          <div class="col-md-12" style="margin-bottom:8px;">
            <span>No Polisi :  </span> <b id="noPolis_keadaan"></b>
          </div>
          <div class="col-md-12">
            <span>Keadaan :</span>
            <select name="id_keadaan" class="form-control" onchange="kolom_input_Info()">
            </select>
          </div>

          <div class="col-md-12" style="display:none;" id="info_data">
            <span>Info :</span>
            <textarea class="form-control textarea-input" rows="4" placeholder="Text.." name="info"></textarea>
          </div>
        </form>
       </div>
      </div>
      <div class="modal-footer" style="text-align:center;">

        <button type="button" class="btn bg-aqua" onclick="update_keadaan()">Perbarui</button>
      </div>
    </div>
  </div>
</div>
<!--/ Modal Status Keadaan -->

<!-- Modal Detail Peminjaman -->
<div class="modal fade bs-example-modal-lg" id="Modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Detail Peminjaman Kendaraan</h4>
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
      <div class="modal-footer" style="text-align:center;">
        <button type="button" class="btn bg-blue" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!--/ Modal Detail Peminjaman -->

<!-- Input Hasil Cek kendaraan -->
<div class="modal fade bs-example-modal-sm" id="ModalCek" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cek Pengembalian</h4>
      </div>
      <div class="modal-body">
       <div class="row">
        <form id="form_inputCek">
          <input type="hidden" name="id_atf_masuk">
          <div class="col-md-12" style="margin-bottom:4px;">
            <span>No Polisi :  </span> <b id="noPolis_atf"></b>
          </div>
          <div class="col-md-12" style="margin-bottom:4px;">
            <span>Pengambil :  </span> <b id="cek_pengambil"></b>
          </div>
          <div class="col-md-12" style="margin-bottom:4px;">
            <span>Pengembali :  </span> <b id="cek_pengembali"></b>
          </div>
          <div class="col-md-12" style="margin-bottom:4px;">
            <span>Pengecek :</span>
            <select name="id_teknisi" class="form-control">
            </select>
          </div>
          <div class="col-md-12" style="margin-bottom:4px;">
            <span>Keadaan Kembali :</span>
            <select name="id_keadaan" class="form-control option-keadaan">
            </select>
          </div>
          <div class="col-md-12">
            <span>Notes :</span>
            <textarea class="form-control" rows="5" placeholder="Notes.." name="notes_cek">Tidak ada</textarea>
          </div>
        </form>
       </div>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="button" class="btn btn-success" onclick="input_hasil_cek()">Okey</button>
      </div>
    </div>
  </div>
</div>
<!--/ Input Hasil Cek kendaraan -->

<!-- Modal Info -->
<div class="modal fade bs-example-modal-sm" id="ModalInfo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-maroon">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-info-circle"></i> Info</h4>
      </div>
      <div class="modal-body">
       <div class="row">
        <div class="col-md-12" style="margin-bottom:8px;">
          <span>No Polisi :  </span> <b id="info_NoPolisi"></b>
        </div>
        <div class="col-md-12">
          <span>Info :</span>
          <div id="isi_dataInfo">
          </div>
        </div>
       </div>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="button" data-dismiss="modal" class="btn bg-maroon">Keluar</button>
      </div>
    </div>
  </div>
</div>
<!--/ Modal Info /-->

<!-- javascript tinymce -->
<script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<!--/ javascript tinymce -->

<script type="text/javascript">
tinymce.init({
  selector:'.textarea-input',
  menubar: false,
  fontsize_formats: "4pt 6pt 8pt 9pt 10pt 11pt 14pt",
  height : "230",
  plugins: "textcolor",
  toolbar: "insertfile undo redo | forecolor backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});

// menampilkan data untuk info kendaraan
function kolom_input_Info(){
  var cekdata = $('#form_update_keadaan [name="id_keadaan"]').val();
  if(cekdata == '1'){
    $('#info_data').css({'display':'none'});
  }else {
    $('#info_data').css({'display':'block'});
  }
}

$(document).ready(function(){
  kendaraan_standBy = $('.table_kendaraan').DataTable({
    //lengthMenu: [[25,50,100,-1], [25,50,100, "All"]],
    ordering: true,
    processing: false,
    scrollX: true,
    serverSide: false,
    ajax: {
      url: "<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/kendaraan_standBy'); ?>",
      type: 'POST',
    }
  });
  setInterval(function(){
    kendaraan_standBy.ajax.reload(null, false);
  },30000);

  //setTimeout(dataReg,10);
  info_jumlah();

  tbl_kdr_keluar = $('.tbl_kendaraan_Keluar').DataTable({
    responsive: true,
    lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
    order: [[0, "desc"]],
    scrollCollapse: true,
    ordering: true,
    processing: false,
    scrollX: true,
    serverSide: false,
    ajax: {
      url: "<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/kendaraan_keluar?data_tgl='.$tanggal); ?>"
    }
  });

  setInterval(function (){
    tbl_kdr_keluar.ajax.reload(null, false);
    info_jumlah();
  },20000);

});

// daftar select option keadaan
$(function(){
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/daftar_keadaan'); ?>',
    dataType: 'JSON',
    success: function (data) {
      $('.option-keadaan').html('');
      for (var i = 0; i < data.length; i++) {
        $('.option-keadaan').append('<option value="'+data[i].id_keadaan+'">'+data[i].keadaan+'</option>');
      }
    }
  });
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
// daftar nama teknisi
$(function(){
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/User/teknisi')?>',
    dataType: 'JSON',
    success: function (data) {
     $('#form_inputCek [name="id_teknisi"]').html('');
     for (var i = 0; i < data.length; i++) {
      $('#form_inputCek [name="id_teknisi"]').append('<option value="'+data[i].id_user+'">'+data[i].nama+'</option>');
     }
    }
  });
});

// menampilkan data detail
function aksi_detail(id_keluar) {
  $.ajax({
    url: "<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/modalDetail_Peminjam/'); ?>"+id_keluar,
    dataType: "JSON",
    success: function(data){
      $('#no_pls').html('');
      $('#no_pls').append('<i class="fa ' + data.keluar[0].icon + ' "></i> ' +  data.keluar[0].nomor_polisi);
      // info penggunaan keluar
      $('#detail_keluar').html('');
      // menampilkan catatan
      //if(data.keluar[0].id_tujuan == '2'){
        var info_catatan = '<br><b>Catatan : </b>'
        +data.keluar[0].catatan_keluar;
      // }else {
      //   var info_catatan = '';
      // }
      $('#detail_keluar').append('<li class="list-group-item">Peminjam : ' + data.keluar[0].nama +'</li><li class="list-group-item">Waktu : ' + data.keluar[0].tgl_keluar + ' - ' + data.keluar[0].waktu_keluar + '</li><li class="list-group-item">Km : ' + data.keluar[0].km_keluar + '</li><li class="list-group-item">Tujuan Pengguna : '+ data.keluar[0].tujuan +info_catatan+'</li>');

      // info penggunaan masuk
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

// menampilkan keadaan kendaraan
function menapilkan_opsi_keadaan(id) {
  //$('#form_update_keadaan')[0].reset('');
  $('[name="id_kendaraan"]').val(id);
  $('#info_data').css({'display':'none'});
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/data_keadaan?id_kendaraan='); ?>'+id,
    type: 'GET',
    dataType: 'JSON',
    success: function (data) {
      $('[name="id_keadaan"]').html('');
      $('[name="id_keadaan"]').append('<option value="'+data.info[0].id_keadaan+'">'+data.info[0].keadaan+'</option>');

      $('#noPolis_keadaan').html('');
      $('#noPolis_keadaan').text(data.info[0].nomor_polisi);

      for (var i = 0; i < data.option.length; i++) {
        $('[name="id_keadaan"]').append('<option value="'+data.option[i].id_keadaan+'">'+data.option[i].keadaan+'</option>');
      }
    }
  });
}

// update keadaan kendaraan
function update_keadaan(){
  var cek = $('#form_update_keadaan [name="id_keadaan"').val();
  if(cek == '1'){
    $('[name="info"]').text('');
  }else {
    var infodata = tinyMCE.get('info');
    var convert_infodata = infodata.getContent();
    $('[name="info"]').text(convert_infodata);
  }

  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/perbarui_keadaan'); ?>',
    type: 'POST',
    data: $('#form_update_keadaan').serialize(),
    dataType: 'JSON',
    success: function (data) {
      $('#form_update_keadaan')[0].reset('');
      setTimeout(function(){
        kendaraan_standBy.ajax.reload(null, false);
      },10);
      $('#ModalPerbaruiKeadaan').modal('hide');
      swal({
        text: 'Berhasil, di Perbarui',
        title: '',
        type: 'success',
        timer: 1300,
        showConfirmButton: false
      });
    }
  });
}

// cek data pengembali
function cek_dataPengembali(id,idmasuk) {
  $.ajax({
    url: "<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/modalDetail_Peminjam/'); ?>"+id,
    dataType: "JSON",
    success: function(data){
      $('[name="id_atf_keluar"]').val('');
      $('#cek_pengambil').text('');
      $('#cek_pengembali').text('');
      $('#noPolis_atf').text('');

      $('[name="id_atf_masuk"]').val(idmasuk);
      $('#cek_pengambil').text(data.keluar[0].nama);
      $('#cek_pengembali').text(data.masuk[0].nama);
      $('#noPolis_atf').text(data.keluar[0].nomor_polisi);
    }
  });
}

// input hasil cek
function input_hasil_cek() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/input_cek_kendaraan'); ?>',
    type: 'POST',
    dataType: 'JSON',
    data: $('#form_inputCek').serialize(),
    success: function (data) {
      setTimeout(function () {
        tbl_kdr_keluar.ajax.reload(null, false);
      },10);

      $('#ModalCek').modal('hide');
      swal({
        text: 'Berhasil, di Perbarui',
        title: '',
        type: 'success',
        timer: 1300,
        showConfirmButton: false
      });
      // hapus set interval
      //clearInterval(reload_tbl_keluar);
    }
  });
}

// menampilkan catatan info keadaan
function catatanInfo_kendaraan(id){ //id info yang di cari
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Info_peminjaman/catatan_info?id_info='); ?>'+id ,
    type: 'GET',
    dataType: 'JSON',
    success: function (data) {
      $('#info_NoPolisi').html('');
      $('#info_NoPolisi').text(data[0].nomor_polisi);
      $('#isi_dataInfo').html('');
      $('#isi_dataInfo').append(data[0].info);
    }
  });
}

</script>
