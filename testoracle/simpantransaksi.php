<?php
include "koneksi.php";
$kdnama = $_POST['pembeli'];
$barang = array($_POST['barang']);
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$total = $_POST['totalharga'];
$counterbarang = count($barang);

$query='INSERT INTO jual(nojual, tgljual, totalfaktur, kodepelanggan)'.
       'VALUES(jual_seq.nextval, sysdate, :total, :kode) returning nojual into :id';

$statemen=oci_parse($conn,$query);


oci_bind_by_name($statemen, ':total', $total);
oci_bind_by_name($statemen, ':kode', $kdnama);
oci_bind_by_name($statemen, ':id', $id);

oci_execute($statemen);


for($x=0;$x<$counterbarang;$x++){
$query_details='INSERT INTO jualbarang(nojual, kodebarang, qty, hargajual, hargatotal)'.
       'VALUES(:id, :barang, :qty, :harga, :total)'; 

$statemen_details=oci_parse($conn,$query_details);

oci_bind_by_name($statemen_details, ':id', $id);
oci_bind_array_by_name($statemen_details, ':barang', $barang, 5, 1, SQLT_INT);
oci_bind_array_by_name($statemen_details, ':qty', $qty, 5, 1, SQLT_INT);
oci_bind_array_by_name($statemen_details, ':harga', $harga, 5, 1, SQLT_INT);
oci_bind_by_name($statemen_details, ':total', $total);


echo "$id, $barang, $qty, $harga";

oci_execute($statemen_details);
}


oci_free_statement($statemen);
oci_free_statement($statemen_details);

oci_commit($conn);

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