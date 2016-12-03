<?php
include "koneksi.php";

$namabarang = $_POST['nama'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];

if (empty($namabarang))
{
		echo "<script>alert('Data tidak boleh kosong!');window.location = 'view_barang.php';</script>";
}else if(empty($stok)){
	echo "<script>alert('Data tidak boleh kosong!');window.location = 'view_barang.php';</script>";
}else if(empty($harga)){
	echo "<script>alert('Data tidak boleh kosong!');window.location = 'view_barang.php';</script>";
}else{

$query='BEGIN Insert_barang(:nama, :stok, :harga, 1); END;';

$statemen=oci_parse($conn,$query);

oci_bind_by_name($statemen, ':nama', $namabarang);
oci_bind_by_name($statemen, ':stok', $stok);
oci_bind_by_name($statemen, ':harga', $harga);

$ror = oci_execute($statemen);

if($ror == true) {
	echo "<script>alert('Data berhasil disimpan');window.location = 'view_barang.php';</script>";
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
}
?>