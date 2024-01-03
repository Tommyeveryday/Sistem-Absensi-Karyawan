<?php
require '../koneksi.php';
$nama=$_POST['nama_petugas'];
$user=$_POST['username'];
$pass=$_POST['password'];
$telp=$_POST['telp'];
$level=$_POST['level'];

$sql=mysqli_query($konek,"insert into petugas(nama_petugas,username,password,telp,level) values('$nama','$user','$pass','$telp','$level') ");

if($sql)
{
	?>
	<script type="text/javascript">
		alert('Data berhasil disimpan');
		window.location='admin.php?url=lihat_petugas';
	</script>
<?php
}
else
{
	?>
	<script type="text/javascript">
		alert('Gunakan Username lain');
		window.location='admin.php?url=lihat_petugas';
	</script>


<?php
}
?>