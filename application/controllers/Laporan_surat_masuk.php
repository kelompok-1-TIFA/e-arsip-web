<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_surat_masuk extends CI_Controller {

    function __construct()    {
        parent::__construct();
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function Laporan_harian(){
      echo "Laporan_harian";
    }
     public function Laporan_bulanan(){
      echo "Laporan_bulanan";
    }
     public function Laporan_tahunan(){
      echo "Laporan_tahunan";
    }
}