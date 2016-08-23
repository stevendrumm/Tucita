<?php
include 'funciones.php';
$tipo=$_POST['tipo'];
$documento=$_POST['documento'];
$bd=new bd();
if ($bd==true) {
	$arr=array();
	$sql="SELECT DISTINCT TIPDOCUM, NUMDOCUM, APELLIDO1, APELLIDO2, NOMBRE1, NOMBRE2, IPS  FROM fac_m_tarjetero WHERE TIPDOCUM = '".$tipo."' AND NUMDOCUM = '".$documento."'";
	$arr=$bd->buscarPersona($sql);
	echo json_encode($arr);

}

?>