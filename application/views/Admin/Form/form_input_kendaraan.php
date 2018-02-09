<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1>Form Kendaraan<small></small></h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-random"></i> SPK Pekerjaan</a></li>
   </ol>
 </section>
  <!-- Main content -->
 <section class="content">
  <!-- Main row -->
  <div class="row">
   <section class="col-lg-12 connectedSortable">
    <div class="box box-primary">
     <form method="post" action="<?php echo base_url(); ?>Admin/Form/inputkendaraan">
      <div class="box-body">

       <!-- Infor Kendaraan -->
       <div class="col-md-4">
        <div class="box" style="border-radius:0%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
         <div class="box-header" style="background:#3c8dbc;color:#fff;border-radius:2%;">
          <h3 class="box-title">1. Info Kendaraan</h3>
         </div>
         <div class="box-body">
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">No Polisi</label>
             <input class="form-control" placeholder="Contoh ( DK 0000 AA )" type="text" name="nomor_polisi" maxlength="12" required>
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Jenis Kendaraan</label>
             <select class="form-control" name="id_jenis_kendaraan" required onchange="view_buku_kir()">
              <option>-- Pilih --</option>
              <option value="1">Motor</option>
              <option value="2">Mobil</option>
             </select>
            </div>

            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Port</label>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#Modalport">(+ Tambah)</a>
             <select class="form-control" name="id_port" required>
             </select>
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1 margin-r-5">Divisi </label>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#exampleModal">(+ Tambah)</a>
             <select class="form-control" name="id_divisi" required>
             </select>
            </div>

            <div class="form-group col-md-6">
             <label for="exampleInputPassword1">Tgl Pembelian</label>
             <input class="form-control datepicker" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" type="text" maxlength="12" name="tgl_pembelian" readonly>
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputPassword1">Tgl Penerimaan</label>
             <input class="form-control datepicker" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" type="text" maxlength="12" name="tgl_penerimaan" readonly>
            </div>

            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Status Hak</label>
             <select class="form-control" name="id_hak" required>
               <option value="1">Di Simpan</option>
               <option value="2">Di Pegang</option>
             </select>
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Keadaan Saat Ini</label>
             <select class="form-control" name="id_keadaan" required>
               <option value="1">Normal</option>
               <option value="2">Rusak Ringan</option>
               <option value="3">Rusak Parah</option>
             </select>
            </div>

         </div>
        </div>
       </div>

       <!-- STNK -->
       <div class="col-md-4">
        <div class="box" style="border-radius:0%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
         <div class="box-header" style="background:#3c8dbc;color:#fff;border-radius:2%;">
          <h3 class="box-title">2. Data STNK</h3>
         </div>
         <div class="box-body">
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Merek</label>
             <input class="form-control" placeholder="- - - - - -" type="text" name="merek" maxlength="100">
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Thn Perakitan</label>
             <input class="form-control datepicker_year" readonly placeholder="Tahun" data-date-format="yyyy" type="text" name="thn_perakitan" maxlength="4" onkeypress="return hanyaAngka(event)">
            </div>

            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">No Rangka</label>
             <input class="form-control"  placeholder="- - - - - -" type="text" name="no_rangka" maxlength="40">
            </div>
            <div class="form-group col-md-6">
              <label for="exampleInputEmail1">No mesin</label>
              <input class="form-control"  placeholder="- - - - - -" type="text" name="no_mesin" maxlength="40">
            </div>

            <div class="form-group col-md-6">
             <label for="exampleInputPassword1">Jenis Model</label>
             <input class="form-control" type="text" maxlength="50"  placeholder="- - - - - -" name="jenis_model">
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputPassword1">Bahan Bakar</label>
             <input class="form-control"  placeholder="- - - - - -" type="text" maxlength="50" name="bahan_bakar">
            </div>

            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Warna</label>
             <input class="form-control"  placeholder="- - - - - -" type="text" maxlength="50" name="warna">
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Masa STNK</label>
             <input class="form-control datepicker" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" type="text" maxlength="12" name="masa_stnk"  placeholder="- - - - - -" readonly>
            </div>
         </div>
        </div>
       </div>

       <!-- Asuransi -->
       <div class="col-md-4">
        <div class="box" style="border-radius:0%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
         <div class="box-header" style="background:#3c8dbc;color:#fff;border-radius:2%;">
          <h3 class="box-title">3. Asuransi</h3>
         </div>
         <div class="box-body">
            <div class="form-group col-md-6">
             <label for="exampleInputPassword1">Nama Asuransi</label>
             <input class="form-control"  placeholder="- - - - - -" type="text" maxlength="50" name="nama_asuransi">
            </div>

            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Jatuh Tempo</label>
             <input class="form-control"  placeholder="- - - - - -" type="text" maxlength="50" name="jatuh_tempo">
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Nominal</label>
             <input class="form-control"  placeholder="- - - - - -" type="text" maxlength="50" name="nominal">
            </div>
         </div>
        </div>
       </div>

       <!-- Kir -->
       <div class="col-md-4" id="form_buku_kir" style="display:none;">
        <div class="box" style="border-radius:0%;border-top:0px;box-shadow:0 10px 20px rgba(0, 0, 0, 0.2);">
         <div class="box-header" style="background:#3c8dbc;color:#fff;border-radius:2%;">
          <h3 class="box-title">4. Buku Kir</h3>
         </div>
         <div class="box-body">
            <div class="form-group col-md-6">
             <label for="exampleInputPassword1">Nama Pemilik</label>
             <input class="form-control"  placeholder="- - - - - -" type="text" maxlength="50" name="nama_pemilik">
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Alamat Pemilik</label>
             <input class="form-control" placeholder="- - - - - -" type="text" maxlength="50" name="alamat_pemilik">
            </div>

            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">No Uji Berkala</label>
             <input class="form-control" placeholder="- - - - - -" type="text" maxlength="50" name="no_uji_berkala">
            </div>
            <div class="form-group col-md-6">
             <label for="exampleInputEmail1">Status Pengguna</label>
             <input class="form-control" placeholder="- - - - - -" type="text" maxlength="50" name="status_pengguna">
            </div>
         </div>
        </div>
       </div>
      </div>
      <div class="box-footer">
           <div class="col-md-12 text-center">
            <a href="<?php echo base_url('Admin/Info_kendaraan'); ?>" class="btn btn-danger">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
           </div>
          </div>
     </form>
    </div>
   </section>
  </div>
 </section>
</div>


<!-- form modal input divisi -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Tambah Divisi</h4>
      </div>
      <div class="modal-body">
        <form id="form_divisi">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Divisi:</label>
            <input type="text" class="form-control" name="nama_divisi">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="inputDivisi()" class="btn btn-primary">Tambahkan</button>
      </div>
    </div>
  </div>
</div>

<!-- form modal input port -->
<div class="modal fade" id="Modalport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Port</h4>
      </div>
      <div class="modal-body">
        <form id="form_port">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Port:</label>
            <input type="text" class="form-control" name="nama_port">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="inputport()" class="btn btn-primary">Tambahkan</button>
      </div>
    </div>
  </div>
</div>



<script>
  function view_buku_kir() {
    var cek = $('[name="id_jenis_kendaraan"]').val();

    if(cek == '2'){
      document.getElementById("form_buku_kir").style.display = 'block';
      //$('#form_buku_kir input').prop('required',true);
    }else {
      document.getElementById("form_buku_kir").style.display = 'none';
      //$('#form_buku_kir input').prop('required',false);
    }
  }


  $(document).ready(function(){
  setTimeout(daftar_divisi,10);
  setTimeout(daftar_port,10);
  });

  // daftar divisi
  function daftar_divisi(){
    $.ajax({
      url: "<?php echo base_url('Admin/Data_Ajax/User/divisi'); ?>",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_divisi"]').html('');
        $('[name="id_divisi"]').append('<option value="">-- Divisi --</option>');
        for (var i = 0; i < data.length; i++) {
          $('[name="id_divisi"]').append('<option value="'+data[i].id_divisi+'">'+data[i].divisi+'</option>');
        }
      }
    });
  }

  // daftar port
  function daftar_port(){
    $.ajax({
      url: "<?php echo base_url('Admin/Data_Ajax/User/port'); ?>",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_port"]').html('');
        $('[name="id_port"]').append('<option value="">-- Port --</option>');
        for (var i = 0; i < data.length; i++) {
          $('[name="id_port"]').append('<option value="'+data[i].id_port+'">'+data[i].port+'</option>');
        }
      }
    });
  }

  //input divisi
  function inputDivisi() {
    var cek = $('[name="nama_divisi"]').val();
    if(cek == ''){
      swal({
      title: "",
      text: "Data kosong tidak diperbolehkan!",
      type: "error",
      timer: 1500,
      showConfirmButton: false
      });
    }else {
      $.ajax({
        url: "<?php echo base_url('Admin/Data_Ajax/Input/divisi')?>",
        type: "POST",
        data: $('#form_divisi').serialize(),
        dataType: "JSON",
        success: function(data) {
          $('#exampleModal').modal('hide')
          $('[name="nama_divisi"]').val('');
          swal({
          title: "",
          text: "Berhasil!",
          type: "success",
          timer: 1000,
          showConfirmButton: false
          });
          setTimeout(daftar_divisi,10);
        }
      });
    }
  }

  //input port
  function inputport() {
    var cek = $('[name="nama_port"]').val();
    if(cek == ''){
      swal({
      title: "",
      text: "Data kosong tidak diperbolehkan!",
      type: "error",
      timer: 1500,
      showConfirmButton: false
      });
    }else {
      $.ajax({
        url: "<?php echo base_url('Admin/Data_Ajax/Input/port')?>",
        type: "POST",
        data: $('#form_port').serialize(),
        dataType: "JSON",
        success: function(data) {
          $('#Modalport').modal('hide')
          $('[name="nama_port"]').val('');
          swal({
          title: "",
          text: "Berhasil!",
          type: "success",
          timer: 1000,
          showConfirmButton: false
          });
          setTimeout(daftar_port,10);
        }
      });
    }
  }
</script>
