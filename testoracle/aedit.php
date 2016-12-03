<?php
include "koneksi.php";

$kdbar = $_GET['barang'];
$nama = $_POST['nama'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];

/* $query = "UPDATE barang SET nama=:nama, stok=:stok, harga=:harga WHERE kodebarang=:kdbar"; */
$query = "BEGIN update_barang(:kdbar, :nama, :stok, :harga); END;";

$statemen=oci_parse($conn,$query);

oci_bind_by_name($statemen, ':kdbar', $kdbar);
oci_bind_by_name($statemen, ':nama', $nama);
oci_bind_by_name($statemen, ':stok', $stok);
oci_bind_by_name($statemen, ':harga', $harga);

oci_execute($statemen);

if(oci_execute($statemen) == true){
	echo "<script>alert('Data berhasil diubah');window.location = 'view_barang.php';</script>";
}else{
	echo "<script>alert('Data gagal diubah');window.location = 'aedit.php?barang=".$_GET['barang']."';</script>";
}
?>