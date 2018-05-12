<div class="content-wrapper">
  <!-- Buat RAB -->
  <section class="content-header">
    <h1>Data Barang <small><a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalRab" onclick="noRab()">Buat RAB</a></small></h1>
    <ol class="breadcrumb">
      <li><a href="#/"><i class="fa fa-tag"></i> Master Barang</a></li>
    </ol>
  </section>

  <!-- data didalam tabel -->
  <section class="content">
    <div class="row">
    <div class="col-xs-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
       <li class="active"><a href="#dataBarang" data-toggle="tab">Data Barang</a></li>
       <li><a href="#TblRab" data-toggle="tab">RAB</a></li>
       <li><a href="#TblRekapanBarang" data-toggle="tab">Rekapan Penggunaan Barang</a></li>
      </ul>

    <div class="tab-content">
     <!-- Table data barang -->
     <div class="tab-pane active" id="dataBarang">
        <!--h4 class="page-header">Report</h4-->
      <div class="box-body">
        <div class="table-responsive">
         <table class="table table-bordered table-striped tbl-barang">
          <thead>
            <tr class="bg-blue">
             <th style="width:10px">#</th>
             <th>Barang</th>
             <th>Kode</th>
             <th>Merek / KW</th>
             <th>Jumlah</th>
             <th>Satuan</th>
             <th>Harga Jual</th>
             <!--th>Action</th-->
            </tr>
          </thead>
          <tbody>
           <?php $no=0; foreach ($barang as $u) { $no +=1; ?>
             <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $u->nama_barang; ?></td>
              <td><?php echo $u->kode_barang; ?></td>
              <td><?php echo $u->merek_barang.' / '.$u->kw_barang; ?></td>
              <td><?php echo $u->stok_barang; ?></td>
              <td><?php echo $u->satuan; ?></td>
              <td><?php echo 'Rp '.number_format($u->harga_jual , 0, ',', '.'); ?></td>
             </tr>
           <?php } ?>
          </tbody>
        </table>
       </div>
      </div>
     </div>

     <!-- Table rab -->
     <div class="tab-pane" id="TblRab">
       <div class="box-header">
          <div class="input-group col-md-2">
           <input class="form-control dateRab" placeholder="mm/yyyy" data-date-format="MM/yyyy" type="text" value="<?php echo date('F/Y'); ?>" readonly id="tgl_rab">
           <span class="input-group-addon bg-maroon" style="border-radius:0;"><i class="fa fa-calendar"></i></span>
          </div>
       </div>
       <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped tblRab_bulanan">
            <thead>
             <tr class="bg-blue">
               <th>No RAB</th>
               <th>Tanggal</th>
               <th>Status RAB</th>
               <th>Jenis RAB</th>
               <th>Total Harga</th>
               <th>Action</th>
             </tr>
            </thead>

            <tfoot>
             <tr>
               <th style="border-top:1px solid #bcc6d2;text-align:right;" colspan="4">Total :</th>
               <th style="background:#bcc6d2;"></th>
               <th style="border-top:1px solid #bcc6d2;"></th>
             </tr>
            <tfoot>

           </table>
         </div>
       </div>
     </div>

     <!-- Table Rekapan barang -->
     <div class="tab-pane" id="TblRekapanBarang">
       <div class="box-header">
        <div class="col-md-3">
          <div class="input-group">
           <input class="form-control daterekapan_barang" placeholder="mm/yyyy" data-date-format="MM/yyyy" type="text" value="<?php echo date('F/Y'); ?>" readonly id="tgl_rekapan_barang">
           <span class="input-group-addon bg-maroon" style="border-radius:0;"><i class="fa fa-calendar"></i></span>
          </div>
        </div>

        <div class="col-md-3">
          <a id="con_pdfRekap_barang" target="_blank" class="btn bg-purple btn-md">Convert to PDF  <i class="fa fa-file"></i></a>
        </div>
       </div>
       <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped tblRekapan_barang">
            <thead>
             <tr class="bg-blue">
               <th>#</th>
               <th>No Polisi</th>
               <th>No Spk</th>
               <th>Tangal</th>
               <th>Barang</th>
               <th>Jumlah</th>
               <th>Harga</th>
               <th>Total</th>
             </tr>
            </thead>

            <tfoot>
             <tr>
               <th style="border-top:1px solid #bcc6d2;text-align:right;" colspan="7">Total :</th>
               <th style="background:#bcc6d2;"></th>
               <!-- <th style="border-top:1px solid #bcc6d2;"></th> -->
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
  <!--/ data didalam tabl -->


</div>

<!-- Modal RAB -->
<div class="modal fade" id="ModalRab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #efefef;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Buat RAB</h4>
      </div>
      <form action="<?php echo base_url('Admin/Rab/input'); ?>" method="post">
      <div class="modal-body">
       <div class="row">
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">No RAB</label>
          <input type="text" class="form-control" name="no_rab" readonly>
        </div>
        <div class="form-group col-md-6">
          <label for="recipient-name" class="control-label">Tanggal</label>
          <input type="text" class="form-control" name="tgl_rab" value="<?php echo date('d/m/Y'); ?>" readonly>
        </div>

        <div class="form-group col-md-12">
          <label class="control-label">Jenis RAB</label>
          <select class="form-control" name="id_jenis_rab" required>
            <option value="">-- Pilih Jenis Rab --</option>
            <?php foreach ($jns_rab as $rb) { ?>
              <option value="<?php echo $rb->id_jenis_rab; ?>"><?php echo $rb->jenis_rab; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-gorup col-md-12">
          <label class="control-label">Catatan</label>
          <textarea class="form-control" rows="4" placeholder="Catatan.." name="catatan_rab"></textarea>
        </div>

       </div>
      </div>
      <div class="modal-footer" style="background: #efefef;text-align:center;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" onclick="inputDivisi()" class="btn btn-success">Buat</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--/ Modal RAB -->


<script>
$(function() {
  $(".tbl-barang").DataTable({order: [[1, "asc"]]});
});


  $(document).ready(function(){
    //setTimeout(noRab,10);
    tabelRAB();
    tabelRekapan();
  });

  function noRab(){
    $.ajax({
      url: '<?php echo base_url('Admin/Data_Ajax/Rab/no_rab'); ?>',
      dataType: "JSON",
      success: function (data) {
        $('[name="no_rab"]').val(data);
      }
    });
  }

  // rekapan RAB perbulan
  function tabelRAB() {
    var tgl = $('#tgl_rab').val();
    $('.tblRab_bulanan').DataTable({
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
        .column( 4 )
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
        $( api.column( 4 ).footer() ).html('<b>Rp. </b>'+ hasil_total);
      },
      order: [[1, "desc"]],
      processing: false,
      serverSide: false,
      ajax: {
        url: "<?php echo base_url('Admin/Data_Ajax/Rab/rab_bulanan?date='); ?>"+tgl,
        type: 'POST',
      }
    });
  }

  // tabel rekapan penggunaan barang perbulan
  function tabelRekapan() {
   var tgl_rekap = $('#tgl_rekapan_barang').val();

   $('#con_pdfRekap_barang').attr({'href':'<?php echo base_url('Pdf/Rekap_barang?date='); ?>'+tgl_rekap});

   $('.tblRekapan_barang').DataTable({
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
       .column( 7 )
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
       $( api.column( 7 ).footer() ).html('<b>Rp. </b>'+ hasil_total);
     },
     order: [[0, "desc"]],
     processing: false,
     serverSide: false,
     ajax: {
       url: "<?php echo base_url('Admin/Data_Ajax/Data_barang/rekap_Barang?date='); ?>"+tgl_rekap
     }
   });
  }
</script>
