<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
<script src="jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>
	<title>Transaksi</title>
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

<?php
include ("link.php");
?>

<h2>Transaksi</h2>
<form method="post" action="simpan.php">
<table border="0" width = "50%" cellpadding = "8">
<tr>
	<td>No Jual</td>
	<td> : </td>
	<td><input type="text" name="nojual" style="width:150px;"></td>
</tr>
<tr>
	<td>Tanggal Jual</td>
	<td> : </td>
	<td><input type="text" name="tgljual" style="width:150px;" id="datepicker"></td>
</tr>
<tr>
	<td>Pembeli</td>
	<td> : </td>
	<td><input type="text" name="pembeli" style="width:150px;"></td>
</tr>
<tr>
	<td>Barang</td>
	<td> : </td>
	<td><input type="text" name="barang" style="width:150px;"></td>
</tr>
<tr>
	<td>Harga</td>
	<td> : </td>
	<td><input type="text" name="harga" onkeypress="return isNumberKey(event)" style="width:150px; background: #ccc;" readonly></td>
</tr>
<tr>
	<td>Jumlah</td>
	<td> : </td>
	<td><input type="number" name="qty" onkeypress="return isNumberKey(event)" style="width:150px;"></td>
</tr>
<tr>
<tr>
	<td>Total</td>
	<td> : </td>
	<td><input type="text" name="total" onkeypress="return isNumberKey(event)" style="width:150px; background: #ccc;" readonly></td>
</tr>
	<td colspan="3" align="center">
		<input type="submit" value="Proses">
		<input type="reset" value="Reset">
	</td>
</tr>
</table>
</form>
</body>
</html>
