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
<h3 style="margin-top:0;text-align:center;">Laporan Penggunaan Kendaraan</h3>
<p>Tanggal : <?php echo $tgl; ?></p>

<?php
$ket = array();
$userLo = array();
$kmM = array();
$waktuM = array();
foreach ($masuk as $mu) {

  if(!empty($mu->km_masuk) && $mu->tgl_keluar !== $mu->tgl_masuk){
    $ket[$mu->id_atf_keluar] = '<span style="color:#dd4b39;">Lebih dari 1 hari</span>';
  }elseif (!empty($mu->km_masuk)) {
    $ket[$mu->id_atf_keluar] = '<span style="color:;">Tepat Waktu</span>';
  }else {
    $ket[$mu->id_atf_keluar] = '<span style="color:#f39c12;">Belum Kembali</span>';
  }
  if(!empty($mu->nama)){
  $userLo[$mu->id_atf_keluar] = $mu->nama;
  }else {
    $userLo[$mu->id_atf_keluar] = '-';
  }
  if(!empty($mu->km_masuk)){
    $kmM[$mu->id_atf_keluar] = $mu->km_masuk;
  }else {
    $kmM[$mu->id_atf_keluar] = '-';
  }
  if(!empty($mu->waktu_masuk)){
  $waktuM[$mu->id_atf_keluar] = $mu->waktu_masuk;
  }else {
    $waktuM[$mu->id_atf_keluar] = '-';
  }
}

?>

<table style="width:100%;border-collapse:none;margin:0;font-size:12px;">
 <thead>
   <tr style="background:#3385ff;">
    <th style="text-align:center;padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:4px;">#</th>
    <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:90px;">No Plat</th>
    <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:45px;">Jenis</th>
    <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:110px;text-align:center;">Nama</th>
    <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:40px;text-align:center;">Waktu</th>
    <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:100px;text-align:center;">Km</th>
    <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:70px;text-align:center;">Keadaan</th>
    <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:110px;text-align:center;">Ket Pengguna</th>
   </tr>
 </thead>
 <tbody>
  <?php
    foreach ($keluar as $key => $vi) { $key +=1;
  ?>
   <tr style="background:#f7f7f7;border-bottom:1px solid #e6e6e6;">
    <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;text-align:center;"><?php echo $key; ?></td>
    <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;text-align:center;"><?php echo $vi->nomor_polisi; ?></td>
    <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;text-align:center;"><?php echo $vi->jenis_kendaraan; ?></td>
    <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;">Out: <?php echo $vi->nama; ?><br> In: <?php echo $userLo[$vi->id_atf_keluar]; ?></td>
    <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;">Out: <?php echo $vi->waktu_keluar; ?> <br style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;"> In: <?php echo $waktuM[$vi->id_atf_keluar]; ?></td>
    <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;">Out: <?php echo $vi->km_keluar; ?><br>In: <?php echo $kmM[$vi->id_atf_keluar]; ?></td>
    <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;text-align:center;"><?php echo $vi->keadaan; ?></td>
    <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;text-align:center;"><?php echo $ket[$vi->id_atf_keluar]; ?></td>
   </tr>
  <?php } ?>
 </tbody>
</table>


</body>
</html>
