
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="alert alert-info">
			<h3>Selamat Datang <?php echo $this->session->userdata('name')?>, Di Halaman Administrator! </h3>
			<p align="justify"> Sistem pakar ini dibangun untuk membantu pengguna ataupun teknisi dalam mengidentifikasi permasalahan atau gangguan kerusakan pada peralatan Ground Satellite Receiver.</p>
			</div>

			<div class="alert alert-warning">
				<h3>Petunjuk Penggunaan Aplikasi</h3>
				<p align="justify">
				  1. Pilih menu yang ingin dilakukan pengolahan data <br>	
				  2. Pilih submenu yang ingin dilakukan pengolahan data <br>
				  3. Inputkan data dengan benar <br>
				  4. Tekan tombol Simpan Jika telah selesai melakukan pengisian data <br>
				  5. Logout sebelum menutup browser
				  </p>
			</div>


			<div class="alert alert-success">
				<h3>Kebijakan Pengguna Aplikasi</h3>
				<p align="justify">
				  1. Jaga Keamanan Username dan Password <br>	
				  2. Isi data dengan kebenaran <br>
				  3. Lakukan Logout sebelum keluar 
				  </p>
			</div>
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      