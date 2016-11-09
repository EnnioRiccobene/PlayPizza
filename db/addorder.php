<?php
session_start();

	include("db_connection.php");
	
	
	if(isset($_POST['order'])&&isset($_SESSION['cart-array'])){
	
	$count= $_SESSION['carrello'];
	$order=$_POST['order'];
	$array=$_SESSION['cart-array'];
	$tot=0;
	
	$i=0;
	
	while($i<$count){
		$row=$array[$i];
		$tot+=$row['price']*$row['quantity']+0.5*$row['supp'];
		$i++;
		
	}
	
	$conn=connect();

	$sql = "insert into ordini
		values (NULL, '".$order."', CURDATE(), CURTIME(),".$tot.", ".$_SESSION['idutente'].");";
	query($conn,$sql);
	
	
	$sql1="SELECT idor , nordine FROM ordini WHERE nordine='".$order."'";
	$result=query($conn,$sql1);
	$row=$result->fetch_assoc();
	$idord=$row['idor'];
	
	$array=$_SESSION['cart-array'];
	
	$i=0;
	
	while($i<$count){
		$row=$array[$i];
		$sql2="";
		$sql2="insert into prodordinato values (NULL, ".$row['quantity'].", ".$row['idprod'].", ".$idord.");";
			
			
		query($conn,$sql2);
			
			
		$i++;
		
	}
	

	
	

	close_connection($conn);  

	}



?>

