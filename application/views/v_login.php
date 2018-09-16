<?php $this->load->view('inc/head'); ?>
</head>

<body class="off-canvas-sidebar login-page"> 
    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('<?php echo base_url() ?>assets/img/background/login.jpeg'); background-size: cover; background-position: top center;">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="container">
                <div class="col-md-4 col-sm-6 ml-auto mr-auto" style="margin-top: -5%;margin-bottom: -5%">
                    <form class="form" method="POST" action="<?php echo base_url('awal/aksilogin') ?>">
                        <div class="card card-login card-hidden">
                            <div class="card-header card-header-warning text-center">
                                <h4 class="card-title font-weight-bold">E-Arsip</h4>
                                <h5 class="caption">Nama Perusahaan</h5>
                            </div>
                            <p class="card-description text-center">
                                Sign in please
                            </p>
                            <div class="card-body ">
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">face</i>
                                            </span>
                                        </div>
                                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username...">
                                    </div>
                                </span>
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password...">
                                    </div>
                                </span>
                            </div>
                            <div class="card-footer justify-content-center mt-2">
                                <button type="submit" class="btn btn-warning">Sign In</button>
                            </div>
                            <hr>
                            <div class="card-footer justify-content-center">
                                <p class="font-weight-bold">
                                    Copyright &copy; 2018<a class="text-warning" href="#"> Nama Perusahaan</a> 
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php $this->load->view('inc/js'); ?>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url() ?>assets/js/demo.js"></script>
<script type="text/javascript">
    $().ready(function() {

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>
<span id="pesan-error-flash"><?php echo $this->session->flashdata('alert'); ?></span>   
</html>