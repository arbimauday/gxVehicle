<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

  protected $kendaraan = 'Admin/Form/form_input_kendaraan';
  protected $rab       = 'Admin/Form/input_rab';

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mrab','Mcodeunik','Mbarang'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

  public function kendaraan(){
    $data['title'] = 'Form Kendaraan';
    $data['content'] = $this->kendaraan;
    $this->load->view('Template/index_admin',$data);
  }

  public function inputkendaraan(){
    $this->load->library('sweet_alert');
    //master kendaraan
    $nomor_polisi = strtoupper($this->input->post('nomor_polisi'));
    $id_jenis_kendaraan = $this->input->post('id_jenis_kendaraan');
    $id_port = $this->input->post('id_port');
    $id_divisi = $this->input->post('id_divisi');
    $tgl_pembelian = $this->input->post('tgl_pembelian');
    $tgl_penerimaan = $this->input->post('tgl_penerimaan');
    $id_hak = $this->input->post('id_hak');
    $id_keadaan = $this->input->post('id_keadaan');
    // mengambil kode kendaraan
    $ambil_kode = $this->Mcodeunik->kode_Kendaraan('master_kendaraan');
    $kode_Kendaraan = 'BKR'.$ambil_kode;
    // master stnk
    $merek = $this->input->post('merek');
    $thn_perakitan = $this->input->post('thn_perakitan');
    $no_rangka = $this->input->post('no_rangka');
    $no_mesin = $this->input->post('no_mesin');
    $jenis_model = $this->input->post('jenis_model');
    $bahan_bakar = $this->input->post('bahan_bakar');
    $warna = $this->input->post('warna');
    $masa_stnk = $this->input->post('masa_stnk');
    // Asuransi
    $nama_asuransi = $this->input->post('nama_asuransi');
    $jatuh_tempo = $this->input->post('jatuh_tempo');
    $nominal = $this->input->post('nominal');
    // input data dalam master kendaraan
    $data_info_kendaraan = array(
      'kode_Kendaraan' => $kode_Kendaraan,
      'id_jenis_kendaraan' => $id_jenis_kendaraan,
      'nomor_polisi' => $nomor_polisi,
      'id_divisi' => $id_divisi,
      'id_port' => $id_port,
      'id_keadaan' => $id_keadaan,
      'id_hak' => $id_hak,
      'tgl_pembelian' => $tgl_pembelian,
      'tgl_penerimaan' => $tgl_penerimaan,
      'status_kendaraan' => "Aktif"
    );
    // input data stnk
    $data_stnk = array(
      'kode_Kendaraan' => $kode_Kendaraan,
      'merek' => $merek,
      'thn_perakitan' => $thn_perakitan,
      'no_rangka' => $no_rangka,
      'no_mesin' => $no_mesin,
      'jenis_model' => $jenis_model,
      'bahan_bakar' => $bahan_bakar,
      'warna' => $warna,
      'masa_stnk' => $masa_stnk
    );

    // input data asuransi
    $data_asuransi = array(
      'kode_Kendaraan' => $kode_Kendaraan,
      'nama_asuransi' => $nama_asuransi,
      'jatuh_tempo' => $jatuh_tempo,
      'nominal' => $nominal
    );

    if(!empty($nomor_polisi)){
      $this->Mform->input($data_info_kendaraan,'master_kendaraan');
      $this->Mform->input($data_stnk,'master_stnk');
      $this->Mform->input($data_asuransi,'master_asuransi');

      // Buku kir
      if($id_jenis_kendaraan == '2'){
        // input data buku kir
        $data_kir = array(
          'kode_Kendaraan' => $kode_Kendaraan,
          'nama_pemilik' => $this->input->post('nama_pemilik'),
          'alamat_pemilik' => $this->input->post('alamat_pemilik'),
          'no_uji_berkala' => $this->input->post('no_uji_berkala'),
          'status_pengguna' => $this->input->post('status_pengguna')
        );
        $this->Mform->input($data_kir,'master_kir');
      }
      echo $this->sweet_alert->notification();
      echo '<script>setInterval(function(){
			swal({
			title: "",
			text: "Berhasil ditambahkan!",
			type: "success",
			timer: 1000,
			showConfirmButton: false
		  });})</script>';
		  echo "<script>setInterval(function(){
			window.location.href = '".base_url()."Admin/Info_kendaraan';},1000)</script>";
    }else {
      echo $this->sweet_alert->notification();
      echo '<script>setInterval(function(){
			swal({
			title: "Coba lagi!",
			text: "Masih ada data yang kosong",
			type: "error",
			timer: 1000,
			showConfirmButton: false
		  });})</script>';
		  echo "<script>setInterval(function(){window.history.back();},1000)</script>";
    }

  }


  // form buat rab
  public function rab(){
    $data['no_rab'] = $_GET['no_rab'];
    $data['id_rab'] = $_GET['id_rab'];
    $data['tabelPembelian'] = $this->Mbarang->pembelian_barang($data['no_rab'])->result();

    $data['infoRab'] = $this->Mrab->infoRab($data['no_rab'])->result();

    $data['title'] = 'Form RAB';
    $data['content'] = $this->rab;
    $this->load->view('Template/index_admin',$data);
  }

}
?>
