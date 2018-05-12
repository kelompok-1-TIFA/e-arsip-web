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
                                <i class="material-icons">mail</i>
                            </div>
                            <h4 class="card-title">Data <?php echo $page_title; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                                <a title="Tambah Data" href="<?php echo base_url('surat_masuk/tambah') ?>" class="btn btn-primary btn-round"><i class="material-icons">add</i> Tambah Data</a>
                            </div>
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No Surat</th>
                                            <th>Asal Surat</th>
                                            <th>Perihal</th>
                                            <th>Tanggal Arsip</th>
                                            <th>Status Disposisi</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=0; foreach ($data_surat_masuk as $surat_masuk): ?>
                                        <tr id="datanya">
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $surat_masuk->no_surat ?></td>   
                                            <td><?php echo $surat_masuk->asal_surat ?></td>
                                            <td><?php echo $surat_masuk->perihal ?></td>
                                            <td><?php echo date("d F Y", strtotime($surat_masuk->tgl_arsip)) ?></td>
                                            <td>

                                                <?php 
                                                    if ($surat_masuk->status_disposisi=="t" and $this->session->userdata('level_user')=="kepala desa") {
                                                        echo "<span class='badge badge-warning'>belum didisposisikan</span>";
                                                    }else{
                                                        echo "<span class='badge badge-success'> didisposisikan</span>";
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-right td-actions">
                                                <?php  if ($surat_masuk->status_disposisi=="t" and $this->session->userdata('level_user')=="kepala desa") { ?>
                                                <a href="<?php echo base_url('disposisi/mendisposisikan/'.$surat_masuk->id_surat_masuk) ?>" title="Disposisikan" class="btn btn-link btn-success"><i class="material-icons">send</i></a>
                                                <?php } ?>
                                                <a href="<?php echo base_url('surat_masuk/edit/'.$surat_masuk->id_surat_masuk) ?>" title="Edit" class="btn btn-link btn-warning"><i class="material-icons">mode_edit</i></a>
                                                <a onclick="deletedata(<?php echo $surat_masuk->id_surat_masuk.",'".$surat_masuk->no_surat."'" ?>)" title="Hapus" class="btn btn-link btn-danger"><i class="material-icons">close</i></a>
                                                <a href="<?php echo base_url('surat_masuk/detail/'.$surat_masuk->id_surat_masuk) ?>" title="Detail" class="btn btn-link btn-info"><i class="material-icons">remove_red_eye</i>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end content-->
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="<?php echo base_url() ?>assets/js/plugins/jquery.datatables.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        var table = $('#datatables').DataTable();
        $('.card .material-datatables label').addClass('form-group');
    });
</script>
<script type="text/javascript">
    $( document ).ready(function() {
        <?php echo $this->session->flashdata('sukses'); ?>
        <?php echo $this->session->flashdata('alert'); ?>
        <?php echo $this->session->flashdata('message'); ?>
    });

    function deletedata(id,datanya){
        swal({
            title: "Anda Yakin?",
            text: "Data "+datanya+" Akan Dihapus Secara Permanen!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Yes, delete it!',
            buttonsStyling: false
        }).then(function(){
            $.ajax({
                url: "<?php echo base_url('surat_masuk/hapus') ?>",
                type: "post",
                data: {id:id},
                success:function(){
                    swal({
                        title: 'Berhasil!',
                        text: 'Data Berhasil Di Hapus.',
                        type: 'success',
                        confirmButtonClass: "btn btn-success",
                        buttonsStyling: false
                    })
                    $("#datanya").fadeTo("slow", 0.7, function(){
                        $(this).remove();
                    })
                },error:function(){
                    swal({
                        title: 'Gagal!',
                        text: 'Data Gagal Di Hapus.',
                        type: 'error',
                        confirmButtonClass: "btn btn-danger",
                        buttonsStyling: false
                    })
                }
            });
        }).catch(swal.noop)
    }
</script>
</html>