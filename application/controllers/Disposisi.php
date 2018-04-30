<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this -> load -> model('M_disposisi');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function index(){
        $disposisi = $this->M_disposisi->get_all();

        $data = array(
            'data_disposisi'  => $disposisi,
            'page_title'   => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('disposisi/v_disposisi',$data);
    }
}