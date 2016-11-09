
<?php
session_start();

$count=$_SESSION['carrello'];


$cars = $_SESSION['cart-array'];


$i=0;

while($i<$count){
echo "Index: ".$i." Idprod: ".$cars[$i]['idprod']." quantita ".$cars[$i]['quantity'].'<br>';
	$i++;
	
}

 // echo $cars[0]['idprod']." quantita ".$cars[0]['quantity'];



//print_r(array_values( $_SESSION['cart-array'] ));

/*$array=$_SESSION['cart-array'];
print_r("cart-array             ");
print_r($array);*/


?>
