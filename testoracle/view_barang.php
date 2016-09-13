<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>View Barang</title>
</head>
<body>

<?php
include ("koneksi.php");
$query="select * from barang order by kodebarang";
$statemen=oci_parse($conn,$query);
oci_execute($statemen);
include ("link.php"); 
?>
<br>
<h2>Data Barang</h2>
<table border = "1" width = "100%" cellpadding = "6"> 
<tr>
<th><b>Kode Barang</th>
<th><b>Nama Barang</th>
<th><b>Stok</th>
<th><b>Harga</th>
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
<td>".ucwords($baris['3'])."</td>
<td><a href = 'edit.php?barang=".$baris['0']."'>Edit</a> | 
<a href = 'delete.php?barang=".$baris['0']."'>Delete</a></td>
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