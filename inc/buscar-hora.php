<?php
include 'funciones.php';
$fecha=$_POST['fecha'];
$profesional=$_POST['profesional'];
$bd=new bd();
if ($bd==true) {
	$arr=array();
	$sql="SELECT LEFT(CONVERT(TIME, FECHA, 108),8) AS HORA FROM fac_m_citas WHERE CODIGO='$profesional' AND CENTROPROD IS NULL AND CONVERT(DATE, FECHA) = '$fecha' ORDER BY FECHA";
	$arr=$bd->queryHour($sql);
	echo json_encode($arr);

}

?>