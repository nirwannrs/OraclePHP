<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="datatable.css">
<script src="jquery.js"></script>
<script src="jquery-datatable.js"></script>
<script src="jquery-modal-min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="jquery-modal-min.css" type="text/css" media="screen" />

<script type="text/javascript">
$(document).ready( function () {
    $('#table_id').DataTable({
		"pageLength": 15,
		"lengthMenu": [ 15, 30, 50, 75, 100 ]
	});
	
$( "#link" ).click(function() {
	$("#add-form").modal();
	$("#add-form").attr("action", "simpanpelanggan.php");
    $("#nama").focus();
	$("#kdPel").hide();
	$("#kdpelanggan").val("");
	$("#nama").val("");
	$("#alamat").val("");
    $("#title").text("Tambah Data");
	//modal loaded
  return false;
});
	} );

function editForm(kdpel, nama, alamat){
	$("#add-form").modal();
	$("#kdPel").show();
	$("#add-form").attr("action", "aeditpel.php?pelanggan="+kdpel);
	$("#kdpelanggan").attr("readonly", "");
	$("#kdpelanggan").attr("style", "width:150px; background: #ccc;")
	$("#nama").focus();
	$("#kdpelanggan").val(kdpel);
    $("#nama").val(nama.replace('_', ' '));
	$("#alamat").val(alamat);
	$("#title").text("Edit Data");
  return false;
}

</script>
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
<a href="#" id="link"><h2><b>Tambah Data</b></h2></a>
<h2>Data Pelanggan</h2>
<table border = "1" width = "100%" cellpadding = "6" id="table_id" class="display"> 
<thead>
<tr>
<th><b>Kode Pelanggan</th>
<th><b>Nama Pelanggan</th>
<th><b>Alamat</th>
<th><b>Aksi</th>
</tr>
</thead>
<tbody>
<?php
while($baris=oci_fetch_array($statemen))
{ 
$nama = str_replace(" ", "_", $baris['1']);
echo "<tr>";
echo "<td>".ucwords($baris['0'])."</td>";
echo "<td>".ucwords($baris['1'])."</td>";
echo "<td>".ucwords($baris['2'])."</td>";
echo "<td><a href = '#' onclick=editForm('".$baris['0']."','".$nama."','".$baris['2']."');><button> Edit </button></a> | <button onclick='myFunction()'>Delete</button></td>";
echo "</tr>";
echo "<script>
function myFunction() {
    var txt;
    var r = confirm('Yakin Hapus Data?');
    if (r == true) {
        window.location = 'deletepelanggan.php?pelanggan=".$baris['0']."';
    }
}
</script>";
}
?>
</tbody> 
</table>
<br>
<?php 
oci_free_statement($statemen);
oci_close($conn);
?>

<!-- form -->
<form method="post" class="modal" id="add-form" style="display:none">
<center>
<table border="0" width = "50%" cellpadding = "8">
<tr>
	<th colspan="3" align="center">Tambah Data Pelanggan</th>
</tr>
<tr id="kdPel">
	<td>Kode Pelanggan</td>
	<td> : </td>
	<td><input type="text" name="kdpelanggan" id="kdpelanggan" style="width:150px;" autofocus></td>
</tr>
<tr>
	<td>Nama Pelanggan</td>
	<td> : </td>
	<td><input type="text" name="nama" id="nama" style="width:150px;"></td>
</tr>
<tr>
	<td>Alamat</td>
	<td> : </td>
	<td><input type="text" name="alamat" id="alamat" style="width:150px;"></td>
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

<br>
<hr> 
</body>
</html>