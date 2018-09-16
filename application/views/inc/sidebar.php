</head>
    <body class="">
        <div class="wrapper">
            <div class="sidebar" data-color="orange" data-background-color="black" data-image="<?php echo base_url('assets/img/background/login.jpeg') ?>">
            <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

                Tip 2: you can also add an image using data-image tag
            -->

            <div class="logo">
                <a href="#" class="simple-text logo-mini">
                    <img src="<?php echo base_url("assets/img/logo1.png") ?>" width="30px">
                </a>
                <a href="#" class="simple-text logo-normal">
                    E-ARSIP
                </a>
            </div>

            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="<?php echo base_url($this->session->userdata('foto')) ?>" />
                    </div>
                    <div class="user-info">
                        <a class="username">
                            <span>
                                <?php echo ucwords($this->session->userdata('nama')); ?><br>
                                <font class="text-muted"><?php if($this->session->userdata('level_user')=="kepala bagian"){echo ucwords("Kepala ".$this->session->userdata('bagian'));}else{echo ucwords($this->session->userdata('jabatan')." ".$this->session->userdata('bagian'));}  ?></font>
                            </span>
                        </a>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item <?php if($this->uri->segment(1)==""){echo "active";}?>">
                        <a class="nav-link" href="<?php echo base_url() ?>">
                            <i class="material-icons">dashboard</i>
                            <p> Dashboard </p>
                        </a>
                    </li>
                    <?php if ($this->session->userdata('level_user')=="admin") { ?>
                        <li class="nav-item <?php if($this->uri->segment(1)=="jenis_surat" OR $this->uri->segment(1)=="pegawai" OR $this->uri->segment(1)=="bagian"){echo "active";}?>">
                            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
                                <i class="material-icons">storage</i>
                                <p> Data Master
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse <?php if($this->uri->segment(1)=="jenis_surat" OR $this->uri->segment(1)=="pegawai" OR $this->uri->segment(1)=="bagian" OR $this->uri->segment(1)=="jabatan"){echo "show";}?> ml-4" id="pagesExamples">
                                <ul class="nav">
                                    <li class="nav-item <?php if($this->uri->segment(1)=="jenis_surat"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('jenis_surat'); ?>">
                                            <span class="sidebar-mini"><i class="material-icons">mail</i></span>
                                            <span class="sidebar-normal"> Data Jenis Surat </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(1)=="bagian"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('bagian'); ?>">
                                            <span class="sidebar-mini"> <i class="material-icons">account_balance</i> </span>
                                            <span class="sidebar-normal"> Data Bagian </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(1)=="jabatan"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('jabatan'); ?>">
                                            <span class="sidebar-mini"> <i class="material-icons">supervisor_account</i> </span>
                                            <span class="sidebar-normal"> Data Jabatan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(1)=="pegawai"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('pegawai'); ?>">
                                            <span class="sidebar-mini"> <i class="material-icons">face</i> </span>
                                            <span class="sidebar-normal"> Data Pegawai </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php }elseif ($this->session->userdata('level_user')=="kepala bagian") { ?>
                        <li class="nav-item <?php if($this->uri->segment(1)=="surat_keluar"){echo "active";}?>">
                            <a class="nav-link" href="<?php echo base_url('surat_keluar') ?>">
                                <i class="material-icons"><i class="material-icons">unarchive</i></i>
                                <p> Surat Keluar </p>
                            </a>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="disposisi"){echo "active";}?>">
                            <a class="nav-link" href="<?php echo base_url('disposisi') ?>">
                                <i class="material-icons">send</i>
                                <p> Disposisi </p>
                            </a>
                        </li>
                    <?php }elseif ($this->session->userdata('level_user')=="kepala desa") { ?>
                        <li class="nav-item <?php if($this->uri->segment(1)=="surat_masuk"){echo "active";}?>">
                            <a class="nav-link" href="<?php echo base_url('surat_masuk'); ?>">
                                <i class="material-icons">archive</i>
                                <p> Surat Masuk </p>
                            </a>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="surat_keluar"){echo "active";}?>">
                            <a class="nav-link" href="<?php echo base_url('surat_keluar') ?>">
                                <i class="material-icons"><i class="material-icons">unarchive</i></i>
                                <p> Surat Keluar </p>
                            </a>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="disposisi"){echo "active";}?>">
                            <a class="nav-link" href="<?php echo base_url('disposisi') ?>">
                                <i class="material-icons">send</i>
                                <p> Disposisi </p>
                            </a>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="laporan_surat_masuk"){echo "active";}?>">
                            <a class="nav-link" data-toggle="collapse" href="#laporansuratmasuk">
                                <i class="material-icons">assignment</i>
                                <p> Laporan Surat Masuk
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse <?php if($this->uri->segment(1)=="laporan_surat_masuk"){echo "show";}?> ml-4" id="laporansuratmasuk">
                                <ul class="nav">
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_harian" and $this->uri->segment(1)=="laporan_surat_masuk"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_masuk/laporan_harian'); ?>">
                                            <span class="sidebar-mini"> LH </span>
                                            <span class="sidebar-normal"> Laporan Harian </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_bulanan" and $this->uri->segment(1)=="laporan_surat_masuk"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_masuk/laporan_bulanan'); ?>">
                                            <span class="sidebar-mini"> LB </span>
                                            <span class="sidebar-normal"> Laporan Bulanan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_tahunan" and $this->uri->segment(1)=="laporan_surat_masuk"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_masuk/laporan_tahunan'); ?>">
                                            <span class="sidebar-mini"> LT </span>
                                            <span class="sidebar-normal"> Laporan Tahunan </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="laporan_surat_keluar"){echo "active";}?>">
                            <a class="nav-link" data-toggle="collapse" href="#laporansuratkeluar">
                                <i class="material-icons">assignment</i>
                                <p> Laporan Surat Keluar
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse <?php if($this->uri->segment(1)=="laporan_surat_keluar"){echo "show";}?> ml-4" id="laporansuratkeluar">
                                <ul class="nav">
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_harian" and $this->uri->segment(1)=="laporan_surat_keluar"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_keluar/laporan_harian'); ?>">
                                            <span class="sidebar-mini"> LH </span>
                                            <span class="sidebar-normal"> Laporan Harian </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_bulanan" and $this->uri->segment(1)=="laporan_surat_keluar"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_keluar/laporan_bulanan'); ?>">
                                            <span class="sidebar-mini"> LB </span>
                                            <span class="sidebar-normal"> Laporan Bulanan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_tahunan" and $this->uri->segment(1)=="laporan_surat_keluar"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_keluar/laporan_tahunan'); ?>">
                                            <span class="sidebar-mini"> LT </span>
                                            <span class="sidebar-normal"> Laporan Tahunan </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php }elseif ($this->session->userdata('level_user')=="staf") { ?>
                        <li class="nav-item <?php if($this->uri->segment(1)=="disposisi"){echo "active";}?>">
                            <a class="nav-link" href="<?php echo base_url('disposisi') ?>">
                                <i class="material-icons">send</i>
                                <p> Disposisi </p>
                            </a>
                        </li>
                    <?php }elseif ($this->session->userdata('level_user')=="sekertaris") { ?>
                        <li class="nav-item <?php if($this->uri->segment(1)=="surat_masuk"){echo "active";}?>">
                            <a class="nav-link" href="<?php echo base_url('surat_masuk'); ?>">
                                <i class="material-icons">archive</i>
                                <p> Surat Masuk </p>
                            </a>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="laporan_surat_masuk"){echo "active";}?>">
                            <a class="nav-link" data-toggle="collapse" href="#laporansuratmasuk">
                                <i class="material-icons">assignment</i>
                                <p> Laporan Surat Masuk
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse <?php if($this->uri->segment(1)=="laporan_surat_masuk"){echo "show";}?> ml-4" id="laporansuratmasuk">
                                <ul class="nav">
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_harian" and $this->uri->segment(1)=="laporan_surat_masuk"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_masuk/laporan_harian'); ?>">
                                            <span class="sidebar-mini"> LH </span>
                                            <span class="sidebar-normal"> Laporan Harian </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_bulanan" and $this->uri->segment(1)=="laporan_surat_masuk"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_masuk/laporan_bulanan'); ?>">
                                            <span class="sidebar-mini"> LB </span>
                                            <span class="sidebar-normal"> Laporan Bulanan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_tahunan" and $this->uri->segment(1)=="laporan_surat_masuk"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_masuk/laporan_tahunan'); ?>">
                                            <span class="sidebar-mini"> LT </span>
                                            <span class="sidebar-normal"> Laporan Tahunan </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="laporan_surat_keluar"){echo "active";}?>">
                            <a class="nav-link" data-toggle="collapse" href="#laporansuratkeluar">
                                <i class="material-icons">assignment</i>
                                <p> Laporan Surat Keluar
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse <?php if($this->uri->segment(1)=="laporan_surat_keluar"){echo "show";}?> ml-4" id="laporansuratkeluar">
                                <ul class="nav">
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_harian" and $this->uri->segment(1)=="laporan_surat_keluar"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_keluar/laporan_harian'); ?>">
                                            <span class="sidebar-mini"> LH </span>
                                            <span class="sidebar-normal"> Laporan Harian </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_bulanan" and $this->uri->segment(1)=="laporan_surat_keluar"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_keluar/laporan_bulanan'); ?>">
                                            <span class="sidebar-mini"> LB </span>
                                            <span class="sidebar-normal"> Laporan Bulanan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->segment(2)=="laporan_tahunan" and $this->uri->segment(1)=="laporan_surat_keluar"){echo "active";}?>">
                                        <a class="nav-link" href="<?php echo base_url('laporan_surat_keluar/laporan_tahunan'); ?>">
                                            <span class="sidebar-mini"> LT </span>
                                            <span class="sidebar-normal"> Laporan Tahunan </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <li class="nav-item <?php if($this->uri->segment(1)=="profile"){echo "active";}?>">
                        <a class="nav-link " data-toggle="collapse" href="#setting">
                            <i class="material-icons">settings</i>
                            <p> Setting
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse ml-4 <?php if($this->uri->segment(1)=="profile"){echo "show";}?>" id="setting">
                            <ul class="nav">
                                <li class="nav-item <?php if($this->uri->segment(1)=="profile"){echo "active";}?>">
                                    <a class="nav-link" href="<?php echo base_url('profile') ?>">
                                        <span class="sidebar-mini"> <i class="material-icons">account_circle</i> </span>
                                        <span class="sidebar-normal"> Profile </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('awal/logout') ?>">
                                        <span class="sidebar-mini"> <i class="material-icons">power_settings_new</i> </span>
                                        <span class="sidebar-normal"> Sign Out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="main-panel">