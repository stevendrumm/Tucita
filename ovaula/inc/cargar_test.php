<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$cons=new generar_consulta();
	$mostrar=new mostrar();
	$cor=$_POST['correo'];
	$sentencia="SELECT id FROM docente WHERE correo='$cor'";
	$sql=$mostrar->consultar_bd($sentencia);
	$arg=$mostrar->mostrar_bd($sql);
	$id=$arg['id'];
	$sentencia="SELECT id FROM asignacion WHERE id_docente='$id'";
	$sql=$mostrar->consultar_bd($sentencia);
	$result=array();
	while ($arg=mysql_fetch_array($sql)) {
		$result[]=$arg;
	}
	$num_row=mysql_num_rows($sql);
	$i=0;
	$resultado=array();
	while ($i < $num_row) {
		$id=$result[$i]['id'];
		$sentencia="SELECT id, descripcion FROM test WHERE id_asignacion='$id'";
		$sql=$mostrar->consultar_bd($sentencia);
		while ($arg=mysql_fetch_array($sql)) {
			$resultado[]=$arg;
		}
		//echo $resultado[$i]['id']."<br>".$resultado[$i]['descripcion']."<br>";
		$i++;
	}
	echo json_encode($resultado);
?>