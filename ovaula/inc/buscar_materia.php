<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$key=$_POST["key"];
	if (!empty($key)){
		buscar($key);
	}

	function buscar($tecla){
		$sentencia=mysql_query("SELECT id, nombre FROM materia WHERE nombre LIKE '%$tecla%'");
			$num_rows=mysql_num_rows($sentencia);
			if ($num_rows==0) {
				$producto=array("mensaje"=>"no");
				echo json_encode($producto);
			}else{
				$producto=array();
				while ($arr=mysql_fetch_assoc($sentencia)) {
					$producto[]=$arr;
				}
				echo json_encode($producto);
			}
	}
?>