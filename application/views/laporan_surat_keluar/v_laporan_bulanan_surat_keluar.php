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
                                <i class="material-icons">mail</i>
                            </div>
                            <h4 class="card-title">Data <?php echo $page_title; ?></h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url() ?>laporan_surat_keluar/laporan_bulanan" method="POST">
                                <div class="row mt-4 mb-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Bulan</label>
                                            <select class="selectpicker" name="bulan" data-style="btn select-with-transition" title="Pilih Bulan" data-size="7">
                                                <?php for ($i=1; $i <= 12; $i++) { ?>
                                                    <option <?php if($bulan==$i){echo "SELECTED";} ?> value="<?php echo $i ?>">
                                                    <?php
                                                        if ($i==1) {
                                                            echo "Januari";
                                                        }elseif ($i==2) {
                                                            echo "Februari";
                                                        }elseif ($i==3) {
                                                            echo "Maret";
                                                        }elseif ($i==4) {
                                                            echo "April";
                                                        }elseif ($i==5) {
                                                            echo "Mei";
                                                        }elseif ($i==6) {
                                                            echo "Juni";
                                                        }elseif ($i==7) {
                                                            echo "Juli";
                                                        }elseif ($i==8) {
                                                            echo "Agustus";
                                                        }elseif ($i==9) {
                                                            echo "September";
                                                        }elseif ($i==10) {
                                                            echo "Oktober";
                                                        }elseif ($i==11) {
                                                            echo "November";
                                                        }elseif ($i==12) {
                                                            echo "Desember";
                                                        } 
                                                    ?> 
                                                    </option>
                                                <?php } ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Tahun</label>
                                            <select class="selectpicker" name="tahun" data-style="btn select-with-transition" title="Pilih Tahun" data-size="7">
                                                <?php for ($i=2012; $i <= date("Y"); $i++) { ?>
                                                    <option <?php if($tahun==$i){echo "SELECTED";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" name="proses" class="btn btn-primary btn-sm"><i class="material-icons">find_replace</i> Proses</button>
                                            <?php if ($this->session->userdata('level_user')!="kepala desa") { ?>
                                            <a href="<?php echo base_url() ?>laporan_surat_keluar/laporan_bulanan_print?bulan=<?php echo $bulan ?>&tahun=<?php echo $tahun ?>" target="_blank" class="btn btn-info btn-sm"><i class="material-icons">print</i> Print</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive material-datatables">
                                <table class="table table-striped" id="datatables" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No Surat</th>
                                            <th>Asal Surat</th>
                                            <th>Perihal</th>
                                            <th>Tanggal Arsip</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=0; foreach ($data_surat_keluar as $surat_keluar): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $surat_keluar->no_surat ?></td>   
                                            <td><?php echo $surat_keluar->tujuan ?></td>
                                            <td><?php echo $surat_keluar->perihal ?></td>
                                            <td><?php echo date("d F Y", strtotime($surat_keluar->tgl_arsip)) ?></td>
                                            <td><?php echo $surat_keluar->keterangan; ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end content-->
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="<?php echo base_url() ?>assets/js/plugins/jquery.datatables.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    var table = $('#datatables').DataTable({
        bFilter: false, 
        bInfo: false, 
        ordering :false,
        bLengthChange: false,
    });
});
</script>
</html>