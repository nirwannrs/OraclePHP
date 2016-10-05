<?php
include "koneksi.php";

$kdpel = $_GET['pelanggan'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$query = "UPDATE pelanggan SET namapelanggan=:nama, alamat=:alamat WHERE kodepelanggan=:kdpel";
$statemen=oci_parse($conn,$query);

oci_bind_by_name($statemen, ':kdpel', $kdpel);
oci_bind_by_name($statemen, ':nama', $nama);
oci_bind_by_name($statemen, ':alamat', $alamat);

oci_execute($statemen);

if(oci_execute($statemen) == true){
	echo "<script>alert('Data berhasil diubah');window.location = 'view_pelanggan.php';</script>";
}else{
	echo "<script>alert('Data gagal diubah');window.location = 'editpel.php?pelanggan=".$_GET['pelanggan']."';</script>";
}
?>
