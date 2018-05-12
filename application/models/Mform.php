<?php
class Mform extends CI_Model{

  public function input($data,$table){
    $this->db->insert($table,$data);
  }

  public function input_cek($data,$table){
    $this->db->insert($table,$data);
    return $this->db->get_where($table,$data);
  }

  public function where($where,$table){
    return $this->db->get_where($table,$where);
  }

  public function where_ajax($where,$table){
    return $this->db->get_where($table,$where)->result();
  }
  public function where_ajax_sort($where,$table){
    $this->db->order_by('id_notes', 'DESC');
    return $this->db->get_where($table,$where)->result();
  }

  public function where_ajax_desc($where,$column,$table){
    $this->db->order_by($column, 'DESC');
    return $this->db->get_where($table,$where)->result();
  }

  public function where_ajax_number($where,$table){
    return $this->db->get_where($table,$where)->num_rows();
  }

  public function update($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }

  public function update_cek_kembali($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
    return $this->db->get_where($table,$where)->num_rows();
  }

  public function view($table){
    return $this->db->get($table);
  }

  // ajax
  public function view_ajax($table){
    return $this->db->get($table)->result();
  }

}
?>
