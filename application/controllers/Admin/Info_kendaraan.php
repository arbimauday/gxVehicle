<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Info_kendaraan extends CI_Controller {

  protected $index = 'Admin/info_kendaraan';

  function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mdaftar_kendaraan'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function index(){
    $where_motor = array('id_jenis_kendaraan' => "1");
    $data['motor'] = $this->Mdaftar_kendaraan->kendaraan('1')->result();

    $where_mobil = array('id_jenis_kendaraan' => "2");
    $data['mobil'] = $this->Mdaftar_kendaraan->kendaraan('2')->result();

    $data['title'] = 'Info Kendaraan';
    $data['content'] = $this->index;
    $this->load->view('Template/index_admin',$data);
  }

}
?>
