<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{

  protected $daftar_user = 'Admin/daftar_user';

  function __construct(){
    parent::__construct();
  }

  function index(){
    $data['level_user'] = $this->Mform->view('level_user')->result();
    $data['port'] = $this->Mform->view('master_port')->result();
    $data['divisi'] = $this->Mform->view('master_divisi')->result();
    $data['title'] = 'Daftar User';
    $data['content'] = $this->daftar_user;
    $this->load->view('Template/index_admin',$data);
  }

}
?>
