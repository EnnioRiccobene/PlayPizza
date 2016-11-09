<?php
session_start();

if(isset($_SESSION['valadmin']) && $_SESSION['valadmin']==1)
{

	include("db_connection.php");
	
	$selclient = "";
	
	$confirm=false;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	
	$selpizza = $_POST["selclient"];
	
	$conn=connect();

	$sql = "DELETE FROM utente
		WHERE idprod='".$selclient."' and valadmin = 0 and valdip = 0;";	  
	
	
	if(query($conn,$sql)!="")
		$confirm=true;

	close_connection($conn);  
	
	
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
		<form method="post">
		<p>Cliente da rimuovere: <select name="selclient"></p>';
		
		$conn=connect();

		$sql1 = "SELECT * FROM utente
		WHERE valadmin = 0 and valdip = 0;";
		$utenti = query($conn,$sql1);
		
		close_connection($conn);
		
		while($row = $utenti->fetch_assoc()) {	
	
				$stringa.='<option value="'.$row["idutente"].'">'.$row["nomeu"]." ".$row["cognomeu"]."</option>\n";

		}
		
		$stringa.='</select>
		<br><br>
		</div>
		<input type="submit" name="submit" value="Rimuovi" id="buttonform">  
		</form>

<br>
<br>';
echo $stringa;
}
else{
	echo ' <h2 id="register">Cliente Rimosso</h2>';
	
	
}

}else{
	
	echo '<h1 style-color:red>Accesso Negato</h1>';
}

?>