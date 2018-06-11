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
        $this->load->model('M_notifikasi');
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
                $tahun=date("Y");
                $bulan=date("m");
                $jml_surat_masuk = $this->M_surat_masuk->total_rows();
                if ($this->session->userdata('level_user')!="kepala desa" and $this->session->userdata('level_user')!="sekertaris") {
                    $jml_surat_keluar = $this->M_surat_keluar->total_rows_perbagian($this->session->userdata('id_bagian'));
                    $jml_disposisi = $this->M_disposisi->total_rows_perbagian($this->session->userdata('id_bagian'));   

                    $dt_surat_keluar = $this->M_surat_keluar->get_limit_data_perbagian($this->session->userdata('id_bagian'),3);
                    $dt_grafik_surat_keluar=$this->M_surat_keluar->get_grafik_perbagian($tahun,$this->session->userdata('id_bagian'));
                    $jml_grafik_surat_keluar=$this->M_surat_keluar->get_jumlah_grafik_perbagian($tahun,$this->session->userdata('id_bagian'));
                    $jml_grafik_surat_keluar1=$this->M_surat_keluar->get_jumlah_grafik_perbagian1($tahun,$bulan,$this->session->userdata('id_bagian'));

                    $dt_disposisi = $this->M_disposisi->get_limit_data_perbagian($this->session->userdata('id_bagian'),3);
                    $dt_grafik_disposisi=$this->M_disposisi->get_grafik_perbagian($tahun,$this->session->userdata('id_bagian'));
                    $jml_grafik_disposisi=$this->M_disposisi->get_jumlah_grafik_perbagian($tahun,$this->session->userdata('id_bagian'));
                    $jml_grafik_disposisi1=$this->M_disposisi->get_jumlah_grafik_perbagian1($tahun,$bulan,$this->session->userdata('id_bagian'));
                }else{
                    $jml_surat_keluar = $this->M_surat_keluar->total_rows();
                    $jml_disposisi = $this->M_disposisi->total_rows();

                    $dt_surat_keluar = $this->M_surat_keluar->get_limit_data(3);
                    $dt_grafik_surat_keluar=$this->M_surat_keluar->get_grafik($tahun);
                    $jml_grafik_surat_keluar=$this->M_surat_keluar->get_jumlah_grafik($tahun);   
                    $jml_grafik_surat_keluar1=$this->M_surat_keluar->get_jumlah_grafik1($tahun,$bulan);

                    $dt_disposisi = $this->M_disposisi->get_limit_data(3);
                    $dt_grafik_disposisi=$this->M_disposisi->get_grafik($tahun);
                    $jml_grafik_disposisi=$this->M_disposisi->get_jumlah_grafik($tahun);   
                    $jml_grafik_disposisi1=$this->M_disposisi->get_jumlah_grafik1($tahun,$bulan);     
                }
                $data = array(
                    'data_surat_masuk'          => $this->M_surat_masuk->get_limit_data(3),
                    'data_grafik_surat_masuk'   => $this->M_surat_masuk->get_grafik($tahun),
                    'jml_grafik_surat_masuk'    => $this->M_surat_masuk->get_jumlah_grafik($tahun),
                    'jml_grafik_surat_masuk1'   => $this->M_surat_masuk->get_jumlah_grafik1($tahun,$bulan),

                    'data_surat_keluar'         => $dt_surat_keluar,
                    'data_grafik_surat_keluar'  => $dt_grafik_surat_keluar,
                    'jml_grafik_surat_keluar'   => $jml_grafik_surat_keluar,
                    'jml_grafik_surat_keluar1'  => $jml_grafik_surat_keluar1,

                    'data_disposisi'            => $dt_disposisi,
                    'data_grafik_disposisi'     => $dt_grafik_disposisi,
                    'jml_grafik_disposisi'      => $jml_grafik_disposisi,
                    'jml_grafik_disposisi1'     => $jml_grafik_disposisi1,

                    'jml_disposisi'             => $jml_disposisi,
                    'jml_surat_keluar'          => $jml_surat_keluar,
                    'jml_surat_masuk'           => $jml_surat_masuk,
                    'page_title'                => "Dashboard",
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
                    'jabatan'       => $cek_fase_2->jabatan,
                    'bagian'        => $cek_fase_2->bagian,
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

    public function notification(){
        if (isset($_GET['id_notif'])) {
            $this->M_notifikasi->delete($_GET['id_notif']);
            if ($_GET['jenis']=="surat masuk") {
                redirect(base_url('surat_masuk/detail/'.$_GET['id']));
            }elseif ($_GET['jenis']=="surat keluar") {
                redirect(base_url('surat_keluar/detail/'.$_GET['id']));
            }else{
                redirect(base_url('disposisi/lembar_disposisi/'.$_GET['id']));
            }
        }else{
            if (isset($_POST['popup'])) {
                $data_notifupdate = array(
                    'status_notif' => 'y' 
                );
                $this->M_notifikasi->updatebyuser($this->session->userdata('id_user'),$data_notifupdate);
            }else{
                $id_user_login=$this->session->userdata('id_user');
                $jmlnotif=$this->M_notifikasi->get_where("WHERE id_user='$id_user_login'")->num_rows();
                $jmlpopup=$this->M_notifikasi->get_where("WHERE status_notif='t' AND id_user='$id_user_login'")->num_rows();
                $output="";
                $output1="";
                $url="";
                $type="";
                $url1="";
                $data_notif=$this->M_notifikasi->get_where("WHERE id_user='$id_user_login' ORDER BY id_notif DESC")->result();
                $no=0;
                foreach ($data_notif as $notif) { 
                    ++$no;
                    if ($no%2==0) { $hr="<hr>"; $no=1;}else{ $hr= ""; }
                    $url = base_url('awal/notification/?id_notif='.$notif->id_notif.'&id='.$notif->id.'&jenis='.$notif->jenis_notif);
                    $output.=$hr."<a class='dropdown-item' href='".$url."'>
                    <div class='row'>
                    <b>".$notif->judul_notif." "."</b>".$notif->isi_notif.
                    "</div>
                    </a>";
                } 

                $data_notifpopup=$this->M_notifikasi->get_where("WHERE status_notif='t' AND id_user='$id_user_login'")->result();

                foreach ($data_notifpopup as $notifpopup) {
                    $url1 = "url: '".base_url('awal/notification/?id_notif='.$notifpopup->id_notif.'&id='.$notifpopup->id.'&jenis='.$notifpopup->jenis_notif)."',";
                    if ($notifpopup->jenis_notif=="surat masuk") {
                        $type = "type : 'rose',";
                    }elseif ($notifpopup->jenis_notif=="surat keluar") {
                        $type = "type : 'info',";
                    }else{
                        $type = "type : 'success',";
                    } 

                    $output1.="
                    <script>
                        $.notify({
                            icon: 'report',
                            title: '<strong>".$notifpopup->judul_notif."</strong><br>',
                            message: '".$notifpopup->isi_notif."',
                            ".$url1."
                        },{
                            ".$type."
                            animate: {
                                enter: 'animated fadeInUp',
                                exit: 'animated fadeOutRight'
                            },
                            placement: {
                                from: 'bottom',
                                align: 'right'
                            },
                            z_index: 1031,
                        });
                    </script>";
                }

                $data = array(
                    'notification'          => $output,
                    'notificationpopup'     => $output1,
                    'unseen_notification'   => $jmlnotif,
                    'jmlpopup'              => $jmlpopup, 
                    'no_notif'              => "<p class='dropdown-item'>No Notification</p>"
                );
                $data1 = json_encode($data);
                echo $data1;
            }
        }
    }
}
