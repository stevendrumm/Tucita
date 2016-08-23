<?php 
	include 'funciones.php';
	//header('Content-Type: text/javascript; charset=utf8');
	$key=$_POST['key'];
	if (!empty($key)){
		buscar($key);
	}

	function buscar($tecla){
		$conexion=new bd();
		$mostrar=new mostrar();
		$generar=new generar_consulta();

		$sentencia="SELECT id, nombre FROM institucion WHERE nombre LIKE '%$tecla%'";

			$num_rows=$generar->num_filas($sentencia);
			if ($num_rows==0) {
				$producto=array("mensaje"=>"no");
				echo json_encode($producto);
			}else{
				$devolver=array();
				$cont=$conexion->query($sentencia);
				while($arr=$cont->fetch_assoc()){
					$devolver[]=array_map('utf8_encode',$arr);//codificar el arreglo para caracteres especiales
				}
				echo json_encode($devolver);
			}
	}
?>