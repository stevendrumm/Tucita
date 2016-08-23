<?php
$serverName = "190.14.241.42, 1433";

	$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");

	$conn=sqlsrv_connect($serverName, $connectionInfo);

	if($conn){
		$fecha ="";
		$fecha = str_replace("-", "",$_POST['FECHA']);
		$centroproduccion = $_POST['CENTROPRODUCCION'];
		$profesional = $_POST['PROFESIONAL'];
		
		//echo "Conexion establecida"."</br>";
		$sql = "SELECT DISTINCT CONVERT(VARCHAR(19),m.FECHA) AS FECHA,  CONVERT(VARCHAR(30), m.FECHA,108) AS HORA,  m.ESTADO FROM fac_m_citas AS m WHERE m.CENTROPROD IS NULL AND m.CODIGO  LIKE '%".$profesional."%'  AND m.ESTADO IN(0,1) AND DATEPART(DD,m.FECHA) = DATEPART(DD,'".$fecha."')AND DATEPART(MM,m.FECHA) = DATEPART(MM,'".$fecha."')AND DATEPART(YYYY, m.FECHA) = DATEPART(YYYY,'".$fecha."') ORDER BY HORA";
  				
		//echo $sql;
		
  		$params = array();
		$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
		$success = sqlsrv_query( $conn, $sql , $params, $options );	
		
		
		
		if($success){
			$obj = array();
			//echo "todo bien";
			//
			//echo sqlsrv_num_rows($success);
			
			if(sqlsrv_num_rows($success) != 0){
				
					//echo "todo bien";
					
					while($row = sqlsrv_fetch_array($success,SQLSRV_FETCH_ASSOC))
					{
	      				array_push($obj, $row);
					}
					echo json_encode($obj);
					sqlsrv_free_stmt( $success);
				
					//echo "todo mal";
			}
			//
		}
		else{
			echo "todo mal";
		}	
		

	}else{
		
		echo "Conexion muerta";
		
		die(print_r(sqlsrv_errors(), true));

	}
	
	

	?>