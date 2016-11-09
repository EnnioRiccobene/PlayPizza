<?php session_start();
$count=$_POST['cartcount'];

$rem=intval($_POST['rem']);
$cart=$_SESSION['cart-array'];



unset($cart[$rem]);

$cart = array_values($cart);


$_SESSION['cart-array']=$cart;
$count=$count-1;
$_SESSION['carrello']=$count;

print json_encode(array('count' => $count));
die();


?>