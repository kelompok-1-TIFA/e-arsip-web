<!DOCTYPE html>
<html>
<body onload=" window.print();" onafterprint="window.close();">
      <center> 
    <div>
        PEMERINTAH KABUPATEN JEMBER<br>
        KECAMATAN BALUNG<br>
        KANTOR DESA BALUNG KIDUL<br>
        Jl.Pemuda no 23 Desa Balung Kidul kode Pos 68161
        <br>
        <hr>
        Laporan Harian Surat Masuk <br>
        dari : <?php echo $_GET['dari'];?> - sampai : <?php echo $_GET['sampai'];?>
        <br>
    </div>
    <br>
    <table cellpadding="10" border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>No.</th>
                <th>No Surat</th>
                <th>Asal Surat</th>
                <th>Perihal</th>
                <th>Tanggal Arsip</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; foreach ($data_surat_masuk as $surat_masuk): ?>
            <tr>
                <td><?php echo ++$no; ?></td>
                <td><?php echo $surat_masuk->no_surat ?></td>   
                <td><?php echo $surat_masuk->asal_surat ?></td>
                <td><?php echo $surat_masuk->perihal ?></td>
                <td><?php echo date("d F Y", strtotime($surat_masuk->tgl_arsip)) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table><br><br>
     <div style="float: left;margin-left: 50px"><td>Mengetahui :</td></div>
     <div style="float: right;margin-right: 50px"><td>Jember,<?php $tgl=date('d-m-Y'); echo $tgl; ?></td></div><br>
     <div style="float: left;margin-left: 50px"><td>Kepala Desa</td></div>
     <div style="float: right;margin-right: 50px"><td>Sekretaris Desa</td></div><br><br><br><br>
     <div style="float: left;margin-left: 50px;"><td><u>Syamsul Arifin</u></td></div>
     <div style="float: right;margin-right: 50px"><td><u>Candra Mak</u></td></div><br>
     <div style="float: left;margin-left: 50px"><td>NIP.874509985</td></div>
     <div style="float: right;margin-right:50px"><td>NIP.874558545</td></div>
    
    
    </center>
</body>
</html>