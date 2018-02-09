<?php
class Laporan_peminjaman extends CI_Controller {

  function __construct(){
      parent::__construct();
      $this->load->model(array('Mdaftar_kendaraan'));
      $this->load->library(array('m_pdf'));
  }

  public function index(){
   $datatgl = $_GET['date'];
   $this->data['tgl'] = $datatgl;
   $this->data['data_tabel'] = $this->Mdaftar_kendaraan->aktifitas_keluar($datatgl);

   $this->data['keluar'] = $this->Mdaftar_kendaraan->con_keluar($datatgl)->result();

   $this->data['masuk'] = $this->Mdaftar_kendaraan->con_masuk($datatgl)->result();

   $html=$this->load->view('File_Pdf/laporan_peminjaman',$this->data, true);
   $pdfFilePath =FCPATH ."uploads/".date('dmy').".pdf";
   $pdf = $this->m_pdf->load();
   $pdf->WriteHTML($html,2);
   $pdf->Output();
  }

}

?>
