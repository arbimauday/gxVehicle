<?php
class Rekap_barang extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mbarang','Mspk'));
    $this->load->helper('url');
    $this->load->library('m_pdf','Sweet_alert');
  }

  public function index(){
    $to = DateTime::createFromFormat ('M/Y',$_GET['date']);
    $getData = $to->format('Y/m');
    $this->data['tgl'] = $_GET['date'];
    $this->data['tblBarang'] = $this->Mbarang->rekapan_bulanan($getData);

    $html=$this->load->view('File_Pdf/rekapan_barang',$this->data, true);
    $pdfFilePath =FCPATH ."uploads/".date('dmy').".pdf";
  	$pdf = $this->m_pdf->load();
    $pdf->WriteHTML($html,2);
  	$pdf->Output();
  }

}
?>
