
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Hasil Analisis</h1>
          <div class="box-header with-border">
              <h6 class="box-title">Gejala yang dipilih</h6>
          </div><!-- /.box-header -->

          <div class="box-body table-responsive">
            <table id="tbl-list" class="table table-bordered">
                <tr>
                    <th width="50px" style="background: #67CDFF; color: white">No</th>
                    <th style="background: #67CDFF; color: white">Gejala</th>
                </tr>
                <tr>
                    <?php $i = 1; foreach($listGejala->result() as $value){?>
                        <tr>
                            <td width="30px"><?php echo $i++?></td>
                            <td><?php echo $value->kode_gejala." - ".$value->nama_gejala?></td>
                        </tr>
                    <?php }?>
                </tr>
            </table>
        </div><!--box body-->


        <div class="box box-success">
          <div class="box-header with-border">
              <h6 class="box-title">Hasil Diagnosa</h6>
          </div><!-- /.box-header -->
          <div class="box-body">
              <table id="tbl-list" class="table table-bordered">
                  <tr>
                      <th width="50px" style="background: #67CDFF; color: white">No</th>
                      <th style="background: #67CDFF; color: white">Kerusakan</th>
                      <th style="background: #67CDFF; color: white">Tingkat Kepercayaan</th>
                  </tr>
                  <tr>
                      <?php $i = 1; foreach($listKerusakan as $value){?>
                          <tr>
                              <td width="30px"><?php echo $i++?></td>
                              <td><?php echo $value['kode_kerusakan']." - ".$value['nama_kerusakan']?></td>
                              <td><?php echo $value['kepercayaan']?> %</td>
                          </tr>
                      <?php }?>
                  </tr>
              </table>
          </div><!--box body-->
      </div><!--box-->

      <div class="box box-success">
        <div class="box-header with-border">
            <h6 class="box-title">Kesimpulan</h6>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?php if(sizeof($listKerusakan)>0) { ?>
                <p>
                    Berdasarkan gejalanya, Peralatan Ground Satellite Receiver di prediksi mengalami kerusakan/masalah <b><?php echo $listKerusakan[0]['nama_kerusakan'];?></b> dengan tingkat kepercayaan <b><?php echo $listKerusakan[0]['kepercayaan'];?> %</b><br/> <br/> 

                    <b>Cara Mengatasinya:</b>
                    <?php echo $listKerusakan[0]['keterangan'];?> <p style="font-style: bold; color: red; font-size: 13px;">*Hasil diagnosa ini membutuhkan pemeriksaan lebih lanjut dengan melakukan perbaikan untuk mengembalikan fungsinya.</p>
                </p>
            <?php }else{?>
                <p>
                    Penyakit tidak dapat diprediksi karena tingkat kepercayaan gejala terlalu rendah
                </p>
            <?php }?>
        </div><!--box body-->
        <div class="box-footer clearfix">
           <div class="box-footer clearfix">
            <a class="btn btn-sm btn-flat pull-right" style="background: #67CDFF; color: white;" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#konsulUlang">Deteksi Ulang</a>
        
           
        </div>
           
        </div>
    </div><!--box-->



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<div class="modal fade" id="konsulUlang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah masalah/gangguan sudah dapat teratasi?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> Jika belum, Silahkan klik tombol "konsultasi" untuk melakukan konsultasi ulang.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Sudah</button>
          <a class="btn btn-primary" href="<?= base_url('konsul'); ?>">konsultasi</a>
        </div>
      </div>
    </div>
  </div>