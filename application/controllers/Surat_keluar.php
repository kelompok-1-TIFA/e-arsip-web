<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

    function __construct()    {
        parent::__construct();
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function index(){
      echo "Surat_keluar";
    }
}