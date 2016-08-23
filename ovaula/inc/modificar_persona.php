<?php
include 'funciones.php';
	$conexion=new conexion_bd();
	//$imprimeConexion=$conexion->inicializar();
	$mensaje="";
	if (isset($_POST['nom'])) {
		$tabla=$_POST['ta'];
		$ti_or=$_POST['or_t'];
		$id_or=$_POST['or_id'];
		$cor_or=$_POST['or_cor'];
		$tipo_id=$_POST['tipo'];
		$identificacion=$_POST['iden'];
		$nombre=$_POST['nom'];
		$apellido=$_POST['ape'];
		$direccion=$_POST['dir'];
		$telefono=$_POST['tel'];
		$correo=$_POST['cor'];
		$rol=$_POST['rol'];
		$persona=new persona();
		$mensaje=$persona->modificar($tabla,$ti_or,$id_or,$cor_or,$tipo_id,$identificacion,$nombre,$apellido,$direccion,$telefono,$correo,$rol);
		echo $mensaje;
	}else{
		$mensaje="error";
		echo $mensaje;
	}
?>