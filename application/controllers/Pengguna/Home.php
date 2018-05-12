<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  protected $index = 'Pengguna/home';

  function __construct(){
    parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
  }

  public function index(){
    if(!empty($_GET['tanggal'])){
      $tanggal = $_GET['tanggal'];
    }else {
      $tanggal = date('d/m/Y');
    }

    $data['tanggal'] =  $tanggal;
    $data['title'] = 'Home';
    $data['content'] = $this->index;
    $this->load->view('Template/index_pengguna',$data);
  }

}
?>
