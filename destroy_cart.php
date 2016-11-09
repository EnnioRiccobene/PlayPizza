<?php session_start();

$_SESSION['carrello'] = 0;
unset( $_SESSION['cart-array'] );


print json_encode(array('message' => $_SESSION['carrello']));
die();


?>