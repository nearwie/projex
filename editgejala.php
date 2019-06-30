<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
      <form action="<?= base_url('gejala/edit/'.$g['id']);?>" method="post">
        <div class="form-group row">
          <input type="hidden" name="id" value="<?php echo $g['id'] ?>">
          <label for="kode_gejala" class="col-sm-2 col-form-label">Kode</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="kode_gejala" name="kode_gejala" placeholder="Kode" value="<?php echo $g['kode_gejala'] ?>" readonly>
          </div>
        </div>
        <div class="form-group row">
            <label for="nama_gejala" class="col-sm-2 col-form-label">Gejala</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_gejala" name="nama_gejala" placeholder="Gejala" value="<?php echo $g['nama_gejala'] ?>" >
          </div>
        </div>
        
        
        <div class="form-group row">
          <div class="col-sm-10">
            <button href="" type="submit" name="submit" value="Edit g" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

      