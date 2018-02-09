<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller{

  function __construct($config = 'rest') {
    parent::__construct($config);
    $this->load->database();
    $this->load->model(array('Mform','Mapi','Mauth_login'));
		$this->load->helper('url');
		//$this->load->library('session','database');
  }

  /********************************************/
  /* PROSE MENAMPILKAN DATA
  /********************************************/
  // menamplkan daftar kendaraan yang mau di pilih untuk di komplen
  public function kendaraan_get($id_kendaraan){
    if(empty($id_kendaraan)){
      $data['data'] = $this->Mform->view_ajax('master_kendaraan');
    }else {
      $where = array('id_kendaraan' => $id_kendaraan);
      $data['data'] = $this->Mform->where_ajax($where,'master_kendaraan');
    }
    $this->response($data, REST_Controller::HTTP_OK);
  }

  // kendaraan yang standBy
  public function kendaraan_in_get(){
    $where = array('token_user' => $this->get('token_user'));
    $hasil_cek = $this->Mform->where_ajax($where,'user');
    if(!empty($hasil_cek)){
      $data['data'] = $this->Mapi->bisa_dipakai('0');
      $this->response($data, REST_Controller::HTTP_OK); // OK (200) berhasil
    }else {
      $this->response([
          'status' => FALSE,
          'message' => 'No users token were found'
      ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
    }
  }

  // kendaraan yang keluar
  public function kendaraan_out_get(){
    $where = array('token_user' => $this->get('token_user'));
    $hasil_cek = $this->Mform->where_ajax($where,'user');
    if(empty($hasil_cek)){
      $this->response([
          'status' => FALSE,
          'message' => 'No users token were found'
      ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
    }else {
      $data_tgl = $this->get('tgl');
      if(!empty($data_tgl)){
        $datatgl = $data_tgl;
      }else {
        $datatgl = date('d/m/Y');
      }
      $data['data'] = $this->Mapi->aktifitas_keluar($datatgl);
      if(empty($data['data'])){
        $this->response([
            'status' => TRUE,
            'message' => 'Belum ada peminjaman untuk '.$datatgl
        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
      }else {
        $this->response($data, REST_Controller::HTTP_OK);
      }

      // data view dalama web
      // $output = array();
      // $output['data'] = array();
      // $no = 0;
      // foreach ($data as $vw){
      //   // keterangan teknisi cek kendaraan yang sudah masuk
      //   if($vw->ket_cek == '1'){
      //     $ket_text = '<i class="fa fa-check text-green"></i> Sudah';
      //     $disabled = 'disabled';
      //   }else {
      //     $ket_text = '<i class="fa fa-times-circle-o text-red"></i> Belum';
      //     $disabled = '';
      //   }
      //   // keterangan kembali
      //   if(!empty($vw->km_masuk) && $vw->tgl_keluar !== $vw->tgl_masuk){
      //     $ket = '<i class="fa fa-check text-red" data-toggle="tooltip" data-placement="right" title=""></i> Telat Mengembali';
      //   }elseif (!empty($vw->km_masuk)) {
      //     $ket = '<i class="fa fa-check text-green" data-toggle="tooltip" data-placement="right" title=""></i> Tepat Waktu';
      //   }else {
      //     $ket = '<i class="fa fa-hourglass-half text-yellow" data-toggle="tooltip" data-placement="right" title=""></i> Masih digunakan';
      //     $disabled = 'disabled';
      //   }
      //   $id_data = $vw->id_atf_keluar.','.$vw->id_atf_masuk;
      //
      //   // mengambil jumlah penggunaan km
      //   if(empty($vw->km_masuk)){
      //     $km_penggunaan = '-';
      //   }else {
      //     $km = $vw->km_masuk - $vw->km_keluar;
      //     $km_penggunaan = $km.' km';
      //   }
      //
      //   $no +=1;
      //   $output['data'][]=array($no,$vw->nomor_polisi,'<i class="fa '.$vw->icon.'"></i> ' . $vw->jenis_kendaraan ,$vw->nama,$vw->divisi,$vw->waktu_keluar.' ' .$vw->tgl_keluar,$vw->keadaan,$ket,$ket_text,$km_penggunaan,'<button type="button" class="btn bg-blue btn-sm" data-toggle="modal" data-target="#Modaldetail" onclick="aksi_detail('.$vw->id_atf_keluar.')">Detail</button> '.' <button type="button" class="btn bg-aqua btn-sm"
      //    data-toggle="modal" data-target="#ModalCek" ' . $disabled .  ' onclick="cek_dataPengembali('.$id_data.')">Cek</button>');
      // }
      //echo json_encode($output);
    }
  }

  // detail peminjaman
  public function detail_peminjam_get($id_data){
    $data['data_keluar'] = $this->Mapi->modalDetail_keluar($id_data);
    $data['data_masuk'] = $this->Mapi->modalDetail_masuk($id_data);
    // if(!empty($data['masuk'])){
    //   $data['notif'] = '1';
    // }else{
    //   $data['notif'] = '0';
    // }
    $data['data_pengecekan'] = $this->Mapi->modalDetail_catatankeadaan($id_data);
    // if(!empty($data['pengecekan'])){
    //   $data['ifcatatan'] = '1';
    // }else{
    //   $data['ifcatatan'] = '0';
    // }
    $this->response($data, REST_Controller::HTTP_OK);
  }

  // menampilkan info catatan teknisi tentang kekurangan kendaraan
  function info_get($keadaan="keadaan"){
    $where = array(
      'id_kendaraan' => $this->get('id_kendaraan'),
      'sts_info'     => 0
    );
    $data['data'] = $this->Mform->where_ajax($where,'info_pengguna');
    $this->response($data, REST_Controller::HTTP_OK);
  }

  // daftar kendaraan untuk pengembalian kunci
  public function peminjam_get(){
    $data['data'] = $this->Mapi->kendaraan_kembali();
    $this->response($data, REST_Controller::HTTP_OK);
  }


  /**********************************/
  /* Proses input, dan update data
  /**********************************/
  // input peminjaman
  public function peminjaman_post($token_user){
    $idKendaraan = $this->post('id_kendaraan');
    $id_tujuan = $this->post('id_tujuan');
    $catatan = $this->post('catatan_keluar');

    // proses cek kendaraan yang masih standBy
    $where_kendaraan = array(
      'id_kendaraan' => $idKendaraan,
      'id_sts_atf' => '0'
    );
    $cekData = $this->Mform->where_ajax($where_kendaraan,'master_kendaraan');
    if(!empty($cekData)){
      // proses cek token user
      $where_token = array('token_user' => $token_user);
      $cek_token = $this->Mform->where_ajax($where_token,'user');
      if(empty($cek_token)){
        $this->response([
            'status' => false,
            'message' => 'No users token were found'
        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
      }else {
        foreach ($cekData as $e) { // mengambil catatan km
          $km_keluar = $e->data_km;
        }

        foreach ($cek_token as $eu) { // mengambil id user
          $id_user = $eu->id_user;
        }

        $input = array(
          'id_user' => $id_user,
          'id_kendaraan' => $idKendaraan,
          'tgl_keluar' => date('d/m/Y'),
          'waktu_keluar' => $this->format_waktu->jam(),
          'id_sts_atf' => '1',
          'km_keluar' => $km_keluar,
          'id_tujuan' => $id_tujuan,
          'catatan_keluar' => $catatan
        );

        $update = array('id_sts_atf' => '1');
        $update_data = $this->Mform->update($where_kendaraan,$update,'master_kendaraan');
        $input_data = $this->Mform->input($input,'aktifitas_keluar');
        $data['data'] = 'berhasil';
        $this->response($data, REST_Controller::HTTP_OK);
      }
    }else {
      $this->response([
          'status' => FALSE,
          'message' => 'Already out!'
      ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
    }
  }

  // input pengembalian kendaraan
  public function pengembalian_post($token_user){
    $id_atf    = $this->post('id_aktifitas');
    $km_masuk  = $this->post('km_masuk');

    $where_token = array('token_user' => $token_user);
    $cek_token = $this->Mform->where_ajax($where_token,'user');
    if(empty($cek_token)){
      $this->response([
          'status' => false,
          'message' => 'No users token were found'
      ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
    }else {
      foreach ($cek_token as $e) { // mengambil id user
        $id_user = $e->id_user;
      }

      $jumlah_km = $this->Mapi->modalDetail_keluar($id_atf);
      foreach ($jumlah_km as $vk) {
        // update km di dalam master_kendaraan
        $where_kendaraan = array('id_kendaraan' => $vk->id_kendaraan);
        $data_km = array(
          'data_km' => $km_masuk,
          'id_sts_atf' => '0'
        );
        $update_km = $this->Mform->update($where_kendaraan,$data_km,'master_kendaraan');

        // proses update catatan ganti oli
        $where_ganti_oli = array(
          'id_kendaraan' => $vk->id_kendaraan,
          'respon_admin' => 0
        );
        $ganti_oli = $this->Mform->where($where_ganti_oli,'catatan_ganti_oli');

        // mencari jumlah km yg di tempu
        $hasil = $km_masuk - $vk->data_km;

        if($ganti_oli->num_rows() == 1){
          foreach ($ganti_oli->result() as $go){
            $data_km_tempuh = $go->km_tempuh + $hasil;
            $km_tempuh = array('km_tempuh' => $data_km_tempuh);
          }
          $this->Mform->update($where_ganti_oli,$km_tempuh,'catatan_ganti_oli');
        }else{
          // proses pembuat ganti oli jika ganti notifikasi ganti oli sudah keluar dan di tijau
          $tgl_update = date('d/m/Y', strtotime("+1 months", strtotime(date('d-m-Y'))));
          $input_dataBaru = array(
            'id_kendaraan' => $vk->id_kendaraan,
            'tgl_ganti' => date('d/m/Y'),
            'km_ganti_oli' => $km_masuk,
            'km_tempuh' => $hasil,
            'tgl_ganti_berikutnya' => $tgl_update
          );
          $this->Mform->input($input_dataBaru,'catatan_ganti_oli');
        }
      }

      $where_id_atf = array('id_atf_keluar' => $id_atf);
      $input_atf_masuk = array(
        'id_user'       => $id_user,
        'tgl_masuk'     => date('d/m/Y'),
        'waktu_masuk'   => $this->format_waktu->jam(),
        'km_masuk'      => $km_masuk,
        'catatan_masuk' => 'Kosong'
      );
      $update_atf = $this->Mform->update($where_id_atf,$input_atf_masuk,'aktifitas_masuk');
      $output['data'] = 'Berhasil!';
      $this->response($output, REST_Controller::HTTP_OK);
    }
  }

  // input keluhan pengguna
  public function keluhan_post($token_user){
    $id_kendaraan = $this->post('id_kendaraan');
    $komplen = $this->post('komplen');

    $where_token = array('token_user' => $token_user);
    $cek_token = $this->Mform->where_ajax($where_token,'user');
    if(empty($cek_token)){
      $this->response([
          'status' => false,
          'message' => 'No users token were found'
      ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
    }else {
      foreach ($cek_token as $e) { // mengambil id user
        $id_user = $e->id_user;
      }
      $input = array(
       'id_kendaraan' => $id_kendaraan,
       'id_user_komplen' => $id_user,
       'tgl_komplen' => date('d/m/Y'),
       'waktu_komplen' => $this->format_waktu->jam(),
       'komplen' => $komplen
      );
      $data_input = $this->Mform->input($input,'komplen');
      $data['data'] = 'Berhasil!';
      $this->response($data, REST_Controller::HTTP_OK);
    }
  }


  /*****************************************/
  /* Proses Login untuk user
  /*****************************************/
  public function login_post(){
    $user = $this->post('user');
    $pass = md5($this->post('pass'));

    $where = array(
      'user' => $user,
      'pass' => $pass
    );
    $where_user = array('user' => $pass);
    $where_pass = array('pass' => $pass);

    $komplit = $this->Mauth_login->proses_login($where,'user');
    $cekUser = $this->Mauth_login->proses_login($where_user,'user');
    $cekPass = $this->Mauth_login->proses_login($where_pass,'user');

    if(!empty($komplit)){
      foreach ($komplit as $u) {
        $sess_data['logged_in'] = TRUE;
        $sess_data['id_user'] = $u->id_user;
        $sess_data['nama'] = $u->nama;
        $sess_data['ket_user'] = $u->ket_user;
        $this->session->set_userdata($sess_data);
      }
      $output = $komplit;
    }else if (empty($cekUser)) {
      $output = 'Username tidak terdaftar';
    }else if (empty($cekPass)) {
      $output = 'Password tidak terdaftar';
    }else {
      $output = 'Tidak dapat di proses';
    }
    $this->response($output, REST_Controller:: HTTP_OK);
  }

}
?>
