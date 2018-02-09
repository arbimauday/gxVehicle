<?php
class Mdaftar_kendaraan extends CI_Model{

  public function kendaraan($id_jenis_kendaraan){
    $query = $this->db->select('*')
      ->from('master_kendaraan')
      ->join('master_divisi','master_divisi.id_divisi = master_kendaraan.id_divisi')
      ->join('master_stnk','master_stnk.kode_kendaraan = master_kendaraan.kode_kendaraan')
      ->join('master_port','master_port.id_port = master_kendaraan.id_port')
      ->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = master_kendaraan.id_keadaan')
      ->join('status_hak','status_hak.id_hak = master_kendaraan.id_hak')
      ->where_in('master_kendaraan.id_jenis_kendaraan', $id_jenis_kendaraan)
      ->get();
    return $query;
  }

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

  // ajax, kenraan yg keuar
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

  // laporan keluaruntuk konversi ke pdf
  public function con_keluar($tgl){
    $query = $this->db->select('*')
      ->from('aktifitas_keluar')
      ->join('master_kendaraan','master_kendaraan.id_kendaraan = aktifitas_keluar.id_kendaraan')
      ->join('user','user.id_user = aktifitas_keluar.id_user')
      ->join('jenis_kendaraan','jenis_kendaraan.id_jenis_kendaraan = master_kendaraan.id_jenis_kendaraan')
      ->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = master_kendaraan.id_keadaan')
      ->where_in('aktifitas_keluar.tgl_keluar',$tgl)
      ->get();
    return $query;
  }

  // laporan masuk untuk konversi ke pdf
  public function con_masuk($tgl){
    $query = $this->db->select('*')
      ->from('aktifitas_keluar')
      ->join('aktifitas_masuk','aktifitas_masuk.id_atf_keluar = aktifitas_keluar.id_atf_keluar')
      ->join('user','user.id_user = aktifitas_masuk.id_user','left')
      ->where_in('aktifitas_keluar.tgl_keluar',$tgl)
      ->get();
    return $query;
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

  // jumlah kendaran yg belum kembali
  public function info_peminjaman($tgl){
    $query = $this->db->select('*')
      ->from('aktifitas_keluar')
      ->join('aktifitas_masuk','aktifitas_masuk.id_atf_keluar = aktifitas_keluar.id_atf_keluar')
      ->join('master_kendaraan','master_kendaraan.id_kendaraan = aktifitas_keluar.id_kendaraan')
      //->join('user','user.id_user = aktifitas_keluar.id_user')
      //->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = master_kendaraan.id_keadaan')
      //->join('jenis_kendaraan','jenis_kendaraan.id_jenis_kendaraan = master_kendaraan.id_jenis_kendaraan')
      //->join('master_divisi','master_divisi.id_divisi = master_kendaraan.id_divisi')
      ->where_in('aktifitas_masuk.id_user', 0)
      ->where_not_in('aktifitas_keluar.tgl_keluar', $tgl)
      ->get();
    return $query->result();
  }

  // profil info kendaraan
  public function info_profil($id_kendaraan){
    $query = $this->db->select('*')
      ->from('master_kendaraan')
      ->join('master_stnk','master_stnk.kode_kendaraan = master_kendaraan.kode_kendaraan')
      ->join('jenis_kendaraan','jenis_kendaraan.id_jenis_kendaraan = master_kendaraan.id_jenis_kendaraan')
      ->join('master_divisi','master_divisi.id_divisi = master_kendaraan.id_divisi')
      ->join('master_port','master_port.id_port = master_kendaraan.id_port')
      ->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = master_kendaraan.id_keadaan')
      ->join('status_hak','status_hak.id_hak = master_kendaraan.id_hak')
      ->where_in('master_kendaraan.id_kendaraan', $id_kendaraan)
      ->get();
    return $query;
  }

  // cari data keadaan kendaraan yang mau di update
  public function cek_keadaan($id_kendaraan){
    $query = $this->db->select('*')
      ->from('master_kendaraan')
      ->join('keadaan_kendaraan','keadaan_kendaraan.id_keadaan = master_kendaraan.id_keadaan')
      ->where_in('master_kendaraan.id_kendaraan',$id_kendaraan)
      ->get();
    return $query->result();
  }

  // menampilkan info catatan yang sts = 0
  public function info_catatan($id){
    $query =  $this->db->select('*')
      ->from('info_pengguna')
      ->join('master_kendaraan','master_kendaraan.id_kendaraan = info_pengguna.id_kendaraan')
      //->where_in('info_pengguna.sts_info',0)
      ->where_in('info_pengguna.id_info',$id)
      ->get();
    return $query->result();
  }

}
?>
