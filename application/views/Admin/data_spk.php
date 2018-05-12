<div class="content-wrapper">
  <!-- Data SPK -->
  <section class="content-header">
    <h1>Data SPK  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalSpk">Buat SPK</button></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-file"></i> Master SPK</a></li>
      <li class="active">Data SPK</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
    <div class="col-xs-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
       <li class="active"><a href="#tbl_open" data-toggle="tab">Open</a></li>
       <li><a href="#tbl_pending" data-toggle="tab">Pending</a></li>
       <li><a href="#tbl_closed" data-toggle="tab">Closed</a></li>
      </ul>

    <div class="tab-content">
     <!-- Table spk open -->
     <div class="tab-pane active" id="tbl_open">
        <div class="box-body">
         <div class="table-responsive">
          <table class="table table-bordered table-striped spkOpen">
           <thead>
            <tr class="bg-red">
             <th style="width:10px">#</th>
             <th>Nomor SPK</th>
             <th>No Polisi</th>
             <th>Tanggal</th>
             <th>Jenis Pekerjaan</th>
             <th>Ket Pengecekan</th>
             <th>Aksi</th>
            </tr>
           </thead>
          </table>
         </div>
        </div>
     </div>

     <!-- Tabel spk Pending -->
     <div class="tab-pane" id="tbl_pending">
       <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped spkPending">
           <thead>
            <tr class="bg-yellow">
             <th style="width:10px">#</th>
             <th>Nomor SPK</th>
             <th>No Polisi</th>
             <th>Tanggal</th>
             <th>Jenis Pekerjaan</th>
             <th>Ket Pengecekan</th>
             <th>Aksi</th>
            </tr>
           </thead>
          </table>
         </div>
       </div>
     </div>

     <!-- Tabel spk Closed -->
     <div class="tab-pane" id="tbl_closed">
       <div class="box-title">
        <div class="input-group col-md-2">
          <input class="form-control PickerClosedSPK" placeholder="Month/Year" type="text" name="data_tgl" data-date-format="MM/yyyy" value="<?php echo date('F/Y'); ?>" readonly>
          <span class="input-group-addon bg-maroon" style="border-radius:0;"><i class="fa fa-calendar"></i></span>
        </div>
       </div>

       <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped spkClosed">
           <thead>
            <tr class="bg-green">
             <th style="width:10px">#</th>
             <th>Tgl Closed</th>
             <th>Nomor SPK</th>
             <th>No Polisi</th>
             <th>Tanggal</th>
             <th>Jenis Pekerjaan</th>
             <!--th>Ongkos</th-->
             <th>Aksi</th>
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


<!-- Modal Membuat SPK -->
<div class="modal fade" id="ModalSpk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Buat SPK</h4>
      </div>
      <form id="formSPK">
      <div class="modal-body">
       <div class="row">
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Nomor Polisi</label>
          <span id="notif_nmrpls" class="text-red pull-right hide-data">data kosong*</span>
          <select class="form-control" name="id_kendaraan" required>
            <option value="">-- Pilih Nomor --</option>
           <?php foreach ($noPolisi as $v){ ?>
            <option value="<?php echo $v->id_kendaraan; ?>"><?php echo $v->nomor_polisi; ?></option>
           <?php }?>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Tanggal</label>
          <input type="tgl_spk" class="form-control" name="tgl_rab" value="<?php echo date('d/m/Y'); ?>" readonly>
        </div>

        <div class="form-group col-md-6">
          <label class="control-label">Jenis Pekerjaan</label>
          <span id="notif_jnspkj" class="text-red pull-right hide-data">data kosong*</span>
          <select class="form-control" name="id_jenis_pekerjaan" required>
            <option value="">-- Pilih Jenis Pekerjaan --</option>
            <?php foreach ($jenis_pekerjaan as $vj) {?>
            <option value="<?php echo $vj->id_jenis_pekerjaan; ?>"><?php echo $vj->jenis_pekerjaan ?></option>
          <?php } ?>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label class="control-label">Peminta</label>
          <span id="notif_pemintah" class="text-red pull-right hide-data">data kosong*</span>
          <select class="form-control" name="id_peminta" required>
            <option value="">-- Pilih Nama --</option>
            <?php foreach ($piminta as $n) {?>
            <option value="<?php echo $n->id_user; ?>"><?php echo $n->nama; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-gorup col-md-12">
          <label class="control-label">Keluhan / Kerusakan</label>
          <span id="notif_masalah" class="text-red pull-right hide-data">data kosong*</span>
          <textarea class="form-control" rows="4" placeholder="Catatan.." name="keluhan"></textarea>
        </div>

       </div>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" onclick="buat_spk()" class="btn btn-success">Buat</button>
      </div>
     </form>
    </div>
  </div>
</div>


<!-- Modal View SPK -->
<div class="modal fade" id="ModalViewSpk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Lihat <span id="viewmodalid"></span></h4>
      </div>
      <div class="modal-body">
       <div class="row">

        <div class="form-gorup col-md-6" id="info_kdr"></div>

        <div class="form-gorup col-md-6" id="info_ctr"></div>

        <div class="form-gorup col-md-6">
          <div class="span-info-text bg-yellow">Keluhan</div>
          <p class="text-info-data" id="lht_keluhan"></p>
        </div>

        <div class="form-gorup col-md-6">
          <div class="span-info-text bg-aqua-active ">Solusi</div>
          <p class="text-info-data" style="background:#e5faff;" id="lht_solusi"></p>
        </div>
        <div class="form-group col-md-12">
          <div class="nav-tabs-custom" style="background:#f7f7f7;">
           <ul class="nav nav-tabs">
            <li class="active"><a href="#tbl_ambilbarang" data-toggle="tab">Penggunaan Barang</a></li>
            <li><a href="#tbl_laporan" data-toggle="tab">Laporan Pekerjaan</a></li>
           </ul>

           <div class="tab-content" style="background:#fdfdfd;">
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
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        <!--button type="button" class="btn btn-warning">Buat</button-->
      </div>
    </div>
  </div>
</div>


<!-- Javascript -->
<script>
$(document).ready(function(){
  spkopen = $('.spkOpen').DataTable({
    ordering: true,
    destroy: true,
    order: [[0, "desc"]],
    processing: false,
    serverSide: false,
    ajax: {
      url: "<?php echo base_url('Admin/Data_Ajax/Spk/status_spk/1'); ?>",
      type: 'POST',
    }
   });

   spkPending = $('.spkPending').DataTable({
     ordering: true,
     destroy: true,
     order: [[0, "desc"]],
     processing: false,
     serverSide: false,
     ajax: {
       url: "<?php echo base_url('Admin/Data_Ajax/Spk/status_spk/2'); ?>",
       type: 'POST',
     }
    });
  //  setTimeout(function(){
  //    spkopen.ajax.reload(null, false);
  //  },10);
  setTimeout(closedSPK,10);
});

//tabel spk closed
function closedSPK() {
  var data_tgl = $('[name="data_tgl"]').val();
  $('.spkClosed').DataTable({
    ordering: true,
    destroy: true,
    order: [[0, "desc"]],
    processing: false,
    serverSide: false,
    ajax: {
      url: "<?php echo base_url('Admin/Data_Ajax/Spk/statusClosed?date='); ?>"+data_tgl,
      type: 'POST',
    }
  });
}

// buata spsk baru
function buat_spk() {
  var id_kendaraan = $('[name="id_kendaraan"]').val();
  var id_jenis_pekerjaan = $('[name="id_jenis_pekerjaan"]').val();
  var id_peminta = $('[name="id_peminta"]').val();
  var masalah = $('[name="masalah"]').val();

  if(id_kendaraan == ''){
    $('#notif_nmrpls').css({'display': 'block'});
    $('#notif_jnspkj').css({'display': 'none'});
    $('#notif_pemintah').css({'display': 'none'});
    $('#notif_masalah').css({'display': 'none'});
    setTimeout(function(){
      $('#notif_nmrpls').css({'display': 'none'});
    },3000);
  }else if (id_jenis_pekerjaan == '') {
    $('#notif_nmrpls').css({'display': 'none'});
    $('#notif_jnspkj').css({'display': 'block'});
    $('#notif_pemintah').css({'display': 'none'});
    $('#notif_masalah').css({'display': 'none'});
    setTimeout(function(){
      $('#notif_nmrpls').css({'display': 'none'});
    },3000);
  }else if (id_peminta == '') {
    $('#notif_nmrpls').css({'display': 'none'});
    $('#notif_jnspkj').css({'display': 'none'});
    $('#notif_pemintah').css({'display': 'block'});
    $('#notif_masalah').css({'display': 'none'});
    setTimeout(function(){
      $('#notif_pemintah').css({'display': 'none'});
    },3000);
  }else if (masalah == '') {
    $('#notif_nmrpls').css({'display': 'none'});
    $('#notif_jnspkj').css({'display': 'none'});
    $('#notif_pemintah').css({'display': 'none'});
    $('#notif_masalah').css({'display': 'block'});
    setTimeout(function(){
      $('#notif_masalah').css({'display': 'none'});
    },3000);
  }else {
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Spk/buat_spk'); ?>',
      type: 'POST',
      data: $('#formSPK').serialize(),
      success: function(){
        $('#ModalSpk').modal('hide');
        $('#formSPK')[0].reset();
        spkopen.ajax.reload(null, false);
        swal({
        title: "",
        text: "Proses Selesai!",
        type: "success",
        timer: 2000,
        showConfirmButton: false
        });
      },error: function(error,dataerror,resulterror) {

      }

    });
  }
}

// lihat spk
function lihatSpk(idData){
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Spk/lihatSpk/'); ?>'+idData,
    dataType: "JSON",
    success:function(data) {
      $('#viewmodalid').text(' || '+data.infoSpk[0].no_spk);
      $('#info_kdr').html('');
      $('#info_kdr').append('<ul class="list-group"><li class="list-group-item infoli">Nomor Polisi<p class="spanli">'+data.infoSpk[0].nomor_polisi+'</p></li><li class="list-group-item infoli">Tgl SPK<p class="spanli">'+data.infoSpk[0].tgl_spk+'</p></li><li class="list-group-item infoli">Jenis Pekerjaan<p class="spanli">'+data.infoSpk[0].jenis_pekerjaan+'</p></li></ul>');

      $('#info_ctr').html('');
      if(data.teknisi[0].id_teknisi == 0){
        teknisi = '-';
      }else {
        teknisi = data.teknisi[0].nama;
      }
      $('#info_ctr').append('<ul class="list-group"><li class="list-group-item infoli">Pembuat (Admin)<p class="spanli">'+data.infoSpk[0].nama+'</p></li><li class="list-group-item infoli">Peminta<p class="spanli">'+data.peminta[0].nama+'</p></li><li class="list-group-item infoli">Teknisi<p class="spanli">'+teknisi+'</p></li></ul>');
      console.log(data.infoSpk[0].id_spk);

      // keluhan dan info
      $('#lht_keluhan').html('');
      $('#lht_keluhan').append(data.infoSpk[0].keluhan);
      if(data.infoSpk[0].solusi){
        textsolusi = data.infoSpk[0].solusi;
      }else {
        textsolusi = 'Belum di cek';
      }
      $('#lht_solusi').html('');
      $('#lht_solusi').append(textsolusi);

      // tabel penggunaan barang
      $('.tbl_ambil_barang').DataTable({
        //lengthMenu: [[10,50,100,-1], [10,25,100, "All"]],
        destroy: true,
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
          url: '<?php echo base_url('Admin/Data_Ajax/Data_barang/penggunaan?idspk='); ?>'+idData,
          type: 'GET',
        }
      });

      // tabel laporan pekerjaan
      $('.laporan').DataTable({
        lengthMenu: [[25,50,100,-1], [25,50,100, "All"]],
        destroy: true,
        ordering: true,
        order: [[0, "desc"]],
        processing: false,
        serverSide: false,
        ajax: {
         url: '<?php echo base_url('Admin/Data_Ajax/Laporan/data?idspk='); ?>'+idData
        }
       });
    }
  });
}
</script>
