<html>
<head>
<title>View Motor</title>
</head>
<body>

<?php
include ("koneksi.php");
$query="select * from motor order by id_motor asc";
$statemen=oci_parse($conn,$query);
oci_execute($statemen);
?>
<hr>
<a href = "view_motor.php"><h2>Data Motor</a> | <a href = "view_trans">Data Transaksi</h2></a>
<hr>
<br>
<h2>Data Motor</h2>
<table border = "1" width = "100%" cellpadding = "8"> 
<tr>
<th><b>ID Motor</th>
<th><b>Nama Motor</th>
<th><b>Merk Motor</th>
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
<a href = "add.php"><b>Tambah Data</a>
<?php 
oci_free_statement($statemen);
oci_close($conn);
?>
<br>
<hr> 
</body>
</html>