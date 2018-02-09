<?php
class Notif_bar extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mnotif_bar'));
  }

  function jadwal_ganti_oli(){
    $data['list'] = $this->Mnotif_bar->jadwal_ganti_oli();
    echo json_encode($data);
  }

  function update_notifOli(){
    $id_ganti_oli = $_GET['id_ganti_oli'];
    $where = array('id_ganti_oli' => $id_ganti_oli);
    $update = array('respon_admin' => 2); // nilai 2 mejunjukan data cuma lewati
    $this->Mform->update($where,$update,'catatan_ganti_oli');
    echo json_encode('okey');
  }

  // update sound bell ganti oli
  public function update_bell_ganti_oli(){
    $where = array('id_ganti_oli' => $_GET['id_ganti_oli']);
    $update = array('notifikasi_sound' => 1); // sudah berbunyi
    $this->Mform->update($where,$update,'catatan_ganti_oli');
  }

  // menampilkan data komplen kerusakan kendaraan
  public function komplen(){
    $data = $this->Mnotif_bar->komplen();
    echo json_encode($data);
  }

  // update sound bell notifikasi komplen
  public function update_bell_komplen(){
    $where = array('id_komplen' => $_GET['id_komplen']);
    $update = array('notif_suara' => 1);
    $this->Mform->update($where,$update,'komplen');
  }

  // mengambil data komplen secara detail
  public function ambilData_keluhan(){
    $where = array('id_komplen' => $_GET['id_komplen']);
    $update = array('notif_bar_cek' => 1);
    $this->Mform->update($where,$update,'komplen');
    $data = $this->Mform->where_ajax($where,'komplen');
    echo json_encode($data);
  }

  // lewati notifkasi komplen
  public function lewati(){
    $where = array('id_komplen' => $_GET['id_komplen']);
    $update = array(
      'cek_tinjau' => 2
    );
    $this->Mform->update($where,$update,'komplen');
    echo json_encode(array('status' => TRUE));
  }

}

?>
