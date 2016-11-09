<?php include 'template/head.php';?>
<?php include 'template/header.php';?>

<h2 id="register">Modifica Pizza</h2>
<br><br>

<?php



	$idprod=$_GET["idprod"];
	

	
	include("db/db_connection.php");

$conn=connect();

$sql = "SELECT * FROM prodotti WHERE idprod='".$idprod."'";
$pizza = query($conn,$sql);

$sql2="SELECT * FROM supplementi";

$supp = query($conn,$sql2);

close_connection($conn);


$row = $pizza->fetch_assoc();
$price=$row["prezzo"];

echo'<h2>La tua Pizza '.$row["nomeprod"].'</h2>';
	
echo '<h3>'.$row["ingredienti"].'</h3>
		<br><br>
		';





?>






<p id="supple" style="font-size: 120%">Ingredienti Aggiunti:</p>
<input type="hidden" name="numsupp" id="numsupp" value="0">
<br>
<p id="remove" style="font-size: 120%">Ingredienti da Rimuovere:</p>
<br>


  <div class="supplements">
		<p style="font-size: 120%">Aggiungi Ingrediente: 
		<select id="ingre" style="border: 2px solid grey; border-radius: 10px; outline-color: transparent;">
		<?php
			while($row = $supp->fetch_assoc()) {	
	
				echo '<option value="'.$row["idsup"].'">'.$row["ingre"]."</option>\n";

		}
			

		?>
		</select>
		</p>
	</div>	
	
	<br>
  <button type="button" onclick="addIngre()" class="buttonform">Aggiungi</button>
	
	
  <br><br>
  <p style="font-size: 120%">Indicare ingredienti da rimuovere:</p> <textarea id="rmvingr" rows="6" cols="60" style="border: 2px solid grey; border-radius: 10px;"></textarea>
  <br><br>
  <button type="button" onclick="remIngre()" class="buttonform">Rimuovi</button>
  <br><br>
  <div class="quant">
		<p style="font-size: 120%">Seleziona la quantità da ordinare: 
		<select name="quantita" id="quant" style="border: 2px solid grey; border-radius: 10px; outline-color: transparent;">
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
		</p>
	</div>	
	<br><br>
    <button type="button" onclick="addToCart(<?php echo "'".$idprod."','".$price."'" ;?>)" class="buttonform">Aggiungi al Carrello</button>
  <br><br><br>

<script>
function addIngre() {
    var sel_id=parseInt($('#ingre').val());
	var numsupp=parseInt($('#numsupp').val())+1;
	document.getElementById('numsupp').value = numsupp;

	var sel_text=$('#ingre').find(":selected").text();
	var element = document.getElementById("supple");
		element.innerHTML +=" "+sel_text;
		
}

function remIngre() {
		
	var rem=$('#rmvingr').val();
	var element = document.getElementById("remove");
		element.innerHTML ="Ingredienti da Rimuovere: "+rem;
		
		
		
}

function addToCart(idprod,price) {
  var cartcount=0;
  var dataString="";
  
       $.ajax({
            type: "POST",
      async: false,
            url: "get_cart.php",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function(response) {

                    cartcount=response.count;

                }
        });
		
	var quant=parseInt($('#quant').val());
	var numsupp=parseInt($('#numsupp').val());
	
  
 
  dataString = {cartcount:cartcount,idprod:idprod,quantity:quant,supp:numsupp,price:price};

  
   $.ajax({

            type: "POST",
			async: false,
            url: "update_cart.php",
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


<?php include 'template/footer.php';?>