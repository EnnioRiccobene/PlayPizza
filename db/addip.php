<?php
session_start();

if(isset($_SESSION['valadmin']) && $_SESSION['valadmin']==1)
{

	include("db_connection.php");
	
	$seldip = "";
	
	$confirm=false;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$error=false;
	
	$seldip = $_POST["seldip"];
	
	if(!$error){
	  	  $conn=connect();

	$sql = "UPDATE utente
		SET valdip='1'
		WHERE idutente='".$seldip."';";	  
	
	
	if(query($conn,$sql)!="")
		$confirm=true;

	close_connection($conn);  
	
  }
	
	}


	if(!$confirm){

$stringa = ' 
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
		Pizza da modificare: <select name="seldip">';
		
		$conn=connect();

		$sql1 = "SELECT * FROM utente
		WHERE valdip = 0 and valadmin = 0;";
		$dip = query($conn,$sql1);
		
		close_connection($conn);
		
		while($row = $dip->fetch_assoc()) {	
	
				$stringa.='<option value="'.$row["idutente"].'">'.$row["nomeu"]." ".$row["cognomeu"]."</option>\n";

		}
		
		$stringa.='</select>
		
		<br><br>
		</div>
		<input type="submit" name="submit" value="Promuovi a dipendente" id="buttonform">  
		</form>

<br>
<br>';
echo $stringa;
}
else{
	echo ' <h2 id="register">Dipendente promosso</h2>';
	
	
}

}else{
	
	echo '<h1 style-color:red>Accesso Negato</h1>';
}

?>
