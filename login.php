

 


    <!-- Outer Row -->
    <div class="row">
    <div class="col"> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="#">Sistem Pakar GSR HimawariCast</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav" class="align ">
         
          <a class="nav-item nav-link" href="<?= base_url('auth/petunjuk');?>">Petunjuk</a>
          <a class="nav-item nav-link" href="<?= base_url('auth/registration');?>">Daftar</a>
          <a class="nav-item nav-link" href="<?= base_url('auth/kontak');?>">Kontak</a>
        </div>
      </div>
      </div>
    </nav>
    </div>
    </div>
  <div class="container">
   <div class="row justify-content-center">
    

      <div class="col-lg-10">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

              <div class="col-sm-6 d-none d-sm-block bg-login-image"></div>
              <div class="col-lg ">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Menu</h1>
                    <?= $this->session->flashdata('message'); ?>
                  </div>

                  <form class="user" method="post" action="<?= base_url('auth');?> ">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan Email" value="<?= set_value('email')?>">
                      <?= form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password">
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                   
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?= base_url("auth/forgotpassword"); ?>">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('auth/registration');?>">Tidak punya akun? Buat Akun.</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  
