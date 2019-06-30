
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title" style="text-align: center;">Selamat Datang <?php echo $this->session->userdata('name')?>, Di Sistem Pakar Troubleshooting Ground Satellite Receiver HimawariCast</h3>
            </div>
              <div class="panel-body">
                <p class="text-justify">
                Sistem Pakar Troubleshooting GSR ini menggunakan metode forward chaining (penalaran runut maju) yaitu 
                proses penalaran yang dimulai dari fakta-fakta yang ada menuju ke kesimpulan akhir. Sehingga untuk mendapatkan suatu kesimpulan,  diperlukan pengecekan terhadap setiap rule atau aturan dengan fakta-fakta yang sedang di observasi tersebut memenuhi aturan yang telah ada.
                
                </p>
                <p class="text-justify">
                Ground Satellite Receiver (GSR) atau sistem penerima data satelit merupakan salah satu unsur utama yang berperan penting menerima data dari satelit yang mengandung informasi meteorologi yang diperlukan dalam Meteorological Early Warning System (MEWS). Selama peralatan GSR ini dioperasionalkan , GSR membutuhkan pemeliharaan agar dapat bekerja secara optimal sesuai dengan standar operasional peralatan.  

                </p>
                <p class="text-center"><a class="btn btn-warning btn-md" href="<?php echo site_url('konsul')?>" role="button">Mulai Konsultasi</a></p>
              </div>
      </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
