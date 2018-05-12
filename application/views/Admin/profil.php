<div class="content-wrapper">
  <!-- Info Kendaraan -->
  <section class="content-header">
    <h1>Profil <button type="button" class="btn btn-xs bg-red" onclick="self.history.back()">Kembali</button></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-support"></i> Master Kendaraan</a></li>
      <li>Info Kendaraan</li>
      <li class="active">Profil</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
   <div class="row">
    <div class="col-md-3">
     <div class="box box-primary">
      <?php foreach ($data_kendaraan as $er) { ?>
        <div class="box-body box-profile">
         <!--img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>assets/dist/img/user4-128x128.jpg" alt="User profile picture"-->
         <h3 class="profile-username text-center"><?php echo $er->nomor_polisi; ?></h3>
         <p class="text-muted text-center"><?php echo $er->merek; ?></p>
         <ul class="list-group list-group-unbordered">
          <li class="list-group-item">Jenis <b><?php echo $er->jenis_kendaraan; ?></b></li>
          <li class="list-group-item">Port <b><?php echo $er->port; ?></b></li>
          <li class="list-group-item">Divisi <b><?php echo $er->divisi; ?></b></li>
          <li class="list-group-item">Tgl Pembelian <b><?php echo $er->tgl_pembelian; ?></b></li>
          <li class="list-group-item">Tgl Penerimaan <b><?php echo $er->tgl_penerimaan; ?></b></li>
          <li class="list-group-item">Status Hak <b><?php echo $er->status_hak; ?></b></li>
          <li class="list-group-item">Keadaan Saat ini <b><?php echo $er->keadaan; ?></b></li>
         </ul>
         <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#Modalupdate_info_kendaraan"><b>Ubah</b></button>
        </div>
      <?php } ?>
     </div>
    </div>

    <div class="col-md-9">
     <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
       <li class="active"><a href="#info" data-toggle="tab"><i class="fa fa-info-circle"></i> Info</a></li>
       <li><a href="#galeri" data-toggle="tab"><i class="fa fa-file-image-o"></i> Galeri</a></li>
        <li><a href="#infoSpk" data-toggle="tab"><i class="fa fa-clipboard"></i> SPK</a></li>
      </ul>
      <div class="tab-content">
       <div class="active tab-pane" id="info">
        <div class="row">
         <!-- tabel STNK -->
         <div class="col-md-4 col-sm-6 col-xs-12">
          <table class="table table-bordered table-striped tbl-stnk">
           <thead>
            <tr><th colspan="2" class="text-center">STNK</th></tr>
            <tr class="bg-gray" style="display:none;"><th class="text-center">Data</th><th>Ket</th></tr>
           </thead>
          </table>
          <div class="col-md-12 text-center">
            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Modalupdate_stnk">Ubah</button>
          </div>
         </div>

         <!-- tabel Asuransi -->
         <div class="col-md-4 col-sm-6 col-xs-12">
          <table class="table table-bordered table-striped tbl-asuransi">
           <thead>
            <tr><th colspan="2" class="text-center">Asuransi</th></tr>
            <tr class="bg-gray" style="display:none;"><th class="text-center">Data</th><th>Ket</th></tr>
           </thead>
          </table>
          <div class="col-md-12 text-center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Modalupdate_asuransi">Ubah</button></div>
         </div>

         <!-- Tabel Kir -->
         <?php foreach ($data_kendaraan as $ue) {
           if($ue->id_jenis_kendaraan == '2'){ ?>
           <div class="col-md-4 col-sm-6 col-xs-12">
            <table class="table table-bordered table-striped tbl-kir">
             <thead>
              <tr><th colspan="2" class="text-center">Buku KIR</th></tr>
              <tr class="bg-gray" style="display:none;"><th class="text-center">Data</th><th>Ket</th></tr>
             </thead>
            </table>
            <div class="col-md-12 text-center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Modalupdate_kir">Ubah</button></div>
           </div>
         <?php } } ?>

        </div>
       </div>

       <div class="tab-pane" id="galeri">
        <div class="row">
         <div class="col-md-12" style="padding-left:30px;">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalUploadImage" id="btnaction-Img"><i class="fa fa-cloud-upload"></i> Upload Gambar</button>
         </div>
         <div class="col-md-12">
           <hr style="border-style:dotted;margin-top: 15px;margin-bottom: 15px;">
         </div>
         <div class="col-md-12">
          <ul class="first" id="dataGallery-img">
          </ul>
         </div>
        </div>
       </div>

       <div class="tab-pane" id="infoSpk">
           <div class="box-header">
               <div class="input-group col-md-2">
                   <input class="form-control datpicker_spkperbulan" name="getMontSPK" placeholder="mm/yyyy" data-date-format="MM/yyyy" type="text" value="<?php echo date('F/Y'); ?>" readonly>
                   <span class="input-group-addon bg-maroon" style="border-radius:0;"><i class="fa fa-calendar"></i></span>
               </div>
           </div>
           <div class="box-body">
               <div class="table-responsive">
                   <table class="table table-bordered table-striped tblSpk_bulanan">
                       <thead>
                       <tr class="bg-blue">
                           <th>#</th>
                           <th>No SPK</th>
                           <th>Tanggal</th>
                           <th>Status SPK</th>
                           <th>JeniS Pekerjaan</th>
                           <th>Ongkos Kerja</th>
                       </tr>
                       </thead>

                       <tfoot>
                       <tr>
                           <th style="border-top:1px solid #bcc6d2;text-align:right;" colspan="5">Total :</th>
                           <th style="background:#bcc6d2;"></th>
                       </tr>
                       <tfoot>

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


<!-- Modal Info Kendaraan -->
<div class="modal fade" id="Modalupdate_info_kendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perbarui Data</h4>
      </div>
      <form id="form_update_info_kendaraan" method="post">
      <input type="hidden" name="kode" value="<?php echo $kode; ?>">
      <div class="modal-body">
       <?php foreach ($data_kendaraan as $oi) { ?>
       <div class="row">
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Port</label>
          <select class="form-control" name="id_port" required>
            <option value="<?php echo $oi->id_port; ?>"><?php echo $oi->port; ?></option>
            <?php foreach ($data_port as $pr) { ?>
            <option value="<?php echo $pr->id_port; ?>"><?php echo $pr->port; ?></option>
            <?php } ?>
          </select>
         </div>
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1 margin-r-5">Divisi </label>
          <select class="form-control" name="id_divisi" required>
            <option value="<?php echo $oi->id_divisi; ?>"><?php echo $oi->divisi; ?></option>
            <?php foreach ($data_divisi as $dv) { ?>
            <option value="<?php echo $dv->id_divisi; ?>"><?php echo $dv->divisi; ?></option>
            <?php } ?>
          </select>
         </div>

         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Status Hak</label>
          <select class="form-control" name="id_hak" required>
            <option value="<?php echo $oi->id_hak; ?>"><?php echo $oi->status_hak; ?></option>
            <?php foreach ($data_hak as $hk) { ?>
            <option value="<?php echo $hk->id_hak; ?>"><?php echo $hk->status_hak; ?></option>
            <?php } ?>
          </select>
         </div>
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Keadaan Saat Ini</label>
          <select class="form-control" name="id_keadaan" required>
            <option value="<?php echo $oi->id_keadaan; ?>"><?php echo $oi->keadaan; ?></option>
            <?php foreach ($data_keadaan as $kd) { ?>
            <option value="<?php echo $kd->id_keadaan; ?>"><?php echo $kd->keadaan; ?></option>
            <?php } ?>
          </select>
         </div>
       </div>
       <?php } ?>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="button" onclick="update_info_kendaraan()" class="btn btn-success">Perbarui</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal Info Kendaraan -->

<!-- Modal Stnk -->
<div class="modal fade" id="Modalupdate_stnk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perbarui Data</h4>
      </div>
      <form id="form_update_stnk" method="post">
      <input type="hidden" name="kode" value="<?php echo $kode; ?>">
      <div class="modal-body">
       <?php foreach ($stnk_data_form as $st) { ?>
       <div class="row">
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Merek</label>
          <input class="form-control" placeholder="- - - - - -" type="text" name="merek" value="<?php echo $st->merek; ?>" maxlength="100" required>
         </div>
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Thn Perakitan</label>
          <input class="form-control datepicker_year" readonly placeholder="Tahun" data-date-format="yyyy" type="text" name="thn_perakitan" maxlength="4" onkeypress="return hanyaAngka(event)" required value="<?php echo $st->thn_perakitan; ?>">
         </div>

         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">No Rangka</label>
          <input class="form-control" placeholder="" type="text" name="no_rangka" maxlength="40" required value="<?php echo $st->no_rangka; ?>">
         </div>
         <div class="form-group col-md-6">
           <label for="exampleInputEmail1">No mesin</label>
           <input class="form-control" placeholder="" type="text" name="no_mesin" maxlength="40" required value="<?php echo $st->no_mesin; ?>">
         </div>

         <div class="form-group col-md-6">
          <label for="exampleInputPassword1">Jenis Model</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="jenis_model" required value="<?php echo $st->jenis_model; ?>">
         </div>
         <div class="form-group col-md-6">
          <label for="exampleInputPassword1">Bahan Bakar</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="bahan_bakar" required value="<?php echo $st->bahan_bakar; ?>">
         </div>

         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Warna</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="warna" required value="<?php echo $st->warna; ?>">
         </div>
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Masa STNK</label>
          <input class="form-control datepicker" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" type="text" maxlength="12" name="masa_stnk" readonly required value="<?php echo $st->masa_stnk; ?>">
         </div>
       </div>
       <?php } ?>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="button" onclick="update_stnk()" class="btn btn-success">Perbarui</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal Stnk -->

<!-- Modal Asuransi -->
<div class="modal fade" id="Modalupdate_asuransi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perbarui Data</h4>
      </div>
      <form id="form_update_asuransi" method="post">
      <input type="hidden" name="kode" value="<?php echo $kode; ?>">
      <div class="modal-body">
       <?php foreach ($asuransi_data_form as $as) { ?>
       <div class="row">
         <div class="form-group col-md-6">
          <label for="exampleInputPassword1">Nama Asuransi</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="nama_asuransi" value="<?php echo $as->nama_asuransi; ?>">
         </div>

         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Jatuh Tempo</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="jatuh_tempo" value="<?php echo $as->jatuh_tempo; ?>">
         </div>
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Nominal</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="nominal" value="<?php echo $as->nominal; ?>">
         </div>
       </div>
       <?php } ?>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="button" onclick="update_asuransi()" class="btn btn-success">Perbarui</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal Asuransi -->

<!-- Modal kir -->
<div class="modal fade" id="Modalupdate_kir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perbarui Data</h4>
      </div>
      <form id="form_update_kir" method="post">
      <input type="hidden" name="kode" value="<?php echo $kode; ?>">
      <div class="modal-body">
       <?php foreach ($kir_data_form as $kr) { ?>
       <div class="row">
         <div class="form-group col-md-6">
          <label for="exampleInputPassword1">Nama Pemilik</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="nama_pemilik" value="<?php echo $kr->nama_pemilik; ?>">
         </div>
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Alamat Pemilik</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="alamat_pemilik" value="<?php echo $kr->alamat_pemilik; ?>">
         </div>

         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">No Uji Berkala</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="no_uji_berkala" value="<?php echo $kr->no_uji_berkala; ?>">
         </div>
         <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Status Pengguna</label>
          <input class="form-control" placeholder="" type="text" maxlength="50" name="status_pengguna" value="<?php echo $kr->status_pengguna; ?>">
         </div>
       </div>
       <?php } ?>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="button" onclick="update_kir()" class="btn btn-success">Perbarui</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal kir -->

<!-- Modal View Images -->
<div class="modal fade" id="bsPhotoGalleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
 <div class="modal-dialog">
  <div class="modal-header" style="background: #efefef;">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <div class="modal-title"><b>Title : </b> <span class="title-modal-img"></span></div>
  </div>
  <div class="modal-content">
    <div class="modal-body">
    </div>
  </div>
 </div>
</div>
<!--/ Modal View Images -->

<div class="modal fade" id="ModalUploadImage" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
 <div class="modal-dialog">
  <div class="modal-header bg-green">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <h4 class="modal-title"><i class="fa fa-cloud-upload"></i> Upload Gambar</h4>
  </div>
  <div class="modal-content">
   <form id="fom_upload_image" enctype="multipart/form-data">
    <input type="hidden" name="id_kendaraan" value="<?php echo $id_kendaraan; ?>">
    <div class="modal-body">
      <div class="row">
        <div class="form-group col-md-12">
          <label>Titel Gambar</label>
          <span id="cek_titleImg" class="text-red pull-right" style="display:none;">Data kosong!</span>
          <input type="text" name="title_img" class="form-control">
        </div>
        <div class="col-md-12">
          <label style="margin-right:10px;">Menampilkan</label><button type="button" id="btganti_Img" class="btn btn-danger btn-xs">Ganti</button>
          <input type="file" name="upload_file" accept="image/x-png,image/gif,image/jpeg" id="filePhoto" class="required borrowerImageFile" data-errormsg="PhotoUploadErrorMsg" style="display:none;">
        </div>
        <div class="col-md-6">
          <img id="previewHolder" alt="Uploaded Image Preview Holder" width="100%" height="250px"/ class="img-thumbnail">
        </div>
      </div>
    </div>
    <div class="modal-footer" style="background: #efefef;text-align:center;">
      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      <button type="button" onclick="upload_image()" class="btn btn-success">Upload</button>
    </div>
   </form>
  </div>
 </div>
</div>


<script>
// menamplkan gambar dalam modal
  $(document).ready(function(){
      daftar_img(); // proses jalankan gallery img
      spklistperbulan();
  });

  function view_image() {
    $('img').click(function(){
      console.log('jadi');
      var alt = $(this).attr('alt');
      var src = $(this).attr('src');
      var img = '<div class="row"><div class="col-md-12"><img src="' + src + '" class="img-responsive pad"></div></div>';
      $('#bsPhotoGalleryModal').modal();
      $('.title-modal-img').text(alt);
      $('#bsPhotoGalleryModal').on('shown.bs.modal', function(){
        $('#bsPhotoGalleryModal .modal-body').html(img);
      });
      $('#bsPhotoGalleryModal').on('hidden.bs.modal', function(){
        $('#bsPhotoGalleryModal .modal-body').html('');
      });
    });
  }

// reset form upload gambar
  $('#btnaction-Img').click(function (){
    $('#fom_upload_image')[0].reset('');
    $('[name="upload_file"]').click();
  });

// ganti gambar yang mau di yg mau di upload
  $('#btganti_Img').click(function (){
    $('[name="upload_file"]').click();
  });

// priview image for upload
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
      $('#previewHolder').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
   }
  }
  // aksi priview
  $("#filePhoto").change(function() {
    readURL(this);
  });

  // proses upload gambar
  function upload_image() {
    var cek_titleImg = $('[name="title_img"]').val();
    var upload_file = $('[name="upload_file"]').prop('files')[0];
    var id_kendaraan = $('[name="id_kendaraan"]').val();

    var form_data = new FormData();
    form_data.append('upload_file', upload_file);
    form_data.append('title_img',cek_titleImg);
    form_data.append('id_kendaraan',id_kendaraan);
    form_data.append('title_img',cek_titleImg);

    if(cek_titleImg == ''){
      $('#cek_titleImg').css({'display':'block'});
      setTimeout(function (){
        $('#cek_titleImg').css({'display':'none'});
      },3500);
    }else {
      $.ajax({
        url: '<?php echo base_url('Admin/Data_Ajax/Profil/upload_image_in_db'); ?>',
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        dataType: 'json',
        data: form_data,
        success: function (data) {
          console.log(data);
          if(data == '1'){
            daftar_img();
            $('#ModalUploadImage').modal('hide');
            swal({
              title: "",
              text: "Succes",
              type: "success",
              timer: 1000,
              showConfirmButton: false
            });
          }else if (data == '2') {
            swal({
              title: "",
              text: "Ukuran Gambar Terlalu besar!",
              type: "warning",
              timer: 1000,
              showConfirmButton: false
            });
          }else {
            swal({
              title: "",
              text: "Coba lagi!",
              type: "warning",
              timer: 1000,
              showConfirmButton: false
            });
          }
        }
      });
    }
  }

  // menampilkan daftar gambar kendaraan
  function daftar_img(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Profil/gallery_img?id_kendaraan='.$id_kendaraan); ?>',
      dataType: 'JSON',
      success: function (data) {

        $('#dataGallery-img').html('');
        for (var i = 0; i < data.length; i++) {
          $('#dataGallery-img').append('<li style="border-left: 1px dotted rgb(208, 208, 208); list-style: none; margin-bottom: 5px;" class="col-lg-3 col-md-4 col-sm-3 col-xs-4 col-xxs-12 lidata-gallery"><img onclick="view_image()" alt="'+data[i].ket_img+'"  src="data:image/jpg;base64,'+data[i].img_kendaraan+'" class="img-responsive" style="width: 100%; height: 170px; cursor: pointer;"><div class="textdata-gallery" style="color: rgb(102, 102, 102); font-size: 12px; margin-bottom: 10px; padding: 5px; background: rgb(247, 247, 247); -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; display: -webkit-box;">'+data[i].ket_img+'</div></li>');
        }
      }
    });

    // $.ajax({
    //   url: '<?php echo base_url('Admin/Data_Ajax/Profil/gallery_img?id_kendaraan='.$id_kendaraan); ?>',
    //   dataType: 'JSON',
    //   success: function (data){
    //     console.log('hello');
    //     $('#dataGallery-img').html('');
    //     for (var i = 0; i < data.length; i++) {
    //       $('#dataGallery-img').append('<li style="border-left: 1px dotted rgb(208, 208, 208); list-style: none; margin-bottom: 5px;" class="col-lg-3 col-md-4 col-sm-3 col-xs-4 col-xxs-12 lidata-gallery"><img onclick="view_image()" alt="'+data[i].ket_img+'"  src="data:image/jpg;base64,'+btoa(data[i].img_kendaraan)+'" class="img-responsive" style="width: 100%; height: 170px; cursor: pointer;"><div class="textdata-gallery" style="color: rgb(102, 102, 102); font-size: 12px; margin-bottom: 10px; padding: 5px; background: rgb(247, 247, 247); -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; display: -webkit-box;">'+data[i].ket_img+'</div></li>');
    //     }
    //   }
    // });
  }

  // menampilkan daftar spk kendaraan
  function spklistperbulan(){
      var dataTgl = $('[name="getMontSPK"]').val();

      $('.tblSpk_bulanan').DataTable({
          ordering: true,
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
          order: [[1, "desc"]],
          processing: false,
          serverSide: false,
          ajax: {
              url: "<?php echo base_url('Admin/Data_Ajax/Spk/spkPerbulan?id='.$_GET['id']); ?>&dataTgl="+dataTgl
          }
      });
  }

</script>


<script>
// style gallery img
$('.uldata-gallery').css({'padding':'0','margin':'0 0 40px 0'});
$('.lidata-gallery').css({'list-style':'none','margin-bottom':'5px'});
$('.lidata-gallery img').css({'width':'100%','height':'170px','cursor':'pointer'});
$('.textdata-gallery').css({'color':'#666','font-size':'12px','margin-bottom':'10px','padding':'5px','background':'#f7f7f7','-webkit-line-clamp': '1',
   '-webkit-box-orient': 'vertical','overflow':'hidden','display':'-webkit-box'});
$('#dataGallery-img').css({'padding':'0px'});

$('.none-td').css({'display':'none'});
var kode = '<?php echo $kode; ?>';
$(document).ready(function(){
  tblstnk();
  tbl_asuransi();
  tbl_kir();
  setTimeout(function () {
    $('.colspanth2').attr({'colspan':'2'});
  });
});

function tblstnk() {
  var tabel_stnk = $('.tbl-stnk').DataTable({
    destroy: true,
    ordering: false,
    paging: false,
    searching: false,
    bInfo: false,
    spans:true,
	  processing: false,
	  serverSide: false,
    ajax: {
      url: '<?php echo base_url('Admin/Data_Ajax/Profil/stnk?kode='); ?>'+kode
    }
  });
}

function tbl_asuransi() {
  var tabel_asuransi = $('.tbl-asuransi').DataTable({
    destroy: true,
    ordering: false,
    paging: false,
    searching: false,
    bInfo: false,
    spans:true,
	  processing: false,
	  serverSide: false,
    ajax: {
      url: '<?php echo base_url('Admin/Data_Ajax/Profil/asuransi?kode='); ?>'+kode
    }
  });
}

function tbl_kir() {
  var kir = $('.tbl-kir').DataTable({
    destroy: true,
    ordering: false,
    paging: false,
    searching: false,
    bInfo: false,
    spans:true,
	  processing: false,
	  serverSide: false,
    ajax: {
      url: '<?php echo base_url('Admin/Data_Ajax/Profil/kir?kode='); ?>'+kode
    }
  });
}

// update info data kendaraan
function update_info_kendaraan() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Profil/update_info_kendaraan'); ?>',
    type: 'POST',
    data: $('#form_update_info_kendaraan').serialize(''),
    dataType: 'JSON',
    success: function (data) {
      console.log('okey');
      location.reload();
    }
  });
}

// update stnk
function update_stnk() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Profil/update_stnk'); ?>',
    type: 'POST',
    data: $('#form_update_stnk').serialize(''),
    dataType: 'JSON',
    success: function (data) {
      console.log('okey');
      location.reload();
    }
  });
}

// update data asuransi
function update_asuransi() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Profil/update_asuransi'); ?>',
    type: 'POST',
    data: $('#form_update_asuransi').serialize(''),
    dataType: 'JSON',
    success: function (data) {
      console.log('okey');
      location.reload();
    }
  });
}

// update kir
function update_kir() {
  $.ajax({
    url: '<?php echo base_url('Admin/Data_Ajax/Profil/update_kir'); ?>',
    type: 'POST',
    data: $('#form_update_kir').serialize(''),
    dataType: 'JSON',
    success: function (data) {
      console.log('okey');
      location.reload();
    }
  });
}
</script>
