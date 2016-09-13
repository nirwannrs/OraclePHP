<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>View Pelanggan</title>
</head>
<body>

<?php
include ("koneksi.php");
$query="select * from pelanggan order by kodepelanggan";
$statemen=oci_parse($conn,$query);
oci_execute($statemen);
include ("link.php"); 
?>
<br>
<h2>Data Pelanggan</h2>
<table border = "1" width = "100%" cellpadding = "6"> 
<tr>
<th><b>Kode Pelanggan</th>
<th><b>Nama Pelanggan</th>
<th><b>Alamat</th>
<th><b>Aksi</th>
</tr>

<?php
while($baris=oci_fetch_array($statemen))
{ 
echo "
<tr>
<td>".ucwords($baris['0'])."</td>
<td>".ucwords($baris['1'])."</td>
<td>".ucwords($baris['2'])."</td>
<td><a href = 'edit.php?motor=".$baris['0']."'>Edit</a> | 
<a href = 'delete.php?motor=".$baris['0']."'>Delete</a></td>
</tr>";
}
?>
 
</table>
<br>
<a href = "addpelanggan.php"><b>Tambah Data</a>
<?php 
oci_free_statement($statemen);
oci_close($conn);
?>
<br>
<hr> 
</body>
</html>