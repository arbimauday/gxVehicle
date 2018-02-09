<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Info_peminjaman extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mcodeunik','Mdaftar_kendaraan'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function kendaraan_standBy(){
    $data_where = $this->Mdaftar_kendaraan->bisa_dipakai('0');
    $output = array();
    $output['data'] = array();
    $no = 0;
    foreach ($data_where as $u) {
      $where = array(
        'id_kendaraan' => $u->id_kendaraan,
        'sts_info' => 0
      );
      $cekData = $this->Mform->where_ajax($where,'info_pengguna');

      if(!empty($cekData)){
        foreach ($cekData as $ue) {
          $btnInfo = '<button type="button" class="btn btn-sm bg-maroon" onclick="catatanInfo_kendaraan('.$ue->id_info.')" data-toggle="modal" data-target="#ModalInfo"><i class="fa fa-info-circle"></i> Info</button>';
        }
      }else {
        $btnInfo = '';
      }
      $no +=1;
      $output['data'][] = array($no,$u->nomor_polisi,'<i class="fa '.$u->icon.'"></i> ' . $u->jenis_kendaraan ,$u->divisi,$u->data_km.' km',$u->keadaan,'<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ModalPerbaruiKeadaan" onclick="menapilkan_opsi_keadaan('.$u->id_kendaraan.')"><i class="fa fa-pencil"></i> Tinjauan</button>'.' '. $btnInfo);
    }
    //,'<button type="button" class="btn bg-green btn-sm">Action</button>'
    echo json_encode($output);
  }

  // daftara keadaan
  function daftar_keadaan(){
    $data = $this->Mform->view_ajax('keadaan_kendaraan');
    echo json_encode($data);
  }

  public function kendaraan_keluar(){
    $where = $this->input->get('data_tgl');
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
      // keterangan teknisi cek kendaraan yang sudah masuk
      if($vw->ket_cek == '1'){
        $ket_text = '<i class="fa fa-check text-green"></i> Sudah';
        $disabled = 'disabled';
      }else {
        $ket_text = '<i class="fa fa-times-circle-o text-red"></i> Belum';
        $disabled = '';
      }
      // keterangan kembali
      if(!empty($vw->km_masuk) && $vw->tgl_keluar !== $vw->tgl_masuk){
        $ket = '<i class="fa fa-check text-red" data-toggle="tooltip" data-placement="right" title=""></i> Telat Mengembali';
      }elseif (!empty($vw->km_masuk)) {
        $ket = '<i class="fa fa-check text-green" data-toggle="tooltip" data-placement="right" title=""></i> Tepat Waktu';
      }else {
        $ket = '<i class="fa fa-hourglass-half text-yellow" data-toggle="tooltip" data-placement="right" title=""></i> Masih digunakan';
        $disabled = 'disabled';
      }
      $id_data = $vw->id_atf_keluar.','.$vw->id_atf_masuk;

      // mengambil jumlah penggunaan km
      if(empty($vw->km_masuk)){
        $km_penggunaan = '-';
      }else {
        $km = $vw->km_masuk - $vw->km_keluar;
        $km_penggunaan = $km.' km';
      }

      $no +=1;
      $output['data'][]=array($no,$vw->nomor_polisi,'<i class="fa '.$vw->icon.'"></i> ' . $vw->jenis_kendaraan ,$vw->divisi,$vw->nama,$vw->waktu_keluar.' ' .$vw->tgl_keluar,$vw->km_keluar.' km'
      ,$vw->keadaan,$ket,$ket_text,$km_penggunaan,'<button type="button" class="btn bg-blue btn-sm" data-toggle="modal" data-target="#Modaldetail" onclick="aksi_detail('.$vw->id_atf_keluar.')">Detail</button> '.' <button type="button" class="btn bg-aqua btn-sm"
       data-toggle="modal" data-target="#ModalCek" ' . $disabled .  ' onclick="cek_dataPengembali('.$id_data.')">Cek</button>');
    }
    echo json_encode($output);
  }

  // info jumlah kendaran yang belum kembali
  function info_jumlah(){
    $datatgl = date('d/m/Y');
    $data['daftar'] = $this->Mdaftar_kendaraan->info_peminjaman($datatgl);
    $data['jumlah'] = 0;
    foreach ($data['daftar'] as $eu) {
      $data['jumlah'] += 1;
    }
    echo json_encode($data);
  }

  // modal info peminjaman
  public function modalDetail_Peminjam($id_data){
    $data['keluar'] = $this->Mdaftar_kendaraan->modalDetail_keluar($id_data);
    $data['masuk'] = $this->Mdaftar_kendaraan->modalDetail_masuk($id_data);
    if(!empty($data['masuk'])){
      $data['notif'] = '1';
    }else{
      $data['notif'] = '0';
    }
    $data['pengecekan'] = $this->Mdaftar_kendaraan->modalDetail_catatankeadaan($id_data);
    if(!empty($data['pengecekan'])){
      $data['ifcatatan'] = '1';
    }else{
      $data['ifcatatan'] = '0';
    }
    echo json_encode($data);
  }

  // menampilkan data keadaan kendaraan
  public function data_keadaan(){
    $id_kendaraan = $_GET['id_kendaraan'];
    $data['info'] = $this->Mdaftar_kendaraan->cek_keadaan($id_kendaraan);
    foreach ($data['info'] as $ol) {
      $where_not = array('id_keadaan !=' => $ol->id_keadaan);
    }
    $data['option'] = $this->Mform->where_ajax($where_not,'keadaan_kendaraan');
    echo json_encode($data);
  }

  // perbarui keadaan
  public function perbarui_keadaan(){
    $id_kendaraan = $this->input->post('id_kendaraan');
    $idKeadaan = $this->input->post('id_keadaan');
    $where = array(
      'id_kendaraan' => $id_kendaraan
    );
    $update = array(
      'id_keadaan' => $idKeadaan
    );
    $update = $this->Mform->update($where,$update,'master_kendaraan');

    if($idKeadaan > 1){
      // input info kendaraan
      $input = array(
        'id_kendaraan' => $id_kendaraan,
        'info' => $this->input->post('info'),
        'waktu_info' => $this->format_waktu->jam(),
        'tgl_info'  => date('d/m/Y'),
        'sts_info'  => 0
      );
      $this->Mform->input($input,'info_pengguna');
    }else {
      // sembunyikan data info yang di tampilkan
      $where_info = array(
        'id_kendaraan' => $id_kendaraan,
        'sts_info' => 0
      );
      $dataCek = array();
      $cekData = $this->Mform->where_ajax($where_info,'info_pengguna');
      foreach ($cekData as $ue) {
        $cekData[] = $ue->id_kendaraan;
      }
      $update_info = array('sts_info' => 1); // matikan info / hide info
      $this->Mform->update($where_info,$update_info,'info_pengguna');
    }
    echo json_encode(array('status'=>TRUE));
  }

  // input hasil cek kendaraan yang masuk dari teknisi
  public function input_cek_kendaraan(){
    $input = array(
      'id_atf_masuk' => $this->input->post('id_atf_masuk'),
      'id_teknisi'   => $this->input->post('id_teknisi'),
      'id_keadaan'   => $this->input->post('id_keadaan'),
      'notes_cek'    => $this->input->post('notes_cek'),
      'waktu_cek'    => $this->format_waktu->jam(),
      'tgl_cek'      => date('d/m/Y')
    );
    $data = $this->Mform->input($input,'cek_atf_masuk');
    //update data pengecekan
    $where = array('id_atf_masuk' => $this->input->post('id_atf_masuk'));
    $update = array('ket_cek' => 1);
    $update_data = $this->Mform->update($where,$update,'aktifitas_masuk');
    echo json_encode(array('status'=>TRUE));
  }

  // menampilkan catatan info kekurangan kendaraan
  public function catatan_info(){
    $id_info = $_GET['id_info'];
    $output = $this->Mdaftar_kendaraan->info_catatan($id_info);
    echo json_encode($output);
  }

}
?>
