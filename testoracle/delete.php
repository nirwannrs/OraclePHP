<?php
include "koneksi.php";

$query="delete from barang where kodebarang ='".$_GET['barang']."'";
$statemen=oci_parse($conn,$query);
oci_execute($statemen);

if(oci_execute($statemen)){
	echo "<script>alert('Data berhasil dihapus');window.location = 'view_barang.php';</script>";
}else{
	echo "<script>alert('Data gagal dihapus');window.location = 'view_barang.php';</script>";
	
oci_free_statement($statemen);
oci_close($conn);
}