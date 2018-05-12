<?php
class Mbarang extends CI_Model{

  // tabel menampilkan data barang
  function tbl_barang(){
    $query = $this->db->select('*')
     ->from('master_barang')
     ->join('kw_barang','kw_barang.id_kw =  master_barang.id_kw')
     ->join('satuan_barang','satuan_barang.id_satuan = master_barang.id_satuan')
     ->order_by('nama_barang','asc')
     ->get();
    return $query->result();
  }

 // spk penggunaan barang
 function penggunaan($idspk){
   $query = $this->db->select('*')
    ->from('history_barang')
    ->join('master_spk','master_spk.id_spk = history_barang.id_spk')
    ->join('master_barang','master_barang.id_barang = history_barang.id_barang')
    ->where_in('history_barang.id_spk',$idspk)
    ->get();
   return $query->result();
 }

 function cekstok($idbarang){
  $query = $this->db->select('*')
    ->from('master_barang')
    ->join('satuan_barang','satuan_barang.id_satuan = master_barang.id_satuan')
    ->join('kw_barang','kw_barang.id_kw = master_barang.id_kw')
    ->where('master_barang.id_barang',$idbarang)
    ->get();
  return $query->result();
 }

 // tabel pembelian barang
 public function pembelian_barang($no_rab){
   $query = $this->db->select('*')
     ->from('master_rab')
     ->join('pembelian_barang','pembelian_barang.id_rab = master_rab.id_rab')
     ->join('master_barang','master_barang.id_barang = pembelian_barang.id_barang')
     ->join('status_pembelian','status_pembelian.id_sts_pembelian = pembelian_barang.id_sts_pembelian')
     ->where_in('master_rab.no_rab', $no_rab)
     ->get();
   return $query;
 }

 // info barang yg mau di beli
 function infoPembelian($idpembelian){
  $query = $this->db->select('*')
    ->from('master_barang')
    ->join('satuan_barang','satuan_barang.id_satuan = master_barang.id_satuan')
    ->join('kw_barang','kw_barang.id_kw = master_barang.id_kw')
    ->join('pembelian_barang','pembelian_barang.id_barang = master_barang.id_barang')
    ->where('pembelian_barang.id_pembelian',$idpembelian)
    ->get();
  return $query->result();
 }

 // rekap penggunaan bulanan
 function rekapan_bulanan($dataTgl){
   $firstDate = $dataTgl.'/01';
   $lastDate = $dataTgl.'/31';
   $query = $this->db->select('*')
    ->from('history_barang')
    ->join('master_spk','master_spk.id_spk = history_barang.id_spk')
    ->join('master_barang','master_barang.id_barang = history_barang.id_barang')
    ->join('master_kendaraan','master_kendaraan.id_kendaraan = master_spk.id_kendaraan')
    ->join('satuan_barang','satuan_barang.id_satuan = master_barang.id_satuan')
    ->where('str_to_date(tgl_ambil,"%d/%m/%Y") >=', $firstDate)
    ->where('str_to_date(tgl_ambil,"%d/%m/%Y") <=', $lastDate)
    ->get();
  return $query->result();
 }

}
?>
