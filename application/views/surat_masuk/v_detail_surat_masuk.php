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
                        <div class="card-body">
                            <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="hidden" value="" name="id" class="form-control" required>
                                            <input type="text" name="no_surat" placeholder="Nomor Surat : " value="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="" name="id" class="form-control" required>
                                            <input type="text" name="tgl_surat" placeholder="Tanggal Surat : " value="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="" name="id" class="form-control" required>
                                            <input type="text" name="tgl_arsip" placeholder="Tanggal Arsip : " value="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="" name="id" class="form-control" required>
                                            <input type="text" name="asal_surat" placeholder="Asal Surat/Tujuan : " value="" class="form-control" required>
                                        </div>
                                    </div>
                        </div>
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
</html>