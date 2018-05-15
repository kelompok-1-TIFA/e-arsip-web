<?php $this->load->view('inc/head'); ?>
<?php $this->load->view('inc/sidebar'); ?>
<?php $this->load->view('inc/navbar'); ?>
    <!-- Content -->
    <div class="content">
        <!-- Container -->
        <?php if ($this->session->userdata('level_user')=="admin") {?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">mail</i>
                                </div>
                                <p class="card-category">Data Jenis Surat</p>
                                <h3 class="card-title"><?php echo $jml_jenis_surat; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                   <i class="material-icons">data_usage</i> Jumlah Data 
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">account_balance</i>
                                </div>
                                <p class="card-category">Data Bagian</p>
                                <h3 class="card-title"><?php echo $jml_bagian; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                   <i class="material-icons">data_usage</i> Jumlah Data 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">supervisor_account</i>
                                </div>
                                <p class="card-category">Data Jabatan</p>
                                <h3 class="card-title"><?php echo $jml_jabatan; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">data_usage</i> Jumlah Data 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">face</i>
                                </div>
                                <p class="card-category">Data Pegawai</p>
                                <h3 class="card-title"><?php echo $jml_pegawai; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">data_usage</i> Jumlah Data 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif ($this->session->userdata('level_user')=="staf") { ?>
        <?php }else{ ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">archive</i>
                                </div>
                                <p class="card-category">Surat Masuk</p>
                                <h3 class="card-title"><?php echo $jml_surat_masuk; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                   <i class="material-icons">data_usage</i> Jumlah Data 
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">unarchive</i>
                                </div>
                                <p class="card-category">Surat Keluar</p>
                                <h3 class="card-title"><?php echo $jml_surat_keluar; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                   <i class="material-icons">data_usage</i> Jumlah Data 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">send</i>
                                </div>
                                <p class="card-category">Disposisi</p>
                                <h3 class="card-title"><?php echo $jml_disposisi; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">data_usage</i> Jumlah Data 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">alarm</i>
                                </div>
                                <p class="card-category">Jam & Tanggal</p>
                                <h4 class="card-title">
                                    <?php echo date("d F Y"); ?></br>
                                    <p id="detik" class="float-right"></p>
                                    <p id="menit" class="float-right"></p>
                                    <p id="jam" class="float-right"></p>
                                </h4>
                            </div>
                            <div class="card-footer" style="margin-top: -10px">
                                <div class="stats">
                                    <i class="material-icons">update</i> Just Updated
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header card-header-warning">
                                <div class="ct-chart" id="suratMasukCart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Grafik Surat Masuk Setiap Bulan</h4>
                                <p class="card-category">Tahun <?php echo date("Y"); ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 0 Surat Masuk
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header card-header-rose">
                                <div class="ct-chart" id="suratKeluarCart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Grafik Surat Keluar Setiap Bulan</h4>
                                <p class="card-category">Tahun <?php echo date("Y"); ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 0 Surat Keluar
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-warning">
                        <div class="card-text">
                            <h4 class="card-title">Surat Masuk</h4>
                            <p class="card-category">List Surat Masuk Baru</p>
                        </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-warning">
                                        <th>No.</th>
                                        <th>No. Surat</th>
                                        <th>Asal</th>
                                        <th>Perihal</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <?php $no=0; foreach ($data_surat_masuk as $surat_masuk): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $surat_masuk->no_surat ?>;</td>
                                            <td><?php echo $surat_masuk->asal_surat ?>;</td>
                                            <td><?php echo $surat_masuk->perihal ?>;</td>
                                            <td><a href="" class="btn btn-link btn-info text-center" title="Jumlah Data "><i class="material-icons">data_usage</i></a></td>
                                        </tr>
                                         <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-rose">
                        <div class="card-text">
                            <h4 class="card-title">Surat Keluar</h4>
                            <p class="card-category">List Surat Keluar Baru</p>
                        </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-warning">
                                        <th>No.</th>
                                        <th>No. Surat</th>
                                        <th>Tujuan</th>
                                        <th>Perihal</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <?php $no=0; foreach ($data_surat_keluar as $surat_keluar): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $surat_keluar->no_surat ?>;</td>
                                            <td><?php echo $surat_keluar->tujuan ?>;</td>
                                            <td><?php echo $surat_keluar->perihal ?>;</td>
                                            <td><a href="" class="btn btn-link btn-info text-center"><i class="material-icons">data_usage</i></a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- Container -->
    </div>
    <!-- Content -->
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
<script src="<?php echo base_url('assets/js/plugins/dashboard.js') ?>"></script>
<script type="text/javascript">

$(document).ready(function(){
  // Javascript method's body can be found in assets/js/demos.js
  grafik.dashboard();
});
</script>
<script type="text/javascript">
    window.setTimeout("waktu()",1000);
    function waktu() {
        var tanggal = new Date();
        setTimeout("waktu()",1000);
        document.getElementById("jam").innerHTML = tanggal.getHours()+":";
        document.getElementById("menit").innerHTML = tanggal.getMinutes()+":";
        document.getElementById("detik").innerHTML = tanggal.getSeconds();
    }
</script>
</html>