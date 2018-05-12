<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mform','Mcodeunik'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function divisi(){
    $masukan = array(
      'divisi' =>  ucwords($this->input->post('nama_divisi'))
    );
    $cek = $this->Mform->where($masukan,'master_divisi')->num_rows();
    if(empty($cek)){
      $this->Mform->input($masukan,'master_divisi');
      $data = '1';
    }else{
      $data = '0';
    }
    echo json_encode($data);
  }

  public function port(){
    $masukan = array(
      'port' =>  ucwords($this->input->post('nama_port'))
    );
    $cek = $this->Mform->where($masukan,'master_port')->num_rows();
    if(empty($cek)){
      $this->Mform->input($masukan,'master_port');
      $data = '1';
    }else{
      $data = '0';
    }
    echo json_encode($data);;
  }

}
?>
