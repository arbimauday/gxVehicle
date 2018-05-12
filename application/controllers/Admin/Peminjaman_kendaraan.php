<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_kendaraan extends CI_Controller {

  protected $index = 'Admin/pinjam_kendaraan';

  function __construct()
  {
    parent::__construct();
    $this->load->model(array());
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function index(){
    if(!empty($_GET['tanggal'])){
      $tanggal = $_GET['tanggal'];
    }else {
      $tanggal = date('d/m/Y');
    }
    $data['tanggal'] = $tanggal;
    $data['title'] = 'Peminjaman Kendaraan';
    $data['content'] = $this->index;
    $this->load->view('Template/index_admin',$data);
  }

}
?>
