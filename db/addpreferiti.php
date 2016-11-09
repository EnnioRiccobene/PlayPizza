<?php

include("db_connection.php");

session_start();
					
		
	
	if(isset($_SESSION['idutente'])&&isset($_POST['idprod'])){
		$conn=connect();
		$sql3 = "insert into preferiti
							values (NULL, '".$_SESSION['idutente']."',' ".$_POST['idprod']."');";
					$result = query($conn,$sql3);

		close_connection($conn);
	}
					
		

?>