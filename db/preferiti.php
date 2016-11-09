<?php 
session_start();

if(isset($_SESSION['valadmin']))
{

include("db_connection.php");



$conn=connect();

$sql = "select * from prodotti
	inner join preferiti
	on preferiti.idprod = prodotti.idprod
	where preferiti.idutente = '".$_SESSION['idutente']."'; ";
$result = query($conn,$sql);

close_connection($conn);



if(isEmpty($result)==false){
	
    while($row = $result->fetch_assoc()) {
		
		echo '	
		<style>
		input ,select{
	 
	 border: 2px solid grey; 
	 border-radius: 10px; 
	 outline-color: transparent;
	 }
		
			#box {
				background-color: white;
				width:800px;
				height:215px;
				padding: 5px;
				border: 2px white;
				margin: 0.25cm;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			}

			#starblock {
				display: flex;
				display: -webkit-flex;
				flex-direction: column;
				-webkit-flex-direction: column;
				padding: 20px 0;
				margin: 0 auto;
				display: inline-block;
				overflow: hidden;
	
			}
			
			#bg {
				background-color: transparent;
				border-radius: 100%;
				outline-color: transparent;
			}
			
			#btnbox {
				background-color: #c4261d;
				border: none;
				font-size: 14px;
				color: #FFFFFF;
				text-align: center;
				cursor: pointer;
				border-bottom-right-radius: 2em;
				border-top-right-radius: 2em;
				border-bottom-left-radius: 2em;
				border-top-left-radius: 2em;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
				outline-color: transparent;
				padding: 5px;
				text-align:center;
			}
		</style>
		
		
		<div id="box" class="row-height" style="float:left;">
		<img src="../img/pizze/'.$row["idprod"].'.jpg" style="float:left;width:200px;height:200px;">
		<div class="boxc2" id="boxc2" style="height: 100%">		
			<h3 style="margin-top: 15px; text-align:center;">'.$row["nomeprod"].'</h3>
			<p style="text-align:center;">'.$row["ingredienti"].'</p>
			
			<div class="boh">
				<br>
				<div class="quant" style="float:left; margin-left:10px">
					Quantità: 
					<select name="quantita" style="border: 2px solid grey; border-radius: 10px; outline-color: transparent;" id="quant-'.$row["idprod"].'">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
					</select>
				</div>	
				
				<div class="price" style="float:right; padding-right: 1cm">
					Prezzo: '.$row["prezzo"].' €
				</div>
			</div>
			<div class="carrel" style="display:block; display:inline-block; padding-left:120px;">
				<br><br>
				<button type="button" id="btnbox" onclick="addToCart(\''.$row["idprod"].'\',\''.$row["prezzo"].'\')">Aggiungi al carrello</button>
			</div>
			
		</div>
	</div>
	<br>';
	

		
} }
else {
	echo "Nessun Elemento Nel Database!";
	
}		

}else{
	
	echo '<h1 style-color:red>Accesso Negato</h1>';
}	
				
	 ?>

<link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6-dist/css/bootstrap.min.css">

<script src="../js/jquery-2.2.3.min.js"></script>
 
<script type="text/javascript" src="../js/code-photoswipe-jQuery-1.0.15.min.js"></script>
								 
<script src="../bootstrap/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>								 
								 
<script>
function addToCart(idprod,price) {
  var cartcount=0;
  var dataString="";
  
       $.ajax({
            type: "POST",
      async: false,
            url: "../get_cart.php",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function(response) {

                    cartcount=response.count;

                }
        });
		
	var quant=parseInt($('#quant-'+idprod).val());
  
  cartcount++;
  
 
  dataString = {cartcount:cartcount,idprod:idprod,quantity:quant,supp:"0",price:price};

  
   $.ajax({

            type: "POST",
			async: false,
            url: "../update_cart.php",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function(response) {
          var badge = document.getElementById("badge");
          badge.textContent=response.count;
		  
                }
        });

}
</script>