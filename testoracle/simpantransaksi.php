<?php
include "koneksi.php";
$nama = $_POST['pembeli'];
$barang = $_POST['barang'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];

$query='INSERT INTO jual(nojual, tgljual, kodepelanggan)'.
       'VALUES(jual_seq.nextval, sysdate, :pelanggan) returning nojual into :id';

$statemen=oci_parse($conn,$query);

oci_bind_by_name($statemen, ':pelanggan', $nama);
oci_bind_by_name($statemen,":id",$id);

$values = "[";
foreach ($barang as $key => $value) {
	$values = $values + "'" + $id + "','" + $value +"', '"+ $qty[$key] + "', '" + $harga[$key] + "' , '" + $harga[$key] * $qty[$key] + "'";
}
$values = $values + "]";

echo $values;
$query_details='INSERT INTO jualbarang(nojual, kodebarang, qty, hargajual, hargatotal)'.
       'VALUES('+ $values +')';

$statemen_details=oci_parse($conn,$query_details);

oci_execute($statemen);
oci_execute($statemen_details);

oci_commit($conn);
oci_free_statement($statemen);
oci_free_statement($statemen_details);

oci_close($conn);

?>