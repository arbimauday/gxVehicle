<?php
class Login extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->model('Mauth_login');
  }

  function index(){
    if($this->session->userdata('logged_in') == TRUE){
      redirect(base_url('Admin/Dashboard'));
    }
    $this->load->view('Login_pages/index');
  }

  function proses_login(){
    $user = $this->input->post('user');
    $pass = md5($this->input->post('pass'));

    $where = array(
      'user' => $user,
      'pass' => $pass,
      'id_level' => '1'
    );
    $where_user = array('user' => $user);
    $where_pass = array('pass' => $pass);

    $komplit = $this->Mauth_login->proses_login($where,'user');
    $cekUser = $this->Mauth_login->proses_login($where_user,'user');
    $cekPass = $this->Mauth_login->proses_login($where_pass,'user');

    if(!empty($komplit)){
      foreach ($komplit as $u) {
        $sess_data['logged_in'] = TRUE;
        $sess_data['id_user'] = $u->id_user;
        $sess_data['nama'] = $u->nama;
        $sess_data['ket_user'] = $u->kon_email;
        $this->session->set_userdata($sess_data);
      }
      $output = '1';
    }else if (empty($cekUser)) {
      $output = 'Username tidak terdaftar';
    }else if (empty($cekPass)) {
      $output = 'Password tidak terdaftar';
    }else {
      $output = 'Tidak dapat di proses';
    }
    echo json_encode($output);
  }

  function log_out(){
    $logged_in = $this->session->unset_userdata('logged_in');
    $id_user = $this->session->unset_userdata('id_user');
    $nama = $this->session->unset_userdata('nama');
    $del_ses = $this->session->unset_userdata($logged_in,$id_user,$nama);

    if($del_ses == false){
	    redirect(base_url().'Auth/Login');
	  }else {
	    echo " <script>alert('Gagal Log-Out!');self.history.back();</script>";
	  }
  }
}
?>
