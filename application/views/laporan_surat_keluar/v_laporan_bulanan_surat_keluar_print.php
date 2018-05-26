<!DOCTYPE html>
<html>
<body onload=" window.print();" onafterprint="window.close();" style="font-family: sans-serif;">
    <center>
    <div style="font-weight: bold;" align="center">
        <img style="float: left;margin-right: -60px" width="60px" src="<?php echo base_url() ?>assets/img/logo.png" >
        PEMERINTAH KABUPATEN JEMBER<br>
        KECAMATAN BALUNG<br>
        KANTOR DESA BALUNG KIDUL<br>
        Jl.Pemuda no 23 Desa Balung Kidul kode Pos 68161
        <br>
        <hr style="border: 2px solid #000">
        <br>
    </div>
    <div style="font-size: 20px">
        Laporan Bulanan Surat Keluar<br>
        <?php
            if ($_GET['bulan']=="01") {
                $bulan="Januari";
            }elseif ($_GET['bulan']=="02") {
                $bulan="Februari";
            }elseif ($_GET['bulan']=="03") {
                $bulan="Maret";
            }elseif ($_GET['bulan']=="04") {
                $bulan="April";
            }elseif ($_GET['bulan']=="05") {
                $bulan="Mei";
            }elseif ($_GET['bulan']=="06") {
                $bulan="Juni";
            }elseif ($_GET['bulan']=="07") {
                $bulan="Juli";
            }elseif ($_GET['bulan']=="08") {
                $bulan="Agustus";
            }elseif ($_GET['bulan']=="09") {
                $bulan="September";
            }elseif ($_GET['bulan']=="10") {
                $bulan="Oktober";
            }elseif ($_GET['bulan']=="11") {
                $bulan="November";
            }else{
                $bulan="Desember";
            }          
        ?>
        Bulan : <?php echo $bulan;?> <?php echo $_GET['tahun'];?><br><br>
    </div>
    <table cellpadding="10" border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>No.</th>
                <th>No Surat</th>
                <th>Asal Surat</th>
                <th>Perihal</th>
                <th>Tanggal Arsip</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; foreach ($data_surat_keluar as $surat_keluar): ?>
            <tr>
                <td><?php echo ++$no; ?></td>
                <td><?php echo $surat_keluar->no_surat ?></td>   
                <td><?php echo $surat_keluar->tujuan ?></td>
                <td><?php echo $surat_keluar->perihal ?></td>
                <td><?php echo date("d F Y", strtotime($surat_keluar->tgl_arsip)) ?></td>
                <td><?php echo $surat_keluar->keterangan; ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table><br><br>
    <div style="float: left;margin-left: 50px"><td>Mengetahui :</td></div>
    <div style="float: right;margin-right: 50px"><td>Jember,<?php echo date('d F Y'); ?></td></div><br>
    <div style="float: left;margin-left: 50px"><td>Kepala Desa</td></div>
    <div style="float: right;margin-right: 50px"><td>Sekretaris Desa</td></div><br><br><br><br>
    <div style="float: left;margin-left: 50px;"><td><u><?php echo $nama_kepala_desa; ?></u></td></div>
    <div style="float: right;margin-right: 50px"><td><u><?php echo $nama_sekertaris; ?></u></td></div><br>
    <div style="float: left;margin-left: 50px"><td>NIP:<?php echo $nip_kepala_desa; ?></td></div>
    <div style="float: right;margin-right:50px"><td>NIP:<?php echo $nip_sekertaris; ?></td></div>
</center>
</body>
</html>