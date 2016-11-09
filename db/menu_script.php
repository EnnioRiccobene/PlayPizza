<?php 


include("db_connection.php");

$conn=connect();

$sql = "SELECT * FROM prodotti";
$result = query($conn,$sql);

close_connection($conn);



if(isEmpty($result)==false){
	
    while($row = $result->fetch_assoc()) {
		
		echo '					<div id="box" class="row-height">
		<img src="img/pizze/'.$row["idprod"].'.jpg" style="float:left;width:200px;height:200px;">
		<div class="boxc2" id="boxc2" style="height: 100%">
			<div class="dropdown text-right">
				<button id="bg" class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-option-vertical"></span></button>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><button type="button" style="border:none; background-color: transparent; outline-color:transparent; margin-left: 20%; margin-right:20%" onclick="Addpreferiti(\''.$row["idprod"].'\')">Aggiungi ai preferiti</button></li>
					<li><a href="addtomodify.php?idprod='.$row["idprod"].'">Aggiungi al carrello con modifica</a></li>
				</ul>
			</div>			
			<h3 style="margin-top: 0px">'.$row["nomeprod"].'</h3>
			<p>'.$row["ingredienti"].'</p>
			
			<div class="boh">
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
				<div class="carrel" style="display:block; display:inline-block">
					<button type="button" id="btnbox" onclick="addToCart(\''.$row["idprod"].'\',\''.$row["prezzo"].'\')">Aggiungi al carrello</button>
				</div>
				<div class="price" style="float:right; padding-right: 1cm">
					Prezzo: '.$row["prezzo"].' €
				</div>
			</div>
			
			<div id="starblock" class="starblock">
				';
		
			echo cssRating(2);
			
		echo '</div>
		</div>
	</div>
	<br>';
	
	
		
		

} }
else {
	echo "Nessun Elemento Nel Database!";
	
}		
				
				
				
				
				
				
				
				function cssRating($rating){
					$return="";
					
				$return = "
				<style>
				
				input ,select{
	 
	 border: 2px solid grey; 
	 border-radius: 10px; 
	 outline-color: transparent;
	 }
				.rating {
					float:left;
				}
				.rating:not(:checked) > input {
					position:absolute;
					top:-9999px;
					clip:rect(0,0,0,0);
				}
				.rating:not(:checked) > label {
					float:right;
					width:1em;
					padding:0 .1em;
					overflow:hidden;
					white-space:nowrap;
					cursor:pointer;
					font-size:200%;
					line-height:1.2;
					color:#ddd;
					text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
				}
				.rating:not(:checked) > label:before {
					content: '★ ';
				}
				.rating > input:checked ~ label {
					color: #f70;
					text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
				}
				.rating:not(:checked) > label:hover,
				.rating:not(:checked) > label:hover ~ label {
					color: gold;
					text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
				}
				.rating > input:checked + label:hover,
				.rating > input:checked + label:hover ~ label,
				.rating > input:checked ~ label:hover,
				.rating > input:checked ~ label:hover ~ label,
				.rating > label:hover ~ input:checked ~ label {
					color: #ea0;
					text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
				}
				.rating > label:active {
					position:relative;
					top:2px;
					left:2px;
				}
				</style>";
				
				switch ($rating){
					case 1:
					$return .= '<fieldset class="rating">
					<input type="radio" id="star5" value="5" /><label for="star5" title="Ottimo">5 stars</label>
					<input type="radio" id="star4"  value="4" /><label for="star4" title="Notevole">4 stars</label>
					<input type="radio" id="star3"  value="3" /><label for="star3" title="Buono">3 stars</label>
					<input type="radio" id="star2"  value="2" /><label for="star2" title="Non è il massimo">2 stars</label>
					<input type="radio" id="star1"  value="1" checked="checked" /><label for="star1" title="Sconsigliato">1 star</label>
					</fieldset>';
					break;
					case 2:
					$return .= '<fieldset class="rating">
					<input type="radio" id="star5"  value="5" /><label for="star5" title="Ottimo">5 stars</label>
					<input type="radio" id="star4"  value="4" /><label for="star4" title="Notevole">4 stars</label>
					<input type="radio" id="star3"  value="3" /><label for="star3" title="Buono">3 stars</label>
					<input type="radio" id="star2"  value="2" checked="checked" /><label for="star2" title="Non è il massimo">2 stars</label>
					<input type="radio" id="star1"  value="1" /><label for="star1" title="Sconsigliato">1 star</label>
					</fieldset>';
					break;
					case 3:
					$return .= '<fieldset class="rating">
					<input type="radio" id="star5"  value="5" /><label for="star5" title="Ottimo">5 stars</label>
					<input type="radio" id="star4"  value="4" /><label for="star4" title="Notevole">4 stars</label>
					<input type="radio" id="star3"  value="3" checked="checked" /><label for="star3" title="Buono">3 stars</label>
					<input type="radio" id="star2"  value="2" /><label for="star2" title="Non è il massimo">2 stars</label>
					<input type="radio" id="star1"  value="1" /><label for="star1" title="Sconsigliato">1 star</label>
					</fieldset>';
					break;
					case 4:
					$return .= '<fieldset class="rating">
					<input type="radio" id="star5"  value="5" /><label for="star5" title="Ottimo">5 stars</label>
					<input type="radio" id="star4"  value="4" checked="checked" /><label for="star4" title="Notevole">4 stars</label>
					<input type="radio" id="star3"  value="3" /><label for="star3" title="Buono">3 stars</label>
					<input type="radio" id="star2"  value="2" /><label for="star2" title="Non è il massimo">2 stars</label>
					<input type="radio" id="star1"  value="1" /><label for="star1" title="Sconsigliato">1 star</label>
					</fieldset>';
					break;
					case 5:
					$return .= '<fieldset class="rating">
					<input type="radio" id="star5"  value="5" checked="checked" /><label for="star5" title="Ottimo">5 stars</label>
					<input type="radio" id="star4"  value="4" /><label for="star4" title="Notevole">4 stars</label>
					<input type="radio" id="star3"  value="3" /><label for="star3" title="Buono">3 stars</label>
					<input type="radio" id="star2"  value="2" /><label for="star2" title="Non è il massimo">2 stars</label>
					<input type="radio" id="star1"  value="1" /><label for="star1" title="Sconsigliato">1 star</label>
					</fieldset>';
					break;
				}
				
				

				return $return;
				}
				
				function addpreferiti($idprod, $idutente) {
					$return="";
					
					$conn=connect();

					$sql3 = "insert into preferiti
							values (NULL, '".$_SESSION['idutente']."',' ".$idprod."');";
					$result = query($conn,$sql3);

					close_connection($conn);
					
					return $return;
				}
				
				
	 ?>
								 
								 
								 
<script>

function Addpreferiti(idprod){

	var dataString = {idprod:idprod};
	
  
   $.ajax({

            type: "POST",
			async: false,
            url: "db/addpreferiti.php",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function(response) {
          
		  
                }
        });
	
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
		
	var quant=parseInt($('#quant-'+idprod).val());
  
 
  dataString = {cartcount:cartcount,idprod:idprod,quantity:quant,supp:"0",price:price};

  
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