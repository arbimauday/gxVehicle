<?php
class Mnotif_bar extends CI_Model {

  public function jadwal_ganti_oli(){
    //$tgl = date('Y/m/d');
    $tgl = date('Y/m/d', strtotime("+3 days", strtotime(date('d-m-Y'))));

    $query = $this->db->select('*')
      ->from('catatan_ganti_oli')
      ->join('master_kendaraan','master_kendaraan.id_kendaraan = catatan_ganti_oli.id_kendaraan')
      ->where('catatan_ganti_oli.km_tempuh >=', 2000)
      ->or_where('str_to_date(tgl_ganti_berikutnya,"%d/%m/%Y") <=', $tgl ,NULL,FALSE)
      ->where_in('catatan_ganti_oli.respon_admin', 0)
      ->order_by('catatan_ganti_oli.id_ganti_oli','DESC')
      ->get();
    return $query->result();
  }

  // notif komplen
  function komplen(){
    $query = $this->db->select('*')
      ->from('komplen')
      ->join('master_kendaraan','master_kendaraan.id_kendaraan = komplen.id_kendaraan')
      ->join('user','user.id_user = komplen.id_user_komplen')
      ->where_in('komplen.cek_tinjau',0)
      ->order_by('komplen.id_komplen','DESC')
      ->get();
    return $query->result();
  }

}

?>
