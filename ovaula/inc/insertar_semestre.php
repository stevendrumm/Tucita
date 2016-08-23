<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	//$imprimeConexion=$conexion->inicializar();
	$mensaje="";
	if (isset($_POST['car'])) {
		$carrera=$_POST['car'];
		$semestre=$_POST['sem'];
		$consulta=new generar_consulta();
		$sentencia="SELECT id_carrera, semestre FROM semestre WHERE id_carrera='$carrera' AND semestre='$semestre'";
		$sql=$consulta->consultar_bd($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$insertar=new insertar();
			$consulta=("INSERT INTO semestre (id, id_carrera, semestre) VALUES (NULL,'".$carrera."','".$semestre."')");
			$insertar->insertar_bd($consulta);
			$mensaje="si";
			echo $mensaje;
		}else{
			$mensaje="no";
			echo $mensaje;
		}
	}else{
		$mensaje="error";
		echo $mensaje;
	}
?>