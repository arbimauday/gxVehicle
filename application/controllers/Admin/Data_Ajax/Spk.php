<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Spk extends CI_Controller {
  function __construct(){
   parent::__construct();
   $this->load->model(array('Mform','Mcodeunik','Mspk','Mlaporan'));
  }

  function buat_spk(){
    $id_kendaraan = $this->input->post('id_kendaraan');
    $tgl_spk = date('d/m/Y');
    $id_jenis_pekerjaan = $this->input->post('id_jenis_pekerjaan');
    $keluhan = $this->input->post('keluhan');
    $id_peminta = $this->input->post('id_peminta');
    // nomor spk dimulai berdasarkan bulan
    $no_spk = 'SPK-'.date('Ymd').$this->Mcodeunik->nospk();
    if(!empty($id_kendaraan)){
      $input = array(
        'no_spk' => $no_spk,
        'tgl_spk'  => date('d/m/Y'),
        'id_kendaraan' => $id_kendaraan,
        'id_pembuat'   => $this->session->userdata('id_user')/*session id user admin*/,
        'id_peminta'   => $id_peminta/*id peminta*/,
        'keluhan'      => $keluhan,
        'id_jenis_pekerjaan' => $id_jenis_pekerjaan,
        'id_status_spk'=>'1'
      );
      $data = $this->Mform->input($input,'master_spk');
    }
    echo json_encode($data);
  }

  // buat spk dari notifkasi bar untuk ganti oli
  function buat_spk_notif_bar(){
    $id_ganti_oli = $this->input->post('id_ganti_oli');
    $id_kendaraan = $this->input->post('id_kendaraan');
    $tgl_spk = date('d/m/Y');
    $id_jenis_pekerjaan = $this->input->post('id_jenis_pekerjaan');
    $keluhan = $this->input->post('keluhan');
    $id_peminta = $this->input->post('id_peminta');
    // nomor spk dimulai berdasarkan bulan
    $no_spk = 'SPK-'.date('Ymd').$this->Mcodeunik->nospk();
    if(!empty($id_kendaraan)){
      $input = array(
        'no_spk' => $no_spk,
        'tgl_spk'  => date('d/m/Y'),
        'id_kendaraan' => $id_kendaraan,
        'id_pembuat'   => $this->session->userdata('id_user')/*session id user admin*/,
        'id_peminta'   => $id_peminta/*id peminta*/,
        'keluhan'      => $keluhan,
        'id_jenis_pekerjaan' => $id_jenis_pekerjaan,
        'id_status_spk'=>'1'
      );
      $data = $this->Mform->input($input,'master_spk');

      // update catatan ganti oli
      $where_up = array('id_ganti_oli' => $id_ganti_oli);
      $update_d = array('respon_admin' => 1);
      $this->Mform->update($where_up,$update_d,'catatan_ganti_oli');
      redirect(base_url('Admin/Data_spk'));
    }
  }

  // buat spk dari bar notifikasi komplen
  public function buat_spk_notif_bar_Komplen(){
    $id_komplen = $this->input->post('Notif_bar_id_komplen');
    $where = array('id_komplen' => $id_komplen);
    $update = array('cek_tinjau' => 1);
    $this->Mform->update($where,$update,'komplen');
    // update keterangan tinjau notifikasi

    $data = $this->Mform->where_ajax($where,'komplen');
    // nomor spk dimulai berdasarkan bulan
    $no_spk = 'SPK-'.date('Ymd').$this->Mcodeunik->nospk();
    foreach ($data as $e) {
      $input = array(
        'no_spk' => $no_spk,
        'tgl_spk'  => date('d/m/Y'),
        'id_kendaraan' => $e->id_kendaraan,
        'id_pembuat'   => $this->session->userdata('id_user')/*session id user admin*/,
        'id_peminta'   => $e->id_user_komplen/*id peminta*/,
        'keluhan'      => $e->komplen,
        'id_jenis_pekerjaan' => 2,
        'id_status_spk'=>'1'
      );
      $this->Mform->input($input,'master_spk');
    }
    redirect(base_url('Admin/Data_spk'));
  }


  function status_spk($data_id){
    if(!empty($data_id)){
      $data = $this->Mspk->spk_status($data_id);
      $output = array();
      $output['data'] = array();
      $no = 0;
      foreach ($data as $u) {
        $no +=1;
        if(!empty($u->solusi)){
          $icn = '<i class="fa fa-check text-green"></i>';
        }else {
          $icn = '<i class="fa  fa-close text-red"></i>';
        }
        $output['data'][] = array($no,$u->no_spk,$u->nomor_polisi,$u->tgl_spk,$u->jenis_pekerjaan,$icn,'<a href="'.base_url('Admin/Data_spk/tinjauan?nospk=').$u->no_spk.'&idspk='.$u->id_spk.'" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Tinjauan</a> <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ModalViewSpk" onclick="lihatSpk('.$u->id_spk.')"><i class="fa fa-search-plus"></i> Lihat</button> <a href="'.base_url('Pdf/Spk/kosong/'.$u->no_spk.
        '?idspk='.$u->id_spk).'" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-clipboard"></i> SPK Kosong</a>');
      }
    }
    echo json_encode($output);
  }

  function statusClosed(){
	  $to = DateTime::createFromFormat ('M/Y',$_GET['date']);
    $getData = $to->format('Y/m');

    $data = $this->Mspk->spkClosed($getData);
    $output = array();
    $output['data'] = array();
    $no = 0;
    foreach ($data as $u) {
      $no +=1;
      $output['data'][] = array($no,$u->tgl_selesai,$u->no_spk,$u->nomor_polisi,$u->tgl_spk,$u->jenis_pekerjaan,'<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ModalViewSpk" onclick="lihatSpk('.$u->id_spk.')"><i class="fa fa-search-plus"></i> Lihat</button> <a href="'.base_url('Pdf/Spk/closed/'.$u->no_spk.
      '?idspk='.$u->id_spk).'" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-clipboard"></i> SPK</a>');
    }
    echo json_encode($output);
  }

  function lihatSpk($idData){
    // $data = array();
    $data['infoSpk'] = $this->Mspk->lihatSpk($idData);
    $where = array('id_spk' => $idData);

    $data['laporan'] = $this->Mlaporan->data($idData);

    foreach ($data['infoSpk'] as $e) {
      $id_peminta = $e->id_peminta;
      $id_teknisi = $e->id_teknisi;
    }
    // user
    $where_id_peminta = array('id_user' => $id_peminta);
    $where_id_teknisi = array('id_user' => $id_teknisi);
    $data['peminta'] = $this->Mform->where_ajax($where_id_peminta,'user');
    $user_peminta = $this->Mform->where_ajax_number($where_id_teknisi,'user');
    if($user_peminta > 0){
      $data['teknisi'] = $this->Mform->where_ajax($where_id_teknisi,'user');
    }else {
      $data['teknisi'] = $data['infoSpk'];
    }
    echo json_encode($data);
  }

  //input solusi_spk
  function solusi_spk(){
    $where = array('id_spk' => $this->input->post('id_spk'));
    $data_input = array(
      'solusi' => $this->input->post('solusi'),
      'id_teknisi' => $this->input->post('id_teknisi')
    );
    $data = $this->Mform->update($where,$data_input,'master_spk');
    echo json_encode($data);
  }

  function getStatus($idData){
    $where = array('id_spk' => $idData);
    $cek = $this->Mform->where_ajax($where,'master_spk');
    foreach ($cek as $ue) {
      $where_sts = array('id_status_spk !=' => $ue->id_status_spk);
      $data = $this->Mform->where_ajax($where_sts,'status_spk');
    }
    echo json_encode($data);
  }

  function update_status(){
    $id_spk = $this->input->post('idspk');
    $id_status_spk = $this->input->post('id_status_spk');
    $id_update = $this->input->post('id_status_update');

    if($id_update == '3'){
      $date_closed = date('d/m/Y');
    }else {
      $date_closed = '';
    }

    $where = array(
      'id_spk' => $id_spk
    );
    $update = array('id_status_spk' => $id_update,'tgl_selesai' => $date_closed);
    $proses_update = $this->Mform->update($where,$update,'master_spk');

    //history status spk
    $inputdata = array(
      'id_spk' => $id_spk,
      'id_status_spk' => $id_status_spk,
      'id_admin' => '4',// input id_admin
      'tgl_ganti' => date('d/m/Y')
    );
    $input = $this->Mform->input($inputdata,'history_status_spk');
    echo json_encode($proses_update);
  }

  function spkPerbulan(){
    $to = DateTime::createFromFormat ('M/Y',$_GET['dataTgl']);
    $dataTgl = $to->format('Y/m');
    $idKendaraan = $_GET['id'];
    $data= $this->Mspk->spkPerbulan($idKendaraan,$dataTgl);
      $output = array();
      $output['data'] = array();
      $no = 0;
      foreach ($data as $vw) {
          if ($vw->id_status_spk == '3'){
              $bg = '#b8fbb4';
          }else if ($vw->id_status_spk == '2') {
              $bg= '#ffc4c4';
          }else {
              $bg = '#ffedc4';
          }
          $no +=1;
          $output['data'][] = array(
              $no,
              $vw->no_spk,
              $vw->tgl_spk,
              '<span class="box-sts" style="background:'.$bg.';">'.$vw->status_spk.'</span>',
              $vw->jenis_pekerjaan,
              'Rp '. number_format(!is_null($vw->ongkos_kerja?$vw->ongkos_kerja:0) , 0, ',', '.')
          );
      }
      echo json_encode($output);
  }

}

?>
