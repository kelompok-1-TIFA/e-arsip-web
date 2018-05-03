<?php $this->load->view('inc/head'); ?>
<?php $this->load->view('inc/sidebar'); ?>
<?php $this->load->view('inc/navbar'); ?>
    <!-- Content -->
    <div class="content">
        <!-- Container -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">archive</i>
                            </div>
                            <p class="card-category">Surat Masuk</p>
                            <h3 class="card-title">0</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                               <i class="material-icons">remove_red_eye</i> Lihat
                               
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
                            <h3 class="card-title">0</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                               <i class="material-icons">remove_red_eye</i> Lihat
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
                            <h3 class="card-title">0</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">remove_red_eye</i> Lihat
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
                            <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                            <div class="card-actions">
                                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                </button>
                                <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                    <i class="material-icons">refresh</i>
                                </button>
                                <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                    <i class="material-icons">edit</i>
                                </button>
                            </div>
                            <h4 class="card-title">Grafik Surat Masuk</h4>
                            <p class="card-category">
                            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated 4 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-chart">
                        <div class="card-header card-header-rose">
                            <div class="ct-chart" id="completedTasksChart"></div>
                        </div>
                        <div class="card-body">
                            <div class="card-actions">
                                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                </button>
                                <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                    <i class="material-icons">refresh</i>
                                </button>
                                <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                    <i class="material-icons">edit</i>
                                </button>
                            </div>
                            <h4 class="card-title">Grafik Surat Keluar</h4>
                            <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> campaign sent 2 days ago
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
                                    <th>Perihal</th>
                                    <th>Sifat</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dakota Rice</td>
                                        <td>$36,738</td>
                                        <td>Niger</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Minerva Hooper</td>
                                        <td>$23,789</td>
                                        <td>Curaçao</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Sage Rodriguez</td>
                                        <td>$56,142</td>
                                        <td>Netherlands</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Philip Chaney</td>
                                        <td>$38,735</td>
                                        <td>Korea, South</td>
                                    </tr>
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
                                    <th>Perihal</th>
                                    <th>Sifat</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dakota Rice</td>
                                        <td>$36,738</td>
                                        <td>Niger</td>
                                        <td><a href="" class="btn"></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container -->
    </div>
    <!-- Content -->
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
<script type="text/javascript">

$(document).ready(function(){

  //init wizard

  demo.initMaterialWizard();

  // Javascript method's body can be found in assets/js/demos.js
  demo.initDashboardPageCharts();

  demo.initCharts();

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