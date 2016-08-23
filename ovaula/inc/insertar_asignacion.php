<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$mensaje="";
	if (isset($_POST['pensum'])) {
		$pensum=$_POST['pensum'];
		$id=$_POST['id'];
		$consulta=new generar_consulta();
		$sentencia="SELECT id_pensum, id_docente FROM asignacion WHERE id_pensum='$pensum' AND id_docente='$id'";
		$sql=$consulta->consultar_bd($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$insertar=new insertar();
			$consulta=("INSERT INTO asignacion (id, id_pensum, id_docente) VALUES (NULL,'".$pensum."','".$id."')");
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