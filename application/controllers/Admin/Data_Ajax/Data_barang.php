<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Data_barang extends CI_Controller {

  //protected $index = 'Admin/info_kendaraan';

  function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mbarang','Mform','Mcodeunik'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  // cek nama barang
  function cek_namabarang(){
    $where = array(
      'nama_barang' => $this->input->get('nama_barang'),
      'merek_barang' => $this->input->get('merek_barang'),
      'id_kw' => $this->input->get('id_kw'),
      'id_satuan' => $this->input->get('id_satuan')
    );
    $cek = $this->Mform->where_ajax_number($where,'master_barang');
    if($cek == 0){
      $data = '0';
    }else {
      $data = '1';
    }
    echo json_encode($cek);
  }

  // daftar kualitas dan satuan barang
  function status_kualitas(){
    $data['kw'] = $this->Mform->view_ajax('kw_barang');
    $data['satuan'] = $this->Mform->view_ajax('satuan_barang');
    echo json_encode($data);
  }

  // tambahkan nama barang
  function tambahkan_barang(){
    $kode = 'BKS-'.$this->Mcodeunik->kode_barang();
    $input = array(
      'nama_barang' => ucwords($this->input->get('nama_barang')),
      'kode_barang' => $kode,
      'merek_barang' => ucwords($this->input->get('merek_barang')),
      'id_kw' => $this->input->get('id_kw'),
      'id_satuan' => $this->input->get('id_satuan')
    );
    $this->Mform->input($input,'master_barang');
    echo json_encode(array('status' => TRUE));
  }

  //spk penggunaan barang
  function penggunaan(){
    $idspk = $_GET['idspk'];
    $data = $this->Mbarang->penggunaan($idspk);

    $output = array();
    $output['data'] = array();
    $no =0;
    foreach ($data as $u) {
      $harga_jual = number_format($u->harga_barang , 0, ',', '.');
      $total = number_format($u->total_harga , 0, ',', '.');
      $no +=1;
      $output['data'][] = array(
        $no,$u->nama_barang,$u->jml_penggunaan,$u->tgl_ambil,'Rp. '.$harga_jual,'Rp. '.$total
      );
    }
    echo json_encode($output);
  }

  function daftar(){
    $output = $this->Mform->view_ajax('master_barang');
    echo json_encode($output);
  }

  // daftar data barang untuk di belih
  function pembelihan_barang(){
    $where = array('id_rab' => $_GET['id_rab']);
    $output['cek'] = $this->Mform->where_ajax($where,'pembelian_barang');
    $output['hasil'] = $this->Mform->view_ajax('master_barang');
    echo json_encode($output);
  }

  // stok barang
  function stok(){
    //$idBarang = $_GET['idBarang'];
    $output = $this->Mbarang->cekstok($_GET['idBarang']);
    echo json_encode($output);
  }

  // ambil barang
  function ambil_barang(){
    $id_spk = $_GET['idspk'];
    $id_barang = $this->input->post('id_barang');
    $jml_penggunaan = $this->input->post('jml_barang');
    $harga_barang = $this->input->post('harga_jual');
    $total_harga = $this->input->post('total_harga');

    $where = array('id_barang'=>$id_barang);
    $data_where = $this->Mform->where_ajax($where,'master_barang');

    foreach ($data_where as $u) {
      $update = array('stok_barang' => $u->stok_barang - $jml_penggunaan);
    }
    // update stok barang
    $this->Mform->update($where,$update,'master_barang');
    //input history penggunaan barang
    $data_history = array(
      'id_spk' => $id_spk,
      'id_barang' => $id_barang,
      'jml_penggunaan' => $jml_penggunaan,
      'harga_barang'   => $harga_barang,
      'total_harga'    => $total_harga,
      'tgl_ambil'      => date('d/m/Y')
    );
    $this->Mform->input($data_history,'history_barang');
    echo json_encode(array("status" => TRUE));
  }

  // total pembelian barang sesuai status barang
  function total_harga(){
    $id_rab = $_GET['id_rab'];
    // ajukan
    $ajukan = array(
      'id_rab' => $id_rab
      //,'id_sts_pembelian' => '0'
    );
    $total_ajukan = $this->Mform->where_ajax($ajukan,'pembelian_barang');
    $total_harga_ajukan = 0;
    foreach ($total_ajukan as $u) {
      $total_harga_ajukan += $u->jumlah_pengajuan * $u->harga_pengajuan;
    }
    // jadi beli
    $beli = array(
      'id_rab' => $id_rab,
      'id_sts_pembelian' => '1'
    );
    $total_beli = $this->Mform->where_ajax($beli,'pembelian_barang');
    $total_harga_beli = 0;
    foreach ($total_beli as $e) {
      $total_harga_beli += $e->jumlah_pembelian * $e->harga_pembelian;
    }

    $output['ajukan'] = 'Rp '. number_format( $total_harga_ajukan , 0, ',', '.');
    $output['beli'] = 'Rp '.number_format($total_harga_beli , 0, ',', '.');
    echo json_encode($output);
  }

  // update status barang dan input jumlah pembelian yang mau di beli
  function input_realisai(){
    $where = array('id_pembelian' => $this->input->post('id_pembelian'));
    if($_GET['hapus'] == '1'){
      $update = array(
        'jumlah_pembelian' => '',
        'harga_pembelian' => '',
        'id_sts_pembelian' => '2'
      );
    }else {
      $update = array(
        'jumlah_pembelian' => $this->input->post('jumlah_pembelian'),
        'harga_pembelian' => $this->input->post('harga_pembelian'),
        'id_sts_pembelian' => '1'
      );
    }
    $this->Mform->update($where,$update,'pembelian_barang');
    echo json_encode(array("status" => TRUE));
  }

  // rekapan penggunaan barang perbulan
  public function rekap_Barang(){
    $to = DateTime::createFromFormat ('M/Y',$_GET['date']);
    $getData = $to->format('Y/m');

    $data = $this->Mbarang->rekapan_bulanan($getData);
    $output = array();
    $output['data'] = array();
    $no = 0;
    foreach ($data as $vm) {
      $no +=1;
      $output['data'][] = array($no,$vm->nomor_polisi,$vm->no_spk,$vm->tgl_ambil,$vm->nama_barang,$vm->jml_penggunaan.' '.$vm->satuan,'Rp '. number_format( $vm->harga_barang, 0, ',', '.'),'Rp '. number_format( $vm->total_harga, 0, ',', '.'));
    }
    echo json_encode($output);
  }


}
?>
