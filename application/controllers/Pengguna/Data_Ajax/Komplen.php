<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Komplen extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mcodeunik','Mdaftar_kendaraan'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function input_komplen(){
    $id_kendaraan = $this->input->post('id_kendaraan_komplen');
    $id_user = $this->input->post('id_user_komplen');
    $pass = md5($this->input->post('pass_komplen'));
    $komplen = $this->input->post('komplen');

    // pengecekan password dan user
    $where = array(
      'id_user' => $id_user,
      'pass'    => $pass
    );
    $cek = $this->Mform->where_ajax_number($where,'user');
    if($cek == '0'){
      $data = '0';
    }else {
      $input = array(
       'id_kendaraan' => $id_kendaraan,
       'id_user_komplen' => $id_user,
       'tgl_komplen' => date('d/m/Y'),
       'waktu_komplen' => $this->format_waktu->jam(),
       'komplen' => $komplen
      );
      $this->Mform->input($input,'komplen');
      $data = '1';
    }
    echo json_encode($data);
  }

  // menamplkan data tujuan penggunaan
  public function dataTujuan(){
    $data = $this->Mform->view_ajax('tujuan_peminjaman');
    echo json_encode($data);
  }

}
?>
