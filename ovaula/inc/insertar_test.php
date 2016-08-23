<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	//$imprimeConexion=$conexion->inicializar();
	$mensaje="";
	if (isset($_POST['nombre']) AND isset($_POST['asig'])) {
		$nombre=$_POST['nombre'];
		$id_asi=$_POST['asig'];
		$cons=new generar_consulta();
		$sentencia="SELECT id FROM test WHERE descripcion='$nombre' AND id_asignacion='$id_asi'";
		$sql=$cons->consultar_bd($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$insertar=new insertar();
			$consulta=("INSERT INTO test (id, descripcion, fecha, tiempo, id_asignacion) VALUES (NULL,'$nombre',NULL,NULL,'$id_asi')");
			$insertar->insertar_bd($consulta);
			$sent="SELECT id FROM test WHERE descripcion='$nombre' AND id_asignacion='$id_asi'";
			$sql=$cons->consultar_bd($sent);
			$resultado=array();
			while($arr=mysql_fetch_assoc($sql))
		     {
			 	$resultado[]=$arr;
		     }
		     echo json_encode($resultado);
		}else{
			$resultado=array("mensaje"=>"ya");
			echo json_encode($resultado);
		}
	}else{
		$resultado=array("mensaje"=>"error");
		echo json_encode($resultado);
	}
?>