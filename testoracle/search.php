<?php
$term = $_GET['term'];
include ("koneksi.php");
$query="select * from barang where kodebarang = :kodebarang";
$statemen=oci_parse($conn,$query);
oci_bind_by_name($statemen, ':kodebarang', $term);

oci_execute($statemen);
?>

<?php
    $emparray = array();
while($baris=oci_fetch_assoc($statemen))
{ 
	$emparray[] = $baris;
}
    echo json_encode($emparray);

oci_free_statement($statemen);
oci_close($conn);
?>
