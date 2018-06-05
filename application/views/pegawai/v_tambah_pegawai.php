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
                                <i class="material-icons">add</i>
                            </div>
                            <h4 class="card-title"><?php echo $page_title; ?></h4>
                        </div>
                        <form method="POST" action="<?php echo base_url($this->uri->segment(1).'/simpan') ?>" class="form-horizontal" enctype="multipart/form-data">
                            <div class="card-body">
                                <h4 class="text-center">DATA PEGAWAI</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">assignment_ind</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                <label class="bmd-label-floating">NIP</label>
                                                <input type="text"  name="nip" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">account_balance</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group mt-0">
                                                <select class="selectpicker" data-style="btn select-with-transition" title="Pilih Bagian" data-size="7" name="id_bagian">
                                                    <?php foreach ($data_bagian as $bagian): ?>
                                                        <option value="<?php echo $bagian->id_bagian ?>"> <?php echo $bagian->bagian; ?></option>
                                                    <?php endforeach ?>
                                                    <option value="1">Desa</option>
                                                </select>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">class</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group mt-0">
                                                <select class="selectpicker" data-style="btn select-with-transition"  title="Pilih Jabatan" data-size="7" name="id_jabatan">
                                                    <?php foreach ($data_jabatan as $jabatan): ?>
                                                        <option value="<?php echo $jabatan->id_jabatan ?>"> <?php echo $jabatan->jabatan; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">assignment_late</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group">
                                                <label class="bmd-label-floating">NIAP</label>
                                                <input type="text"  name="niap" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">face</i></label>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Nama Pegawai</label>
                                                    <input type="text"  name="nama" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">usb</i></label>
                                            <div class="col-md-10">
                                                <div class="form-group mt-0">
                                                    <select class="selectpicker" data-style="btn select-with-transition"  title="Pilih Jenis Kelamin" data-size="7" name="jenis_kelamin">
                                                        <option value="Laki - Laki"> Laki - Laki </option>
                                                        <option value="Perempuan"> Perempuan </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">my_location</i></label>
                                            <div class="col-md-10">
                                                <div class="form-group ">
                                                    <label class="bmd-label-floating">Tempat Lahir</label>
                                                    <input type="text"  name="tempat_lahir" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">date_range</i></label>
                                            <div class="col-md-10">
                                                <div class="form-group mt-2">
                                                    <label for="exampleEmail" class="bmd-label-floating">Tanggal Lahir</label>
                                                    <input type="date" name="tgl_lahir" class="form-control" required value="<?php echo date("Y-m-d"); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">location_city</i></label>
                                            <div class="col-md-10">
                                                <div class="form-group ">
                                                    <label class="bmd-label-floating">Agama</label>
                                                    <input  type="text" name="agama" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">vpn_key</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                <label class="bmd-label-floating">Pangkat</label>
                                                  <input type="text"  name="pangkat" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">location_on</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                <label class="bmd-label-floating">Alamat</label>
                                                <textarea name="alamat" required class="form-control"></textarea>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">phone</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                    <label class="bmd-label-floating">No. Handphone</label>
                                                    <input type="text"  name="no_hp" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">school</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                    <label class="bmd-label-floating">Pendidikan Terakhir</label>
                                                  <input type="text"  name="pendidikan_terakhir" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">assignment</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                <label class="bmd-label-floating">SK Pengangkatan</label>
                                                  <input type="text"  name="sk_pengangkatan" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>   
                                        <div class="row">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">camera_alt</i></label>
                                            <div class="col-md-10">
                                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="<?php echo base_url() ?>assets/img/image_placeholder.jpg" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-rose btn-round btn-file">
                                                            <span class="fileinput-new">Pilih Foto</span>
                                                            <span class="fileinput-exists">Ganti Foto</span>
                                                            <input accept="image/*" type="file" name="file_foto" required />
                                                        </span>
                                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>      
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="text-center">DATA LOGIN</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">assignment_ind</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                <label class="bmd-label-floating">Username</label>
                                                <input type="text"  name="username" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-2">
                                            <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">lock_outline</i></label>
                                            <div class="col-md-10">
                                              <div class="form-group ">
                                                <label class="bmd-label-floating">Password</label>
                                                <input type="text"  name="password" class="form-control" required>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-md-2 col-form-label font-weight-bold"><i class="material-icons">supervisor_account</i></label>
                                                    <div class="col-md-10">
                                                        <div class="form-group mt-0">
                                                            <select class="selectpicker" data-style="btn select-with-transition" title="Pilih Level User" data-size="7" name="level_user">
                                                                <option value="kepala desa">Kepala Desa</option>
                                                                <option value="sekertaris">Sekertaris Desa</option>
                                                                <option value="kepala bagian">Kepala Bagian</option>
                                                                <option value="staf">Staf</option>
                                                                <option value="admin">Admin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>    
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
    <script type="text/javascript">
        $(document).ready(function(){
            //init DateTimePickers
            md.initFormExtendedDatetimepickers();
            // Sliders Init
            md.initSliders();
        });
    </script>
</html>