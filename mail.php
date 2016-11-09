
<?php
$subject = "Conferma registrazione PlayPizza";
$txt = "Benvenuto in PlayPizza!\n\nLa tua registrazione ha avuto successo.\nProva subito ad ordinare online e buon appetito!!\n\n\nQuesta mail è stata generata in modo automatico.\nNon rispondere!";
$from = "do_not_reply@playpizza.com";
$headers = "From: ".$from; 


mail("harrypulvirenti@gmail.com",$subject,$txt,$headers);

?>
