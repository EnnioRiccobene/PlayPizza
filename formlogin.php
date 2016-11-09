<?php include 'template/head.php';?>
<?php include 'template/header.php';?>

<?php



include("db/db_connection.php");

if(isset($_SESSION['name'])!="")
{
 header("Location: index.php");
}


$emailErr = $pswdErr = "";
$email = $pswd = "";
$error=false;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["email"])) {
    $emailErr = "Inserire E-mail";
	$error=true;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
	  $error=true;
    }
  }
    
  if (empty($_POST["pswd"])) {
    $pswdErr = "Inserire Password";
	$error=true;
  } else {
    $pswd = test_input($_POST["pswd"]);
    // check if e-mail address is well-formed
  }
  
  
  if(!$error){
	  $noUser=true;
	 $conn=connect();

	$sql = "SELECT * FROM utente WHERE email='".$email."'";
	$result = query($conn,$sql);
	close_connection($conn);
	
	while($row = $result->fetch_assoc()){
		if($email==$row["email"]){
			$noUser=false;
			break;
		}
		
	}
	
	$result->data_seek(0);
	
	if(!$noUser){
		$row = $result->fetch_assoc();
		if($pswd==$row["password"]){
			 $_SESSION['name'] = $row['nomeu'];
			 $_SESSION['idutente'] = $row['idutente'];
			 $_SESSION['email'] = $row['email'];
			 $_SESSION['valadmin'] = $row['valadmin'];
			 $_SESSION['valdip'] = $row['valdip'];
			 $_SESSION['valclient'] = $row['valclient'];
			header("Location: index.php");
			
		}else{
			$pswdErr = "La Password non è corretta.";
			
		}
		
		
		
		
		
	} 
	else{
		$emailErr = "Utente non registrato.";
	}	
		
}
  
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2 id="register">Play Pizza: Login Utente</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	E-mail: <input type="email" name="email" value="<?php echo $email;?>">
    <br>
	<span class="error"><?php echo $emailErr;?></span>
	<br><br>
    Password: <input type="password" name="pswd" value="">
	<br>
    <span class="error"><?php echo $pswdErr;?></span>
	<br><br>
    <input type="submit" name="submit" value="Login" id="buttonform">
</form>

<br>
<br>


<?php include 'template/footer.php';?>