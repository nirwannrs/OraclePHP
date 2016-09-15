<html>
<head>
	<title>Edit Pelanggan</title>
</head>
<body>

<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

<?php
include ("koneksi.php");
$query="select * from pelanggan where kodepelanggan='".$_GET['pelanggan']."'";
$statemen=oci_parse($conn,$query);
oci_execute($statemen);
$baris=oci_fetch_array($statemen)
?>

<a href = "view_pelanggan.php"><b><- Batal</a>
<form method="post" action="aeditpel.php?pelanggan=<?php echo $_GET['pelanggan']; ?>">
<center>
<table border="0" width = "50%" cellpadding = "8">
<tr>
	<th colspan="3" align="center">Edit Data pelanggan</th>
</tr>
<tr>
	<td>Kode Pelanggan</td>
	<td> : </td>
	<td><input type="text" name="kdpel" style="width:150px; background: #ccc;" value="<?php echo $baris['0']; ?>" readonly></td>
</tr>
<tr>
	<td>Nama Pelanggan</td>
	<td> : </td>
	<td><input type="text" name="nama" value="<?php echo $baris['1']; ?>" style="width:150px;" autofocus></td>
</tr>
<tr>
	<td>Alamat</td>
	<td> : </td>
	<td><input type="text" name="alamat" value="<?php echo $baris['2']; ?>" style="width:150px;"></td>
</tr>
<tr>
	<td colspan="3" align="center">
		<input type="submit" value="Proses">
		<input type="reset" value="Reset">
	</td>
</tr>
</table>
</center>
</form>
</body>
</html>
