<!DOCTYPE html>
<?php $this->load->view('inc/head'); ?>
<html>
<body onload=" window.print();" onafterprint="window.close();" style="color: #000">
    <div class="card">
        <div class="card-header card-header-info card-header-icon">
            <h2 class="card-title text-center">Lembar Disposisi</h2>
        </div>
        <div class="card-body mt-3">
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
        </div>
    </div>
</body>
</html>

