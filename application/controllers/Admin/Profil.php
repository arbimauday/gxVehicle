<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Profil extends CI_Controller{

  protected $index = 'Admin/profil';

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mdaftar_kendaraan'));
  }

  function index(){
    $data['no_polisi'] = $_GET['no_polisi'];
    $data['id_kendaraan'] = $_GET['id'];
    $data['kode'] = $_GET['kode'];
    $data['data_kendaraan'] = $this->Mdaftar_kendaraan->info_profil($data['id_kendaraan'])->result();
    $where = array('kode_kendaraan'=>$data['kode']);

    $data['stnk_data_form'] = $this->Mform->where($where,'master_stnk')->result();
    $data['asuransi_data_form'] = $this->Mform->where($where,'master_asuransi')->result();
    $data['kir_data_form'] = $this->Mform->where($where,'master_kir')->result();

    // data select option
    foreach ($data['data_kendaraan'] as $ue) {
      $where_port = array('id_port !=' => $ue->id_port);
      $where_divisi = array('id_divisi !=' => $ue->id_divisi);
      $where_hak = array('id_hak !=' => $ue->id_hak);
      $where_keadaan = array('id_keadaan !=' => $ue->id_keadaan);

      $data['data_port'] = $this->Mform->where($where_port,'master_port')->result();
      $data['data_divisi'] = $this->Mform->where($where_divisi,'master_divisi')->result();
      $data['data_hak'] = $this->Mform->where($where_hak,'status_hak')->result();
      $data['data_keadaan'] = $this->Mform->where($where_keadaan,'keadaan_kendaraan')->result();
    }

    $data['title'] = 'Profil Kendaraan';
    $data['content'] = $this->index;
    $this->load->view('Template/index_admin',$data);
  }

}

?>
