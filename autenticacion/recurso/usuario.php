<?php 

	
	//phpinfo();
	
	$serverName = "190.14.241.42, 1433";

	$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");

	$conn=sqlsrv_connect($serverName, $connectionInfo);

	if($conn){
		
		//echo "Conexion establecida"."</br>";

		$tipodocumento= $_POST['tipo'];
		$numerodocumento= $_POST['documento'];
		
		$sql = "SELECT DISTINCT TIPDOCUM, NUMDOCUM, APELLIDO1, APELLIDO2, NOMBRE1, NOMBRE2  FROM fac_m_tarjetero WHERE TIPDOCUM = ".$tipodocumento." AND NUMDOCUM = '".$numerodocumento."'";
  		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$success = sqlsrv_query( $conn, $sql , $params, $options );	
		
		
		if($success){
			 
			//echo "todo bien";
			//echo sqlsrv_num_rows($success);
			if(sqlsrv_num_rows($success) != 0){
				//echo "todo bien";
				
				$obj = sqlsrv_fetch_array($success,SQLSRV_FETCH_ASSOC);

				$obj['TIPDOCUM'] = (String) $obj['TIPDOCUM'];
				
				echo json_encode($obj);
				
				sqlsrv_free_stmt( $success);
			}else{
				//echo "todo mal";
			}
			
		}
		else{
			//echo "todo mal";
		}	
		

	}else{
		//echo "Conexion muerta";
		
		die(print_r(sqlsrv_errors(), true));

	}

?>
