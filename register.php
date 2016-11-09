<?php include 'template/head.php';?>
<?php include 'template/header.php';?>

<?php

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

// define variables and set to empty values
$nameErr = $surnameErr = $emailErr = $pswdErr = $checkpswd = $cittaErr = $provinciaErr = $capErr = $indirizzoErr = $civErr = $telErr = $cellulareErr = "";
$name = $surname = $email = $pswd = $checkpswdErr = $cap = $indirizzo = $civ = $citofono = $tel = $cellulare = "";
$citta = "Catania";
$provincia = "CT";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$error=false;
	
  if (empty($_POST["name"])) {
    $nameErr = "Inserire il nome";
	$error=true;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
	  $error=true;
    }
  }
  
  if (empty($_POST["surname"])) {
    $surnameErr = "Inserire il cognome";
	$error=true;
  } else {
    $surname = test_input($_POST["surname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
      $surnameErr = "Only letters and white space allowed"; 
	  $error=true;
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Inserire l'Email";
	$error=true;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
	  $error=true;
    }
	if(!$error){
	while($row = $result->fetch_assoc()){
		if($email==$row["email"]){
			$emailErr = "Utente Già Registrato"; 
			$error=true;
			break;
		}
		
	}}
  }
    
  if (empty($_POST["pswd"])) {
    $pswdErr = "Inserire la password";
	$error=true;
  } else {
    $pswd = test_input($_POST["pswd"]);
    // check if e-mail address is well-formed
  }
  
  if (empty($_POST["checkpswd"])) {
    $checkpswdErr = "Inserire password";
	$error=true;
  } else{
	  $checkpswd = test_input($_POST["checkpswd"]);
  if ($checkpswd =! $pswd) {

	$checkpswdErr = "Le password non corrispondono"; 
	$error=true;
  }}
	
  if (empty($_POST["citta"])) {
    $cittaErr = "Inserire la città";
	$error=true;
  } else {
    $citta = test_input($_POST["citta"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$citta)) {
      $cittaErr = "Only letters and white space allowed";
	
	$error=true;	  
    }
  }

  if (empty($_POST["provincia"])) {
    $provinciaErr = "Inserire la provincia";
	$error=true;
  } else {
    $provincia = test_input($_POST["provincia"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$provincia)) {
      $provinciaErr = "Only letters and white space allowed"; 
	  $error=true;
    }
  }

  if (empty($_POST["cap"])) {
    $capErr = "Inserire il CAP";
	$error=true;
  } else {
    $cap = test_input($_POST["cap"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9 ]*$/",$cap)) {
      $capErr = "Only numbers allowed"; 
	  $error=true;
    }
  }
  
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
  
  if (empty($_POST["citofono"])) {
    $citofono = null;
  } else {
    $citofono = test_input($_POST["citofono"]);
  }
  
  if (empty($_POST["tel"])) {
    $telErr = "Inserire il numero di telefono";
	$error=true;
  } else {
    $tel = test_input($_POST["tel"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9 ]*$/",$tel)) {
      $telErr = "Only numbers allowed"; 
	  $error=true;
    }
  }
  
    if (empty($_POST["cellulare"])) {
	$cellulare = null;
  } else {
    $cellulare = test_input($_POST["cellulare"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9 ]*$/",$cellulare)) {
      $cellulareErr = "Only numbers allowed";
		$error=true;	  
    }
  }

  if(!$error){
	  	  $conn=connect();

	$sql = "insert into utente (nomeu, cognomeu, email, password, cittau, provincia, cap, indirizzo, civ, citofono, telefono, cellulare)
		values ('".$name."', '".$surname."', '".$email."', '".$pswd."', '".$citta."', '".$provincia."', '".$cap."', '".$indirizzo."', '".$civ."', '".$citofono."', '".$tel."', '".$cellulare."');";
	query($conn,$sql);

	close_connection($conn);  
	
	sendMail($email);
	
	$_SESSION['name'] = $name;
	$_SESSION['valadmin'] = $row['valadmin'];
	$_SESSION['valdip'] = $row['valdip'];
	$_SESSION['valclient'] = $row['valclient'];
	
	$_POST = array();

	header('Location: '.$_SERVER['REQUEST_URI']);
  }
  
  
  }
  
  
  

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function sendMail($mail){

$subject = "Conferma registrazione PlayPizza";
$txt = "Benvenuto in PlayPizza!\n\nLa tua registrazione ha avuto successo.\nProva subito ad ordinare online e buon appetito!!\n\n\nQuesta mail è stata generata in modo automatico.\nNon rispondere!";
$headers = "From: Play Pizza <do_not_reply@playpizza.com>\r\n";

mail($mail,$subject,$txt,$headers);
	
}

?>

<?php

if(!$session){

echo ' <h2 id="register">Play Pizza: Registrazione Utente</h2>
<p><span class="error">* campi obbligatori.</span></p>
<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">  
  Nome: <input type="text" name="name" value=" '.$name.'">
  <span class="error">*  '.$nameErr.'</span>
  
  Cognome: <input type="text" name="surname" value="'.$surname.'">
  <span class="error">*  '.$surnameErr.'</span>
  <br><br>
  E-mail: <input type="email" name="email" value="'.$email.'">
  <span class="error">* '.$emailErr.'</span>
  
  Password: <input type="password" name="pswd" value="'.$pswd.'">
  <span class="error">* '.$pswdErr.'</span>
  
  Ripeti Password: <input type="password" name="checkpswd" value="'.$checkpswd.'">
  <span class="error">*  '.$checkpswdErr.'</span>
  <br><br>
  Città: <input type="text" name="citta" value="'.$citta.'" readonly>
  <span class="error">  '.$cittaErr.'</span>
  
  Provincia: <input type="text" name="provincia" value="'.$provincia.'" readonly>
  <span class="error">  '.$provinciaErr.'</span>
  
  CAP: <input type="number" name="cap" value="'.$cap.'">
  <span class="error">*  '.$capErr.'</span>
  <br><br>
  Indirizzo: <input type="text" name="indirizzo" value="'.$indirizzo.'">
  <span class="error">*  '.$indirizzoErr.' </span>
  
  Numero Civico: <input type="number" name="civ" value="'.$civ.'">
  <span class="error">*  '.$civErr.' </span>
  
  Citofono: <input type="text" name="citofono" value="'.$citofono.'">
  <br><br>
  Telefono: <input type="number" name="tel" value="'.$tel.'">
  <span class="error">*  '.$telErr.'</span>
  
  Cellulare: <input type="number" name="cellulare" value="'.$cellulare.'">
  <span class="error"> '.$cellulareErr.'</span>
  <br><br>
  <input type="submit" name="submit" value="Registra" id="buttonform">  
</form>

<br>
<br>';
}
else{
	echo ' <h2 id="register">Benvenuto su PlayPizza '.$_SESSION['name'].'!!</h2>
	<br>
	<h2 id="register">Effettua il <a href="index.php?logout">LogOut</a> per registrare un nuovo utente.</h2>';
	
	
}
 
 
 ?>



<?php include 'template/footer.php';?>	 