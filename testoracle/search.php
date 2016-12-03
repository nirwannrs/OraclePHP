<?php
$term = $_GET['term'];
include ("koneksi.php");
$query="select * from barang where kodebarang = $term and status = 1";
$statemen=oci_parse($conn,$query);

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
