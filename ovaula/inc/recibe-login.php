<?php
	session_start();
	include 'funciones.php';	
	if((!isset($_SESSION['institucion']) & !isset($_SESSION['usuario'])) & !isset($_SESSION['contrasena'])){
		$conexion=new bd();
		$generar=new generar_consulta();
		$mostrar=new mostrar();
		$institucion=$_POST['institucion'];
		$usuario=$_POST['usuario'];
		$contrasena=$_POST['contrasena'];
		$consulta="SELECT id_institucion FROM usuario WHERE id_institucion='$institucion' AND nick='$usuario' AND password='$contrasena'";
		$numrow_inst=$generar->num_filas($consulta);
		$id_inst=$mostrar->mostrar_bd($consulta);
		$consulta="SELECT id FROM usuario WHERE nick='$usuario'";
		$numrow_user=$generar->num_filas($consulta);
		$id_user=$mostrar->mostrar_bd($consulta);
		$consulta="SELECT id FROM usuario WHERE password='$contrasena'";
		$numrow_pas=$generar->num_filas($consulta);
		$id_pas=$mostrar->mostrar_bd($consulta);
		if(($numrow_inst!=0 AND $numrow_user!=0) AND $numrow_pas!=0){
			if(($id_pas[0]['id']==$id_user[0]['id']) & (!empty($id_inst))){
					$_SESSION['institucion']=$institucion;
					$_SESSION['usuario']=$usuario;
					$_SESSION['contrasena']=$contrasena;
					$_SESSION['id']=$id_user[0]['id'];
					$producto=array("mensaje"=>"si");
					echo json_encode($producto);
			}else{ 
				$producto=array("mensaje"=>"incorrecto");
				echo json_encode($producto);
			}
		}elseif(($numrow_inst==0 AND $numrow_user==0) AND $numrow_pas==0){ 
			$producto=array("mensaje"=>"no");
			echo json_encode($producto);
		}elseif($numrow_inst!=0 || $numrow_user!=0 || $numrow_pas!=0){ 
			$producto=array("mensaje"=>"incorrecto");
			echo json_encode($producto);
		}
	}
?>