<html>
<head>
	<title>Tambah Motor</title>
</head>
<body>
<a href = "view_motor.php"><b><- Batal</a

<?php
include "kankesi.php";
$sql=mysql_query("SELECT * FROM nilai WHERE npm='".$_GET['npm']."'");
$data=mysql_fetch_array($sql);
?>

<form method="post" action="simpan.php">
<center>
<table border="0" width = "50%" cellpadding = "8">
<tr>
	<th colspan="3" align="center">Tambah Data Motor</th>
</tr>
<tr>
	<td>ID Motor</td>
	<td> : </td>
	<td><input type="text" name="idmotor"></td>
</tr>
<tr>
	<td>Nama Motor</td>
	<td> : </td>
	<td><input type="text" name="nama"></td>
</tr>
<tr>
	<td>Merk</td>
	<td> : </td>
	<td><input type="text" name="merk"></td>
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
