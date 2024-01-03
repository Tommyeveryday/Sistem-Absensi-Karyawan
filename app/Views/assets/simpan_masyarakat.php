<?php
require 'koneksi.php';
$nik=$_POST['nik'];
$nama=$_POST['nama'];
$user=$_POST['username'];
$pass=$_POST['password'];
$telp=$_POST['telp'];

$sql=mysqli_query($konek,"insert into masyarakat values ('$nik','$nama','$user','$pass','$telp')");
if ($sql)
{
	?>
	<script>
		alert ('Data berhasil disimpan,silahkan digunakan untuk login');
		window.location="login.php";
	</script>
<?php
}
else
{
	?>
	<script type="text/javascript">
	alert ('Data gagal disimpan,silahkan registrai ulang');
	window.location="register.php";
	</script>
<?php
}
?>