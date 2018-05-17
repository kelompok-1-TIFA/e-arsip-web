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
                                <div class="row">
                                    <div class="col-md-6">
                                        <table>
                                    <tr>
                                        <td>Nomor Surat</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Surat</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                        <tr>
                                        <td>Tanggal Arsip</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Asal Surat/Tujuan</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    </table>
                                    </div>
                                </div>
                        </div>

                        <div>
                               
                                    
                                        
                                            <center><b><iframe src="<?php
                                            echo base_url() ?>assets/uploads/Surat%20Keterangan%20Usaha/CCCApply.pdf" width="550" height="600"></iframe></b></center>
                                        
                                    
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