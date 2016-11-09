<?php
session_start();

if(isset($_SESSION['valadmin']) && $_SESSION['valadmin']==1)
{

	include("db_connection.php");
	
	$nomeprod = $ingredienti = $prezzo = "";
	$nomeprodErr = $ingredientiErr = $prezzoErr = "";
	
	$confirm=false;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$error=false;
	
	if (empty($_POST["nomeprod"])) {
		$nomeprodErr = "Inserire il nome del prodotto";
		$error=true;
	} else {
		$nomeprod = test_input($_POST["nomeprod"]);
    // check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$nomeprod)) {
			$nomeprodErr = "Only letters and white space allowed"; 
			$error=true;
		}
	}
	
	if (empty($_POST["ingredienti"])) {
		$ingredientiErr = "Inserire l'elenco degli ingredienti";
		$error=true;
	} else {
		$ingredienti = test_input($_POST["ingredienti"]);
	}
	
	if (empty($_POST["prezzo"])) {
		$prezzoErr = "Inserire il prezzo";
		$error=true;
	} else {
		$prezzo = test_input($_POST["prezzo"]);
	}
	
	if(!$error){
	  	  $conn=connect();

	$sql = "insert into prodotti (nomeprod, ingredienti, prezzo)
		values ('".$nomeprod."', '".$ingredienti."', '".$prezzo."');";
	if(query($conn,$sql)!="")
		$confirm=true;

	close_connection($conn);  
	
  }
	
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	if(!$confirm){

echo ' 
		<style>
		input ,select{
	 
	 border: 2px solid grey; 
	 border-radius: 10px; 
	 outline-color: transparent;
	 }
		
			#buttonform {
				position: relative;
				background-color: #c4261d;
				border: none;
				font-size: 14px;
				color: #FFFFFF;
				padding: 20px;
				max-width: 200px;
				text-align: center;
				text-decoration: none;
				overflow: hidden;
				cursor: pointer;
				border-radius:10%;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
				outline-color: transparent;
			}
			
			.error {
				color:red;
			}
		</style>
<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">  
		Nome della pizza: <input type="text" name="nomeprod" value=" '.$nomeprod.'">
		<span class="error">*  '.$nomeprodErr.'</span>
		<br><br>
		Lista degli ingredienti: <input type="text" name="ingredienti" value="'.$ingredienti.'">
		<span class="error">*  '.$ingredientiErr.'</span>
		<br><br>
		Prezzo: <input type="number" step="0.01" name="prezzo" value="'.$prezzo.'">
		<span class="error">* '.$prezzoErr.'</span>
		<br><br>
		</div>
		<input type="submit" name="submit" value="Inserisci" id="buttonform">  
		</form>

<br>
<br>';
}
else{
	echo ' <h2 id="register">Pizza Aggiunta</h2>';
	
	
}

}else{
	
	echo '<h1 style-color:red>Accesso Negato</h1>';
}

?>

