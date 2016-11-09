<?php include 'template/head.php';?>
<?php include 'template/header.php';?>

<!--Se l'utente non è registrato:

<h2>Bisogna <a href="register.php">registrarsi</a> per poter ordinare online e accedere al carrello</h2>

se il carrello è vuoto visualizzare:

<p>Il carrello è vuoto.</p>

Se tutto va bene:
-->
<?php 

	include("db/db_connection.php");

$carrello="";
$count=0;
$user="";
$descr="";

if(isset($_SESSION['carrello'])!=""&&$_SESSION['carrello']>0)
{
	$carrello="Carrello";
	$count= $_SESSION['carrello'];

}else{
	 $carrello="Il Carrello è Vuoto.";
}



if(isset($_SESSION['name'])!=""){
	
	$conn=connect();

$sql = "SELECT * FROM utente WHERE idutente='".$_SESSION['idutente']."'";
$result = query($conn,$sql);
$user=$result->fetch_assoc();
close_connection($conn);
	
	
	
	
	
}





?>

<h2 style="color:black"><b><?php echo $carrello;?></b></h2>
<br><br>





<?php 

$tot=0;

if($count>0){


$conn=connect();

$sql = "SELECT idprod, nomeprod FROM prodotti";
$pizze = query($conn,$sql);

close_connection($conn);
	
	
	
	
	
	$array=$_SESSION['cart-array'];
	
	
	
	$table='<div class="table">
	<table id="t01">
		<tr>
			<th style="border-top-left-radius: 2em;">Quantità</th>
			<th>Pizza</th>
			<th>Prezzo di Listino</th>
			<th>Supplementi</th>
			<th style="border-top-right-radius: 2em;">Totale</th>
		</tr>';
	
	
	$i=0;
	
	while($i<$count){
		$row=$array[$i];
		
		$descr.=getName($row['idprod'],$pizze)." Supplementi: ".$row['supp']." Costo: ".($row['price']*$row['quantity']+0.5*$row['supp'])."\xA";
		
		$table.='<tr>
			<td><button type="button" onclick="Remove(\''.$i.'\')" style="border:none; background-color:transparent; float:left; border-radius:100%; cursor: pointer; outline-color: transparent;"><span class="glyphicon glyphicon-remove"></span></button>
			<input type="number" name="quantity" value="'.$row['quantity'].'" style="text-align:center; border:none; background-color:transparent;"></td>
			<td>'.getName($row['idprod'],$pizze).'</td>
			<td>'.$row['price'].'</td>
			<td>'.$row['supp'].'</td> 
			<td>'.($row['price']*$row['quantity']+0.5*$row['supp']).'</td>
		</tr>';
		$tot+=$row['price']*$row['quantity']+0.5*$row['supp'];
		$i++;
		
	}
	
	$table.='		<tr>
			<td style="border-color:transparent; background-color:white;"></td>
			<td style="border-color:transparent; background-color:white;"></td>
			<td style="border-color:transparent; background-color:white;"></td>
			<th style="text-align:right; border-bottom-left-radius: 2em;">TOTALE</th>
			<td style="text-align:center; border-bottom-right-radius: 2em;"><b>'.$tot.'</b></td> <!--ci va la somma dei vari totali-->
		</tr>
			
	</table>
	<br><br>
	
	   <script type="text/javascript">
    function Remove(row){
			  var cartcount=0;
  var dataString="";
  
       $.ajax({
            type: "POST",
      async: false,
            url: "get_cart.php",
            data: dataString,
            dataType: \'json\',
            cache: false,
            success: function(response) {

                    cartcount=response.count;

                }
        });
		
  
 
  dataString = {cartcount:cartcount,rem:row};

  
   $.ajax({

            type: "POST",
			async: false,
            url: "remrow_cart.php",
            data: dataString,
            dataType: \'json\',
            cache: false,
            success: function(response) {
          var badge = document.getElementById("badge");
          badge.textContent=response.count;
			
		  window.location.reload();
		  
		  
                }
        });
			
			
	} 
	
	function Destroy(){
		 var dataString="";
		
		   $.ajax({

            type: "POST",
			async: false,
            url: "destroy_cart.php",
            data: dataString,
            dataType: \'json\',
            cache: false,
            success: function(response) {
			
		  window.location.reload();
		  
		  
                }
        });
		
		
		
		
	}
	
		function Login(){

		
		window.location="formlogin.php";
		
		
		
		
	}
	
	
	
    </script>
	
	
	';
	
	
	
	echo $table;
	
	if(isset($_SESSION['name'])!="")
{
	
	echo '	<button type="button" onclick="Destroy()" id="btnbox" style="float:right;">Svuota Carrello</button>
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="float:right; margin-right:50px; border:none; outline-color:transparent;">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="payment@playpizza.it">

<input type="hidden" name="cmd" value="_ext-enter">
<input type="hidden" name="redirect_cmd" value="_xclick">

  <!-- USERS INFO -->
<input type="hidden" name="email" value="'.$user['email'].'">
<input type="hidden" name="first_name" value="'.$user['nomeu'].'">
<input type="hidden" name="last_name" value="'.$user['cognomeu'].'">
<input type="hidden" name="city" value="'.$user['cittau'].'">
<input type="hidden" name="address1" value="'.$user['indirizzo'].' '.$user['civ'].'">
<input type="hidden" name="zip" value="'.$user['cap'].'">
<input type="hidden" name="no_shipping" value="1">


  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="'.$descr.'">
  
  
  
  
  <input type="hidden" name="amount" value="'.$tot.'">
  <input type="hidden" name="currency_code" value="EUR">
  
  
  <input type="hidden" name="return" value="http://localhost/siti/playpizza/confermaordine.php">
<input type="hidden" name="cancelreturn" value="http://localhost/siti/playpizza/index.php">
<input type="hidden" name="notify_url" value="http://localhost/siti/playpizza/confermaordine.php">
  

  <!-- Display the payment button. -->
  <input style="border:none; outline-color:transparent;" type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
  alt="PayPal - The safer, easier way to pay online">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>	
<br><br>';


/*

	echo '	<button type="button" onclick="Destroy()" id="btnbox" style="float:right;">Svuota Carrello</button>
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="float:right; margin-right:50px;">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="payment@playpizza.it">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="Pizze PlayPizza">
  <input type="hidden" name="amount" value="'.$tot.'">
  <input type="hidden" name="currency_code" value="EUR">

  <!-- Display the payment button. -->
  <input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
  alt="PayPal - The safer, easier way to pay online">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>	
<br><br>';


*/

}else{
		echo '	<button type="button" onclick="Login()" id="btnbox" style="float:right;">  Login  </button>
		<br><br>';
	
}
	
}


function getName($id,$db){
	$name="";
	$db->data_seek(0);
	
	while($row = $db->fetch_assoc()){
		if($id==$row['idprod']){
			$name=$row['nomeprod'];
			break;
		}
		
	}
	
	return $name;
}




?>









		
		
	
</div>







<?php

/*
$session=false;

if(isset($_SESSION['name'])!="")
{
 $session=true;
}


include("db/db_connection.php");


$conn=connect();

$sql = "SELECT * FROM utente";
$result = query($conn,$sql);

close_connection($conn);

$indirizzoErr = $civErr = "";
$indirizzo = "$row.indirizzo"; 
$civ = "$row.civ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$error=false;
	
	if (empty($_POST["indirizzo"])) {
    $indirizzoErr = "Inserire l'indirizzo";
	$error=true;
  } else {
    $indirizzo = test_input($_POST["indirizzo"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$indirizzo)) {
      $indirizzoErr = "Only letters and white space allowed"; 
	  $error=true;
    }
  }
  
  if (empty($_POST["civ"])) {
    $civErr = "Inserire il numero civico";
	$error=true;
  } else {
    $civ = test_input($_POST["civ"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9 ]*$/",$civ)) {
      $civErr = "Only numbers allowed";
		$error=true;	  
    }
  }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'"> 
Indirizzo di Spedizione: <input type="text" name="indirizzo" value="'.$indirizzo.'">
  <span class="error">  '.$indirizzoErr.' </span>
  
Numero Civico: <input type="number" name="civ" value="'.$civ.'">
  <span class="error">  '.$civErr.' </span>
  
  <br><br>
  <input type="submit" name="submit" value="Ordina" id="buttonform">  
</form>
<br><br>
'*/
?>

<!--i campi indirizzo e civ devono essere precompilati con i dati dell'utente presi dal db ma è possibile modificarli
al click su ordina vanno aggiornate le tabelle del db relative all'ordine; deve partire il pagamento con paypal; si svuota il carrello; 
da decidere se notificare i qualche modo a dipendente e admin che hanno ricevuto un ordine, oppure lasciamo a loro la libertà di controllare dalle loro pagine 
il db
-->

<?php include 'template/footer.php';?>	