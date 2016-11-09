<?php

include("db_connection.php");

	if(isset($_POST['idprod'])){

	$idprod=$_POST['idprod'];
	
	$conn=connect();

	$sql1 = "SELECT * FROM prodotti WHERE idprod='".$idprod."';";
	$pizze = query($conn,$sql1);
	$row = $pizze->fetch_assoc();
	$nomeprod=$row["nomeprod"];
	$ingredienti=$row["ingredienti"];
	$prezzo=$row["prezzo"];
		
	close_connection($conn);
	
	print json_encode(array('nomeprod' => $nomeprod, 'ingredienti' => $ingredienti,'prezzo' => $prezzo ));
	die();
	}	
		

?>