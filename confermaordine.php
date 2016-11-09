<?php include 'template/head.php';?>
<?php include 'template/header.php';?>

<?php

if(isset($_POST['payment_status'])&&$_POST['payment_status']=='Completed'){

$order=$_POST['txn_id'];

echo '
	<h1 style="color:red;"><b>Abbiamo ricevuto il tuo ordine</b></h1>
	<br><br>
	<p style = "text-align:center; font-size:200%;" >Numero Ordine: '.$order.'</p>
	<br><br>
	
		   <script type="text/javascript">
			$( window ).load(function() {
				
				var dataString= {order:"'.$order.'"};
				
				
				$.ajax({
					type: "POST",
					async: false,
					url: "db/addorder.php",
					data: dataString,
					dataType: \'json\',
					cache: false,
					success: function(response) {
						}});
						
						
				dataString="";
  
				$.ajax({
					type: "POST",
					async: false,
					url: "destroy_cart.php",
					data: dataString,
					dataType: \'json\',
					cache: false,
					success: function(response) {
						var badge = document.getElementById("badge");
						badge.textContent="0";
						}});		
				
				var dataString= {order:"'.$order.'"};

				$.ajax({
					type: "POST",
					async: false,
					url: "mailconferma.php",
					data: dataString,
					dataType: \'json\',
					cache: false,
					success: function(response) {
						}});		
				 
				
				
				});
			
		</script>
		
		
';



}



?>






<?php include 'template/footer.php';?>	