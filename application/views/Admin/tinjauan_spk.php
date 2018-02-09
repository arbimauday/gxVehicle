<div class="content-wrapper">
 <!-- Tinjauan SPK -->
 <section class="content-header">
  <h1>Tinjauan SPK  <a href="<?php echo base_url('Admin/Data_spk'); ?>" class="btn btn-danger btn-xs">Kembali</a></h1>
  <ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-file"></i> Master SPK</a></li>
   <li>Data SPK</li>
   <li class="active">Ubah SPK</li>
  </ol>
 </section>

 <section class="content">
  <div class="box box-default color-palette-box">
   <div class="box-header with-border">
    <!-- Nomor SPK -->
    <h3 class="box-title" id="titlespk"></h3>
   </div>

   <div class="box-body">
    <div class="col-sm-4 form-group no-padding" id="data_spk">
     <!-- Info SPK -->
      <div class="col-sm-12" id="info_kdr">
      </div>
     <!--/ Info SPK -->

     <!-- Button Ambil Barang dan Laporan -->
      <div class="col-sm-12 text-center"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalAmbilbarang" onclick="reset_form_ambilbarang()" id="btn-barang">Ambil Barang</button> <button type="button" class="btn bg-purple" data-toggle="modal" data-target="#ModalLaporan" id="btn-laporan">Laporan</button></div>
    </div>

    <div class="form-group col-md-8 col-sm-8 no-padding">
      <!-- Keluhan -->
      <div class="form-group col-md-6">
       <div class="span-info-text bg-yellow col-sm-12">Keluhan</div>
       <p class="text-info-data" id="lht_keluhan"></p>
      </div>
      <!--/ Keluhan -->

      <!-- Solusi -->
      <div class="form-group col-md-6 col-sm-12" id="data-view-solusi">
        <div class="span-info-text bg-aqua-active">Solusi</div>
        <p class="text-info-data" style="background:#e5faff;" id="lht_solusi"></p>
      </div>
      <!--/ Solusi -->
    </div>

    <!-- Form Input Solusi -->
    <div class="col-md-8" id="data-solusi" style="display:none;">
     <div class="box-header" style="background: #efefef;">
      <h3 class="box-title">Solusi Teknisi</h3>
     </div>

     <form id="form_solusi" >
      <div class="box-body" style="border:2px solid #efefef;background:#fdfdfd;">
        <input type="hidden" name="id_spk" value="<?php echo $idspk; ?>">
        <div class="form-group">
          <label>Teknisi <span class="text-red">**</span></label>
          <span id="not_tkn" class="text-red" style="display:none;">Data kosong</span>
          <select class="form-control" name="id_teknisi" required>
           <option value="">-- Teknis --</option>
           <?php foreach ($teknisi as $u) { ?>
            <option value="<?php echo $u->id_user; ?>"><?php echo $u->nama; ?></option>
           <?php } ?>
          </select>
        </div>

        <div class="form-group">
         <label>Solusi <span class="text-red">**</span></label>
         <span id="not_sls" class="text-red" style="display:none;"> Data kosong</span>
         <textarea name="solusi" rows="10" cols="80" placeholder="text solusi"></textarea>
        </div>
      </div>

      <div class="box-footer text-center" style="background: #efefef;">
        <button type="button" class="btn btn-primary" onclick="input_solusi()">Masukan</button>
      </div>
     </form>
    </div>
    <!--/ Form Input Solusi -->

   </div>
  </div>


  <!-- Tabel Penggunaan barang dan Laporan Pekerjaan-->
  <div class="row">
   <div class="col-xs-12">
    <div class="nav-tabs-custom">
     <ul class="nav nav-tabs">
      <li class="active"><a href="#tbl_ambilbarang" data-toggle="tab">Penggunaan Barang</a></li>
      <li><a href="#tbl_laporan" data-toggle="tab">Laporan Pekerjaan</a></li>
     </ul>

     <div class="tab-content">
      <!-- Table motor -->
      <div class="tab-pane active" id="tbl_ambilbarang">
       <div class="box-body">
        <div class="table-responsive">
         <table class="table table-bordered table-striped tbl_ambil_barang">
          <thead>
           <tr class="bg-info">
            <th style="width:1px">#</th>
            <th style="width:150px">Barang</th>
            <th style="width:100px">Penggunaan</th>
            <th style="width:100px">Tgl Ambil</th>
            <th style="width:100px">Harga</th>
            <th style="width:100px">Total</th>
           </tr>
          </thead>
          <tfoot>
            <tr>
             <td colspan="5" style="border-top:1px solid #bcc6d2;text-align:right;">Total: </td>
             <td style="background:#bcc6d2;"></td>
            </tr>
          </tfoot>
         </table>
        </div>
       </div>
      </div>

      <!-- Table laporan -->
      <div class="tab-pane" id="tbl_laporan">
       <div class="box-body">
        <div class="table-responsive">
         <table class="table table-bordered table-striped laporan">
           <thead>
            <tr class="bg-info">
             <th>Laporan</th>
            </tr>
           </thead>
         </table>
        </div>
       </div>
      </div>

     </div>
    </div>
   </div>
  </div>


 </section>

</div>

<!-- Modal Status SPK -->
<div class="modal fade" id="ModalStatusSpk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Status SPK</h4>
      </div>
      <form id="form-status-spk">
        <input type="hidden" name="idspk" value="<?php echo $idspk; ?>">
        <input type="hidden" name="id_status_spk" value="">
      <div class="modal-body">
       <div class="row">
        <div class="form-group col-md-12">
          <label class="control-label">Status</label>
          <select class="form-control" name="id_status_update" required>
          </select>
        </div>
       </div>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" onclick="update_status()" class="btn btn-success">Perbarui</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal Status SPK -->

<!-- Modal Ambil Barang -->
<div class="modal fade" id="ModalAmbilbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pengambilan Barang</h4>
      </div>
      <form id="form-ambilbarang">
      <div class="modal-body">
       <div class="row">
        <div class="form-group col-md-12">
          <label class="control-label">Barang</label>
          <select class="form-control" onchange="infobarang()" name="id_barang" required>
          </select>
        </div>

        <div id="menampilkanInfobarang">
        </div>

       </div>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button"class="btn btn-info" id="btnAmbil" onclick="ambil_barang()" disabled>Ambil</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal Ambil Barang -->

<!-- Modal Laporan Pekerjaan -->
<div class="modal fade bs-example-modal-lg" id="ModalLaporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
     <div class="modal-header" style="background: #efefef;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Laporan</h4>
     </div>
     <form id="form-laporan">
      <div class="modal-body">
       <div class="row">
        <div class="form-group col-md-6">
          <label class="control-label">Teknisi</label>
          <select class="form-control" name="id_teknisi" required>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label class="control-label">Tanggal</label>
          <input type="text" value="<?php echo date('d/m/Y'); ?>" name="tgl" readonly class="form-control secondcal">
        </div>

        <div class="col-md-12">
         <label class="control-label"></label>
         <textarea placeholder="text.." name="isi"></textarea>
        </div>
       </div>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Batal</button>
        <button type="button" class="btn bg-purple" onclick="kirim()">Kirim</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal Laporan Pekerjaan -->

<!-- javascript tinymce -->
<script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<!--/ javascript tinymce -->

<script type="text/javascript">
var idspk = '<?php echo $idspk; ?>';
//javascript tinymce
tinymce.init({
  selector:'textarea',
  menubar: false,
  fontsize_formats: "4pt 6pt 8pt 9pt 10pt 11pt 14pt",
  height : "230",
  plugins: "textcolor",
  toolbar: "insertfile undo redo | forecolor backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});

  $(document).ready(function(){
    dataspk();
    status();
    daftarbarang();
    tbl_ambil_barang();
    laporan();
  });

  // tabel ambil barang
  function tbl_ambil_barang() {
    tbl_barang = $('.tbl_ambil_barang').DataTable({
      //lengthMenu: [[10,50,100,-1], [10,25,100, "All"]],
      footerCallback: function ( row, data, start, end, display ) {
       var api = this.api(), data;
       // converting to interger to find total
       var intVal = function ( i ) {
        return typeof i === 'string' ?
        i.replace(/[\Rp.]/g, '')*1 :
          typeof i === 'number' ?
          i : 0;
        };
       // computing column Total of the complete result
	     var Total = api
        .column( 5 )
        .data()
        .reduce( function (a, b) {
          return intVal(a) + intVal(b);
        }, 0 );
        //menambahkan tanda titik
        var	rev_total =
          Total.toString().split('').reverse().join(''),
          hasil_total 	= rev_total.match(/\d{1,3}/g);
          hasil_total	= hasil_total.join('.').split('').reverse().join('');
       // Update footer
        $( api.column( 5 ).footer() ).html('<b>Rp. </b>'+ hasil_total);
      },
      ordering: true,
      order: [[0, "desc"]],
      processing: false,
      serverSide: false,
      ajax: {
        url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/penggunaan?idspk='); ?>'+idspk,
        type: 'GET',
      }
    });
  }

  // data laporan spk
  function laporan() {
   tbl_laporan = $('.laporan').DataTable({
     lengthMenu: [[25,50,100,-1], [25,50,100, "All"]],
     ordering: true,
     order: [[0, "desc"]],
     processing: false,
     serverSide: false,
     ajax: {
      url: '<?php echo base_url('Admin/Data_Ajax/Laporan/data?idspk='); ?>'+idspk
     }
    });
  }

  // modal status spk
  function status() {
   $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Spk/getStatus/'); ?>'+idspk,
    dataType: 'JSON',
    success: function (data) {
     $('[name="id_status_update"]').html('');
     $('[name="id_status_update"]').append('<option value="">-- Pilih Status --</option>');
     for (var i = 0; i < data.length; i++) {
      $('[name="id_status_update"]').append('<option value="'+data[i].id_status_spk+'">'+data[i].status_spk+'</option>');
     }
    }
   });
  }

  // menampilkan data spk
  function dataspk() {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Spk/lihatSpk/'); ?>'+idspk,
      dataType: "JSON",
      success:function(data) {
        if(data.teknisi[0].id_teknisi){
          teknisi = '-';
        }else {
          teknisi = data.teknisi[0].nama;
        }
        // data untuk update status_spk
        $('[name="id_status_spk"]').val(data.infoSpk[0].id_status_spk);

        $('#titlespk').text(data.infoSpk[0].no_spk);
        $('#info_kdr').html('');
        $('#info_kdr').append('<ul class="list-group"><li class="list-group-item infoli">Nomor Polisi<p class="spanli">'+data.infoSpk[0].nomor_polisi+'</p></li><li class="list-group-item infoli">Tgl SPK<p class="spanli">'+data.infoSpk[0].tgl_spk+'</p></li><li class="list-group-item infoli">Jenis Pekerjaan<p class="spanli">'+data.infoSpk[0].jenis_pekerjaan+'</p></li><li class="list-group-item infoli">Divisi <p class="spanli">'+data.infoSpk[0].divisi+'</p></li><li class="list-group-item infoli">Pembuat (Admin)<p class="spanli">'+data.infoSpk[0].nama+'</p></li><li class="list-group-item infoli">Peminta<p class="spanli">'+data.peminta[0].nama+'</p></li><li class="list-group-item infoli">Teknisi<p class="spanli">'+teknisi+'</p></li><li class="list-group-item infoli">Status <span class="pull-right span-ganti" data-toggle="modal" data-target="#ModalStatusSpk" id="gantistatus">Ganti</span><p class="spanli">'
        +data.infoSpk[0].status_spk+'</p></li></ul>');
        // keluhan dan info
        $('#lht_keluhan').html('');
        $('#lht_keluhan').append(data.infoSpk[0].keluhan);
        if(data.infoSpk[0].solusi){
          textsolusi = data.infoSpk[0].solusi;
          $('#data-solusi').css({'display':'none'});
          $('#data-view-solusi').css({'display':'block'});
          $('#gantistatus').css({'display':'block'});
          $('#btn-barang').css({'display':''});
          $('#btn-laporan').css({'display':''});
        }else {
          $('#data-view-solusi').css({'display':'none'});
          textsolusi = '-';
          $('#data-solusi').css({'display':'block'});
          $('#gantistatus').css({'display':'none'});
          $('#btn-barang').css({'display':'none'});
          $('#btn-laporan').css({'display':'none'});
          swal({
            title: "",
            text: "Belum ada Pengecekan!",
            type: "warning",
            timer: 1700,
            showConfirmButton: false
          });
        }
        $('#lht_solusi').html('');
        $('#lht_solusi').append(textsolusi);
      },
      error: function (infoSpk,jqXHR, textStatus, errorThrown) {
        swal({
          title: "",
          text: "Data ini tidak tersedia",
          type: "error",
          timer: 1300,
          showConfirmButton: false
        });
        setTimeout(function() {
          window.location.href= '<?php echo base_url('Admin/Data_spk'); ?>';
        },1400);
      }
    });
  }

  // input solusi dari pekerjaan
  function input_solusi(){
   var id_teknisi = $('[name="id_teknisi"]').val();
   var solusi = tinyMCE.get('solusi');
   var convert_solusi = solusi.getContent();
   console.log(solusi.getContent());

   if(id_teknisi == ''){
    $('#not_tkn').css({'display': 'block'});
    $('#not_sls').css({'display': 'none'});
    setTimeout(function () {
      $('#not_tkn').css({'display': 'none'});
    },3000);
   }else if (convert_solusi == '') {
    $('#not_sls').css({'display':'block'});
    $('#not_tkn').css({'display':'none'});
    setTimeout(function () {
      $('#not_sls').css({'display':'none'});
    },3000);
   }else {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Spk/solusi_spk')?>',
      type: "POST",
      dataType: "JSON",
      data: {id_spk :idspk,solusi:solusi.getContent(),id_teknisi:id_teknisi},
      success: function (data){
        swal({
          title: "",
          text: "Proses Selesai!",
          type: "success",
          timer: 1500,
          showConfirmButton: false
        });
        setTimeout(function(){
          dataspk();
          status();
        },300);
      },
      error: function (data,error,dataerror,resulterror) {
        swal({
          title: "",
          text: "Proses gagal!",
          type: "error",
          timer: 1800,
          showConfirmButton: false
        });
      }

    });
   }
  }

  // update status spk
  function update_status(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Spk/update_status'); ?>',
      type: 'POST',
      data: $('#form-status-spk').serialize(),
      dataType: "JSON",
      success: function(data) {
        $('#ModalStatusSpk').modal('hide');
        $('#form-status-spk')[0].reset('');
        swal({
          title: "",
          text: "Proses Selesai!",
          type: "success",
          timer: 1000,
          showConfirmButton: false
        });
        setTimeout(function(){
          dataspk();
          status();
        },300);
      },
      error: function(error) {
        swal({
          title: "",
          text: "Proses gagal!",
          type: "error",
          timer: 1800,
          showConfirmButton: false
        });
      }
    });
  }

  // daftar barang
  function daftarbarang(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/daftar'); ?>',
      dataType: 'JSON',
      success: function(data) {
        $('[name="id_barang"]').html('');
        $('[name="id_barang"]').append('<option value="">-- Pilih Barang --</option>');
        for (var i = 0; i < data.length; i++) {
          if(data[i].stok_barang == 0){
            var disabled = 'disabled';
            var title = 'Stok habis';
          }else {
            var disabled = '';
            var title = 'Masih tersedia';
          }
          $('[name="id_barang"]').append('<option value="'+data[i].id_barang+'"'+ disabled + ' title="'+title+ '">'+data[i].nama_barang+'</option>');
        }
      }
    });
  }

  // menampilkan data stok barang
  function infobarang(){
    var idBarang = $('[name="id_barang"]').val();
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/stok?idBarang=')?>'+ idBarang,
      type: 'GET',
      dataType: 'JSON',
      success: function(data) {
        // if(data.length != 0){
        //   $('#btnAmbil').prop('disabled',false);
        // }else {
        //   $('#btnAmbil').prop('disabled',true);
        // }

        $('#menampilkanInfobarang').html('');
        for (var i = 0; i < data.length; i++) {
          // -- convert rupia --
          var harga_beli = data[i].harga_beli;
          var	rev_beli = harga_beli.toString().split('').reverse().join(''),
          	ribuan_beli 	= rev_beli.match(/\d{1,3}/g);
          	ribuan_beli[i]	= ribuan_beli.join('.').split('').reverse().join('');

          var harga_jual = data[i].harga_jual;
          var	rev_jual = harga_jual.toString().split('').reverse().join(''),
          	ribuan_jual 	= rev_jual.match(/\d{1,3}/g);
          	ribuan_jual[i]	= ribuan_jual.join('.').split('').reverse().join('');
          // -- convert rupiah --

         $('#menampilkanInfobarang').append('<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Stok<p class="spanli">'
         + data[i].stok_barang +' ' +data[i].satuan +
         '</p></li><li class="list-group-item infoli">Merek / Tipe<p class="spanli">'
         + data[i].merek_barang+' / '+data[i].tipe_barang+
         '</p></li></ul></div>'

         +'<div class="col-md-6"><ul class="list-group"><li class="list-group-item infoli">Harga Jual<p class="spanli">Rp '
         + ribuan_beli[i]+
         '</p></li><li class="list-group-item infoli">Harga Beli<p class="spanli">Rp '
         + ribuan_jual[i]+'</p></li></ul></div>'+
         '<input type="hidden" name="harga_jual" value="'+data[i].harga_jual+'">'
         +'<div class="col-md-6"><label>Jumlah Kebutuhan</label><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" max="'+data[i].stok_barang+'" min="1" name="jml_barang" onkeyup="keyup_barang()"><span id="notif_stok" class="pull-right" style="display:none;"></span></div><div class="col-md-6"><label>Total Harga</label><input type="number" class="form-control" name="total_harga" readonly></div>');
        }
      }
    });
  }

  function keyup_barang() {
    var mx = $('[name="jml_barang"]').attr('max');
    console.log(mx);
    var harga = eval($('[name="harga_jual"]').val());
    var jumlah = eval($('[name="jml_barang"]').val());
    var total = harga * jumlah;
    //console.log(jumlah);
    $('#btnAmbil').prop('disabled',true);
    if(jumlah > mx || jumlah < 1){
      $('[name="total_harga"]').val('');
      $('#notif_stok').css({'display':'block','color':'red'});
      $('#notif_stok').html('');
      if(jumlah > mx){
        $('#notif_stok').text('Maaf! Stok tidak cukup');
      }else if (jumlah < 1) {
        $('#notif_stok').text('Tidak dapat di proses!');
      }
    }else {
      $('#notif_stok').html('');
      $('#btnAmbil').prop('disabled',false);
      $('[name="total_harga"]').val(total);
      $('#notif_stok').css({'display':'none'});
    }
  }

  function reset_form_ambilbarang() {
    $('#form-ambilbarang')[0].reset();
    $('#menampilkanInfobarang').html('');
  }

  function ambil_barang() {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/ambil_barang?idspk='); ?>'+idspk,
      type: 'POST',
      data: $('#form-ambilbarang').serialize(),
      dataType: 'JSON',
      success: function(data){
        $('#ModalAmbilbarang').modal('hide');
        swal({
          title: "",
          text: "Okey!",
          type: "success",
          timer: 1200,
          showConfirmButton: false
        });
        setTimeout(function tbl_ambil_barang(){
          tbl_barang.ajax.reload(null, false);
        },1300);
      }
    });
  }

  // nama teknisi
  $(function(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/User/teknisi')?>',
      dataType: 'JSON',
      success: function (data) {
       $('#form-laporan [name="id_teknisi"]').html('');
        //$('[name="id_teknisi"]').append('<option value="">-- Pilih Teknisi --</option>');
       for (var i = 0; i < data.length; i++) {
        $('#form-laporan [name="id_teknisi"]').append('<option value="'+data[i].id_user+'">'+data[i].nama+'</option>');
       }
      }
    });
  });

  // kirim laporan pekerjaan
  function kirim() {
   var isi = tinyMCE.get('isi');
   $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Laporan/kirim_data'); ?>',
    type: 'POST',
    data: {idspk:idspk,id_teknisi: $('#form-laporan [name="id_teknisi"]').val(),tgl:$('[name="tgl"]').val(),isi:isi.getContent()},
    dataType: 'JSON',
    success: function (data){
      $('#ModalLaporan').modal('hide');
      $('#form-laporan')[0].reset('');
      swal({
        title: "",
        text: "Okey!",
        type: "success",
        timer: 1200,
        showConfirmButton: false
      });
      setTimeout(function laporan(){
        tbl_laporan.ajax.reload(null, false);
      },1300);
    }
   });
  }


</script>
