<?php
class Spk extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mbarang','Mspk'));
		$this->load->helper('url');
		$this->load->library('m_pdf','Sweet_alert');
  }

  function kosong(){
   $idspk = $_GET['idspk'];
   //$this->data['barang'] = $this->Mbarang->penggunaan($idspk);

	 //now pass the data//
	 $this->data['title']="MY PDF TITLE 1.";
	 $this->data['master_spk']	=	$this->Mspk->lihatSpk($idspk);

   if($this->data['master_spk'] == null){
     echo $this->sweet_alert->notification();
     echo '<script>setTimeout(function(){
     swal({
     title: "",
     text: "SPK tidak tersedia!",
     type: "error",
     timer: 2000,
     showConfirmButton: false
     });})</script>';
     echo "<script>setTimeout(function(){
     window.location.href = '".base_url()."Admin/Data_spk';},2500)</script>";
   }else {
     // nama peminta / reques name
     foreach ($this->data['master_spk'] as $u) {
       $cekPeminta = array('id_user' => $u->id_peminta);
       $cekteknisi = array('id_user' => $u->id_teknisi);
       $hasil = $this->Mform->where($cekPeminta,'user')->result();
       $teknisi = $this->Mform->where($cekteknisi,'user');
       foreach ($hasil as $ue) {
        $this->data['peminta'] = $ue->nama;
       }
       if($teknisi->num_rows() > 0){
         foreach ($teknisi->result() as $e) {
          $this->data['teknisi'] = $e->nama;
         }
       }else {
         $this->data['teknisi'] = '';
       }
     }
  	 //now pass the data //

  	$html=$this->load->view('File_Pdf/spk_kosong',$this->data, true);
  	//$pdfFilePath ="mypdfName-".date('d/m/y');
    $pdfFilePath =FCPATH ."uploads/".date('dmy').".pdf";
  	$pdf = $this->m_pdf->load();

  	$pdf->SetHTMLFooter('<hr>
      <p style="margin:0;font-family:arial,sans-serif;font-size:10px;">Syarat & Ketentuan :</p>
      <p style="margin:0 0 0 30px;font-family:arial,sans-serif;font-size:8px;">
      	PKB ini merupakan SURAT KUASA dari Pelanggan kepada ARBAXTREME untuk :
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		a.&nbsp;&nbsp; Mengerjakan pekerjaan seperti yang tertulis pada PKB ini.
      	</p>
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		b.&nbsp;&nbsp; Izi mencoba kendaraan di luar Bengkel ARBAXTREME.
      	</p>
      </p>

      <p style="margin:0 0 0 30px;font-family:arial,sans-serif;font-size:8px;">
      	Jaminan pekerjaan berlaku :
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		a.&nbsp;&nbsp; General Repair, 15 Hari atau 1.000 km mana yang tercapai terlebih dahulu.
      	</p>
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		b.&nbsp;&nbsp; Engine Overhaul, 1 bulan atau 1.000 km mana yang tercapai lebih dahulu.
      	</p>
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		c.&nbsp;&nbsp; Pengecekan 3 bulan.
      	</p>
      </p>

      <p style="margin:0 0 0 30px;font-family:arial,sans-serif;font-size:8px;">
      	Apabila dalam waktu 2 (dua) hari setelah perbaikan part bekas tidak diambil, maka kami berhak untuk melakukan pemusnahan part bekas tersebut.
      </p>
      <p style="margin:0 0 0 30px;font-family:arial,sans-serif;font-size:8px;">
      	Apabila dalam waktu 7 (tujuh) hari kendaraan tidak diambil dari Bengkel ARBAXTREME, maka kami akan kenakan biaya tambahan <br>sebesar Rp. 10.000 (Sepuluh Ribu Rupiah) Perhari.
      </p><br><br>');
  	$pdf->WriteHTML($html,2);
  	$pdf->Output();
   }
  }


  function closed(){
    $idspk = $_GET['idspk'];
    $cek_status = array('id_spk' => $idspk, 'id_status_spk' => '3');
    $cek = $this->Mform->where_ajax($cek_status,'master_spk');
    if($cek == null){
      echo $this->sweet_alert->notification();
      echo '<script>setTimeout(function(){
      swal({
      title: "",
      text: "SPK tidak tersedia!",
      type: "error",
      timer: 2000,
      showConfirmButton: false
      });})</script>';
      echo "<script>setTimeout(function(){
      window.location.href = '".base_url()."Admin/Data_spk';},2500)</script>";
    }else {


   	 $this->data['master_spk']	=	$this->Mspk->lihatSpk($idspk);
     // nama peminta / reques name
     foreach ($this->data['master_spk'] as $u) {
       $cekPeminta = array('id_user' => $u->id_peminta);
       $cekteknisi = array('id_user' => $u->id_teknisi);
       $hasil = $this->Mform->where($cekPeminta,'user')->result();
       $teknisi = $this->Mform->where($cekteknisi,'user')->result();
       foreach ($hasil as $ue) {
        $this->data['peminta'] = $ue->nama;
       }
       foreach ($teknisi as $e) {
        $this->data['teknisi'] = $e->nama;
       }
     }
  	 //now pass the data //

     $this->data['penggunaan_barang'] = $this->Mbarang->penggunaan($idspk);

  	$html=$this->load->view('File_Pdf/spk_closed',$this->data, true);
  	//$pdfFilePath ="mypdfName-".date('d/m/y');
    $pdfFilePath =FCPATH ."uploads/".date('dmy').".pdf";
  	$pdf = $this->m_pdf->load();

  	$pdf->SetHTMLFooter('<hr>
      <p style="margin:0;font-family:arial,sans-serif;font-size:10px;">Syarat & Ketentuan :</p>
      <p style="margin:0 0 0 30px;font-family:arial,sans-serif;font-size:8px;">
      	PKB ini merupakan SURAT KUASA dari Pelanggan kepada ARBAXTREME untuk :
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		a.&nbsp;&nbsp; Mengerjakan pekerjaan seperti yang tertulis pada PKB ini.
      	</p>
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		b.&nbsp;&nbsp; Izi mencoba kendaraan di luar Bengkel ARBAXTREME.
      	</p>
      </p>

      <p style="margin:0 0 0 30px;font-family:arial,sans-serif;font-size:8px;">
      	Jaminan pekerjaan berlaku :
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		a.&nbsp;&nbsp; General Repair, 15 Hari atau 1.000 km mana yang tercapai terlebih dahulu.
      	</p>
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		b.&nbsp;&nbsp; Engine Overhaul, 1 bulan atau 1.000 km mana yang tercapai lebih dahulu.
      	</p>
      	<p style="margin:0 0 0 100px;font-family:arial,sans-serif;font-size:8px;">
      		c.&nbsp;&nbsp; Pengecekan 3 bulan.
      	</p>
      </p>

      <p style="margin:0 0 0 30px;font-family:arial,sans-serif;font-size:8px;">
      	Apabila dalam waktu 2 (dua) hari setelah perbaikan part bekas tidak diambil, maka kami berhak untuk melakukan pemusnahan part bekas tersebut.
      </p>
      <p style="margin:0 0 0 30px;font-family:arial,sans-serif;font-size:8px;">
      	Apabila dalam waktu 7 (tujuh) hari kendaraan tidak diambil dari Bengkel ARBAXTREME, maka kami akan kenakan biaya tambahan <br>sebesar Rp. 10.000 (Sepuluh Ribu Rupiah) Perhari.
      </p><br><br>');
  	$pdf->WriteHTML($html,2);
  	$pdf->Output();

    }
  }


}
?>
