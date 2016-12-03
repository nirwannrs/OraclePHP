<?php
include "koneksi.php";

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$query='BEGIN insert_pelanggan(:nama, :alamat); END;';

$statemen=oci_parse($conn,$query);

oci_bind_by_name($statemen, ':nama', $nama);
oci_bind_by_name($statemen, ':alamat', $alamat);

$ror = oci_execute($statemen);

if($ror == true) {
	echo "<script>alert('Data berhasil disimpan');window.location = 'view_pelanggan.php';</script>";
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