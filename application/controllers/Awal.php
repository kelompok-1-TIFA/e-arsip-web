<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Awal extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_user');
    }

    public function index()
    {
        if ($this->session->userdata('status_login')!="login") {
            $data = array('page_title' => "Login",);
            $this->load->view('v_login',$data);
        }else{
            $data = array('page_title' => "Dashboard",);
            $this->load->view('v_dashboard',$data);
        }
    }

    public function aksilogin(){
        $username = $this->input->post('username');
        $password=$this->input->post('password');
        $where = array(
            'username' => $username,
            );
        $cek_fase_1 = $this->M_user->cek_login($where)->num_rows();
        $cek_fase_2 = $this->M_user->cek_login($where)->row();
        if($cek_fase_1 > 0){
            $this->load->library('encrypt'); 
            $key = 'vyanarypratamabanyuwangi12345678';
            $password_encrypt =  $this->encrypt->decode($cek_fase_2->password, $key);
            if ($password==$password_encrypt) {
                $data_session = array(
                    'id_user'       => $cek_fase_2->id_user,
                    'nama'          => $cek_fase_2->nama,
                    'foto'          => $cek_fase_2->foto,
                    'id_bagian'     => $cek_fase_2->id_bagian_pegawai,
                    'level_user'    => $cek_fase_2->level_user,
                    'status_login'  => "login"
                );
         
                $this->session->set_userdata($data_session);
         
                redirect(base_url());
            }else{
                $this->session->set_flashdata("alert", "<script>
                    $.notify({
                        icon: 'report',
                        title: '<strong>Gagal Login!!</strong><br>',
                        message: 'Password tidak valid!!',
                    },{
                        type: 'danger',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                    });
                </script>");
                redirect(base_url());
            }
        }else{
            $this->session->set_flashdata("alert", "<script>
                $.notify({
                    icon: 'report',
                    title: '<strong>Gagal Login!!</strong><br>',
                    message: 'Username tidak terdaftar!!',
                },{
                    type: 'danger',
                    timer: 3000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                });
            </script>");
            redirect(base_url());
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
