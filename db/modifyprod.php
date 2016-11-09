<?php
session_start();

if(isset($_SESSION['valadmin']) && $_SESSION['valadmin']==1)
{

	include("db_connection.php");
	

	$conn=connect();

	$sql1 = "SELECT * FROM prodotti";
	$pizze = query($conn,$sql1);
		
	close_connection($conn);
	
	
	$nomeprod = $ingredienti = $prezzo = $selpizza = "";
	$nomeprodErr = $ingredientiErr = $prezzoErr = "";
	
	$confirm=false;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$error=false;
	
	$selpizza = $_POST["selpizza"];
	
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

	$sql = "UPDATE prodotti
		SET nomeprod='".$nomeprod."', ingredienti='".$ingredienti."', prezzo='".$prezzo."'
		WHERE idprod='".$selpizza."';";	  
	
	
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

$stringa = ' 
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">

  <script src="jquery-2.2.3.min.js"></script>

</head>

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
		<body>
<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'"> 
		Pizza da modificare: <select id="pizza" name="selpizza">';
		
		$pizze->data_seek(0);
		
		$row = $pizze->fetch_assoc();
		$nomeprod=$row["nomeprod"];
		$ingredienti=$row["ingredienti"];
		$prezzo=$row["prezzo"];
		$pizze->data_seek(0);
		
		while($row = $pizze->fetch_assoc()) {	
	
				$stringa.='<option value="'.$row["idprod"].'">'.$row["nomeprod"]."</option>\n";

		}
		
		$stringa.='</select>
		<h2 style="text-align:center">Modifica</h2>
		Nome della pizza: <input id="nome" type="text" name="nomeprod" value=" '.$nomeprod.'" >
		<span class="error">*  '.$nomeprodErr.'</span>
		<br><br>
		Lista degli ingredienti: <input id="ingre" type="text" name="ingredienti" value="'.$ingredienti.'" >
		<span class="error">*  '.$ingredientiErr.'</span>
		<br><br>
		Prezzo: <input id="prezzo" type="number" step="0.01" name="prezzo" value="'.$prezzo.'" >
		<span class="error">* '.$prezzoErr.'</span>
		<br><br>
		</div>
		<input type="submit" name="submit" value="Modifica" id="buttonform">  
		</form>

<br>
<br>



	<script type="text/javascript">
				$("#pizza").change(function() {
				 var selectedOption = this[this.selectedIndex];
				 var selectedIndex=selectedOption.value;
				
				var   dataString = {idprod:selectedIndex};
				

								   $.ajax({

            type: "POST",
			async: false,
            url: "getproddata.php",
            data: dataString,
            dataType: \'json\',
            cache: false,
            success: function(response) {
					$("#nome").val(response.nomeprod);
					$("#ingre").val(response.ingredienti);
					$("#prezzo").val(response.prezzo);
                }
        });
				
				
			});	
	</script>


';
echo $stringa;
}
else{
	echo ' <h2 id="register">Pizza Modificata</h2>';
	
	
}

}else{
	
	echo '<h1 style-color:red>Accesso Negato</h1>';
}

echo'</body>';


function getName($ind){
	$name="";
	
	
	
	
	return $name;
}

?>