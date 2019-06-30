<!DOCTYPE html>
<html>
<head>
    <title>Laporan/title>
</head>
<body>
<!--<div class="container-fluid"> -->
    <center><h1>ARSIP DATA - LAPORAN HASIL ANALISIS</h1>
        <table class='table table-bordered'> 
            <thead>
                <tr>
                    <th style="text-align: center;">Nama Gejala</th>
                    <th style="text-align: center;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no; foreach($listHistory as $list):?>
                    <tr>
                        <td ><?php echo $list->nama_gejala?></td>
                        <td ><?php echo $list->created_at ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

          <hr>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th style="text-align: center;">Hasil Diagnosa</th>
                <th style="text-align: center;">Kerusakan</th>
                <th style="text-align: center;">CF</th>
                <th style="text-align: center;">Solusi</th>
                <th style="text-align: center;">Tanggal</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $no; foreach($listHasil as $list):?>
                <tr>
                    <td ><?php echo $list['kode_kerusakan'] ?></td>
                    <td ><?php echo $list['nama_kerusakan'] ?></td>
                    <td ><?php echo $list['kepercayaan'] ?></td>
                    <td ><?php echo $list['keterangan'] ?></td>
                    <td ><?php echo $list['created_at'] ?></td>
                   
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</body>
</html>