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
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">No Surat</label>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                          <input type="text" name="no_surat" placeholder="" value="<?php echo $no_surat; ?>" class="form-control" required>
                                          <input type="hidden" name="id" placeholder="" value="<?php echo $id_surat_masuk; ?>" class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Bagian</label>
                                    <div class="col-md-8">
                                        <div class="form-group mt-0">
                                            <select class="selectpicker" data-style="btn select-with-transition" title="Pilih Bagian" data-size="7" name="id_bagian" required>
                                                <?php foreach ($data_bagian as $bagian): ?>
                                                    <option value="<?php echo $bagian->id_bagian ?>"> <?php echo $bagian->bagian; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Isi Disposisi</label>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                          <textarea name="isi_disposisi" placeholder="" class="form-control" required></textarea>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Sifat</label>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                         <select class="selectpicker" data-style="btn select-with-transition" title="Pilih Sifat " data-size="7" name="sifat" required>
                                         <option value="Rahasia">Rahasia</option>
                                         <option value="Penting">Penting</option> 
                                         <option value="Segera">Segera</option>
                                         <option value="Biasa">Biasa</option>
                                         </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Catatan</label>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                          <textarea name="catatan" placeholder="" class="form-control" required></textarea>
                                      </div>
                                    </div>
                                </div>
                                <div class="row pull-right my-3">
                                    <div class="col-12 ">
                                        <button type="submit" class="btn btn-primary"><i class="material-icons">save</i> Kirim</button>
                                        <a href="<?php echo base_url(); ?>surat_masuk" class="btn btn-danger"><i class="material-icons">close</i> Batal</a>
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