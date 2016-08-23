<?php
include 'funciones.php';
$centro=$_POST['centro'];
$fecha=$_POST['fecha'];
$bd=new bd();
if ($bd==true) {
	$arr=array();
	$sql="SELECT DISTINCT PRO.NOMBRE AS NOMBRE, CITA.CODIGO AS CODIGO FROM fac_p_profesional AS PRO, fac_p_rx_profcprod AS CENPRO, fac_m_citas AS CITA WHERE CENPRO.CODIGO='".$centro."' AND	CENPRO.PROFESIONAL=PRO.CODIGO AND CITA.CODIGO=PRO.CODIGO AND CITA.CENTROPROD IS NULL AND CONVERT(DATE, CITA.FECHA) = '".$fecha."' ORDER BY CITA.CODIGO";
	$arr=$bd->queryPerson($sql);
	//var_dump($arr);
	echo json_encode($arr);

}

?>