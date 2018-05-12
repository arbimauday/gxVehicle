<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1>Pengelolaan RAB<small><button type="button" class="btn btn-sm bg-red" onclick="self.history.back()">Kembali</button></small></h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-tag"></i> Master Barang</a></li>
    <li>Data Barang</li>
    <li class="active">Pengelola RAB</li>
   </ol>
 </section>

 <section class="content">
  <div class="row">
   <div class="col-lg-12 connectedSortable">

    <div class="box box-primary">
      <div class="box-body">

       <!-- Info RAB -->
       <div class="col-md-3" style="padding:5px;">
        <div class="box" style="border-radius:0%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
         <div class="box-header bg-blue" style="color:#fff;border-radius:2%;">
          <h3 class="box-title">Info RAB</h3>
         </div>
         <div class="box-body">
          <?php foreach ($infoRab as $if) { ?>
            <div class="col-md-12 border_bottom">
             <b>No RAB</b>
             <p class="paragraf-0"><?php echo $if->no_rab; ?></p>
            </div>

            <div class="col-md-12 border_bottom">
             <b>Tanggal</b>
             <p class="paragraf-0"><?php echo $if->tgl_rab; ?></p>
            </div>

            <div class="col-md-12 border_bottom">
             <b>Jenis Rab</b>
             <p class="paragraf-0"><?php echo $if->jenis_rab; ?></p>
            </div>

            <div class="col-md-12 border_bottom">
             <b>Status Rab</b>
             <p class="paragraf-0"><?php echo $if->sts_rab; ?></p>
            </div>

            <div class="col-md-12 border_bottom">
             <b>Total Pengajuan</b>
             <p class="paragraf-0 text-yellow" id="total_ajukan"></p>
            </div>

            <div class="form-group col-md-12 border_bottom">
             <b>Total Pembelian</b>
             <p class="paragraf-0 text-green" id="total_pembelian"></p>
            </div>

            <?php if($if->id_sts_rab == '0'){ ?>
            <div class="col-md-12 btn-rab">
             <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-plus-circle text-info"></i></span>
              <button class="form-control btn-default" type="button" data-toggle="modal" data-target="#Modaltambahbarang">Tambah Nama Barang</button>
             </div>
            </div>
            <div class="form-group col-md-12 btn-rab">
             <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-cart-plus text-info"></i></span>
              <button class="form-control btn-default" type="button" data-toggle="modal" id="btn-pembelian" data-target="#ModalPembelian">Pembelian Barang</button>
             </div>
            </div>

            <div class="col-md-12 text-center">
              <button type="button" class="btn btn-sm btn-success" onclick="konfirmasi_selesai()">Selesai!</button>
            </div>
          <?php }else if ($if->id_sts_rab == '1') { ?>
            <div class="col-md-12 text-center">
              <button type="button" class="btn btn-sm btn-info" onclick="update_stok_barang()">Update Stok</button>

              <button type="button" class="btn btn-sm btn-success" onclick="konfir_realisasi()">Selesai!</button>
            </div>
          <?php } } ?>
         </div>
        </div>
       </div>


       <div class="col-md-9" style="padding:5px;">
         <!-- Tabel Pembelian Barang -->
          <div class="box" style="border-radius:0%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
           <div class="box-header" style="background:#3c8dbc;color:#fff;border-radius:2%;">
            <h3 class="box-title">Daftar Barang</h3>
           </div>
           <div class="box-body">
             <div class="box-body table-responsive">
              <table class="table table-bordered table-striped tbl-pembelian">
               <thead>
                <tr style="background:#d4d4d4;">
                 <th width="1px">#</th>
                 <th>Barang</th>
                 <th>Jumlah</th>
                 <th>Harga Per 1</th>
                 <th>Total Harga</th>
                 <th>Merek / Kw</th>
                 <th>Ket</th>
                 <th>Aksi</th>
                </tr>
               </thead>
              </table>
             </div>
           </div>
          </div>
         <!-- Tabel Pembelian Barang -->
       </div>


      </div>
    </div>

   </div>
  </div>
</section>

</div>

<!-- Modal Pembelian Barang -->
<div class="modal fade" id="ModalPembelian" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#fbf8f8;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-cart-plus text-info"></i> Pembelian Barang</h4>
      </div>
      <div class="modal-body">
       <div class="row">
        <form id="form_pembelian">
          <div class="form-group col-md-12">
            <span id="notif_select" class="pull-right" style="display:none;"></span>
            <label for="recipient-name" class="control-label">Nama Barang</label>
            <select class="form-control select2 select2-hidden-accessible" onchange="info_barang()" name="id_barang" style="width: 100%;"></select>
          </div>

          <div class="form-group col-md-12" id="info_barang">
          </div>

        </form>
       </div>
      </div>
      <div class="modal-footer" style="background:#fbf8f8;text-align:center;">
        <!--button type="button" class="btn btn-default" data-dismiss="modal">Batal</button-->
        <button type="button" onclick="pembelian()" class="btn btn-primary">Ajukan</button>
      </div>
    </div>
  </div>
</div>
<!--/ Modal Pembelian Barang -->

<!-- Modal penambahan nama barang -->
<div class="modal fade" id="Modaltambahbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#fbf8f8;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-plus-circle text-info"></i> Tambah Nama Barang</h4>
      </div>
      <div class="modal-body">
       <div class="row">
        <form id="form-tambahbarang">
          <div class="form-group col-md-6">
            <span class="pull-right" id="not-barang"></span>
            <label for="recipient-name" class="control-label">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" onkeyup="cek_barang()">
          </div>

          <div class="form-group col-md-6">
            <span id="not-merek" class="pull-right"></span>
            <label for="recipient-name" class="control-label">Merek</label>
            <input type="text" class="form-control" name="merek_barang" onkeyup="cek_barang()">
          </div>

          <div class="form-group col-md-6">
            <span id="not-kw" class="pull-right"></span>
            <label for="recipient-name" class="control-label">Kualitas</label>
            <select class="form-control" name="id_kw" onchange="cek_barang()"></select>
          </div>

          <div class="form-group col-md-6">
            <span id="not-satuan" class="pull-right"></span>
            <label for="recipient-name" class="control-label">Satuan</label>
            <select class="form-control" name="id_satuan" onchange="cek_barang()"></select>
          </div>

          <div class="form-group col-md-12 text-center">
          <span id="notif_name" style="display:none;"></span></div>
        </form>
       </div>
      </div>
      <div class="modal-footer" style="background:#fbf8f8;text-align:center;">
        <button type="button" class="btn btn-primary" id="btn-tambahkan" onclick="tambahkan_nama_barang()">Tambahkan</button>
      </div>
    </div>
  </div>
</div>
<!--/ Modal penambahan nama barang -->

<!-- Modal Realisasi barang -->
<div class="modal fade" id="Modalrealisasibarang" role="dialog">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header" style="background:#fbf8f8;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><i class="fa fa-check-square-o text-info"></i> Realisasi Barang</h4>
    </div>

    <form id="form_inputrealisasi">
      <input type="hidden" name="id_pembelian">
      <div class="modal-body">
       <div class="row">
        <div class="col-md-12">
         <label>Info Barang</label>
         <div class="row" id="info_ajuan"></div>
        </div>
        <div class="col-md-12">
         <div class="row">
          <div class="col-md-6">
            <label>Jumlah Pembelian</label>
            <span class="pull-right text-red" id="notif_jmlpembelian" style="display:none;">Data kosong</span>
            <input class="form-control" placeholder="-- Pembelian --" type="number" name="jumlah_pembelian" min="1" onkeypress="return hanyaAngka(event)" onkeyup="total_realisasi_harga()">
          </div>
          <div class="form-group col-md-6">
            <label>Harga</label>
            <span class="pull-right text-red" id="notif_hargapembelian" style="display:none;">Data kosong</span>
            <input class="form-control" type="text" min="1" placeholder="-- Harga --" name="harga_pembelian" onkeypress="return hanyaAngka(event)" onkeyup="total_realisasi_harga()">
          </div>
          <div class="col-md-6">
            <ul class="list-group"><li class="list-group-item infoli">
            Total
            <p class="spanli" id="realisasi_total_pembelian"></p>
            </li></ul>
          </div>
         </div>
        </div>
       </div>
      </div>
    </form>

    <div class="modal-footer" style="background:#fbf8f8;text-align:center;">
      <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
      <button type="button" class="btn btn-danger" onclick="batal_membeli()">Batal</button>
      <button type="button" class="btn btn-success" onclick="input_pembelian_barang()">Beli</button>
    </div>

  </div>
 </div>
</div>
<!--/ Modal Realisasi barang -->


<script>
var idRab = '<?php echo $id_rab; ?>';
$('.select2-container .select2-selection--single').css({'width': '100%','border-radius':'0','border-left':'0px'});

$(document).ready(function(){
  daftarbarang();
  total_harga_barang();

  tbl_pembelian = $('.tbl-pembelian').DataTable({
    ordering: true,
    order: [[0, "desc"]],
    processing: false,
    serverSide: false,
    ajax: {
      url: '<?php echo base_url('Admin/Data_Ajax/Rab/tbl_pengajuan_barang?idrab='); ?>'+idRab,
      type: 'GET',
    }
  });

});

// totol harga barang
function total_harga_barang() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/total_harga?id_rab='); ?>'+idRab,
    dataType: 'JSON',
    success: function (data){
      $('#total_ajukan').text(data.ajukan);
      $('#total_ajukan').css({'font-size':'20px'});
      $('#total_pembelian').text(data.beli);
      $('#total_pembelian').css({'font-size':'20px'});
    }
  });
}

// data satuan barang dan kualitas
$(function(){
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/status_kualitas'); ?>',
    dataType: 'JSON',
    success: function (data){
      // id kualitas barang
      $('[name="id_kw"]').html('');
      $('[name="id_kw"]').append('<option value="">-- Kw Barang --</option>');
      for (var i = 0; i < data.kw.length; i++) {
        $('[name="id_kw"]').append('<option value="'+data.kw[i].id_kw+'">'+data.kw[i].kw_barang+'</option>');
      }
      // id satuan barang
      $('[name="id_satuan"]').html('');
      $('[name="id_satuan"]').append('<option value="">-- Satuan --</option>');
      for (var i = 0; i < data.satuan.length; i++) {
        $('[name="id_satuan"]').append('<option value="'+data.satuan[i].id_satuan+'">'+data.satuan[i].satuan+'</option>');
      }
    }
  });
});

// click reset form pembelian
$('#btn-pembelian').click(function() {
  $('#form_pembelian')[0].reset('');
  $('#info_barang').html('');
});

// daftar nama barang
function daftarbarang(){
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/pembelihan_barang?id_rab='); ?>'+idRab,
    dataType: 'JSON',
    success: function(data) {
      $('[name="id_barang"]').html('');
      $('[name="id_barang"]').append('<option value="">-- Pilih Barang --</option>');
      for (var i = 0; i < data.hasil.length; i++) {
        if(data.hasil[i].id_barang){
          // var disabled = 'disabled';
          // var title = 'Sudah terpilih';
          var disabled = '';
          var title = '';
        }else {
          var disabled = '';
          var title = '';
        }

         $('[name="id_barang"]').append('<option value="'+data.hasil[i].id_barang+'"'+ disabled + ' title="'+title+ '">'+data.hasil[i].nama_barang+'</option>');
        console.log(data.hasil[i]);
      }
    }
  });
}

// menampilkan data barang dari master barang
function info_barang() {
  var idBarang = $('[name="id_barang"]').val();
  console.log(idBarang);
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/stok?idBarang=')?>'+ idBarang,
    type: 'GET',
    dataType: 'JSON',
    success: function (data){
      $('#info_barang').html('');
      for (var i = 0; i < data.length; i++) {

       $('#info_barang').append('<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Satuan<p class="spanli">'
       + data[i].satuan +
       '</p></li></ul></div>'

       +'<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Merek / Kw<p class="spanli">'
       + data[i].merek_barang+' / '+data[i].kw_barang+
       '</p></li></li></ul></div>'+

       '<input type="hidden" name="id_rab" value="'+idRab+'">'+

       '<div class="form-group col-md-6"><label>Jumlah Pengajuan</label><span id="notif_jml" class="pull-right" style="display:none;"></span><input type="number" min="1" class="form-control" onkeypress="return hanyaAngka(event)" name="jml_pengajuan" placeholder="-- Jumlah Pengajuan --" onkeyup="total_pengauan_barang()"></div><div class="col-md-6 form-group"><label>Harga Pengajuan</label><span id="notif_harga" class="pull-right" style="display:none;"></span><input type="text" onkeypress="return hanyaAngka(event)" onkeyup="total_pengauan_barang()" class="form-control" name="harga_pengajuan" placeholder="-- Harga Barang --"></div>'+

       '<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Total<p class="spanli" id="total_pengajuan"></p></li></ul></div>'
       );
      }
    }
  });
}

// total pengajuan barang
function total_pengauan_barang() {
  var pembelian = $('[name="jml_pengajuan"]').val();
  var harga = $('[name="harga_pengajuan"]').val();
  var total = pembelian * harga;

  var	rev_total = total.toString().split('').reverse().join('');
    hasil 	= rev_total.match(/\d{1,3}/g);
    hasil	= hasil.join('.').split('').reverse().join('');
  $('#total_pengajuan').text('Rp '+ hasil);
}

// input pembelian barang
function pembelian() {
  var barang = $('[name="jml_pengajuan"]').val();
  var harga = $('[name="harga_pengajuan"]').val();
  var select = $('[name="id_barang"]').val();
  if (select == '') {
    $('#notif_select').html('');
    $('#notif_select').text('Data Kosong');
    $('#notif_select').css({'display':'block','color': 'red'});
    setTimeout(function() {
      $('#notif_select').css({'display':'none','color': 'red'});
    },2000);
  }else if(barang == '' || barang == 0){
    $('#notif_jml').html('');
    $('#notif_jml').text('Data Kosong');
    $('#notif_jml').css({'display':'block','color': 'red'});
    setTimeout(function() {
      $('#notif_jml').css({'display':'none','color': 'red'});
    },2000);
  }else if (harga == '' || harga == 0) {
    $('#notif_harga').html('');
    $('#notif_hargal').text('Data Kosong');
    $('#notif_harga').css({'display':'block','color': 'red'});
    setTimeout(function() {
      $('#notif_harga').css({'display':'none','color': 'red'});
    },2000);
  }else {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Rab/input_pengajuan_barang'); ?>',
      type: 'POST',
      data: $('#form_pembelian').serialize(),
      success: function (data) {
        total_harga_barang();
        tbl_pembelian.ajax.reload(null, false);
        $('#ModalPembelian').modal('hide');
        swal({
          title: "",
          text: "Okey!",
          type: "success",
          timer: 800,
          showConfirmButton: false
        });
      }
    });
  }

}

// reset form tambah barang
$('#btn-tambahkan').click(function () {
  $('#form-tambahbarang')[0].reset('');
});

// cek nama barang sehingga tidak ke dobelan
function cek_barang() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/cek_namabarang'); ?>',
    type: 'GET',
    dataType: 'JSON',
    data: $('#form-tambahbarang').serialize(),
    success: function (data) {
      if(data == '0'){
        $('#notif_name').text('');
        $('#notif_name').css({'display':'none'});
        $('#btn-tambahkan').removeAttr('disabled');
      }else {
        $('#notif_name').text('Sudah tersedia!');
        $('#notif_name').css({'display':'','color':'red'});
        $('#btn-tambahkan').attr("disabled", "true");
      }
    }
  });
}

// tambahkan nama barang
function tambahkan_nama_barang(){
  var barang = $('[name="nama_barang"]').val();
  var merek  = $('[name="merek_barang"]').val();
  var kw  = $('[name="id_kw"]').val();
  var satuan  = $('[name="id_satuan"]').val();
  var text = 'Data kosong!';
  var netral = setTimeout(function(){$('span #form-tambahbarang').text('');},1500);
  var hidetext = $('span #form-tambahbarang ').text('');

  if(barang == ''){
    hidetext
    $('#not-barang').text(text);
    $('#not-barang').css({'color':'red'});
    netral
  }else if (merek == '') {
    hidetext
    $('#not-merek').text(text);
    $('#not-merek').css({'color':'red'});
    netral
  }else if (kw == '') {
    hidetext
    $('#not-satuan').text(text);
    $('#not-satuan').css({'color':'red'});
    netral
  }else if (satuan == '') {
    hidetext
    $('#not-satuan').text(text);
    $('#not-satuan').css({'color':'red'});
    netral
  }else {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/tambahkan_barang'); ?>',
      type: 'GET',
      dataType: 'JSON',
      data: $('#form-tambahbarang').serialize(),
      success: function (data) {
        daftarbarang();
        $('#Modaltambahbarang').modal('hide');
        swal({
          title: "",
          text: "Okey!",
          type: "success",
          timer: 800,
          showConfirmButton: false
        });
      }
    });
  }
}

// konfirmasi status RAB menjadi proses realisasi berupa modal
function konfirmasi_selesai(){
  swal({
    title: "Pengajuan barang selesai?",
    text: "Setelah Selesai, RAB ini tidak dapat menambahkan barang lagi!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#007fd6",
    confirmButtonText: "Okey",
    closeOnConfirm: false,
    cancelButtonText: "Batal"
  },
  function(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Rab/update_status?id_rab=')?>'+idRab+'&id_sts=1',
      type: 'GET',
      success: function(data){
        swal({
          title: "Selesai!",
          text: "Halaman akan di Reload.",
          type: "success",
          timer: 850,
          showConfirmButton: false
        },function() {
          window.location.reload();
        });
      }
    });
  });
}

// update status RAB menjadi realisasi
function konfir_realisasi() {
  swal({
    title: "Proses Realisasi Selesai?",
    text: "Setelah ini barang tidak akan dapat di Tinjau lagi!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#007fd6",
    confirmButtonText: "Okey",
    closeOnConfirm: false,
    cancelButtonText: "Batal"
  },
  function(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Rab/update_status?id_rab=')?>'+idRab+'&id_sts=2',
      type: 'GET',
      success: function(data){
        swal({
          title: "Selesai!",
          text: "Halaman akan di Reload.",
          type: "success",
          timer: 850,
          showConfirmButton: false
        },function() {
          window.location.reload();
        });
      }
    });
  });
}

// info barang untuk realisasi
function realisasi_barang(idpembelian){
 $('[name="id_pembelian"]').val(idpembelian);
 $('#form_inputrealisasi')[0].reset('');
 $('#realisasi_total_pembelian').html('');
 $.ajax({
  url: '<?php echo base_url('Admin/Data_Ajax/Rab/infopembelian_barang?idpembelian=')?>'+idpembelian,
  type: 'GET',
  dataType: 'JSON',
  success: function (data){
    $('#info_ajuan').html('');
    for (var i = 0; i < data.length; i++) {
      var	rev_total =
        data[i].harga_pengajuan.toString().split('').reverse().join('');
        hasil 	= rev_total.match(/\d{1,3}/g);
        hasil[i]	= hasil.join('.').split('').reverse().join('');

      var jumlah = data[i].harga_pengajuan * data[i].jumlah_pengajuan;
      var	total =
        jumlah.toString().split('').reverse().join('');
        total_harga 	= total.match(/\d{1,3}/g);
        total_harga[i]	= total_harga.join('.').split('').reverse().join('');

      $('#info_ajuan').append('<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Barang<p class="spanli">'+data[i].nama_barang+'</p></li></ul></div>'+
      '<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Merek / Kw<p class="spanli">'
      + data[i].merek_barang+' / '+data[i].kw_barang+
      '</p></li></li></ul></div>'+
      '<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Jumlah Pengajuan<p class="spanli">'
      + data[i].jumlah_pengajuan+' '+data[i].satuan+
      '</p></li></li></ul></div>'+
      '<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Harga Per 1<p class="spanli">Rp '
      + hasil[i] + '</p></li></li></ul></div>'+
      '<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Total<p class="spanli">Rp '
      + total_harga[i] + '</p></li></li></ul></div>'
      );
    }
  }
 });
}

// total harga dari jumlah pembelian realisasi harga
function total_realisasi_harga() {
  var pembelian = $('[name="jumlah_pembelian"]').val();
  var harga = $('[name="harga_pembelian"]').val();
  var total = pembelian * harga;

  var	rev_total = total.toString().split('').reverse().join('');
    hasil 	= rev_total.match(/\d{1,3}/g);
    hasil	= hasil.join('.').split('').reverse().join('');
  $('#realisasi_total_pembelian').text('Rp '+ hasil);
}

// input barang realisasi
function input_pembelian_barang() {
  var pembelian = $('[name="jumlah_pembelian"]').val();
  var harga = $('[name="harga_pembelian"]').val();
  if(pembelian == ''){
    $('#notif_jmlpembelian').css({'display':'block'});
    setTimeout(function() {
      $('#notif_jmlpembelian').css({'display':'none'});
    },1500);
  }else if (harga == '') {
    $('#notif_hargapembelian').css({'display':'block'});
    setTimeout(function() {
      $('#notif_hargapembelian').css({'display':'none'});
    },1500);
  }else {
    $.ajax({
      url : '<?php echo base_url('Admin/Data_Ajax/Data_barang/input_realisai?hapus='); ?>',
      type: 'POST',
      data: $('#form_inputrealisasi').serialize(),
      dataType: 'JSON',
      success: function(data){
        swal({
          title: "Berhasil!",
          text: "",
          type: "success",
          timer: 850,
          showConfirmButton: false
        });
        tbl_pembelian.ajax.reload(null, false);
        $('#Modalrealisasibarang').modal('hide');
        total_harga_barang();
      }
    });
  }
}

// update status batal pembelian
function batal_membeli(){
  swal({
    title: "Barang tidak dibeli?",
    text: "Tekan Ya, untuk melanjutkan",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#dd4b39",
    confirmButtonText: "Ya",
    closeOnConfirm: true,
    cancelButtonText: "Batal",
  },function(){
    $.ajax({
      url : '<?php echo base_url('Admin/Data_Ajax/Data_barang/input_realisai?hapus=1'); ?>',
      type: 'POST',
      data: $('#form_inputrealisasi').serialize(),
      dataType: 'JSON',
      success: function(data){
        swal({
          title: "Selesai!",
          text: "",
          type: "success",
          timer: 850,
          showConfirmButton: false
        });
        tbl_pembelian.ajax.reload(null, false);
        $('#Modalrealisasibarang').modal('hide');
        total_harga_barang();
      }
    });
  });

}

// update stok barang yang jadi di beli
function update_stok_barang() {
  swal({
    title: "Update Stok?",
    text: "Barang yang sudah dibeli akan di tambahkan ke dalam stok barang!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#007fd6",
    confirmButtonText: "Okey",
    closeOnConfirm: false,
    cancelButtonText: "Batal"
  },
  function(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Rab/update_stok_barang?id_rab=')?>'+idRab,
      type: 'GET',
      dataType: 'JSON',
      success: function(data){
        swal({
          title: "Selesai!",
          text: "Halaman akan di Reload.",
          type: "success",
          timer: 850,
          showConfirmButton: false
        },function() {
          window.location.reload();
        });
      }
    });
  });
}

</script>
