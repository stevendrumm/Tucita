<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$mensaje="";
	if (isset($_POST['materia'])) {
		$materia=$_POST['materia'];
		$pensum=$_POST['pensum'];
		$consulta=new generar_consulta();
		$sentencia="SELECT id_semestre, id_materia FROM pensum WHERE id_semestre='$pensum' AND id_materia='$materia'";
		$sql=$consulta->consultar_bd($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$insertar=new insertar();
			$consulta=("INSERT INTO pensum (id, id_semestre, id_materia) VALUES (NULL,'".$pensum."','".$materia."')");
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