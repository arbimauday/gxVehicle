<?php
class Mcodeunik extends CI_Model
{

  function kode_Kendaraan($table){
    $q = $this->db->query("SELECT MAX(RIGHT(kode_kendaraan,4)) as kode_kendaraan FROM $table");
    $kd = "";
    if($q){
      foreach($q->result() as $k){
        $nilaikode = $k->kode_kendaraan;
        $kode2 = (int) $nilaikode;
        $kode = $kode2 + 1;
        $kode_otomatis = str_pad($kode, 4, "0", STR_PAD_LEFT);
      }
    }else{
      $kd = "0001";
    }
    return $kode_otomatis;
  }

  function no_rab(){
    $q = $this->db->query("SELECT MAX(RIGHT(no_rab,4)) as no_rab FROM master_rab");
    $kd = "";
    if($q){
      foreach($q->result() as $k){
        $nilaikode = $k->no_rab;
        $kode2 = (int) $nilaikode;
        $kode = $kode2 + 1;
        $kode_otomatis = str_pad($kode, 4, "0", STR_PAD_LEFT);
      }
    }else{
      $kd = "0001";
    }
    return $kode_otomatis;
  }

  function nospk(){
    $first = date('01/m/Y');
    $last  = date('31/m/Y');
    $q = $this->db->query("SELECT MAX(RIGHT(no_spk,4)) as no_spk FROM master_spk WHERE tgl_spk <= '$last' AND tgl_spk >= '$first'");
    $kd = "";
    if($q){
      foreach($q->result() as $k){
        $nilaikode = $k->no_spk;
        $kode2 = (int) $nilaikode;
        $kode = $kode2 + 1;
        $kode_otomatis = str_pad($kode, 4, "0", STR_PAD_LEFT);
      }
    }else{
      $kd = "0001";
    }
    return $kode_otomatis;
  }

  function kode_barang(){
    $table = 'master_barang';
    $q = $this->db->query("SELECT MAX(RIGHT(kode_barang,4)) as kode_barang FROM $table");
    $kd = "";
    if($q){
      foreach($q->result() as $k){
        $nilaikode = $k->kode_barang;
        $kode2 = (int) $nilaikode;
        $kode = $kode2 + 1;
        $kode_barang = str_pad($kode, 4, "0", STR_PAD_LEFT);
      }
    }else{
      $kd = "0001";
    }
    return $kode_barang;
  }

}

?>
