<?php
class Rab extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mrab','Mbarang'));
    $this->load->helper('url');
    $this->load->library('session','database');
  }

  // pengambilan no rab
  public function no_rab(){
    $data = 'RAB-'.date('ymd').$this->Mcodeunik->no_rab();
    echo json_encode($data);
  }

  // tabel rab perbulan
  function rab_bulanan(){
    $to = DateTime::createFromFormat ('M/Y',$_GET['date']);
    $getData = $to->format('Y/m');

    $data = $this->Mrab->Rab_bulanan($getData);
    $output = array();
    $output['data'] = array();
    $no = 0;
    foreach ($data as $vw) {
      if ($vw->id_sts_rab == '2'){
        $bg = '#b8fbb4';
      }else if ($vw->id_sts_rab == '1') {
        $bg = '#ffedc4';
      }else {
        $bg = '#d0d0d0';
      }
      $no +=1;
      $output['data'][] = array(
          $vw->no_rab,
          $vw->tgl_rab,
          '<span class="box-sts" style="background:'.$bg.'">'.$vw->sts_rab.'</span>',
          $vw->jenis_rab,
          'Rp '. number_format($vw->total_pengeluaran , 0, ',', '.'),
          '<a href="'.base_url('Admin/Form/rab?no_rab='.$vw->no_rab.'&id_rab='.$vw->id_rab). '" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Tinjauan</a>');
    }
    echo json_encode($output);
  }

  // input pengajuan barang di dalam RAB
  function input_pengajuan_barang(){
    $id_rab = $this->input->post('id_rab');
    $id_barang = $this->input->post('id_barang');
    $jml_pengajuan = $this->input->post('jml_pengajuan');
    $harga_pengajuan = $this->input->post('harga_pengajuan');

    $input = array(
     'id_rab' => $id_rab,
     'id_barang' => $id_barang,
     'jumlah_pengajuan' => $jml_pengajuan,
     'harga_pengajuan'  => $harga_pengajuan
    );
    $this->Mform->input($input,'pembelian_barang');
    echo json_encode(array("status" => TRUE));
  }

  // tabel pengajuan barang
  function tbl_pengajuan_barang(){
    $id_rab = $_GET['idrab'];
    $data = $this->Mrab->pengajuan_barang($id_rab);
    $output = array();
    $output['data'] = array();
    $no = 0;
    foreach ($data as $u) {
      $no +=1;
      $harga = 'Rp '.number_format($u->harga_pengajuan , 0, ',', '.');
      $total = 'Rp '.number_format($u->jumlah_pengajuan * $u->harga_pengajuan , 0, ',', '.');

      // ket barang
      if($u->id_sts_pembelian == '1'){
        $harga = 'Rp '.number_format($u->harga_pembelian , 0, ',', '.');
        $total = 'Rp '.number_format($u->jumlah_pembelian * $u->harga_pembelian , 0, ',', '.');
        $jml_barang = $u->jumlah_pembelian;
        $bg_sts = 'bg-green';
      }else if ($u->id_sts_pembelian == '2') {
        $harga = 'Rp '.number_format($u->harga_pengajuan , 0, ',', '.');
        $total = 'Rp '.number_format($u->jumlah_pengajuan * $u->harga_pengajuan , 0, ',', '.');
        $jml_barang = $u->jumlah_pengajuan;
        $bg_sts = 'bg-red';
      }else {
        $harga = 'Rp '.number_format($u->harga_pengajuan , 0, ',', '.');
        $total = 'Rp '.number_format($u->jumlah_pengajuan * $u->harga_pengajuan , 0, ',', '.');
        $jml_barang = $u->jumlah_pengajuan;
        $bg_sts = 'bg-yellow';
      }

      // disable button
      if($u->id_sts_rab == '1'){
        if($u->ket_update_stok == '0'){
          $disabled = '';
        }elseif ($u->ket_update_stok == '1') {
          $disabled = 'disabled';
        }
      }else {
        $disabled = 'disabled';
      }

      $output['data'][] = array(
       $no,$u->nama_barang,$jml_barang.' '.$u->satuan,$harga,$total,$u->merek_barang. ' / ' .$u->kw_barang,'<span class="box-sts '.$bg_sts.'">'.$u->sts_pembelian.'</span>','<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#Modalrealisasibarang"'. $disabled .' onclick="realisasi_barang('.$u->id_pembelian.')">Tinjau</button>'
      );
    }
    echo json_encode($output);
  }

  // update status RAB
  function update_status(){
    $where = array('id_rab' => $_GET['id_rab']);
    $getHarga = $this->Mform->where_ajax($where,'pembelian_barang');
    $total = 0;
    foreach ($getHarga as $ge) {
     if($_GET['id_sts'] == '2'){
      $total += $ge->harga_pembelian * $ge->jumlah_pembelian;
     }else {
      $total += $ge->harga_pengajuan * $ge->jumlah_pengajuan;
     }
    }

    $update = array(
      'total_pengeluaran' => $total,
      'id_sts_rab' => $_GET['id_sts']
    );
    $this->Mform->update($where,$update,'master_rab');
    redirect(base_url('Admin/Data_Ajax/Rab/update_stok_barang?id_rab='.$_GET['id_rab']));
    echo json_encode(array('status' => true));
  }

  // update stok barang yang telah di beli
  function update_stok_barang(){
    $where_pembeian = array(
      'id_rab' => $_GET['id_rab'],
      'id_sts_pembelian' => 1,
      'ket_update_stok' => 0
    );
    $data_pembelian = $this->Mform->where_ajax($where_pembeian,'pembelian_barang');
    foreach ($data_pembelian as $ue) {
      // where id pembelian
      $where_idPembelian = array(
        'id_pembelian' => $ue->id_pembelian
      );
      // where id barang
      $where_barang = array(
        'id_barang' => $ue->id_barang
      );
      // cek barang
      $data_barang = $this->Mform->where_ajax($where_barang,'master_barang');
      foreach ($data_barang as $st) {
        $total_stok = $st->stok_barang + $ue->jumlah_pembelian;
        $harga_11persen = $ue->harga_pembelian / 100 * 11 ;
        // update stok
        $update_stok = array(
          'stok_barang' => $total_stok,
          'harga_beli'  => $ue->harga_pembelian,
          'harga_jual'  => $harga_11persen + $ue->harga_pembelian
        );
        // update stok
        $this->Mform->update($where_barang,$update_stok,'master_barang');
        // update ke terangan update stok
        $update_ket = array('ket_update_stok' => 1);
        $this->Mform->update($where_idPembelian,$update_ket,'pembelian_barang');
      }
    }
    echo json_encode(array('status' => TRUE));// menggunakan fungsi ajax
    // menggunakan fungsi redirect
  }

  // cari id pembelian untuk di realisasi
  function infopembelian_barang(){
    $output = $this->Mbarang->infoPembelian($_GET['idpembelian']);
    echo json_encode($output);
  }

}
?>
