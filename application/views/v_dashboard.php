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
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-6 col-sm-6">
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
                                    <i class="material-icons">data_usage</i> Jumlah Data Keseluruhan 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header card-header-success">
                                <div class="ct-chart" id="disposisiCart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Grafik Disposisi Setiap Bulan</h4>
                                <p class="card-category">Tahun <?php echo date("Y"); ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 
                                        <?php
                                         if($jml_grafik_disposisi1==0){
                                            echo 0;
                                        }else{  
                                            foreach ($data_grafik_disposisi as $grafik_disposisi){ 
                                                if (date("m")==$grafik_disposisi->bulan) {
                                                    echo $grafik_disposisi->jumlah;
                                                }
                                            }
                                        }
                                        ?> Disposisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-success">
                                <div class="card-text">
                                    <h4 class="card-title">Disposisi Bulan Ini</h4>
                                    <p class="card-category">List Surat Disposisi Baru</p>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-success">
                                        <th>No.</th>
                                        <th>No. Surat</th>
                                        <th>Isi Disposisi</th>
                                        <th>Sifat</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <?php if($jml_grafik_disposisi1==0){ ?>
                                        <tr class="text-center">
                                            <td colspan="5">No data available in table</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php $no=0; foreach ($data_disposisi as $disposisi): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $disposisi->no_surat ?></td>
                                            <td><?php echo $disposisi->isi_disposisi ?></td>
                                            <td><?php echo $disposisi->sifat ?></td>
                                            <td><a href="<?php echo base_url('disposisi/lembar_disposisi/'.$disposisi->id_disposisi) ?>" class="btn btn-link btn-info text-center" title="Jumlah Data "><i class="material-icons">remove_red_eye</i></a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif ($this->session->userdata('level_user')=="sekertaris") { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
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
                    <div class="col-lg-6 col-md-12 col-sm-12">
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
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 
                                        <?php
                                        if($jml_grafik_surat_masuk1==0){
                                            echo 0;
                                        }else{ 
                                            foreach ($data_grafik_surat_masuk as $grafik_surat_masuk){ 
                                                if (date("m")==$grafik_surat_masuk->bulan) {
                                                    echo $grafik_surat_masuk->jumlah;
                                                }
                                            }
                                        }
                                        ?> Surat Masuk
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-warning">
                                <div class="card-text">
                                    <h4 class="card-title">Surat Masuk Bulan Ini</h4>
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
                                    <?php if($jml_grafik_surat_masuk1==0){ ?>
                                        <tr class="text-center">
                                            <td colspan="5">No data available in table</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php $no=0; foreach ($data_surat_masuk as $surat_masuk): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $surat_masuk->no_surat ?></td>
                                            <td><?php echo $surat_masuk->asal_surat ?></td>
                                            <td><?php echo $surat_masuk->perihal ?></td>
                                            <td><a href="<?php echo base_url('surat_masuk/detail/'.$surat_masuk->id_surat_masuk) ?>" class="btn btn-link btn-info text-center" title="Jumlah Data "><i class="material-icons">remove_red_eye</i></a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($this->session->userdata('level_user')=="kepala bagian"){ ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
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
                                   <i class="material-icons">data_usage</i> Jumlah Data Keseluruhan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
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
                                    <i class="material-icons">data_usage</i> Jumlah Data Keseluruhan 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
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
                            <div class="card-header card-header-rose">
                                <div class="ct-chart" id="suratKeluarCart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Grafik Surat Keluar Setiap Bulan</h4>
                                <p class="card-category">Tahun <?php echo date("Y"); ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 
                                        <?php 
                                        if($jml_grafik_surat_keluar1==0){
                                            echo 0;
                                        }else{ 
                                            foreach ($data_grafik_surat_keluar as $grafik_surat_keluar){
                                                if (date("m")==$grafik_surat_keluar->bulan) {
                                                    echo $grafik_surat_keluar->jumlah;
                                                }
                                            }
                                        }
                                        ?> Surat Keluar
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-rose">
                                <div class="card-text">
                                    <h4 class="card-title">Surat Keluar Bulan Ini</h4>
                                    <p class="card-category">List Surat Keluar Baru</p>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-rose">
                                        <th>No.</th>
                                        <th>No. Surat</th>
                                        <th>Tujuan</th>
                                        <th>Perihal</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <?php if($jml_grafik_surat_keluar1==0){ ?>
                                        <tr class="text-center">
                                            <td colspan="5">No data available in table</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php $no=0; foreach ($data_surat_keluar as $surat_keluar): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $surat_keluar->no_surat ?></td>
                                            <td><?php echo $surat_keluar->tujuan ?></td>
                                            <td><?php echo $surat_keluar->perihal ?></td>
                                            <td><a href="<?php echo base_url('surat_keluar/detail/'.$surat_keluar->id_surat_keluar) ?>" class="btn btn-link btn-info text-center" title="Jumlah Data "><i class="material-icons">remove_red_eye</i></a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header card-header-success">
                                <div class="ct-chart" id="disposisiCart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Grafik Disposisi Setiap Bulan</h4>
                                <p class="card-category">Tahun <?php echo date("Y"); ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 
                                        <?php
                                         if($jml_grafik_disposisi1==0){
                                            echo 0;
                                        }else{  
                                            foreach ($data_grafik_disposisi as $grafik_disposisi){ 
                                                if (date("m")==$grafik_disposisi->bulan) {
                                                    echo $grafik_disposisi->jumlah;
                                                }
                                            }
                                        }
                                        ?> Disposisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-success">
                                <div class="card-text">
                                    <h4 class="card-title">Disposisi Bulan Ini</h4>
                                    <p class="card-category">List Surat Disposisi Baru</p>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-success">
                                        <th>No.</th>
                                        <th>No. Surat</th>
                                        <th>Isi Disposisi</th>
                                        <th>Sifat</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <?php if($jml_grafik_disposisi1==0){ ?>
                                        <tr class="text-center">
                                            <td colspan="5">No data available in table</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php $no=0; foreach ($data_disposisi as $disposisi): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $disposisi->no_surat ?></td>
                                            <td><?php echo $disposisi->isi_disposisi ?></td>
                                            <td><?php echo $disposisi->sifat ?></td>
                                            <td><a href="<?php echo base_url('disposisi/lembar_disposisi/'.$disposisi->id_disposisi) ?>" class="btn btn-link btn-info text-center" title="Jumlah Data "><i class="material-icons">remove_red_eye</i></a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 
                                        <?php
                                         if($jml_grafik_surat_masuk1==0){
                                            echo 0;
                                        }else{  
                                            foreach ($data_grafik_surat_masuk as $grafik_surat_masuk){ 
                                                if (date("m")==$grafik_surat_masuk->bulan) {
                                                    echo $grafik_surat_masuk->jumlah;
                                                }
                                            }
                                        }
                                        ?> Surat Masuk
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-warning">
                        <div class="card-text">
                            <h4 class="card-title">Surat Masuk Bulan Ini</h4>
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
                                    <?php if($jml_grafik_surat_masuk1==0){ ?>
                                        <tr class="text-center">
                                            <td colspan="5">No data available in table</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php $no=0; foreach ($data_surat_masuk as $surat_masuk): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $surat_masuk->no_surat ?></td>
                                            <td><?php echo $surat_masuk->asal_surat ?></td>
                                            <td><?php echo $surat_masuk->perihal ?></td>
                                            <td><a href="<?php echo base_url('surat_masuk/detail/'.$surat_masuk->id_surat_masuk) ?>" class="btn btn-link btn-info text-center" title="Jumlah Data "><i class="material-icons">remove_red_eye</i></a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
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
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 
                                        <?php 
                                        if($jml_grafik_surat_keluar1==0){
                                            echo 0;
                                        }else{ 
                                            foreach ($data_grafik_surat_keluar as $grafik_surat_keluar){
                                                if (date("m")==$grafik_surat_keluar->bulan) {
                                                    echo $grafik_surat_keluar->jumlah;
                                                }
                                            }
                                        }
                                        ?> Surat Keluar
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-rose">
                        <div class="card-text">
                            <h4 class="card-title">Surat Keluar Bulan Ini</h4>
                            <p class="card-category">List Surat Keluar Baru</p>
                        </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-rose">
                                        <th>No.</th>
                                        <th>No. Surat</th>
                                        <th>Tujuan</th>
                                        <th>Perihal</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <?php if($jml_grafik_surat_keluar1==0){ ?>
                                        <tr class="text-center">
                                            <td colspan="5">No data available in table</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php $no=0; foreach ($data_surat_keluar as $surat_keluar): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $surat_keluar->no_surat ?></td>
                                            <td><?php echo $surat_keluar->tujuan ?></td>
                                            <td><?php echo $surat_keluar->perihal ?></td>
                                            <td><a href="<?php echo base_url('surat_keluar/detail/'.$surat_keluar->id_surat_keluar) ?>" class="btn btn-link btn-info text-center" title="Jumlah Data "><i class="material-icons">remove_red_eye</i></a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header card-header-success">
                                <div class="ct-chart" id="disposisiCart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Grafik Disposisi Setiap Bulan</h4>
                                <p class="card-category">Tahun <?php echo date("Y"); ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> Bulan <?php echo date("F"); ?> 
                                        <?php
                                         if($jml_grafik_disposisi1==0){
                                            echo 0;
                                        }else{  
                                            foreach ($data_grafik_disposisi as $grafik_disposisi){ 
                                                if (date("m")==$grafik_disposisi->bulan) {
                                                    echo $grafik_disposisi->jumlah;
                                                }
                                            }
                                        }
                                        ?> Disposisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-success">
                                <div class="card-text">
                                    <h4 class="card-title">Disposisi Bulan Ini</h4>
                                    <p class="card-category">List Surat Disposisi Baru</p>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-success">
                                        <th>No.</th>
                                        <th>No. Surat</th>
                                        <th>Isi Disposisi</th>
                                        <th>Sifat</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <?php if($jml_grafik_disposisi1==0){ ?>
                                        <tr class="text-center">
                                            <td colspan="5">No data available in table</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php $no=0; foreach ($data_disposisi as $disposisi): ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $disposisi->no_surat ?></td>
                                            <td><?php echo $disposisi->isi_disposisi ?></td>
                                            <td><?php echo $disposisi->sifat ?></td>
                                            <td><a href="<?php echo base_url('disposisi/lembar_disposisi/'.$disposisi->id_disposisi) ?>" class="btn btn-link btn-info text-center" title="Jumlah Data "><i class="material-icons">remove_red_eye</i></a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
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
<?php if ($this->session->userdata('level_user')!="admin") { ?>
<script type="text/javascript">

$(document).ready(function(){
  // Javascript method's body can be found in assets/js/demos.js
    if ($('#suratMasukCart').length != 0 || $('#suratKeluarCart').length != 0 || $('#disposisiCart').length != 0) {
        datasuratMasukCart = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
            series: [
                [
                <?php
                    $data = array();
                    for ($i=0; $i < 12; $i++) { 
                        $data[$i]=0;
                    }
                    foreach ($data_grafik_surat_masuk as $grafik_surat_masuk) {
                        $data[$grafik_surat_masuk->bulan-1]=$grafik_surat_masuk->jumlah;
                    }
                    for ($i=0; $i < 12; $i++) { 
                        echo $data[$i].",";
                    }
                ?>
                ]
            ]
        };
        optionssuratMasukCart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: <?php 
                    if($jml_grafik_surat_masuk->jumlah==0){
                        echo 10;
                    }else{
                        echo $jml_grafik_surat_masuk->jumlah*2; 
                    }
                  ?>,
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
        }
        var suratMasukCart = new Chartist.Line('#suratMasukCart', datasuratMasukCart, optionssuratMasukCart);
        md.startAnimationForLineChart(suratMasukCart);

        datasuratKeluarCart = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
            series: [
                [
                <?php
                    $data = array();
                    for ($i=0; $i < 12; $i++) { 
                        $data[$i]=0;
                    }
                    foreach ($data_grafik_surat_keluar as $grafik_surat_keluar) {
                        $data[$grafik_surat_keluar->bulan-1]=$grafik_surat_keluar->jumlah;
                    }
                    for ($i=0; $i < 12; $i++) { 
                        echo $data[$i].",";
                    }
                ?>
                ]
            ]
        };
        optionssuratKeluarCart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: <?php if($jml_grafik_surat_keluar->jumlah==0){
                        echo 10;
                    }else{
                        echo $jml_grafik_surat_keluar->jumlah*2; 
                    } 
                  ?>, 
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        }
        var suratKeluarCart = new Chartist.Line('#suratKeluarCart', datasuratKeluarCart, optionssuratKeluarCart);
        md.startAnimationForLineChart(suratKeluarCart);

        datadisposisiCart = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
            series: [
                [
                <?php
                    $data = array();
                    for ($i=0; $i < 12; $i++) { 
                        $data[$i]=0;
                    }
                    foreach ($data_grafik_disposisi as $grafik_disposisi) {
                        $data[$grafik_disposisi->bulan-1]=$grafik_disposisi->jumlah;
                    }
                    for ($i=0; $i < 12; $i++) { 
                        echo $data[$i].",";
                    }
                ?>
                ]
            ]
        };
        optionsdisposisiCart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: <?php 
                    if($jml_grafik_disposisi->jumlah==0){
                        echo 10;
                    }else{
                        echo $jml_grafik_disposisi->jumlah*2; 
                    }
                  ?>,
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
        }
        var disposisiCart = new Chartist.Line('#disposisiCart', datadisposisiCart, optionsdisposisiCart);
        md.startAnimationForLineChart(disposisiCart);
    }
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
<?php } ?>
</html>