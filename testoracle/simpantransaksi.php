<?php
include "koneksi.php";
$kdnama = $_POST['pembeli'];
$barang = $_POST['barang'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$total = $_POST['totalharga'];
$stok = $_POST['stok'];

$query='INSERT INTO jual(nojual, tgljual, totalfaktur, kodepelanggan)'.
       'VALUES(jual_seq.nextval, sysdate, :total, :kode) returning nojual into :id';

$statemen=oci_parse($conn,$query);


oci_bind_by_name($statemen, ':total', $total);
oci_bind_by_name($statemen, ':kode', $kdnama);
oci_bind_by_name($statemen, ':id', $id);

oci_execute($statemen);


foreach ($barang as $key => $value){
$query_details='INSERT INTO jualbarang(nojual, kodebarang, qty, hargajual, hargatotal)'.
       'VALUES(:id, :barang, :qty, :harga, :total)'; 

$query_child='UPDATE barang SET stok = :stok where kodebarang = :parent_id';

$statemen_details=oci_parse($conn,$query_details);
$query_child=oci_parse($conn, $query_child);

$subtotal = ($harga[$key]*$qty[$key]);
$newStok = $stok[$key] - $qty[$key];
$idBarang = $barang[$key];

oci_bind_by_name($statemen_details, ':id', $id);
oci_bind_by_name($statemen_details, ':barang', $idBarang);
oci_bind_by_name($statemen_details, ':qty', $qty[$key]);
oci_bind_by_name($statemen_details, ':harga', $harga[$key]);
oci_bind_by_name($statemen_details, ':total', $subtotal);
oci_bind_by_name($query_child, ':stok', $newStok);
oci_bind_by_name($query_child, ':parent_id', $idBarang);

oci_execute($statemen_details);
oci_execute($query_child);
}


oci_free_statement($statemen);
oci_free_statement($statemen_details);

oci_commit($conn);

echo "<script>alert('Data berhasil disimpan');window.location = 'transaksi.php';</script>";

/* $values = "[";
foreach ($barang as $key => $value) {
	$values = $values + "'" + $id + "','" + $value +"', '"+ $qty[$key] + "', '" + $harga[$key] + "' , '" + $harga[$key] * $qty[$key] + "'";
}
$values = $values + "]";

echo $values;
$query_details='INSERT INTO jualbarang(nojual, kodebarang, qty, hargajual, hargatotal)'.
       'VALUES('+ $values +')';


oci_close($conn);
*/

?>