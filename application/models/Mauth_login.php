<?php
class Mauth_login extends CI_Model{

  function proses_login($where,$table){
    return $this->db->get_where($table,$where)->result();
  }

}

?>
