<?php
require '../koneksi.php';
$tgl=date('Y/m/d');
$nik=$_POST['nik'];
$isi=$_POST['isi_laporan'];
$ft=$_FILES['foto']['name'];
$file=$_FILES['foto']['tmp_name'];
$st=0;

$sql=mysqli_query($konek,"insert into pengaduan(tgl_pengaduan,nik,isi_laporan,foto,status) values('$tgl','$nik','$isi','$ft','$st')");
move_uploaded_file($file,"../foto/".$ft);
if ($sql)
{
	?>
	<script type="text/javascript">
		alert ('Data berhasil disimpan');
		window.location="masyarakat.php";
	</script>
<?php
}
else
{
?>
	<script type="text/javascript">
		alert ('Data gagal disimpan');
		window.location="masyarakat.php";
	</script>
<?php
}
?>