<?php session_start();
$count=$_POST['cartcount'];
$update=true;
$idprod=$_POST['idprod'];

if(isset($_SESSION['cart-array'])){
	$cart=$_SESSION['cart-array'];
	
	
$i=0;

while($i<$count){
	$row=$cart[$i];
	if($row['idprod']==$idprod&&$row['supp']=="0"){
	
	$cart[$i]['quantity']+=$_POST['quantity'];

	$update=false;
	break;
}
	$i++;
	
}

if($update){
		$count++;
	$_SESSION['carrello'] = $count;

array_push($cart,array('idprod' => $_POST['idprod'],'quantity'=>$_POST['quantity'],'supp'=>$_POST['supp'],'price'=>$_POST['price']));

}
$_SESSION['cart-array']=$cart;

}
else{
	
	
	
	$count++;
	$_SESSION['carrello'] = $count;
	$_SESSION['cart-array']=array(array('idprod' => $_POST['idprod'],'quantity'=>$_POST['quantity'],'supp'=>$_POST['supp'],'price'=>$_POST['price']));

}



print json_encode(array('count' => $count));
die();


?>