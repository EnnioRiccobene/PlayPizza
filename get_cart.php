<?php 
session_start();

	$cartcount=0;
	
	    if(isset($_SESSION['carrello'])!="")
		{
		$cartcount=$_SESSION['carrello'];
		}else{
	 $cartcount=0;
	
		}
	



print json_encode(array('count' => $cartcount));
die();


?>