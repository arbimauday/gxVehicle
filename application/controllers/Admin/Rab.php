<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rab extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mcodeunik'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function input(){
    $no_rab = 'RAB-'.date('ymd').$this->Mcodeunik->no_rab();
    $tgl_rab =  date('d/m/Y');
    $id_jenis_rab = $this->input->post('id_jenis_rab');
    $catatan_rab = $this->input->post('catatan_rab');

    $data = array(
      'no_rab'       => $no_rab,
      'tgl_rab'      => $tgl_rab,
      'id_jenis_rab' => $id_jenis_rab,
      'catatan_rab'  => $catatan_rab,
      'id_user'      => $this->session->userdata('id_user')
    );

    $cek_data = $this->Mform->where($data,'master_rab')->result();
    if(empty($cek_data)){
      $cek_input = $this->Mform->input_cek($data,'master_rab')->result();
      if(!empty($cek_input)){
        foreach ($cek_input as $u) {

        }
        redirect(base_url('Admin/Form/rab?no_rab='.$no_rab.'&id_rab='.$u->id_rab));
      }else {
        echo '<script>window.history.back();</script>';
      }
    }else{
      echo '<script>window.history.back();</script>';
    }
  }

}
?>
