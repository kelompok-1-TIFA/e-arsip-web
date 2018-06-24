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
                            <i class="material-icons">mode_edit</i>
                          </div>
                          <h4 class="card-title"><?php echo $page_title; ?></h4>
                        </div>
                        <form method="POST" action="<?php echo base_url($this->uri->segment(1).'/editaction') ?>" class="form-horizontal" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">assignment_late</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group">
                                                <label class="bmd-label-floating">Isi Disposisi</label>
                                                <input value="<?php echo $isi_disposisi ?>" type="text"  name="isi_disposisi" class="form-control" required>
                                                <input type="hidden" value="<?php echo $id_disposisi ?>" name="id" class="form-control" required=>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">my_location</i></label>
                                            <div class="col-md-10">
                                                <div class="form-group ">
                                                    <label class="bmd-label-floating">Sifat</label>
                                                    <select class="selectpicker" name="sifat" data-style="btn select-with-transition" title="Pilih Sifat" data-size="7">
                                                       <option value="Rahasia"<?php if($sifat=="Rahasia"){ echo "SELECTED"; }?>>Rahasia</option>
                                                       <option value="Penting"<?php if($sifat=="Penting"){ echo "SELECTED"; }?>>Penting</option>
                                                       <option value="Segera"<?php if($sifat=="Segera"){ echo "SELECTED"; } ?>>Segera</option>
                                                       <option value="Biasa"<?php if($sifat=="Biasa"){ echo "SELECTED"; } ?>>Biasa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">vpn_key</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                <label class="bmd-label-floating">Catatan</label>
                                                  <input type="text" value="<?php echo $catatan ?>" name="catatan" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row pull-right my-3">
                                            <div class="col-12 ">
                                                <button type="submit" class="btn btn-primary"><i class="material-icons">save</i> Simpan</button>
                                                <button type="Reset" class="btn btn-danger"><i class="material-icons">cached</i> Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
</html>