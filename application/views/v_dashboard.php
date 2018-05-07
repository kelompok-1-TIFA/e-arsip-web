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
                            <div class="ct-chart" id="completedTasksChart"></div>
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
                                    <tr>
                                        <td>1</td>
                                        <td>Dakota Rice</td>
                                        <td>$36,738</td>
                                        <td>Niger</td>
                                        <td><a href="" class="btn btn-link btn-info text-center" title="Lihat"><i class="material-icons">remove_red_eye</i></a></td>
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
                                    <th>Tujuan</th>
                                    <th>Perihal</th>
                                    <th class="disabled-sorting text-center">Actions</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dakota Rice</td>
                                        <td>$36,738</td>
                                        <td>Niger</td>
                                        <td><a href="" class="btn btn-link btn-info text-center"><i class="material-icons">remove_red_eye</i></a></td>
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
  // Javascript method's body can be found in assets/js/demos.js
  demo.initDashboardPageCharts();
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