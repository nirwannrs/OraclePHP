<?php
include "koneksi.php";

$idmotor = $_POST['idmotor'];
$nama = $_POST['nama'];
$merk = $_POST['merk'];

$query='INSERT INTO motor(id_motor, nama, merk)'.
       'VALUES( :idmot, :nama, :merk)';

$statemen=oci_parse($conn,$query);

oci_bind_by_name($statemen, ':idmot', $idmotor);
oci_bind_by_name($statemen, ':nama', $nama);
oci_bind_by_name($statemen, ':merk', $merk);

$ror = oci_execute($statemen);

if($ror == true) {
	echo "<script>alert('Data berhasil disimpan');window.location = 'view_motor.php';</script>";
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