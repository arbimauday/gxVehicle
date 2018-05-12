<html>
<head>
</head>
<body style="margin:0;padding:0;">
<!--===> COP SURAT SPK <===-->
<div style="padding:0;margin:0;">
 <div style="width:50%;float:left;font-size:12px;">
  <h3 style="margin:0;font-family:arial;">PT. ARBA XTREME MEDIA</h3>
  <p style="margin:0;font-family:arial,sans-serif;font-size:10px;">Jl. Raya Kerobokan 388x, Br Semer<br>Kuta, Bali (80361) Indonesia</p>
  <p style="margin:0;font-family:arial,sans-serif;font-size:10px;">P. (0361) 736811 </p>
  <p style="margin:0;font-family:arial,sans-serif;font-size:10px;">E. info@globalxtreme.net</p>
 </div>
 <div style="width:50%;float:right;font-size:12px;">
  <p style="text-align:right;margin:0;padding-right:35px;"><img src="./assets/img/pdf/TV.png"></p>
 </div>
 <!--hr style="margin-top:0;border:1px solid red;"-->
</div>
<br>
<!-- JUDUL SURAT-->
<h3 style="margin-top:0;text-align:center;">Surat Perintah Kerja (SPK)</h3>

<!-- ISI KETERANGAN SPK -->
<div style="padding: 0px 10px;background:;border-radius:5px;margin:0;">
  <?php
   if(!empty($master_spk)){//JIKA DATA TIDAK KOSONG
     foreach($master_spk as $u){
   ?>
  <div style="width:49%;float:left;font-size:12px;border-right:1px solid black;">
    <table style="font-size:12px;">
      <tr>
        <td>No. SPK</td><td>:</td><td><?php echo $u->no_spk?></td>
      </tr>
      <tr>
        <td>Tanggal</td><td>:</td><td><?php echo $u->tgl_spk?></td>
      </tr>
      <tr>
        <td>Plat No.</td><td>:</td><td><?php echo $u->nomor_polisi.' '. '('.$u->merek.')'?></td>
      </tr>
      <tr>
        <td>No. RAB</td><td>:</td><td></td>
      </tr>
    </table>
  </div>

  <div style="width:50%;float:right;font-size:12px;">
    <table style="font-size:12px;">
      <tr >
        <td>Customer</td><td>:</td><td>GlobalXtreme</td>
      </tr>
      <tr>
        <td>Peminta</td><td>:</td><td><?php echo $peminta; ?> </td> <!--(?php echo $u->id_divisi; ?>)-->
      </tr>
      <tr>
        <td>Alamat</td><td>:</td><td>Jl. Kerobokan 388x Br. Kuta, Bali, Indonesia</td>
      </tr>
      <tr>
        <td>Teknisi</td><td>:</td><td><?php echo $teknisi; ?></td>
      </tr>
    </table>
  </div>
</div>

<!-- KELUHAN DAN SOLUSI ->
<div style="margin:5px 0 0 0;">

</div-->

<!-- Kolom Keluhan -->
<div style="font-size:15px;"><p style="margin:0;">Keluhan</p></div>
<div style="width:100%;height:40px;font-size:12px;border:1px solid black;margin-top:0;padding:0 5px;"><?php echo $u->keluhan; ?></div>

<!-- Kolom Solusi -->
<div style="font-size:15px;margin:5px 0 0 0;"><p style="margin:0;">Solusi</p></div>
<div style="width:100%;height:auto;border:1px solid black;margin-top:0;padding:0 5px;font-size:12px;"><?php echo $u->solusi; ?></div>

<?php
    }
      }else{//JIKA DATA KOSONG
    echo "Data kosong";
    }
?>
<p style="margin:0;font-size:9px;">
  Mohon untuk tidak meninggalkan barang Berharga didalam kendaraan, Apabila terjadi kerusakan / kehilangan menjadi tanggung jawab Customer.<small>*</small>
</p>
<p style="margin:0;font-size:9px;">Solusi / Analisa berdasarkan Keluhan dari Customer.<small>*</small></p>

<p style="border-top:0.5px solid black;"></p>
<div style="width:30%;height:90px;float:left;font-size:12px;margin:0;text-align:center;">
  <p style="padding:0 5px 0 7px;margin:0;">Nama Peminta</p>
  <br><br><br>
  <p style="padding:0 5px 0 7px;margin:0;">( <?php echo $peminta; ?> )</p>
</div>

<!-- KOLOM TANDA TANGAN -->
<div style="width:30%;height:90px;float:right;font-size:12px;margin:0;text-align:center;">
  <p style="padding:0 5px 0 7px;margin:0;">Service Advisor</p>
  <br><br><br>
  <p style="padding:0 5px 0 7px;margin:0;">( Bpk. Boby )</p>
</div>

<div style="width:40%;height:90px;float:right;font-size:12px;margin:0;text-align:center;">
  <p style="padding:0 5px 0 7px;margin:0;">Mengetahui</p>
  <br><br><br>
  <p style="padding:0 5px 0 7px;margin:0;">( Bpk. Alik Yuswanto )</p>
</div>
<p style="margin:0;border-top:0.5px solid black;"></p>

<!--TOTAL HARGA-->
<?php $totalharga = 0;
  foreach($penggunaan_barang as $d){
    $totalharga += $d->total_harga;
  }
?>
<div style="background:;width: 60%; border-radius:5px;padding: 5px;margin:6px 0 0 0;">
  <table style="border-collapse: none;height:300px;margin:0;font-size:12px;">
    <tr>
      <td>Total Harga Barang</td><td>:</td><td> Rp. <?php echo number_format($totalharga , 0, ',', '.'); ?></td>
    </tr>
    <tr>
      <td>Ongkos Kerja</td><td>:</td><td>Rp.</td>
    </tr>
    <tr>
      <td>Total Pembayaran</td><td>:</td><td>Rp.</td>
    </tr>
  </table>
</div>

<!--  TABEL BARANG YANG DI BELI  -->
<div style="margin:0 0 0 0;">
  <div>Data Penggunaan Barang
  <table style="border-collapse:none;margin:0;font-size:18px;">
      <tr style="background:#3385ff;">
        <th style="text-align:center;height:40px;border-right:1px solid #4d94ff;color:#fff;" width="40px">No</th>
        <th style="text-align:center;height:40px;border-right:1px solid #4d94ff;color:#fff;" width="300">Nama Barang</th>
        <th style="text-align:center;height:40px;border-right:1px solid #4d94ff;color:#fff;" width="150">Tgl Ambil</th>
        <th style="text-align:center;height:40px;border-right:1px solid #4d94ff;color:#fff;" width="150">Harga</th>
        <th style="text-align:center;height:40px;border-right:1px solid #4d94ff;color:#fff;" width="140">Jml Barang</th>
        <th style="text-align:center;height:40px;color:#fff;" width="180">Total</th>
      </tr>

    <?php
      $urut = 0;
      foreach($penggunaan_barang as $u){
      $urut += 1;
    ?>
    <tr style="text-align:center;background:#f7f7f7;border-bottom:1px solid #e6e6e6;">
    <td style="text-align:center;border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;height:40px;"><?php echo $urut; //membuat nomor urut?></td>
    <td style="padding-left:10px;border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;height:10px;"><?php echo $u->nama_barang; ?></td>
    <td style="padding-left:10px;border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;height:40px;"><?php echo $u->tgl_ambil; ?></td>
    <td style="padding-left:10px;border-right:1px solid #e6e6e6;border-bottom:1px solid #e6e6e6;height:40px;">Rp. <?php echo number_format($u->harga_barang , 0, ',', '.'); ?></td>
    <td style="padding-left:10px;border-right:1px solid #e6e6e6;border-bottom:1px solid #e6e6e6;height:40px;"><?php echo $u->jml_penggunaan; ?></td>
    <td style="padding-left:10px;border-bottom:1px solid #e6e6e6;height:40px;">Rp. <?php echo number_format($u->total_harga , 0, ',', '.'); ?></td>
    </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>
