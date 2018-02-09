<?php
class Mrab extends CI_Model{

  public function Rab_bulanan($dataTgl){
    $firstDate = $dataTgl.'/01';
    $lastDate = $dataTgl.'/31';
    $query = $this->db->select('*')
      ->from('master_rab')
      ->join('jenis_rab','jenis_rab.id_jenis_rab = master_rab.id_jenis_rab')
      ->join('status_rab','status_rab.id_sts_rab = master_rab.id_sts_rab')
      ->where('str_to_date(tgl_rab,"%d/%m/%Y") >=', $firstDate)
      ->where('str_to_date(tgl_rab,"%d/%m/%Y") <=', $lastDate)
      ->order_by('master_rab.tgl_rab','DESC')
      ->get();
    return $query->result();
  }

  public function infoRab($dataRab){
    $query = $this->db->select('*')
      ->from('master_rab')
      ->join('jenis_rab','jenis_rab.id_jenis_rab = master_rab.id_jenis_rab')
      ->join('status_rab','status_rab.id_sts_rab = master_rab.id_sts_rab')
      ->where_in('master_rab.no_rab', $dataRab)
      ->order_by('master_rab.tgl_rab','DESC')
      ->get();
    return $query;
  }

  function pengajuan_barang($id_rab){
    $query = $this->db->select('*')
      ->from('master_rab')
      ->join('pembelian_barang','pembelian_barang.id_rab = master_rab.id_rab')
      ->join('master_barang','master_barang.id_barang = pembelian_barang.id_barang')
      ->join('status_pembelian','status_pembelian.id_sts_pembelian = pembelian_barang.id_sts_pembelian')
      ->join('satuan_barang','satuan_barang.id_satuan = master_barang.id_satuan')
      ->join('kw_barang','kw_barang.id_kw = master_barang.id_kw')
      ->where_in('master_rab.id_rab', $id_rab)
      ->get();
    return $query->result();
  }

}
?>
