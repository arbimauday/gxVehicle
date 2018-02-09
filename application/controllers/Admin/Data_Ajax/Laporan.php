<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

  function __construct(){
   parent::__construct();
   $this->load->model(array('Mform','Mspk','Mlaporan'));
   $this->load->helper('url');
   $this->load->library('session','database');
  }

  function data(){
    $idspk = $_GET['idspk'];
    $data_get = $this->Mlaporan->data($idspk);

    $output = array();
    $output['data'] = array();
    foreach ($data_get as $u) {
      $output['data'][] = array(
       '<div class="col-md-12"><address style="margin-bottom:5px;"><b>Teknisi :</b> '.$u->nama.' <br><b>Tanggal :</b></b> '.$u->tgl.'</address><div class="col-md-12 ext-muted well well-sm no-shadow"><b>Laporan:</b> '.$u->isi.'</></div>'
      );
    }
    echo json_encode($output);
  }

  function kirim_data(){
   $idspk = $this->input->post('idspk');
   $id_teknisi = $this->input->post('id_teknisi');
   $tgl = $this->input->post('tgl');
   $isi = $this->input->post('isi');

   $input = array(
    'id_spk' => $idspk,
    'id_teknisi' => $id_teknisi,
    'isi' => $isi,
    'tgl' => $tgl
   );
   $data = $this->Mform->input_cek($input,'laporan_spk');
   echo json_encode($data);
  }

}

?>
