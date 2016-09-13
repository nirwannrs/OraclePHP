<html>
<head>
	<title>Tambah Barang</title>
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

<a href = "view_barang.php"><b><- Kembali</a>
<form method="post" action="simpan.php">
<center>
<table border="0" width = "50%" cellpadding = "8">
<tr>
	<th colspan="3" align="center">Tambah Data Barang</th>
</tr>
<tr>
	<td>Kode Barang</td>
	<td> : </td>
	<td><input type="text" name="kdbarang" style="width:150px;"></td>
</tr>
<tr>
	<td>Nama Barang</td>
	<td> : </td>
	<td><input type="text" name="nama" style="width:150px;"></td>
</tr>
<tr>
	<td>Stok</td>
	<td> : </td>
	<td><input type="number" name="stok" onkeypress="return isNumberKey(event)" style="width:150px;"></td>
</tr>
<tr>
	<td>Harga</td>
	<td> : </td>
	<td><input type="text" name="harga" onkeypress="return isNumberKey(event)" style="width:150px;"></td>
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
