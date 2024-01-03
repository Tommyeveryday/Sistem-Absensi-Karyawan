<?php
require '../koneksi.php';
$nama=$_POST['nama_petugas'];
$user=$_POST['username'];
$pass=$_POST['password'];
$telp=$_POST['telp'];
$level=$_POST['level'];
$id=$_POST['id_petugas'];

$sql=mysqli_query($konek,"update petugas set nama_petugas='$nama',username='$user',password='$pass',telp='$telp',level='$level' where id_petugas='$id'");

if($sql)
{
	?>
	<script type="text/javascript">
		alert('Data berhasil diubah');
		window.location='admin.php?url=lihat_petugas';
	</script>
<?php
}
?>