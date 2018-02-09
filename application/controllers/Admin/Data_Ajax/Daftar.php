<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model(array('Mform','Mcodeunik','Mjoin_table'));
		$this->load->helper('url');
		$this->load->library('session','database');
  }

}
?>
