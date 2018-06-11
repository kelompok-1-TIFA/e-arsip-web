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
                                            <td class="font-weight-bold" width="100px">Nomor Surat</td>
                                            <td width="10px">:</td>
                                            <td><?php echo $no_surat; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Bagian</td>
                                            <td>:</td>
                                            <td><?php echo $bagian; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Tujuan</td>
                                            <td>:</td>
                                            <td><?php echo $tujuan; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Perihal</td>
                                            <td>:</td>
                                            <td><?php echo $perihal; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Isi Singkat</td>
                                            <td>:</td>
                                            <td><?php echo $isi_singkat; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Jenis Surat</td>
                                            <td>:</td>
                                            <td><?php echo $jenis_surat; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" width="100px">Tanggal Arsip</td>
                                            <td width="10px">:</td>
                                            <td><?php echo date("d F Y", strtotime($tgl_arsip)); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Tanggal Surat</td>
                                            <td>:</td>
                                            <td><?php echo date("d F Y", strtotime($tgl_surat)); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Keterangan</td>
                                            <td>:</td>
                                            <td><?php echo $keterangan; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <?php $typefile=mime_content_type(str_replace("%20", " ", $file));
                                if ($typefile=="image/jpg" or $typefile=="image/png" or $typefile=="image/jpeg" or $typefile=="image/gif" or $typefile=="image/JPG") { ?>
                                    <div class="col-md-10">
                                        <img src="<?php echo base_url($file) ?>" width="100%" >
                                    </div>
                                <?php }else{ ?>
                                    <iframe class="col-md-10" src="http://docs.google.com/viewer?url=<?php echo str_replace("https", "http", base_url($file)) ?>&embedded=true" style="border: none;min-height: 720px"></iframe> 
                                <?php } ?>
                                
                            </div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-md-2">
                                    <a title="Download File" href="<?php echo base_url($file) ?>" class="btn btn-primary btn-round"><i class="material-icons"></i> Download File</a>
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