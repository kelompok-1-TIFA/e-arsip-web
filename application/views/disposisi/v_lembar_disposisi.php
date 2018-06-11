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
                                <i class="material-icons">insert_drive_file</i>
                            </div>
                            <h4 class="card-title"><?php echo $page_title; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table>
                                        <tr>
                                            <td width="80">No Surat</td>
                                            <td width="20">:</td>
                                            <td><?php echo $no_surat; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Asal Surat</td>
                                            <td>:</td>
                                            <td><?php echo $asal_surat; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sifat</td>
                                            <td>:</td>
                                            <td><?php echo $sifat; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table>
                                        <tr>
                                            <td width="100">Tanggal Surat</td>
                                            <td width="20">:</td>
                                            <td><?php echo date("d F Y", strtotime($tgl_surat)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Arsip</td>
                                            <td>:</td>
                                            <td><?php echo date("d F Y", strtotime($tgl_arsip)); ?></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-6 border">
                                    <p>Isi Disposisi : </p>
                                    <p><?php echo $isi_disposisi; ?></p>
                                </div>
                                <div class="col-6 border">
                                    <p>Kepada : </p>
                                    <div class="row">
                                        <?php foreach ($data_bagian as $bagian) { ?>
                                            <div class="col-6">
                                                <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" <?php if($id_bagian==$bagian->id_bagian){echo "checked";} ?> disabled>
                                                      <?php echo $bagian->bagian; ?>
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 border">
                                    <p>Catatan :</p>
                                    <p><?php echo $catatan; ?></p>
                                </div>
                                
                            </div>
                            <div class="row my-4 justify-content-end">
                                <div class="col-3 text-center">
                                    <p>
                                        Jember, <?php echo date("d F Y", strtotime($tgl_disposisi)); ?><br>
                                        Kepala Desa
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <p>
                                        <u><?php echo $nama_kepala_desa; ?></u><br>
                                        Nip : <?php echo $nip_kepala_desa; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <a href="<?php echo base_url() ?>/disposisi/lembar_disposisi_print/<?php echo $id_disposisi; ?>" target="_blank" class="btn btn-primary"><i class="material-icons">print</i> Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
</html>                                