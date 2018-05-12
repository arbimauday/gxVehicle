<?php
class Mlaporan extends CI_Model{

  // laporan pekerjaan spk
  function data($idspk){
   $query = $this->db->select('*')
    ->from('laporan_spk')
    ->join('master_spk','master_spk.id_spk = laporan_spk.id_spk')
    ->join('user','user.id_user = laporan_spk.id_teknisi')
    ->where_in('laporan_spk.id_spk',$idspk)
    ->order_by('tgl', 'DESC')
    ->get();
   return $query->result();
  }

}
?>
