<?php $this->load->view('inc/head'); ?>
<?php $this->load->view('inc/sidebar'); ?>
<?php $this->load->view('inc/navbar'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title"><?php echo $page_title; ?></h4>
                        </div>
                        <div class="col-md-3">
                            <div class="card-body">
                                <label class="bmd-label-floating"><u>Nomor Surat : </u></label>
                            </div>
                            <div class="card-body">
                                <label class="bmd-label-floating"><u>Tanggal Surat : </u></label>
                            </div>
                            <div class="card-body">
                                <label class="bmd-label-floating"><u>Tanggal Arsip : </u></label>
                            </div>
                            <div class="card-body">
                                <label class="bmd-label-floating"><u>Asal Surat/Tujuan : </u></label>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="toolbar">
                                <a title="Download File" href="" class="btn btn-primary btn-round"><i class="material-icons"></i> Download File</a>
                            </div>
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
</html>