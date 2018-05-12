<?php

class Mapi extends CI_Model{

  // ajax, kendaraan yg bisa di pakai
  public function bisa_dipakai($id_data){
    $query = $this->db->select('*')
      ->from('master_kendaraan')
      ->join('master_divisi','master_divisi.id_divisi = master_kendaraan.id_divisi')
      ->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = master_kendaraan.id_keadaan')
      ->join('jenis_kendaraan','jenis_kendaraan.id_jenis_kendaraan = master_kendaraan.id_jenis_kendaraan')
      ->where_in('master_kendaraan.id_sts_atf', $id_data)
      ->order_by('master_kendaraan.id_divisi','DESC')
      ->get();
    return $query->result();
  }

  // ajax, kenraan yg keluar
  public function aktifitas_keluar($tgl){
    $query = $this->db->select('*')
      ->from('aktifitas_keluar')
      ->join('aktifitas_masuk','aktifitas_masuk.id_atf_keluar = aktifitas_keluar.id_atf_keluar')
      ->join('master_kendaraan','master_kendaraan.id_kendaraan = aktifitas_keluar.id_kendaraan')
      ->join('user','user.id_user = aktifitas_keluar.id_user')
      ->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = master_kendaraan.id_keadaan')
      ->join('jenis_kendaraan','jenis_kendaraan.id_jenis_kendaraan = master_kendaraan.id_jenis_kendaraan')
      ->join('master_divisi','master_divisi.id_divisi = master_kendaraan.id_divisi')
      ->where_in('aktifitas_keluar.tgl_keluar', $tgl)
      ->order_by('aktifitas_keluar.tgl_keluar','ASC')
      ->order_by('aktifitas_keluar.waktu_keluar','ASC')
      ->get();
    return $query->result();
  }

  // ajax, info kendaraan keluar dalam bentuk modal
  public function modalDetail_keluar($id_data){
    $query = $this->db->select('*')
      ->from('aktifitas_keluar')
      ->join('aktifitas_masuk','aktifitas_masuk.id_atf_keluar = aktifitas_keluar.id_atf_keluar')
      ->join('master_kendaraan','master_kendaraan.id_kendaraan = aktifitas_keluar.id_kendaraan')
      ->join('user','user.id_user = aktifitas_keluar.id_user')
      ->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = master_kendaraan.id_keadaan')
      ->join('jenis_kendaraan','jenis_kendaraan.id_jenis_kendaraan = master_kendaraan.id_jenis_kendaraan')
      ->join('tujuan_peminjaman','tujuan_peminjaman.id_tujuan = aktifitas_keluar.id_tujuan', 'inner')
      ->where_in('aktifitas_keluar.id_atf_keluar', $id_data)
      ->get();
    return $query->result();
  }

  // ajax, info kendaraan masuk dalam bentuk modal
  function modalDetail_masuk($id_data){
    $query = $this->db->select('*')
      ->from('aktifitas_masuk')
      ->join('user','user.id_user = aktifitas_masuk.id_user')
      ->where_in('aktifitas_masuk.id_atf_keluar', $id_data)
      ->get();
    return $query->result();
  }

  //modal detail teknisi cek keadaan kendaraan
  public function modalDetail_catatankeadaan($id_data){
    $query = $this->db->select('*')
      ->from('aktifitas_masuk')
      ->join('cek_atf_masuk','cek_atf_masuk.id_atf_masuk = aktifitas_masuk.id_atf_masuk')
      ->join('user','user.id_user = cek_atf_masuk.id_teknisi')
      ->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = cek_atf_masuk.id_keadaan')
      ->where_in('aktifitas_masuk.id_atf_keluar', $id_data)
      ->get();
    return $query->result();
  }

  // mencari kendaraan yg belum pulang
  function kendaraan_kembali(){
      $query =  $this->db->select('*')
        ->from('master_kendaraan')
        ->join('aktifitas_keluar','aktifitas_keluar.id_kendaraan = master_kendaraan.id_kendaraan')
        ->join('aktifitas_masuk','aktifitas_masuk.id_atf_keluar = aktifitas_keluar.id_atf_keluar')
        ->join('user','user.id_user = aktifitas_keluar.id_user')
        ->where_in('aktifitas_masuk.id_user', 0)
        ->get();
    return $query->result();
  }



}

?>
