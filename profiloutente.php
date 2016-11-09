<?php include 'template/head.php';?>
<?php include 'template/header.php';?>


<br><br>
<div class="row">


<?php 

if(isset($_SESSION['valadmin']) && ($_SESSION['valclient']==1))
{

	$menu='<div class="col-sm-3">
		<div class="btn-group-vertical" id="btug">
			<h4 style="color:white"><b>Utente</b></h4>
			<button type="button" class="btn" id="btu" onclick="modificadatiutente()">Modifica Dati Utente</button>
			<button type="button" class="btn" id="btu" onclick="myorder()">I Miei Ordini</button>
			<button type="button" class="btn" id="btu" onclick="preferiti()">Preferiti</button>';
			
	if($_SESSION['valadmin']==1){
		$menu.='		
			<h4 style="color:white; border-style:solid; border-color:transparent; border-top-color:white; border-width: 1px; padding-top: 10px;"><b>Amministratore</b></h4>
			<div class="btn-group">
				<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="btu">Prodotti <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu" id="dpd">
					<li><button type="button" class="btn" id="btdrop" onclick="viewprod()">Visualizza Prodotti</a></li>
					<li><button type="button" class="btn" id="btdrop" onclick="addprod()">Aggiungi Prodotto</a></li>
					<li><button type="button" class="btn" id="btdrop" onclick="modifyprod()">Modifica Prodotto</a></li>
					<li><button type="button" class="btn" id="btdrop" onclick="removeprod()">Rimuovi Prodotto</a></li>
				</ul>
			</div>
			<div class="btn-group">
				<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="btu">Ordini <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
					<li><button type="button" class="btn" id="btdrop" onclick="dayvieword()">Visualizza Ordini Odierni</button></li>
					<li><button type="button" class="btn" id="btdrop" onclick="vieword()">Visualizza Tutti Gli Ordini</button></li>
				</ul>
			</div>
			<div class="btn-group">
				<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="btu">Clienti <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
					<li><button type="button" class="btn" id="btdrop" onclick="viewclient()">Visualizza Clienti</button></li>
					<li><button type="button" class="btn" id="btdrop" onclick="removeclient()">Rimuovi Cliente</button></li>
				</ul>
			</div>
			<div class="btn-group">
				<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"  id="btu">Dipendenti <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
					<li><button type="button" class="btn" id="btdrop" onclick="viewdip()">Visualizza Dipendenti</button></li>
					<li><button type="button" class="btn" id="btdrop" onclick="removedip()">Rimuovi Dipendente</button></li>
					<li><button type="button" class="btn" id="btdrop" onclick="addip()">Aggiungi Dipendente</button></li>
				</ul>
			</div>
			<button type="button" class="btn" onclick="addadmin()"  id="btu">Aggiungi Amministratore</button>';
		
		
	}
	
	if($_SESSION['valdip']==1){
		$menu.='			<h4 style="color:white; border-style:solid; border-color:transparent; border-top-color:white; border-width: 1px; padding-top: 10px;"><b>Dipendente</b></h4>
			<div class="btn-group-vertical">
				<div class="btn-group">
					<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="btu">Prodotti <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><button type="button" class="btn" id="btdrop" onclick="viewprod()">Visualizza Prodotti</a></li>
					</ul>
				</div>
				<div class="btn-group">
					<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="btu">Ordini <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><button type="button" class="btn" id="btdrop" onclick="dayvieword()">Visualizza Ordini Odierni</button></li>
						<li><button type="button" class="btn" id="btdrop" onclick="vieword()">Visualizza Tutti Gli Ordini</button></li>
					</ul>
				</div>
				<div class="btn-group">
					<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="btu">Clienti <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><button type="button" class="btn" id="btdrop" onclick="viewclient()">Visualizza Clienti</button></li>
					</ul>
				</div>
			</div>';
		
		
	}


	$menu.='		</div>
	</div>';
	
	echo $menu;
}else{
	
	echo '<h1 style-color:red>Accesso Negato</h1>';
}
?>



	
	
	<div class="col-sm-9">
		<h2 style="color:red; text-align:left;">Profilo Utente</h2>
		
		<iframe src="db/modificadatiutente.php" id="iframe"></iframe>
		
		
		<script>
			function modificadatiutente() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/modificadatiutente.php";		
				}	
		</script>
		
		<script>
			function myorder() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/myorder.php";		
				}	
		</script>		
		
		<script>
			function preferiti() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/preferiti.php";		
				}	
		</script>	
		
		<script>
			function viewprod() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/viewprod.php";		
				}	
		</script>
		
		<script>
			function addprod() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/addprod.php";		
				}	
		</script>
		
		<script>
			function modifyprod() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/modifyprod.php";		
				}	
		</script>
		
		<script>
			function removeprod() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/removeprod.php";		
				}	
		</script>
		
		<script>
			function dayvieword() { 
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/dayvieword.php";		
				}	
		</script>
		
		
		<script>
			function vieword() { 
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/vieword.php";		
				}	
		</script>
		
		<script>
			function viewclient() { 
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/viewclient.php";		
				}	
		</script>
		
		<script>
			function removeclient() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/removeclient.php";		
				}	
		</script>
		
		<script>
			function viewdip() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/viewdip.php";		
				}	
		</script>
		
		<script>
			function removedip() { 
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/removedip.php";		
				}	
		</script>
		
		<script>
			function addip() { 
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/addip.php";		
				}	
		</script>
		
		<script>
			function addadmin() {
				
				var iframe = document.getElementById('iframe');
					iframe.src = "db/addadmin.php";		
				}	
		</script>

	</div>

</div>

<br><br>

<?php include 'template/footer.php';?>