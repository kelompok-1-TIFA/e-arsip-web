<<<<<<< HEAD
=======
<?php $this->load->view('inc/head'); ?>
<?php $this->load->view('inc/sidebar'); ?>
<?php $this->load->view('inc/navbar'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">send</i>
                          </div>
                          <h4 class="card-title"><?php echo $page_title; ?></h4>
                        </div>
                        <form method="POST" action="<?php echo base_url($this->uri->segment(1).'/simpan') ?>" class="form-horizontal" enctype="multipart/form-data">
                              <div class="card-body">
                            </div>
                            <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">No Surat</label>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                          <input type="text" name="no_surat" placeholder="" class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group mt-0">
                                    <select class="selectpicker" data-style="btn select-with-transition" title="Pilih Bagian" data-size="7" name="id_bagian">
                                        <?php foreach ($data_bagian as $bagian): ?>
                                            <option value="<?php echo $bagian->id_bagian ?>"> <?php echo $bagian->bagian; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>
                            <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Isi Disposisi</label>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                          <textarea name="isi_singkat" placeholder="" class="form-control" required></textarea>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Sifat</label>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                          <textarea name="isi_singkat" placeholder="" class="form-control" required></textarea>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Catatan</label>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                          <textarea name="isi_singkat" placeholder="" class="form-control" required></textarea>
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
>>>>>>> 5753904c2ab453450e047b320384b7b6fc403f9e
