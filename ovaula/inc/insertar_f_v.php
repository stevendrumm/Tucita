<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	//$imprimeConexion=$conexion->inicializar();
	$mensaje="";
	if (isset($_POST['respuesta'])) {
		$desc=$_POST['descripcion'];
		$respuesta=$_POST['valor'];
		$test=$_POST['test'];
		$valor=$_POST['respuesta'];
		$cons=new generar_consulta();
		$sentencia="SELECT id FROM pregunta WHERE descripcion='$desc' AND tipo_pregunta='$respuesta' AND id_test='$test'";
		$sql=$cons->consultar_bd($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$insertar=new insertar();
			$consulta=("INSERT INTO pregunta (id, tipo_pregunta, descripcion, id_test) VALUES (NULL,'$respuesta','$desc','$test')");
			$insertar->insertar_bd($consulta);
			$sentencia="SELECT id FROM pregunta WHERE descripcion='$desc' AND tipo_pregunta='$respuesta' AND id_test='$test'";
			$sql=$cons->consultar_bd($sentencia);
			$mostrar=new mostrar();
			$resultado=$mostrar->mostrar_bd($sql);
		     $id_pre=$resultado['id'];
		     $consulta=("INSERT INTO respuesta (id, descripcion, id_pregunta) VALUES (NULL,'$valor','$id_pre')");
			$insertar->insertar_bd($consulta);
			$resultado=array("mensaje"=>"$consulta");
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