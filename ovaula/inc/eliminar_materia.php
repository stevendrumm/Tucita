<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$mensaje="";
	if (isset($_POST['actual'])) {
		$actual=$_POST['actual'];
		$consulta=new generar_consulta();
		$sentencia="SELECT nombre FROM materia WHERE nombre='$actual'";
		$sql=$consulta->consultar_bd($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$mensaje="no";
			echo $mensaje;
		}else{
			$modifica=new modificar();
			$sentencia="DELETE FROM materia  WHERE nombre='$actual'";
			$modifica->modificar_bd($sentencia);
			$mensaje="si";
			echo $mensaje;
		}
	}else{
		$mensaje="error";
		echo $mensaje;
	}
?>