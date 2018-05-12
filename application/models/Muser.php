<?php
class Muser extends CI_Model{

  function data_tbl(){
    $query = $this->db->select('*')
      ->from('user')
      ->join('master_divisi','master_divisi.id_divisi = user.id_divisi')
      ->join('master_port','master_port.id_port = user.id_port')
      ->join('level_user','level_user.id_level = user.id_level')
      ->order_by('nama','asc')
      ->get();
    return $query->result();
  }

  // ambil data user perdetail
  public function ambil_user($id_user){
    $query = $this->db->select('*')
      ->from('user')
      ->join('master_divisi','master_divisi.id_divisi = user.id_divisi')
      ->join('master_port','master_port.id_port = user.id_port')
      ->join('level_user','level_user.id_level = user.id_level')
      ->where_in('user.id_user',$id_user)
      ->get();
    return $query->result();
  }
}

?>
