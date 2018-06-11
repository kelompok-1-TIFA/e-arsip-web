<?php $this->load->view('inc/head'); ?>
<?php $this->load->view('inc/sidebar'); ?>
<?php $this->load->view('inc/navbar'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">add</i>
                          </div>
                          <h4 class="card-title"><?php echo $page_title; ?></h4>
                        </div>
                        <form method="POST" action="<?php echo base_url($this->uri->segment(1).'/simpan') ?>" class="form-horizontal" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">No Surat</label>
                                    <div class="col-md-10">
                                      <div class="form-group">
                                          <input type="text" name="no_surat" placeholder="Masukan No surat..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Tujuan</label>
                                    <div class="col-md-10">
                                      <div class="form-group">
                                          <input type="text" name="tujuan" placeholder="Masukkan tujuan..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Isi Singkat</label>
                                    <div class="col-md-10">
                                      <div class="form-group">
                                          <textarea name="isi_singkat" placeholder="Masukkan isi singkat..." class="form-control" required></textarea>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Jenis Surat</label>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <select class="selectpicker" name="id_jenis_surat" data-style="btn select-with-transition" title="Pilih Jenis Surat" data-size="7">
                                                <?php foreach ($data_jenis_surat as $jenis_surat): ?>
                                                    <option value="<?php echo $jenis_surat->id_jenis_surat ?>"> <?php echo $jenis_surat->jenis_surat; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Perihal</label>
                                    <div class="col-md-10">
                                      <div class="form-group">
                                          <textarea name="perihal" placeholder="Masukkan perihal..." class="form-control" required></textarea>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Tanggal Surat</label>
                                    <div class="col-md-10">
                                      <div class="form-group">
                                          <input type="date" name="tgl_surat" placeholder="Masukkan Tanggal Surat..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Keterangan </label>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                             <textarea name="keterangan" placeholder="Masukkan keterangan..." class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">File / Scan Surat</label>
                                    <div class="col-md-10">
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <img src="<?php echo base_url() ?>assets/img/image_placeholder.jpg" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-rose btn-round btn-file">
                                                    <span class="fileinput-new">Pilih File</span>
                                                    <span class="fileinput-exists">Ganti File</span>
                                                    <input type="file" name="file_surat" required accept="image/*,.pdf,.doc,.docx" />
                                                </span>
                                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                            </div>
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
                        </form>
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
</html>