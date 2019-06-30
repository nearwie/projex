
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
          <h6>User : (<strong><?php echo $this->session->userdata('name')?></strong>)</h6>
          <br>
           <div >
                <a href="<?php echo site_url()?>konsul/createPdf/"><button  class="btn pull-right hidden-sm-down btn-success"><i class="fas fa-file-pdf"></i> Unduh PDF</button></a>
                    </div>
                    <br>

          <table class='table table-bordered'> 
            <thead>
                <tr>
                    <th style="text-align: center;background: #1E90FF; color: white; padding: 5px">Nama Gejala</th>
                    <th style="text-align: center;background: #1E90FF; color: white; padding: 5px">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no; foreach($listHistory as $list):?>
                    <tr>
                        <td style="padding: 5px;"><?php echo $list->nama_gejala?></td>
                        <td style="text-align: center;padding: 5px;"><?php echo $list->created_at ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

            
    <hr>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th style="text-align: center;background: #1E90FF; color: white; padding: 5px;">Hasil Diagnosa</th>
                <th style="text-align: center;background: #1E90FF; color: white; padding: 5px;">Kerusakan</th>
                <th style="text-align: center;background: #1E90FF; color: white; padding: 5px;">CF</th>
                <th style="text-align: center;background: #1E90FF; color: white; padding: 5px;">Keterangan</th>
                <th style="text-align: center;background: #1E90FF; color: white; padding: 5px;">Tanggal</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $no; foreach($listHasil as $list):?>
                <tr>
                    <td style="text-align: center;padding: 5px;"><?php echo $list['kode_kerusakan'] ?></td>
                    <td style="padding: 5px;"><?php echo $list['nama_kerusakan'] ?></td>
                    <td style="text-align: center;padding: 5px;"><?php echo $list['kepercayaan'] ?></td>
                    <td style="padding: 5px;"><?php echo $list['keterangan'] ?></td>
                    <td style="text-align: center;padding: 5px;"><?php echo $list['created_at'] ?></td>
                   
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
              
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
