
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



          <div class="row ">
          	<div class="col-lg">

          		<?= form_error('menu', '<div class="alert alert-danger" role="alert">Kolom menu wajb diisi!</div>'); ?>
          		<?php if (validation_errors()) :?>
          			<div class="alert alert-danger" role="alert">
          				<?= validation_errors(); ?>
          			</div>
          		<?php endif; ?>



          		<?= $this->session->flashdata('message'); ?>

          		<a href="" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#newKerusakanModal"> Tambah Data Kerusakan Baru <i class="fas fa-plus"></i></a>

          		<div class="container">
          			<div class="table-responsive">
          		<table class="table table-striped table-bordered table-hover">
				  <thead>
				    <tr>
				      
				      <th scope="col" style="text-align: center;">Kode</th>
				      <th scope="col" style="text-align: center;">Diagnosa Kerusakan</th>
				      <th scope="col" style="text-align: center;">Solusi</th>
				      <th scope="col" style="text-align: center;">Opsi</th>
				      
				    </tr>
				  </thead>
				  <tbody>
				  	
				  	<?php foreach ($kerusakans as $k) :?>
				    <tr>
				     
				      <td style="text-align: center;"><?= $k['kode_kerusakan'];?></td>
				      <td><?= $k['nama_kerusakan'];?></td>
				      <td ><?= $k['keterangan'];?></td>
				     
				      <td style="text-align: center;">
				      	
				      	<a href="<?php echo base_url('kerusakan/edit/'.$k['id']) ?>" class="badge badge-success" > Ubah <i class="fas fa-edit"></i></a> 

				      	<?php echo '|' ?>


				      	<a href="<?php echo base_url('kerusakan/delete/'.$k['id']) ?>" onclick="javascript: return confirm('Apakah yakin menghapus')" class="badge badge-danger"><i class="fas fa-trash-alt"></i> Hapus</a>

				      </td>
				    </tr>
				   
					<?php endforeach; ?>
				  </tbody>
				</table>
				<?php echo $pagging_link; ?>
				</div>
				</div>
          	</div>
          </div>
          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- MODAL -->

<!-- Modal ADD-->
<div class="modal fade" id="newKerusakanModal" tabindex="-1" role="dialog" aria-labelledby="newKerusakanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newKerusakanModalLabel">Tambah Data Kerusakan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="<?= base_url('kerusakan');?>" method="post" >
	      <div class="modal-body">
		        <div class="form-group">
				    <input type="text" class="form-control" id="kode_kerusakan" name="kode_kerusakan" placeholder="Kode baru" >
				</div>
				<div class="form-group">
				    <input type="text" class="form-control" id="nama_kerusakan" name="nama_kerusakan" placeholder="Kerusakan baru">
				</div>
				<div class="form-group">
				    <textarea rows="13" cols="20" type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
				     <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'keterangan' );
            </script>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
	        <button type="submit" class="btn btn-primary">Simpan</button>
      	</div>
      </form>
    </div>
  </div>
</div>


