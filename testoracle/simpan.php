<?php
include "koneksi.php";

$kdbarang = $_POST['kdbarang'];
$namabarang = $_POST['nama'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];

$query='INSERT INTO barang(kodebarang, nama, stok, harga)'.
       'VALUES( :kdbar, :nama, :stok, :harga)';

$statemen=oci_parse($conn,$query);

oci_bind_by_name($statemen, ':kdbar', $kdbarang);
oci_bind_by_name($statemen, ':nama', $namabarang);
oci_bind_by_name($statemen, ':stok', $stok);
oci_bind_by_name($statemen, ':harga', $harga);

$ror = oci_execute($statemen);

if($ror == true) {
	echo "<script>alert('Data berhasil disimpan');window.location = 'add.php';</script>";
}
else {
	$e = oci_error();
	print htmlentities($e['message']);
	echo "<hr>";
	echo "<a href = 'add.php'><b> <- Kembali </a>";
	echo "<script>alert('Data gagal disimpan')</script>";
}
oci_commit($conn);
oci_free_statement($statemen);

oci_close($conn);

?>