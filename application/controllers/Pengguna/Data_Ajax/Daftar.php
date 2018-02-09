<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mcodeunik','Mdaftar_kendaraan'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  // pengguna kendaraan level Pengguna dan teknisi
  public function user(){
    $where = array(
      'id_level !=' => '1'
    );
    $data = $this->Mform->where_ajax($where,'user');
    echo json_encode($data);
  }

  // daftar kendaraan
  public function kendaraan(){
    $data = $this->Mform->view_ajax('master_kendaraan');
    echo json_encode($data);
  }

  // input keterangan km yang baru masuk
  public function pengembalian_kunci(){
    $id_atf    = $this->input->post('id_aktifitas');
    $km_masuk  = $this->input->post('km_masuk');
    $id_user   = $this->input->post('id_user');
    $pass      = md5($this->input->post('pass_pengembali'));

    // cek pass dan id user
    $where_pass = array('id_user'=>$id_user,'pass'=>$pass);
    $cek_pass = $this->Mform->where_ajax_number($where_pass,'user');
    if(!empty($cek_pass)){
      $jumlah_km = $this->Mdaftar_kendaraan->modalDetail_keluar($id_atf);
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
      $output = '1';
    }else {
      $output = '0';
    }
    echo json_encode($output);
  }

  public function kendaraan_standBy(){
    $data_where = $this->Mdaftar_kendaraan->bisa_dipakai('0');
    $output = array();
    $output['data'] = array();
    $no = 0;
    foreach ($data_where as $u) {
      $no +=1;
      $output['data'][] = array($no,$u->nomor_polisi,'<i class="fa '.$u->icon.'"></i> ' . $u->jenis_kendaraan ,$u->divisi,$u->keadaan,$u->data_km.' km','<button type="button" class="btn bg-green btn-sm" data-toggle="modal" data-target="#ModalPeminjam" onclick="idKendaraan('.$u->id_kendaraan.')">Pinjam</button>');
    }
    echo json_encode($output);
  }

  public function kendaraan_keluar(){
    $where = $this->input->post('data_tgl');
    if(!empty($where)){
      $datatgl = $where;
    }else {
      $datatgl = date('d/m/Y');
    }
    $data = $this->Mdaftar_kendaraan->aktifitas_keluar($datatgl);
    $output = array();
    $output['data'] = array();
    $no = 0;
    foreach ($data as $vw){
      if(!empty($vw->km_masuk) && $vw->tgl_keluar !== $vw->tgl_masuk){
        $ket = '<i class="fa fa-check text-red" data-toggle="tooltip" data-placement="right" title=""></i> Telat Mengembali';
      }elseif (!empty($vw->km_masuk)) {
        $ket = '<i class="fa fa-check text-green" data-toggle="tooltip" data-placement="right" title=""></i> Tepat Waktu';
      }else {
        $ket = '<i class="fa fa-hourglass-half text-yellow" data-toggle="tooltip" data-placement="right" title=""></i> Masih digunakan';
      }

      // mengambil jumlah penggunaan km
      if(empty($vw->km_masuk)){
        $km_penggunaan = '-';
      }else {
        $km = $vw->km_masuk - $vw->km_keluar;
        $km_penggunaan = $km.' km';
      }

      $no +=1;
      $output['data'][]=array($no,$vw->nomor_polisi,'<i class="fa '.$vw->icon.'"></i> ' . $vw->jenis_kendaraan ,$vw->divisi,$vw->nama,$vw->waktu_keluar.' ' .$vw->tgl_keluar,$vw->km_keluar.' km',$vw->keadaan,$ket,$km_penggunaan,'<button type="button" class="btn bg-blue btn-sm" data-toggle="modal" data-target="#Modaldetail" onclick="aksi_detail('.$vw->id_atf_keluar.')">Detail</button>');
    }
    echo json_encode($output);
  }

  public function modalDetail_Peminjam($id_data){
    // info penggunaan keluar
    $data['keluar'] = $this->Mdaftar_kendaraan->modalDetail_keluar($id_data);
    // info penggunaan keluar
    $data['masuk'] = $this->Mdaftar_kendaraan->modalDetail_masuk($id_data);
    if(!empty($data['masuk'])){
      $data['notif'] = '1';
    }else{
      $data['notif'] = '0';
    }
    // data pengecekan kendaran masuk
    $data['pengecekan'] = $this->Mdaftar_kendaraan->modalDetail_catatankeadaan($id_data);
    if(!empty($data['pengecekan'])){
      $data['ifcatatan'] = '1';
    }else{
      $data['ifcatatan'] = '0';
    }
    echo json_encode($data);
  }

  public function pinjam_kendaraan(){
    $idKendaraan = $this->input->post('idkendaraan');
    $id_tujuan = $this->input->post('id_tujuan');
    $catatan = $this->input->post('catatan_keluar');
    if(empty($catatan)){
      $data = '3'; // notifikasi catatan kosong
    }else {
      $cek_where = array(
        'id_kendaraan' => $idKendaraan,
        'id_sts_atf' => '0'
      );
      $cekData = $this->Mform->where_ajax($cek_where,'master_kendaraan');
      if(!empty($cekData)){

        $where = array(
          'id_user' => $this->input->post('v_iduser'),
          'pass' => md5($this->input->post('pass'))
        );
        $cekUser = $this->Mform->where_ajax($where,'user');
        if(!empty($cekUser)){

          // foreach($cekUser as $us){
          //   $id_user = $us->id_user;
          // }

          foreach ($cekData as $vs) {
            $km_keluar = $vs->data_km;
          }
          // cek data catatan untuk di input
          if(empty($catatan)){
            $d_catatan = '';
          }else {
            $d_catatan = $catatan;
          }
          $input = array(
            'id_user' => $this->input->post('v_iduser'),
            'id_kendaraan' => $idKendaraan,
            'tgl_keluar' => date('d/m/Y'),
            'waktu_keluar' => $this->format_waktu->jam(),
            'id_sts_atf' => '1',
            'km_keluar' => $km_keluar,
            'id_tujuan' => $id_tujuan,
            'catatan_keluar' => $d_catatan
          );

          $update = array('id_sts_atf' => '1');
          $this->Mform->update($cek_where,$update,'master_kendaraan');
          $this->Mform->input($input,'aktifitas_keluar');

          $data = '1';
        }else {
          $data = '2';
        }

      }else {
        $data = 'Sudah Keluar';
      }
    }
    echo json_encode($data);
  }

  function cari_noKendaraan(){
    //$null = $_GET('hs');
    //if(!empty($_GET('hs'))
    //if($keyword!=''){
    $data = $this->Mdaftar_kendaraan->kendaraan_kembali();
    foreach ($data as $u) {
      $hasil[] = $u->nomor_polisi;
    }
    echo json_encode($data);
  }

  // menampilkan info catatan teknisi untuk kekurangan kendaraan
  function info(){
    $where = array(
      'id_kendaraan' => $_GET['id_kendaraan'],
      'sts_info'     => 0
    );
    $data = $this->Mform->where_ajax_desc($where,'id_info','info_pengguna');
    echo json_encode($data);
  }

}
?>
