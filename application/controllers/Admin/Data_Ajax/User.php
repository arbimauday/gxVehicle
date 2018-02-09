<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Muser'));
    $this->load->helper('url');
    $this->load->library('session','database');
  }

  function data_user(){
    //$data['jenis_pekerjaan'] = $this->Mform->view_ajax('jenis_pekerjaan');
    $where = array('id_level !=' => '1','kon_email' => '1' );
    $data = $this->Mform->where_ajax($where,'user');
    echo json_encode($data);
  }

  function teknisi(){
   $where = array('id_level' => '4');
   $data = $this->Mform->where_ajax($where,'user');
   echo json_encode($data);
  }

  // tambahkan divisi
  public function divisi(){
    $data = $this->Mform->view_ajax('master_divisi');
    echo json_encode($data);
  }

  // tambahkan port
  public function port(){
    $data = $this->Mform->view_ajax('master_port');
    echo json_encode($data);
  }

  // tabel user
  public function data_tbl(){
    $data = $this->Muser->data_tbl();
    $output = array();
    $output['data'] = array();
    $no = 0;
    foreach ($data as $u) {
      if($u->id_level == '1'){
        $btn_sabel = 'disabled';
        $idUser = '';
      }else {
        $btn_sabel = '';
        $idUser = $u->id_user;
      }
      $no +=1;
      $output['data'][] = array($no,$u->nama,$u->level,$u->level,$u->port,$u->email,'<button type="button" class="btn bg-red btn-xs" onclick="reset_pw_user('.$idUser.')"'.' '.$btn_sabel.'><i class="fa fa-rotate-left margin-r-5"></i>Reset PW</button> | <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalUbahUser" '.' '.$btn_sabel.' onclick="ubah_userPengguna('.$idUser.')"><i class="fa fa-pencil"></i> Ubah</button>');
    }
    echo json_encode($output);
  }

  // cek nama untuk menjaga data nama tidak yg sama
  function cek_nama(){
   $where = array('nama'=> $this->input->post('nama'));
   $data = $this->Mform->where_ajax_number($where,'user');
   echo json_encode($data);
  }

  // input user yang baru
  public function input_user(){
    $input = array(
      'nama'      => ucwords($this->input->post('nama')),
      'id_divisi' => $this->input->post('id_divisi'),
      'id_port'   => $this->input->post('id_port'),
      'user'      => $this->input->post('user'),
      'pass'      => md5($this->input->post('pass')),
      'id_level'  => $this->input->post('id_level'),
      'email'     => $this->input->post('email'),
      'kon_email' => 1,
      'token_user'=> uniqid().date('dmyhis')
    );
    $data = $this->Mform->input($input,'user');
    echo json_encode(array('status' => TRUE));
  }

  // update password admin
  public function update_pw_admin(){
    $pw = md5($this->input->post('p_u_admin'));
    $where = array('id_user' => $this->session->userdata('id_user'));
    $update= array(
      'pass' => $pw,
      'ket_user' => 1
    );
    $data = $this->Mform->update_cek_kembali($where,$update,'user');
    echo json_encode($data);
  }

  // reset password dari admin
  public function reset_password(){
    $where = array('id_user' => $_GET['id_user']);
    $update = array('pass' => md5('12345678'), 'ket_user' => 0);
    $this->Mform->update($where,$update,'user');
    echo json_encode(array('status'=> true));
  }

  // ubah_userPengguna
  public function ubah_userPengguna(){
    $id_user = $this->input->get('id_user');
    $data['user'] = $this->Muser->ambil_user($id_user);
    foreach ($data['user'] as $u) {
      $w_port   = array('id_port !=' =>$u->id_port);
      $w_divisi = array('id_divisi !=' => $u->id_divisi);
      $w_level  = array('id_level !=' => $u->id_level);

      $data['port'] = $this->Mform->where_ajax($w_port,'master_port');
      $data['divisi'] = $this->Mform->where_ajax($w_divisi,'master_divisi');
      $data['level'] = $this->Mform->where_ajax($w_level,'level_user');
    }
    echo json_encode($data);
  }

  // update user pengguna
  public function update_userPengguna(){
    $update = array(
      'nama'      => $this->input->post('nama_ubah_user'),
      'id_divisi' => $this->input->post('id_divisi_ubah_user'),
      'id_port'   => $this->input->post('id_port_ubah_user'),
      'user'      => $this->input->post('user_ubah_user'),
      'id_level'  => $this->input->post('id_level_ubah_user'),
      'email'     => $this->input->post('email_ubah_user')
    );
    $where = array('id_user' => $this->input->post('id_user_ubah_user'));
    $this->Mform->update($where,$update,'user');
    echo json_encode(array('status'=> true));
  }

}
?>
