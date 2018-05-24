<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                    <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <a class="navbar-brand" href="#pablo"><?php if($this->uri->segment(1)!="" and $this->uri->segment(2)=="" and $this->uri->segment(1)=="laporan_surat_masuk" and $this->uri->segment(1)=="laporan_surat_keluar" and $this->uri->segment(1)=="profile"){echo "Data ";} echo $page_title; ?></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <?php if ($this->session->userdata('level_user')=="kepala desa" or $this->session->userdata('level_user')=="kepala bagian" or $this->session->userdata('level_user')=="staf") { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification" id="jml_notifikasi">0</span>
                        <span class="popupnotifikasi"></span>
                        <p><span class="d-lg-none d-md-block">Some Actions<b class="caret"></b></span></p>
                    </a>
                    <div class="row">
                        <div aria-labelledby="navbarDropdownMenuLink" class="dropdown-menu dropdown-menu-right data_notifikasi" style="overflow-wrap: normal;">
                            
                        </div>
                    </div>
                </li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="hidden-lg hidden-md">Profile</p>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
                        <a class="dropdown-item" href="<?php echo base_url('profile') ?>">Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url('awal/logout') ?>">Sign Out</a>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->