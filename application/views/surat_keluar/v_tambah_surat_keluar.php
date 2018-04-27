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
                        <form method="POST" action="<?php echo base_url($this->uri->segment(1).'/simpan') ?>" class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">No Surat</label>
                                    <div class="col-md-10">
                                      <div class="form-group has-default">
                                          <input type="text" name="no_surat" placeholder="Masukan No surat..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Bagian</label>
                                    <div class="col-md-10">
                                      <div class="form-group has-default">
                                          <select class="selectpicker" name="id_bagian" data-style="btn select-with-transition" multiple title="Pilih Bagian" data-size="7">
                                    <option disabled> Multiple Options</option>
                                    <option value="2">Paris </option>
                                    <option value="3">Bucharest</option>
                                    <option value="4">Rome</option>
                                    <option value="5">New York</option>
                                    <option value="6">Miami </option>
                                    <option value="7">Piatra Neamt</option>
                                    <option value="8">Paris </option>
                                    <option value="9">Bucharest</option>
                                    <option value="10">Rome</option>
                                    <option value="11">New York</option>
                                    <option value="12">Miami </option>
                                    <option value="13">Piatra Neamt</option>
                                    <option value="14">Paris </option>
                                    <option value="15">Bucharest</option>
                                    <option value="16">Rome</option>
                                    <option value="17">New York</option>
                                    <option value="18">Miami </option>
                                    <option value="19">Piatra Neamt</option>
                                </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Tujuan</label>
                                    <div class="col-md-10">
                                      <div class="form-group has-default">
                                          <input type="text" name="tujuan" placeholder="Masukkan tujuan..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Isi Singkat</label>
                                    <div class="col-md-10">
                                      <div class="form-group has-default">
                                          <input type="text" name="isi_singkat" placeholder="Masukkan Isi Singkat..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Jenis Surat</label>
                                    <div class="col-md-10">
                                      <div class="form-group has-default">
                                         <select class="selectpicker" name="id_jenis_surat" data-style="btn select-with-transition" multiple title="Pilih Jenis Surat" data-size="7">
                                    <option disabled> Multiple Options</option>
                                    <option value="2">Paris </option>
                                    <option value="3">Bucharest</option>
                                    <option value="4">Rome</option>
                                    <option value="5">New York</option>
                                    <option value="6">Miami </option>
                                    <option value="7">Piatra Neamt</option>
                                    <option value="8">Paris </option>
                                    <option value="9">Bucharest</option>
                                    <option value="10">Rome</option>
                                    <option value="11">New York</option>
                                    <option value="12">Miami </option>
                                    <option value="13">Piatra Neamt</option>
                                    <option value="14">Paris </option>
                                    <option value="15">Bucharest</option>
                                    <option value="16">Rome</option>
                                    <option value="17">New York</option>
                                    <option value="18">Miami </option>
                                    <option value="19">Piatra Neamt</option>
                                </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Perihal</label>
                                    <div class="col-md-10">
                                      <div class="form-group has-default">
                                          <input type="text" name="perihal" placeholder="Masukkan Perihal..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Tanggal Surat</label>
                                    <div class="col-md-10">
                                      <div class="form-group has-default">
                                          <input type="date" name="tgl_surat" placeholder="Masukkan Tanggal Surat..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Tanggal Arsip</label>
                                    <div class="col-md-10">
                                      <div class="form-group has-default">
                                          <input type="date" name="tgl_arsip" placeholder="Masukkan Tanggal Arsip..." class="form-control" required>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label font-weight-bold">Keterangan </label>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                             <input type="text" name="keterangan" placeholder="Masukkan Keterangan..." class="form-control" required>
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