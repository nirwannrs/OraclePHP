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
$nojual = $_GET['data'];
include ("koneksi.php");
$query="select * from jualbarang where nojual=$nojual";
$statemen=oci_parse($conn,$query);
oci_execute($statemen);
include ("link.php"); 
?>
<br>
<h2>Data Transaksi</h2>


<table border="1" width = "100%" cellpadding = "6" id="table_id" class="display"> 
  <thead>
  <tr>
    <th><b>No Jual</th>
    <th><b>Kode Barang</th>
    <th><b>Quantity</th>
    <th><b>Harga Jual</th>
    <th><b>Harga Total</th>
  </tr>
  </thead>
  <tbody>
<?php
while($baris=oci_fetch_array($statemen))
{ 
echo "<tr>";
$nama = str_replace(" ", "_", $baris['1']);
echo "<td>".ucwords($baris['0'])."</td>";
echo "<td>".ucwords($baris['1'])."</td>";
echo "<td>".ucwords($baris['2'])."</td>";
echo "<td>".ucwords($baris['3'])."</td>";
echo "<td>".ucwords($baris['4'])."</td>";
echo "</tr>";
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

<br>
<hr> 
</body>
</html>