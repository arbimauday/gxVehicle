<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data_spk extends CI_Controller {

  protected $index = 'Admin/data_spk';
  protected $tinjauan_spk = 'Admin/tinjauan_spk';

  function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mspk','Mform'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function index(){
    $data['noPolisi'] = $this->Mform->view('master_kendaraan')->result();
    $data['jenis_pekerjaan'] = $this->Mform->view('jenis_pekerjaan')->result();
    $where = array('id_level !=' => '1','kon_email' => '1' );
    $data['piminta'] = $this->Mform->where($where,'user')->result();

    $data['title'] = 'Data SPK';
    $data['content'] = $this->index;
    $this->load->view('Template/index_admin',$data);
  }

  public function tinjauan(){
    $data['nospk'] = $_GET['nospk'];
    $data['idspk'] = $_GET['idspk'];

    $where_teknisi = array('id_level'=>'4');
    $data['teknisi'] = $this->Mform->where($where_teknisi,'user')->result();

    $data['title'] = 'Tinjauan SPK';
    $data['content'] = $this->tinjauan_spk;
    $this->load->view('Template/index_admin',$data);
  }

}
?>
