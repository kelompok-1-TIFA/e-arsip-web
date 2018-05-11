<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Awal extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_pegawai');
        $this->load->model('M_jenis_surat');
        $this->load->model('M_bagian');
        $this->load->model('M_jabatan');
        $this->load->model('M_surat_masuk');
        $this->load->model('M_surat_keluar');
        $this->load->model('M_disposisi');
    }

    public function index()
    {
        if ($this->session->userdata('status_login')!="login") {
            $data = array('page_title' => "Login",);
            $this->load->view('v_login',$data);
        }else{
            if ($this->session->userdata('level_user')=="admin") {
                $jml_jenis_surat = $this->M_jenis_surat->total_rows();
                $jml_bagian = $this->M_bagian->total_rows();
                $jml_jabatan = $this->M_jabatan->total_rows();   
                $jml_pegawai = $this->M_pegawai->total_rows();  
                $data = array(
                    'jml_jenis_surat'   => $jml_jenis_surat,
                    'jml_bagian'        => $jml_bagian,
                    'jml_jabatan'       => $jml_jabatan,
                    'jml_pegawai'       => $jml_pegawai,
                    'page_title'        => "Dashboard",
                );
            }else{
                $jml_surat_masuk = $this->M_surat_masuk->total_rows();
                if ($this->session->userdata('level_user')!="kepala desa") {
                    $jml_surat_keluar = $this->M_surat_keluar->total_rows_perbagian($this->session->userdata('id_bagian'));
                $jml_disposisi = $this->M_disposisi->total_rows_perbagian($this->session->userdata('id_bagian'));    
                }else{
                    $jml_surat_keluar = $this->M_surat_keluar->total_rows();
                    $jml_disposisi = $this->M_disposisi->total_rows();    
                }
                $data = array(
                    'jml_disposisi'     => $jml_disposisi,
                    'jml_surat_keluar'  => $jml_surat_keluar,
                    'jml_surat_masuk'   => $jml_surat_masuk,
                    'page_title'        => "Dashboard",
                );
            }
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
                    'nip'           => $cek_fase_2->nip,
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
