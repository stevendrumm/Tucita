<?php
$serverName = "190.14.241.42, 1433";

	$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");

	$conn=sqlsrv_connect($serverName, $connectionInfo);

	if($conn){
		$arr = array();

		$fecha = $_POST["FECHA"];
		$centroproduccion = $_POST['CENTROPRODUCCION'];
		$tipo = $_POST["TIPO"];
		$documento = $_POST["DOCUMENTO"];
		$primernombre = $_POST["PRIMERNOMBRE"];
		$segundonombre = $_POST["SEGUNDONOMBRE"];
		$primerapellido = $_POST["PRIMERAPELLIDO"];
		$segundoapellido = $_POST["SEGUNDOAPELLIDO"];
		$codigo = $_POST["CODIGO"];

		$sql="SELECT COUNT(*) AS NUMERO FROM fac_m_citas WHERE CONVERT(DATE, FECHA)  = CAST(CONVERT(datetime, '".$fecha."',101) as DATE) AND TIPDOCUM = '$tipo' AND NUMDOCUM = '$documento' AND CENTROPROD = '$centro'";

		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$success = sqlsrv_query( $conn, $sql , $params, $options );	
		

		if($success){
			
			$num_count = sqlsrv_get_field($success,0);
			if($num_count > 0){
				/*
				$sql = "UPDATE fac_m_citas SET FECHA_SOLICITUD = GETDATE(), CENTROPROD = '".$centroproduccion."', ESTADO = 1, HISTORIA='$documento', TIPDOCUM ='$tipo', NUMDOCUM = '$documento', NOMBRE1 = '$primernombre', APELLIDO1 = '$primerapellido'  WHERE FECHA = CONVERT(datetime, '".$fecha."',121) AND CODIGO = '".$codigo."'"; 
				$success = sqlsrv_query($conn, $sql);

				if($success){
					
					if(sqlsrv_rows_affected($success) != 0){
						$arr = array('mensaje'=>'La cita fue asignada con exito para el dia '.$fecha);
					}
					else{
						$arr = array('mensaje'=>'La cita no pudo ser asignada');
					}	
				}
				else{
					$arr = array('mensaje'=>'error de consulta');

				}
				*/
				$arr = array('mensaje'=>'$num_count');
				echo json_encode($arr);
				sqlsrv_free_stmt( $success);
			
			}
			else{
				$arr = array('mensaje' =>'La cita no pudo ser asignada, para este dia no se puede reservar mas de una cita');
				echo json_encode($arr);
				sqlsrv_free_stmt($success);
			}



			}
		}else{
		
		echo "Conexion muerta";
		
		die(print_r(sqlsrv_errors(), true));

		}
	
	

?>