<?php
session_start();

if(isset($_SESSION['email'])&&isset($_POST['order'])){

$subject = "Conferma Ordine PlayPizza";
$txt = "Gentile cliente,\n\nLa ringraziamo di aver utilizzato il nostro servizio. Il suo ordine numero: ".$_POST['order']." è stato ricevuto con successo e sarà pronto al più presto.\nBuon appetito!!\n\n\nQuesta mail è stata generata in modo automatico.\nNon rispondere!";
$headers = "From: Play Pizza <do_not_reply@playpizza.com>\r\n";

mail($_SESSION['email'],$subject,$txt,$headers);
	
}

?>