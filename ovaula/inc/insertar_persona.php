<?php
	include 'funciones.php';
	$conexion=new bd();
	//$imprimeConexion=$conexion->inicializar();
	$mensaje="";
	if (isset($_POST['nom'])) {
		$tipo_id=$_POST['tipo'];
		$identificacion=$_POST['iden'];
		$nombre=$_POST['nom'];
		$apellido=$_POST['ape'];
		$direccion=$_POST['dir'];
		$telefono=$_POST['tel'];
		$correo=$_POST['cor'];
	}else{
		$mensaje="error";
		echo $mensaje;
	}
?>