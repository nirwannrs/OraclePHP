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
	$("#add-form").attr("action", "simpan.php");
    $("#nama").focus();
	
	$("#kdbarang").val("");
	$("#kode").hide();
	$("#nama").val("");
	$("#stok").val("");
	$("#harga").val("");
    $("#title").text("Tambah Data");
	//modal loaded
  return false;
});

	} );

function editForm(kdbarang, nama, stok, harga){
	$("#add-form").modal();
	$("#add-form").attr("action", "aedit.php?barang="+kdbarang);
	$("#kode").show();
	$("#nama").focus();
	$("#kdbarang").attr("readonly", "");
	$("#kdbarang").attr("style", "width:150px; background: #ccc;")
	$("#kdbarang").val(kdbarang);
	$("#nama").val(nama.replace('_', ' '));
	$("#stok").val(stok);
	$("#harga").val(harga);
	$("#title").text("Edit Data");
  return false;
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function liveValidation(){
  if($("#nama").val()=="") {
    $("#nama").attr("border", "1px solid red");
    alert("Silakan Lengkapi Data")
  } else if($("#stok").val()=="") {
    $("#stok").attr("border", "1px solid red");
    alert("Silakan Lengkapi Data")
  } else if($("#harga").val()=="") {
    $("#harga").attr("border", "1px solid red");
    alert("Silakan Lengkapi Data")
  } else {
  $("#add-form").submit();
  }
}

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
<a href="#" id="link"><h2><b>Tambah Data</b></h2></a>
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
$nama = str_replace(" ", "_", $baris['1']);
echo "<td>".ucwords($baris['0'])."</td>";
echo "<td>".ucwords($baris['1'])."</td>";
echo "<td>".ucwords($baris['2'])."</td>";
echo "<td>".ucwords($baris['3'])."</td>";
echo "<td><a href = '#' onclick=editForm(".$baris['0'].",'".$nama."','".$baris['2']."','".$baris['3']."');><button> Edit </button></a> | <button onclick='myFunction()'>Delete</button></td>";
//echo "<td><a href = 'edit.php?barang=".$baris['0']."'><button>Edit</button></a> | <button onclick='myFunction()'>Delete</button></td>";
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

<?php 
oci_free_statement($statemen);
oci_close($conn);
?>

<!-- form -->
<form method="post" class="modal" id="add-form" style="display:none;">
<center>	
<table border="0" width = "50%" cellpadding = "8">
<tr>
	<th colspan="3" align="center" id="title">Tambah Data Barang</th>
</tr>
<tr id="kode">
	<td>Kode Barang</td>
	<td> : </td>
	<td><input type="text" id="kdbarang" name="kdbarang" style="width:150px;" autofocus></td>
</tr>
<tr>
<input type="hidden" name="kd" value="B">
	<td>Nama Barang</td>
	<td> : </td>
	<td><input type="text" id="nama" name="nama" style="width:150px;"></td>
</tr>
<tr>
	<td>Stok</td>
	<td> : </td>
	<td><input type="number" id="stok" class="number" min="0" name="stok" onkeypress="return isNumberKey(event)" style="width:150px;"></td>
</tr>
<tr>
	<td>Harga</td>
	<td> : </td>
	<td><input type="text" min="0" id="harga" class="number" name="harga" onkeypress="return isNumberKey(event)" style="width:150px;"></td>
</tr>
<tr>
	<td colspan="3" align="center">
		<input type="submit" value="Proses" style="display:none;">
    <a href="#" onclick="liveValidation()" class="btn">Proses</a>
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