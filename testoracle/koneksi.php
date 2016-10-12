<?php
$conn = oci_connect('dbbarang', '1234', '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)) (CONNECT_DATA=(SERVER=DEDICATED) (SERVICE_NAME = XE)))');
if (!$conn){
$e = oci_error();
print htmlentities($e['message']);
exit;
}
?>