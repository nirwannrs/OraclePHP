<html>
<head>
	<title>Edit Barang</title>
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
$query="select * from barang where kodebarang='".$_GET['barang']."'";
$statemen=oci_parse($conn,$query);
oci_execute($statemen);
$baris=oci_fetch_array($statemen)
?>

<a href = "view_barang.php"><b><- Batal</a>
<form method="post" action="aedit.php?barang=<?php echo $_GET['barang']; ?>">
<center>
<table border="0" width = "50%" cellpadding = "8">
<tr>
	<th colspan="3" align="center">Edit Data Barang</th>
</tr>
<tr>
	<td>Kode Barang</td>
	<td> : </td>
	<td><input type="text" name="kdbarang" style="width:150px; background: #ccc;" value="<?php echo $baris['0']; ?>" readonly></td>
</tr>
<tr>
	<td>Nama Barang</td>
	<td> : </td>
	<td><input type="text" name="nama" value="<?php echo $baris['1']; ?>" style="width:150px;" autofocus></td>
</tr>
<tr>
	<td>Stok</td>
	<td> : </td>
	<td><input type="number" name="stok" value="<?php echo $baris['2']; ?>" onkeypress="return isNumberKey(event)" style="width:150px;"></td>
</tr>
<tr>
	<td>Harga</td>
	<td> : </td>
	<td><input type="text" name="harga" value="<?php echo $baris['3']; ?>" onkeypress="return isNumberKey(event)" style="width:150px;"></td>
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
