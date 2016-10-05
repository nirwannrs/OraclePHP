<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
<link rel="stylesheet" type="text/css" href="datatable.css">
<script src="jquery.js"></script>
<script src="jquery-datatable.js"></script>
<script src="jquery-ui.js"></script>
<script type="text/javascript" src="transaksi.js"></script>
	<title>Faktur Penjualan</title>

	<style>
	body {
	font-family: Arial, Helvetica, sans-serif;
}

table {
	font-size: 1em;
}

.ui-draggable, .ui-droppable {
	background-position: top;
}
#tabel
{
font-size:25px !important;
border-collapse:collapse;
}
#tabel  td
{
border: 1px solid black;
width: 200px;
}
#transaksi{
	font-size: 25px !important;
}
</style>
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

  <?php
include ("koneksi.php");
$query="select * from pelanggan order by kodepelanggan";
$statemen=oci_parse($conn,$query);
oci_execute($statemen);
?>
<div id="tablePelanggan">
<br>
<br>
<h2>Pilih Pelanggan</h2>
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
echo "<td><a href = '#' onclick=bukaTransaksi('".$baris['0']."','".$nama."','".$baris['2']."');><button> Buat Transaksi </button></a>";
echo "</tr>";
}
?>
</tbody> 
</table>
<br>
<?php 
oci_free_statement($statemen);
oci_close($conn);
?>
</div>

<div id="transaksi" style="display: none;">
<center><table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top; font-size:10pt'>
<span style='font-size:25pt'><b>Toko S.M.T</b></span></br>Jalan Dago No.128 Bandung</br>Telp : 0594094545
</td>
<td style='vertical-align:top' width='30%' align='left'>
<b><span style='font-size:12pt'>FAKTUR PENJUALAN</span></b></br>
No Trans. : 1</br>
Tanggal :5 Oktober 2016</br>
</td>
</table>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td  align='left' style='padding-right:80px; vertical-align:top'>
<br>
<p>Nama Pelanggan : <p id="namapelanggan"></p></p>
<p>Alamat : <p id="alamatpelanggan"></p></p>
</td>
<td style='vertical-align:top' width='30%' align='left'>
<br>
No Telp : -
</td>
</table>

<form method="post" action="simpan.php">
	<table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
	<input type="hidden" name="pembeli" style="width:150px;" id="idpelanggan">
	<tr align='center'>
	<td width='10%'>Kode Barang</td>
	<td width='20%'>Nama Barang</td>
	<td width='13%'>Harga</td>
	<td width='4%'>Qty</td>
	<td width='13%'>Total Harga</td>
	<tr id="barang-1">
		<td><input type="text" name="barang-1" id="tags-1"></td>
		<td id="nama-1"> </td>
		<td> <input type="text" name="harga-1" id="harga-1" readonly>  </td>
		<td><input type="text" name="qty-1" style="width:150px;" id="qty-1" onkeypress="return isNumberKey(event)"></td>
		<td id="total-1" style='text-align:right' class="subTotal"></td>
		<td width="auto"><a href="#" onclick="addBarang(2)" style="text-decoration: none" class="btn"> Add</a> | <a href='remove' class="btn">Remove</a></td>
	</tr>

	<tr>
		<td colspan = '5'>
		<div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div>
		</td>
		<td style='text-align:right' id="allTotal">0</td>
	</tr>
	</table></center>
	</div>
</form>

  <div id="transaksi2" style="display:none;">
<div>
	<p id="namapelanggan"></p>
	<p id="alamatpelanggan"></p>
</div>

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
  </div>
</body>
</html>