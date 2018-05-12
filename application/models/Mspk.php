<?php
class Mspk extends CI_Model{

    // daftar tabel spk open dan pending
    function spk_status($idData){
        $query = $this->db->select('*')
            ->from('master_spk')
            ->join('master_kendaraan','master_kendaraan.id_kendaraan = master_spk.id_kendaraan')
            ->join('jenis_pekerjaan','jenis_pekerjaan.id_jenis_pekerjaan = master_spk.id_jenis_pekerjaan')
            ->join('master_stnk','master_stnk.kode_kendaraan = master_kendaraan.kode_kendaraan')
            ->where_in('master_spk.id_status_spk', $idData)
            ->get();
        return $query->result();
    }

    // spk closed
    function spkClosed($date){
        $first = $date.'/01';
        $last  = $date.'/31';

        $query = $this->db->select('*')
            ->from('master_spk')
            ->join('master_kendaraan','master_kendaraan.id_kendaraan = master_spk.id_kendaraan')
            ->join('jenis_pekerjaan','jenis_pekerjaan.id_jenis_pekerjaan = master_spk.id_jenis_pekerjaan')
            ->join('master_stnk','master_stnk.kode_kendaraan = master_kendaraan.kode_kendaraan')
            ->where_in('master_spk.id_status_spk', '3')
            ->where('str_to_date(tgl_spk,"%d/%m/%Y") >=', $first)
            ->where('str_to_date(tgl_spk,"%d/%m/%Y") <=', $last)
            ->get();
        return $query->result();
    }

    // lihat spk
    function lihatSpk($idData){
        $query = $this->db->select('*')
            ->from('master_spk')
            ->join('master_kendaraan','master_kendaraan.id_kendaraan = master_spk.id_kendaraan')
            ->join('master_divisi','master_divisi.id_divisi = master_kendaraan.id_divisi')
            ->join('status_spk','status_spk.id_status_spk = master_spk.id_status_spk')
            ->join('jenis_pekerjaan','jenis_pekerjaan.id_jenis_pekerjaan = master_spk.id_jenis_pekerjaan')
            ->join('master_stnk','master_stnk.kode_kendaraan = master_kendaraan.kode_kendaraan')
            ->join('user','user.id_user = master_spk.id_pembuat')
            ->where_in('master_spk.id_spk',$idData)
            ->get();
        return $query->result();
    }

    // mengambil spk perbulan
    function spkPerbulan($idKendaraan,$dataTgl){
        $firstDate = $dataTgl.'/01';
        $lastDate = $dataTgl.'/31';
        $query = $this->db->select('*')
            ->from('master_spk')
            ->join('status_spk','status_spk.id_status_spk = master_spk.id_status_spk')
            ->join('jenis_pekerjaan','jenis_pekerjaan.id_jenis_pekerjaan = master_spk.id_jenis_pekerjaan')
            ->where('str_to_date(tgl_spk,"%d/%m/%Y") >=', $firstDate)
            ->where('str_to_date(tgl_spk,"%d/%m/%Y") <=', $lastDate)
            ->where_in('master_spk.id_kendaraan',$idKendaraan)
            ->order_by('master_spk.tgl_spk','DESC')
            ->get();
        return $query->result();
    }

}
?>
