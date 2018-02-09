<div class="content-wrapper">
  <!-- Info Kendaraan -->
  <section class="content-header">
    <h1>Info Kendaraan  <a href="<?php echo base_url('Admin/Form/kendaraan'); ?>" class="btn btn-success btn-xs">Tambahkan Kendaraan</a></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-support"></i> Master Kendaraan</a></li>
      <li class="active">Info Kendaraan</li>
    </ol>
  </section>
  <section class="content">
   <div class="row">
   <div class="col-xs-12">
   <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
     <li class="active"><a href="#tbl_motor" data-toggle="tab">Motor</a></li>
     <li><a href="#tbl_mobil" data-toggle="tab">Mobil</a></li>
    </ul>

    <div class="tab-content">
     <!-- Table motor -->
     <div class="tab-pane active" id="tbl_motor">
      <div class="box-body">
       <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
         <thead>
          <tr class="bg-blue">
           <th style="width:10px">#</th>
           <th style="width:95px">No Polisi</th>
           <th style="width:150px">Merek</th>
           <th style="width:70px">Km</th>
           <th style="width:60px">Posisi</th>
           <th style="width:70px">Kondisi</th>
           <th style="width:100px">Status Hak</th>
           <th>Action</th>
          </tr>
         </thead>
         <tbody>
          <?php $nmr = 0; foreach ($motor as $mt) { $nmr +=1; ?>
          <tr>
           <td><?php echo $nmr; ?></td>
           <td><?php echo $mt->nomor_polisi; ?></td>
           <td><?php echo $mt->merek; ?></td>
           <td><?php echo $mt->data_km; ?></td>
           <td><?php echo $mt->port.' / '.$mt->divisi; ?></td>
           <td><?php echo $mt->keadaan; ?></td>
           <td><?php echo $mt->status_hak; ?></td>
           <td>
            <a href="<?php echo base_url('Admin/Profil?no_polisi='.$mt->nomor_polisi.'&id='.$mt->id_kendaraan.'&kode='.$mt->kode_kendaraan); ?>" class="btn btn-primary">Profil</a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#InfoKm" onclick="info_km('<?php echo $mt->id_kendaraan; ?>')">Info KM</button>
           </td>
          </tr>
          <?php } ?>
         </tbody>
        </table>
       </div>
      </div>
     </div>

     <!-- Table mobil -->
     <div class="tab-pane" id="tbl_mobil">
      <div class="box-body">
       <div class="table-responsive">
        <table class="table table-bordered table-striped example1">
          <thead>
           <tr class="bg-blue">
            <th style="width:10px">#</th>
            <th style="width:95px">No Polisi</th>
            <th style="width:150px">Merek</th>
            <th style="width:70px">Km</th>
            <th style="width:60px">Posisi</th>
            <th style="width:70px">Kondisi</th>
            <th style="width:100px">Status Hak</th>
            <th>Action</th>
           </tr>
          </thead>
          <tbody>
           <?php $nmr = 0; foreach ($mobil as $mb) { $nmr +=1; ?>
           <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $mb->nomor_polisi; ?></td>
            <td><?php echo $mb->merek; ?></td>
            <td><?php echo $mb->data_km; ?></td>
            <td><?php echo $mb->port.' / '.$mt->divisi; ?></td>
            <td><?php echo $mb->keadaan; ?></td>
            <td><?php echo $mb->status_hak; ?></td>
            <td>
              <a href="<?php echo base_url('Admin/Profil?no_polisi='.$mb->nomor_polisi.'&id='.$mb->id_kendaraan.'&kode='.$mb->kode_kendaraan); ?>" class="btn btn-primary">Profil</a>
              <button class="btn btn-warning" data-toggle="modal" data-target="#InfoKm" onclick="info_km('<?php echo $mb->id_kendaraan; ?>')">Info KM</button>
            </td>
           </tr>
           <?php } ?>
          </tbody>
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


<!-- Modal Info Km -->
<div class="modal fade bs-example-modal-lg" id="InfoKm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-yellow">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Info KM</h4>
   </div>
   <div class="modal-body">
    <div class="row">

     <div class="form-group col-md-12" id="info_km">
      <div class="box-header" style="background:#f2dede;">
       <i class="fa fa-minus-circle text-red margin-r-5"></i> Catatan Ganti Oli
      </div>
      <ul class="list-group" id="dataModalKm"></ul>
     </div>

     <div id="formInfo-km" class="form-group col-md-6 col-md-offset-3" style="display:none;">
      <div class="box-header bg-aqua text-center"><h4 class="box-title">Buat Catatan Gantil Oli</h4></div>
      <form id="formCatatan-km">
        <input name="id_kendaraan" type="hidden">
        <div class="box-body" style="background:#fdfdfd;">
         <div class="form-group">
          <span>Terakhir Ganti Oli</span>
          <div class="input-group">
            <span class="input-group-addon border-circle" style="background:#eee;"><i class="fa fa-calendar" style="color:#ababab;"></i></span>
            <input type="text" class="form-control border-input firstcal" data-date-format="dd/mm/yyyy" readonly placeholder="dd/mm/yyyy" name="tgl_ganti">
          </div>
         </div>

         <div class="form-group">
          <span>Km</span>
          <div class="input-group">
            <span class="input-group-addon border-circle"><i class="fa fa-dashboard" style="color:#ababab;"></i></span>
            <input type="number" class="form-control border-input" placeholder="Km (Saat Ganti Oli)" name="km_ganti_oli" min="0">
          </div>
         </div>

         <div class="form-group">
          <span>Jadwal Ganti Berikutnya</span>
          <div class="input-group">
            <span class="input-group-addon border-circle" style="background:#eee;"><i class="fa fa-calendar" style="color:#ababab;"></i></span>
            <input type="text" class="form-control border-input secondcal" data-date-format="dd/mm/yyyy" readonly placeholder="dd/mm/yyyy" name="tgl_ganti_berikutnya">
          </div>
         </div>
        </div>
      </form>

      <div class="box-footer text-center" style="background:#fbfbfb;"><button type="button" class="btn bg-aqua" onclick="inputCatatanOli()">Tambahkan</button></div>
     </div>

    </div>
   </div>
  </div>
 </div>
</div>

<script>
function inputCatatanOli() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Data_km/buat_catatan_info_km'); ?>',
    type: "POST",
    data: $('#formCatatan-km').serialize(),
    dataType: "JSON",
    success: function(data){
      swal({
        title: "",
        text: "Succes",
        type: "success",
        timer: 1000,
        showConfirmButton: false
      });
      setInterval(function(){
        $('#formCatatan-km')[0].reset();
        info_km(data);
      },1100)
    },
    error: function(texterror,dataerror,resulterror) {
      alert('Tidak bisa menambahkan');
    }

  });
}

function info_km(id_data){
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Data_km/info_km/')?>'+id_data,
    dataType: "JSON",
    success: function(data){
      if(data.length == '0'){
        $('[name="id_kendaraan"]').val(id_data);
        $('#info_km').css({'display':'none'});
        $('#formInfo-km').css({'display':'block'});
      }else {
        $('#info_km').css({'display':'block'});
        $('#formInfo-km').css({'display':'none'});

        $('#dataModalKm').html('');
        for (var i = 0; i < data.length; i++) {
          $('#dataModalKm').append('<li class="list-group-item">Tanggal Ganti Oli : '+data[i].tgl_ganti+'</li><li class="list-group-item">Km Ganti Oli : '+data[i].km_ganti_oli+'</li><li class="list-group-item">Km Tempuh : '+data[i].km_tempuh+'</li><li class="list-group-item">Tanggal Ganti Berikutnya : <span class="tooltip-inner bg-red">'+data[i].tgl_ganti_berikutnya+'</span></li>');
        }
      }
    },error: function(jqXHR, textStatus, errorThrown) {
      console.log('error');
    }
  });
}
</script>
