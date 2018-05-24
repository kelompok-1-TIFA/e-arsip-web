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
                                    <td>Tujuan</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                </table>
                                </div>
<<<<<<< HEAD
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="pull-left">View File
                                            </div>
                                            <br>
                                        </div>
                                            <div class="panel-body">
                                                <div>
                                                    <embed src="<?php echo base_url();?>assets/ponororgo.pdf" type="application/pdf" width="100%" height="700px"/>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                            <div>

                        <div>
                                <style> 
                                    #example1 {
                                        box-sizing: content-box;    
                                        width: 980px;
                                        height : 230px;
                                        padding: 30px;    
                                        border: 2px solid black;
                                    }
                                </style>
                                    <body>
                                        <div id="example1"><p style="text-align:center">
                                            <b>VIEW FILE</b></p>
                                        </div>
                                    </body>
                        </div>

                        
                        <div class="card-body">
                            <div class="toolbar">
                                <a title="Download File" href="" class="btn btn-primary btn-round"><i class="material-icons"></i> Download File</a>
=======
>>>>>>> 03b04b15036b72b84fec85c49fd30d1cdfcfa244
                            </div>
                            <div class="row justify-content-center mt-3">
                                <iframe class="col-md-10" src="http://docs.google.com/viewer?url=http://e-arsip.pratamatechnocraft.com/assets/uploads/file/TUGASBUBETTY.docx&embedded=true" style="border: none;min-height: 320px"></iframe>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <div class="col-md-2">
                                    <a title="Download File" href="" class="btn btn-primary btn-round"><i class="material-icons"></i> Download File</a>
                                </div>
                            </div><!--  end card  -->
                        </div>
                    </div>
                </div> <!-- end col-md-12 -->
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
</html>