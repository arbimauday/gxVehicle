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

  <h3 style="text-align:center;">Rekapan Penggunaan Barang</h3>
  <p style="margin:0px;">Bulan : <?php echo $tgl; ?></p>
  <?php
   $ttl = 0;
   foreach ($tblBarang as $ui){
     $ttl += $ui->total_harga;
   }
  ?>
  <p style="margin:0 0 10px 0;">Total : <?php echo 'Rp '. number_format( $ttl, 0, ',', '.') ?></p>

  <table style="width:100%;border-collapse:none;margin:0;font-size:12px;">
   <thead>
    <tr style="background:#3385ff;">
     <th style="text-align:center;padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:4px;">#</th>
     <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:90px;">No Polisi</th>
     <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:90px;">No Spk</th>
     <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:auto;text-align:center;">Tanggal</th>
     <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;">Barang</th>
     <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;width:65px;">Jml</th>
     <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;">Harga</th>
     <th style="padding:8px 10px;border-right:1px solid #4d94ff;color:#fff;">Total</th>
    </tr>
   </thead>
   <tbody>
    <?php foreach ($tblBarang as $key => $ie) { $key += 1; ?>
      <tr style="background:#f7f7f7;border-bottom:1px solid #e6e6e6;">
       <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;text-align:center;"><?php echo $key; ?></td>
       <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;"><?php echo $ie->nomor_polisi; ?></td>
       <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;"><?php echo $ie->no_spk; ?></td>
       <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;"><?php echo $ie->tgl_ambil; ?></td>
       <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;"><?php echo $ie->nama_barang; ?></td>
       <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;"><?php echo $ie->jml_penggunaan.' '.$ie->satuan; ?></td>
       <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;"><?php echo 'Rp '. number_format( $ie->harga_barang, 0, ',', '.'); ?></td>
       <td style="border-right:1px solid #e6f0ff;border-bottom:1px solid #e6e6e6;padding:6px 8px;"><?php echo 'Rp '. number_format( $ie->total_harga, 0, ',', '.') ?></td>
      </tr>
    <?php }?>
   </tbody>
  </table>
</body>
</html>
