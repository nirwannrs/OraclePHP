<html>
<head>
	<title>Tambah Barang</title>
</head>
<body>


<a href = "view_pelanggan.php"><b><- Kembali</a>
<form method="post" action="simpanpelanggan.php">
<center>
<table border="0" width = "50%" cellpadding = "8">
<tr>
	<th colspan="3" align="center">Tambah Data Pelanggan</th>
</tr>
<tr>
	<td>Kode Pelanggan</td>
	<td> : </td>
	<td><input type="text" name="kdpelanggan" style="width:150px;"></td>
</tr>
<tr>
	<td>Nama Pelanggan</td>
	<td> : </td>
	<td><input type="text" name="namapelanggan" style="width:150px;"></td>
</tr>
<tr>
	<td>Alamat</td>
	<td> : </td>
	<td><input type="text" name="alamat" style="width:150px;"></td>
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
