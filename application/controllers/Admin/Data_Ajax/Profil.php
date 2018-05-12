<?php
class Profil extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mdaftar_kendaraan'));
  }

  public function stnk(){
    $where = array('kode_kendaraan' => $_GET['kode']);
    $data_get = $this->Mform->where_ajax($where,'master_stnk');
    $output = array();
    $output['data'] = array();
    foreach ($data_get as $u) {
      $output['data'][] = array('Merek','<b>'.$u->merek.'</b>');
      $output['data'][] = array('Thn Perakitan','<b>'.$u->thn_perakitan.'</b>');
      $output['data'][] = array('No Rangka','<b>'.$u->no_rangka.'</b>');
      $output['data'][] = array('No Mesin','<b>'.$u->no_mesin.'</b>');
      $output['data'][] = array('Jenis Model','<b>'.$u->jenis_model.'</b>');
      $output['data'][] = array('Bahan Bakar','<b>'.$u->bahan_bakar.'</b>');
      $output['data'][] = array('Warna','<b>'.$u->warna.'</b>');
      $output['data'][] = array('Masa STNK','<b class="text-red">'.$u->masa_stnk.'</b>');
    }
    echo json_encode($output);
  }

  public function asuransi(){
    $where = array('kode_kendaraan' => $_GET['kode']);
    $data_get = $this->Mform->where_ajax($where,'master_asuransi');
    $output = array();
    $output['data'] = array();
    foreach ($data_get as $u) {
      $output['data'][] = array('Nama Asuransi','<b>'.$u->nama_asuransi.'</b>');
      $output['data'][] = array('Jatuh Tempo','<b>'.$u->jatuh_tempo.'</b>');
      $output['data'][] = array('Nominal','<b>'.$u->nominal.'</b>');
    }
    echo json_encode($output);
  }

  public function kir(){
    $where = array('kode_kendaraan' => $_GET['kode']);
    $data_get = $this->Mform->where_ajax($where,'master_kir');
    $output = array();
    $output['data'] = array();
    foreach ($data_get as $u) {
      $output['data'][] = array('Nama Pemilik','<b>'.$u->nama_pemilik.'</b>');
      $output['data'][] = array('Alamat','<b>'.$u->alamat_pemilik.'</b>');
      $output['data'][] = array('No Uji Berkala','<b>'.$u->no_uji_berkala.'</b>');
      $output['data'][] = array('Status Pengguna','<b>'.$u->status_pengguna.'</b>');
    }
    echo json_encode($output);
  }


  // update info kendaraan
  public function update_info_kendaraan(){
    $where = array('kode_kendaraan' => $this->input->post('kode'));
    $update = array(
      'id_divisi' => $this->input->post('id_divisi'),
      'id_port' => $this->input->post('id_port'),
      'id_keadaan' => $this->input->post('id_keadaan'),
      'id_hak' => $this->input->post('id_hak')
    );
    $this->Mform->update($where,$update,'master_kendaraan');
    echo json_encode(array('status'=> TRUE));
  }

  // update stnk
  public function update_stnk(){
    $where = array('kode_kendaraan' => $this->input->post('kode'));
    $update = array(
      'merek' => $this->input->post('kode'),
      'thn_perakitan' => $this->input->post('thn_perakitan'),
      'no_rangka' => $this->input->post('no_rangka'),
      'no_mesin' => $this->input->post('no_mesin'),
      'jenis_model' => $this->input->post('jenis_model'),
      'bahan_bakar' => $this->input->post('bahan_bakar'),
      'warna' => $this->input->post('warna'),
      'masa_stnk' => $this->input->post('masa_stnk')
    );
    $this->Mform->update($where,$update,'master_stnk');
    echo json_encode(array('status'=> TRUE));
  }

  // update asuransi
  public function update_asuransi(){
    $where = array('kode_kendaraan' => $this->input->post('kode'));
    $update = array(
      'nama_asuransi' => $this->input->post('nama_asuransi'),
      'jatuh_tempo' => $this->input->post('jatuh_tempo'),
      'nominal' => $this->input->post('nominal')
    );
    $this->Mform->update($where,$update,'master_asuransi');
    echo json_encode(array('status'=> TRUE));
  }

  // update kir
  public function update_kir(){
    $where = array('kode_kendaraan' => $this->input->post('kode'));
    $update = array(
      'nama_pemilik' => $this->input->post('nama_pemilik'),
      'alamat_pemilik' => $this->input->post('alamat_pemilik'),
      'no_uji_berkala' => $this->input->post('no_uji_berkala'),
      'status_pengguna' => $this->input->post('status_pengguna'),
    );
    $this->Mform->update($where,$update,'master_kir');
    echo json_encode(array('status'=> TRUE));
  }

  // menampilkan daftar gambar kendaraan
  public function gallery_img(){
    $where = array('id_kendaraan' => $_GET['id_kendaraan']);
    $data = $this->Mform->where_ajax($where,'image_kendaraan');
    $response = array();
    $responseArr = array();
    for($b=0;$b<count($data);$b++){
      $response['id_img_kendaraan']=$data[$b]->id_img_kendaraan;
      $response['id_kendaraan'] = $data[$b]->id_kendaraan;
      $response['ket_img'] = $data[$b]->ket_img;
      $response['img_kendaraan']=base64_encode($data[$b]->img_kendaraan);
      array_push($responseArr,$response);
    }
    echo json_encode($responseArr);
  }

  // upload gambar
  public function upload_image(){
    $configg = time().$_FILES['upload_file']['name'];
    $config['upload_path'] = './assets/gallery-img-profil';
    $config['allowed_types'] = 'jpeg|gif|jpg|png';
    $config['max_size']  = '1000';
    $config['max_width']  = '1024';
    $config['max_height']  = '768';
    $config['file'] = $_FILES['upload_file']['tmp_name'];
    $config['encrypt_name'] = TRUE;
    $config['tmp_name'] = $_FILES['upload_file']['tmp_name'];
    $this->load->library('upload', $config);
    if(!$configg){
      $status = '0';
      $msg = $this->upload->display_errors();
    }else if ($_FILES['upload_file']['size'] == ''){
      $status = '2';
    }else{
      move_uploaded_file($_FILES['upload_file']['tmp_name'],"assets/gallery-img-profil/".$configg);
      $input = array(
        'id_kendaraan' => $this->input->post('idkendaraan'),
        'tgl_img_kendaraan' => date('d/m/Y'),
        'img_kendaraan' => $configg,
        'ket_img' => $this->input->post('title_img')
      );
      $this->Mform->input($input,'image_kendaraan');
      $status = '1';
    }
    echo json_encode($status);
  }

  public function upload_image_in_db() {
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']  = '100';
    $config['max_width'] = '1024';
    $config['max_height'] = '768';
    $imgdata = file_get_contents($_FILES['upload_file']['tmp_name']);
    if ($_FILES['upload_file']['size'] == ''){
      $status = '2';
    }else{
      $input = array(
        'id_kendaraan' => $this->input->post('id_kendaraan'),
        'tgl_img_kendaraan' => date('d/m/Y'),
        'img_kendaraan' => $imgdata,
        'ket_img' => $this->input->post('title_img')
      );
      $this->Mform->input($input,'image_kendaraan');
      $status = '1';
    }
    echo json_encode($status);
  }

}
?>
