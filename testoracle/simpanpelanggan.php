<?php
include "koneksi.php";

$kdpelanggan = $_POST['kdpelanggan'];
$nama = $_POST['namapelanggan'];
$alamat = $_POST['alamat'];

$query='INSERT INTO pelanggan(kodepelanggan, namapelanggan, alamat)'.
       'VALUES( :kdpel, :nama, :alamat)';

$statemen=oci_parse($conn,$query);

oci_bind_by_name($statemen, ':kdpel', $kdpelanggan);
oci_bind_by_name($statemen, ':nama', $nama);
oci_bind_by_name($statemen, ':alamat', $alamat);

$ror = oci_execute($statemen);

if($ror == true) {
	echo "<script>alert('Data berhasil disimpan');window.location = 'addpelanggan.php';</script>";
}
else {
	$e = oci_error();
	print htmlentities($e['message']);
	echo "<hr>";
	echo "<a href = 'addpelanggan.php'><b> <- Kembali </a>";
	echo "<script>alert('Data gagal disimpan')</script>";
}
oci_commit($conn);
oci_free_statement($statemen);

oci_close($conn);

?>