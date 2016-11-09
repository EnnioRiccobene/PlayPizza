<?php
session_start();

if(isset($_SESSION['valadmin']) && $_SESSION['valadmin']==1)
{

	include("db_connection.php");
	
	$selpizza = "";
	
	$confirm=false;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	
	$selpizza = $_POST["selpizza"];
	
	$conn=connect();

	$sql = "DELETE FROM prodotti
		WHERE idprod='".$selpizza."';";	  
	
	
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
		<p>Pizza da rimuovere: <select name="selpizza"></p>';
		
		$conn=connect();

		$sql1 = "SELECT * FROM prodotti";
		$pizze = query($conn,$sql1);
		
		close_connection($conn);
		
		while($row = $pizze->fetch_assoc()) {	
	
				$stringa.='<option value="'.$row["idprod"].'">'.$row["nomeprod"]."</option>\n";

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
	echo ' <h2 id="register">Pizza Rimossa</h2>';
	
	
}

}else{
	
	echo '<h1 style-color:red>Accesso Negato</h1>';
}

?>