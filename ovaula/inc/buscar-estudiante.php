<?php 
	include 'funciones.php';
	//header('Content-Type: text/javascript; charset=utf8');
	$key=$_POST['key'];
	buscar($key);

	function buscar($tecla){
		$conexion=new bd();
		$mostrar=new mostrar();
		$generar=new generar_consulta();
		session_start();
		$institucion=$_SESSION['institucion'];
		$sentencia="SELECT id, nombre, apellido FROM estudiante WHERE id LIKE '%$tecla%' OR nombre LIKE '%$tecla%' OR apellido LIKE '%$tecla%' AND cod_institucion='$institucion'";

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