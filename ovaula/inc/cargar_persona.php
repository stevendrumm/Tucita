<?php
include 'funciones.php';
$conexion=new conexion_bd();
$table=$_POST['t'];
$id=$_POST['result'];
$sentencia=mysql_query("SELECT tipo_id, identificacion, nombre, apellido, direccion, telefono, correo FROM ".$table." WHERE identificacion='$id'");
$num_rows=mysql_num_rows($sentencia);
if ($num_rows==0) {
	$producto=array("mensaje"=>"no");
	echo json_encode($producto);
}else{
	$producto=array();
	while ($arr=mysql_fetch_assoc($sentencia)) {
		$producto[]=$arr;
	}
	echo json_encode($producto);
}
?>