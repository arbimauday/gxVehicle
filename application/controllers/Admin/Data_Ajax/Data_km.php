<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data_km extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mcodeunik','Mjoin_table'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  // catatan km kendaraan
  public function buat_catatan_info_km(){
    $id_kendaraan         = $this->input->post('id_kendaraan');
    $tgl_ganti            = $this->input->post('tgl_ganti');
    $km_ganti_oli         = $this->input->post('km_ganti_oli');
    $tgl_ganti_berikutnya = $this->input->post('tgl_ganti_berikutnya');

    $where = array(
      'id_kendaraan' => $id_kendaraan,
      'ket_ganti'    => '0'
    );
    $cek_catatan = $this->Mform->where_ajax($where,'catatan_ganti_oli');
    if(empty($cek_catatan)){
      $inputData = array(
        'id_kendaraan' => $id_kendaraan,
        'tgl_ganti'    => $tgl_ganti,
        'km_ganti_oli' => $km_ganti_oli,
        'tgl_ganti_berikutnya'  => $tgl_ganti_berikutnya
      );
      $data = $this->Mform->input($inputData,'catatan_ganti_oli');
      echo json_encode($id_kendaraan );
    }
  }

  // data modal info km
  public function info_km($id_data){
    $where = array(
      'id_kendaraan' => $id_data,
      'respon_admin' => '0'
    );
    $data = $this->Mform->where_ajax($where,'catatan_ganti_oli');
    echo json_encode($data);
  }

}

?>
