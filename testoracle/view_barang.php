<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="datatable.css">
<script src="jquery.js"></script>
<script src="jquery-datatable.js"></script>

<script type="text/javascript">
$(document).ready( function () {
    $('#table_id').DataTable({
		"pageLength": 15,
		"lengthMenu": [ 15, 30, 50, 75, 100 ]
	});
} );
</script>


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
<table border="1" width = "100%" cellpadding = "6" id="table_id" class="display"> 
  <thead>
  <tr>
    <th><b>Kode Barang</th>
    <th><b>Nama Barang</th>
    <th><b>Stok</th>
    <th><b>Harga</th>
    <th><b>Aksi</th>
  </tr>
  </thead>
  <tbody>
<?php
while($baris=oci_fetch_array($statemen))
{ 
echo "<tr>";
echo "<td>".ucwords($baris['0'])."</td>";
echo "<td>".ucwords($baris['1'])."</td>";
echo "<td>".ucwords($baris['2'])."</td>";
echo "<td>".ucwords($baris['3'])."</td>";
echo "<td><a href = 'edit.php?barang=".$baris['0']."'><button>Edit</button></a> | <button onclick='myFunction()'>Delete</button></td>";
echo "</tr>";
echo "<script>
function myFunction() {
    var txt;
    var r = confirm('Yakin Hapus Data?');
    if (r == true) {
        window.location = 'delete.php?barang=".$baris['0']."';
    }
}
</script>";
}
?>

</tbody>
</table>
<p id="demo"></p>
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