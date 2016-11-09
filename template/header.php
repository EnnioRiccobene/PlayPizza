
<?php

session_start();

$log_user = $reg_logout = "";
$log_user_link = $reg_logout_link = "";
$cartcount=0;




if(isset($_SESSION['name'])!="")
{
 $log_user=$_SESSION['name'];
 $reg_logout="LogOut";
 $log_user_link="profiloutente.php";
 $reg_logout_link="index.php?logout";
}else{
	 $log_user="Login";
 $reg_logout="Registrati";
 $log_user_link="formlogin.php";
 $reg_logout_link="register.php";
	
}
	
	    if(isset($_SESSION['carrello'])!="")
		{
		$cartcount=$_SESSION['carrello'];
		}else{
	 $cartcount=0;
	
		}



?>








<body style="background-color:lightgrey">

<div class="container-fluid text-center">
  <div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10" style="background-color:white">
		<div class="row"  id="row_log">
			<div class="col-sm-7" style="text-align:left; margin-top: 10px;">
				<p>Consegna dalle 19:00 alle 24:00</p>
				<p>Lunedì riposo settimanale</p>
			</div>
			<div class="col-sm-2" style="text-align:right; margin-top: 10px;">
				<br>
				<a href="carrello.php" id="a1"><span class="glyphicon glyphicon-shopping-cart" style="color:white; margin-right: 5px"></span>Carrello <span class="badge" id="badge"><?php echo $cartcount;?></span></a>
			</div>
			<div class="col-sm-3" style="text-align:right; margin-top: 10px;">
				<br>
				<a href="<?php echo $log_user_link;?>" id="a1" style="margin-right:10px"><span class="glyphicon glyphicon-log-in" style="color:white; margin-right: 5px"></span><?php echo $log_user;?></a>
				<a href="<?php echo $reg_logout_link;?>" id="a1" style="margin-right:10px"><span class="glyphicon glyphicon-user" style="color:white; margin-right: 5px"></span><?php echo $reg_logout;?></a>
			</div>			
		</div>	
		<div class="row">
			<br>
			<div class="col-sm-3">
				<a href="index.php"><img src="img/playpizza.png" alt="PizzaWeb Logo" style="width:128px;height:128px;"></a> <!-- Modificare con .php -->
			</div>
			<div class="col-sm-9 text-right">
				<br>
				<br>
				<nav class="navbar navbar-inverse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php" id="a2"> <b>HOME</b></a></li>
						<li><a href="news.php" id="a2"> <b>NEWS</b></a></li>
						<li><a href="menu.php" id="a2"> <b>MENU'</b></a></li>
						<li><a href="photo.php" id="a2"> <b>PHOTOGALLERY</b></a></li>
						<li><a href="contatti.php" id="a2"> <b>CONTATTI</b></a></li>
					</ul>
				</nav>
			</div>
			<br>
		</div>
		
		
		