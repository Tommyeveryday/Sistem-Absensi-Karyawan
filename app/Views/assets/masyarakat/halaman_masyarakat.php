<?php
if (isset($_GET['url']))
{
	$url=$_GET['url'];

	switch($url)
	{
		case 'tulis_pengaduan';
		include 'tulis_pengaduan.php';
		break;

		case 'lihat_pengaduan';
		include 'lihat_pengaduan.php';
		break;

		case 'detail_pengaduan';
		include 'detail_pengaduan.php';
		break;

		case 'lihat_tanggapan';
		include 'lihat_tanggapan.php';
		break;


	}
}
else
{
	?>
	Selamat Datang di Aplikasi Pelaporan Pengaduan Masyarakat (APPEM)<br>
	Anda Login Sebagai : <b> <?php echo $_SESSION['nama']; 

	require '../koneksi.php';
	$sql=mysqli_query($konek,"select * from pengaduan where status='selesai' and nik=$_SESSION[nik]");
	if ($cek=mysqli_num_rows($sql)) 
	{
	?>
		<div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">laporan Pengaduan : </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Ada <?php echo $cek; ?> Laporan yang sudah ditanggapi</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-4x text-gray-300"></i>
                      <span class="badge badge-danger bagde-counter"><?php echo $cek; ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php
}
}
?>

