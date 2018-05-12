<?php
class Mjoin_table extends CI_Model{

  // mengambil data km terakhir
  function kmTerakhir($idKendaraan){
    $query = $this->db->select('*')
      ->from('aktifitas_keluar')
      ->join('aktifitas_masuk','aktifitas_masuk.id_atf_keluar = aktifitas_keluar.id_atf_keluar')
      ->order_by('aktifitas_keluar.id_atf_keluar','DESC')
      ->limit(1)
      ->get();
    return $query;
  }



}
?>
