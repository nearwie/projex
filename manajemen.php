
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



          <div class="row">
          	<div class="col-lg">

          		<?= form_error('menu', '<div class="alert alert-danger" role="alert">Kolom menu wajb diisi!</div>'); ?>
          		<?php if (validation_errors()) :?>
          			<div class="alert alert-danger" role="alert">
          				<?= validation_errors(); ?>
          			</div>
          		<?php endif; ?>



          		<?= $this->session->flashdata('message'); ?>

          		<a href="" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#newSubMenuModal"> Tambah Submenu Baru <i class="fas fa-plus"></i></a>

          		<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Sub Menu</th>
				      <th scope="col">Menu</th>
				      <th scope="col">Url</th>
				      <th scope="col">Ikon</th>
				      <th scope="col">Aktif</th>
				      <th scope="col">Aksi</th>
				      
				    </tr>
				  </thead>
				  <tbody>
				  	<?php $i = 1; ?>
				  	<?php foreach ($subMenu as $sm) :?>
				    <tr>
				      <th scope="row"><?= $i;?></th>
				      <td><?= $sm['title'];?></td>
				      <td><?= $sm['menu'];?></td>
				      <td><?= $sm['url'];?></td>
				      <td><?= $sm['icon'];?></td>
				      <td><?= $sm['is_active'];?></td>
				      <td>



				      	<form action="<?= base_url('menu/d') ?>" method="post" >

				      		<input type="hidden" name="id" value="<?= $sm['id'] ?>">
				      		<button onclick="return confirm('')" class="btn btn-success"><i class="fas fa-edit"></i> Ubah</button>

				      	</form>

				      	<form action="<?= base_url('menu/dels') ?>" method="post">
				      		
				      		<input type="hidden" name="id" value="<?= $sm['id'] ?>">
				      		<button onclick="return confirm('')" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>

				      	</form>
				      	
				      </td>
				    </tr>
				    <?php $i++; ?>
					<?php endforeach; ?>
				  </tbody>
				</table>
          	</div>
          </div>
          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- MODAL -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Menu Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="<?= base_url('admin/manajemen');?>" method="post" >
	      <div class="modal-body">
		        <div class="form-group">
				    <input type="text" class="form-control" id="title" name="title" placeholder="Nama submenu baru" >
				</div>
				<div class="form-group">
				    <select name="menu_id" id="menu_id" class="form-control">
				    	<option value="">Select menu</option>
				    	<?php foreach ($menu as $m) :?>
				    		<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
				    	<?php endforeach; ?>
				    </select>
				</div>
				<div class="form-group">
				    <input type="text" class="form-control" id="url" name="url" placeholder="Url submenu baru">
				</div>
				<div class="form-group">
				    <input type="text" class="form-control" id="icon" name="icon" placeholder="Ikon submenu baru">
				</div>
				<div class="form-group">
				    <div class="form-check">
					  <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
					  <label class="form-check-label" for="is_active">
					    Aktif
					  </label>
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
