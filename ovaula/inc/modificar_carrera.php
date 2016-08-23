<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	//$imprimeConexion=$conexion->inicializar();
	$mensaje="";
	if (isset($_POST['actual']) AND isset($_POST['proximo'])) {
		$actual=$_POST['actual'];
		$proximo=$_POST['proximo'];
		$consulta=new generar_consulta();
		$sentencia="SELECT nombre FROM carrera WHERE nombre='$actual'";
		$sql=$consulta->consultar_bd($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$mensaje="no";
			echo $mensaje;
		}else{
			$sentencia="SELECT nombre FROM carrera WHERE nombre='$proximo'";
			$sql=$consulta->consultar_bd($sentencia);
			$num=mysql_num_rows($sql);
			if($num==0){
				$modifica=new modificar();
				$sentencia="UPDATE carrera SET nombre='$proximo' WHERE nombre='$actual'";
				$modifica->modificar_bd($sentencia);
				$mensaje="si";
				echo $mensaje;
			}else{
				$mensaje="ya";
				echo $mensaje;
			}
		}
	}else{
		$mensaje="error";
		echo $mensaje;
	}
?>