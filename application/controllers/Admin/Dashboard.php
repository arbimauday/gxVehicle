<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  protected $index = 'Admin/dashboard';

  function __construct()
  {
    parent::__construct();
    $this->load->model(array(''));
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
    $data['title'] = 'Admin Home';
    $data['content'] = $this->index;
    $this->load->view('Template/index_admin',$data);
  }

  public function img(){
    $data = $this->Mform->view('image_kendaraan')->result();
    foreach ($data as $u) {
       //echo '<img src="data:image/jpg;base64,'.$u->img_kendaraan.'" >';
      //echo $u->image_kendaraan;
      echo '<img src="data:image/jpg;base64,'.base64_encode($u->img_kendaraan).'"     />  ';
      // $data2 = 'Tutorial base64 di php www.malasngoding.com';
      // echo base64_encode($data2);
    }
//     $str = 'Test';
// $encode = base64_encode($str);
// $decode = base64_decode($encode);
// echo "String awal :".$str;
// echo "<br/>Hasil encode :".base64_encode('dd');
// echo "<br/> Hasil Decode :".$decode;
  }

}
?>
