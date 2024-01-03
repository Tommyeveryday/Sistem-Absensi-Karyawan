<?php
require '../koneksi.php';
$id_pengaduan=$_POST['id_pengaduan'];
$tgl=$_POST['tgl_tanggapan'];
$tanggapan=$_POST['tanggapan'];
$id_petugas=$_POST['id_petugas'];
$id=$_POST['id_tanggapan'];

$sql=mysqli_query($konek,"update tanggapan set id_pengaduan='$id_pengaduan',tgl_tanggapan='$tgl',tanggapan='$tanggapan',id_petugas='$id_petugas' where id_tanggapan='$id'");

if($sql)
{
	?>
	<script type="text/javascript">
		alert('Data berhasil diubah');
		window.location='admin.php?url=lihat_tanggapan';
	</script>
<?php
}
?>