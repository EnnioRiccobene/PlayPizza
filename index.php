	
	<?php include 'template/headhome.php';?>
	 <?php include 'template/header.php';?>

	<?php 

	
	
	 if(isset($_GET['logout']))
	{
	session_destroy();
	unset($_SESSION['name']);
	header("Location: index.php");
	}
	 
	?> 
	 
		<!--fine header-->		
		<div class="row text-center" id="center">
			<!--inizio carosello, modificare immagini-->
			<br>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<li data-target="#myCarousel" data-slide-to="3"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="img/primascelta.jpg" alt="Pizza di prima scelta" width="460" height="345">
					</div>

					<div class="item">
						<img src="img/gratis.png" alt="consegna a domicilio gratuita" width="460" height="345">
					</div>
    
					<div class="item">
						<img src="img/online.png" alt="Ordina online" width="460" height="345">
					</div>
					
					<div class="item">
						<img src="img/pizzasocial.jpg" alt="Seguici sui Social" width="460" height="345">
					</div>
				</div>

				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<br>
			<!--fine carosello-->
		
			<p style="margin-left: 20px; margin-right: 20px;">La pizzeria Play Pizza è un ambiente coinvolgente in cui sicuramente troverete il piatto che stuzzicherà il vostro appetito. 
Il menù è tipico della cucina siciliana e viene offerto con una larga scelta di pizze cotte nel forno a legna. 
Si eseguono i servizi di "pizza d'asporto", consegna a domicilio e ordini online.</p>
			<br>
		</div>
		<!--inizio footer-->

 
  <?php include 'template/footer.php';?>