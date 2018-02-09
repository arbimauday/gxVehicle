<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data_barang extends CI_Controller {

  protected $index = 'Admin/data_barang';

  function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mform','Mbarang'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function index(){

    if(!empty($_GET['tanggalRab'])){
      $whereTgl = $_GET['tanggalRab'];
      $to = DateTime::createFromFormat ('M/Y', $whereTgl);
		  $where_month = $to->format('Y/m');
    }else {
      $whereTgl = date('M/Y');
      $where_month = date('Y/m');
    }

    $data['barang'] = $this->Mbarang->tbl_barang();
    $data['tglRab'] = $whereTgl;
    $data['jns_rab'] = $this->Mform->view('jenis_rab')->result();
    $data['title'] = 'Data Barang';
    $data['content'] = $this->index;
    $this->load->view('Template/index_admin',$data);
  }

}
?>
