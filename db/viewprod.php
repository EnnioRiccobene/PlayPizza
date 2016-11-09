<?php
session_start();

if(isset($_SESSION['valadmin']) && ($_SESSION['valadmin']==1 || $_SESSION['valdip']==1))
{


include("db_connection.php");

$conn=connect();

$sql = "SELECT * FROM prodotti";
$db = query($conn,$sql);

close_connection($conn);	

$result ='';
if(isEmpty($db)==false){
	$db->data_seek(0);
	$result='
			<style>
				table {
					width:100%;
	
				}

				table, th, td {
					border: 1px solid transparent;
					border-collapse: collapse;
	
				}

				th, td {
					padding: 5px;
					text-align:center;
				}

				table#t01 tr:nth-child(even) {
					background-color: #eee;
					padding: 10px;
				}

				table#t01 tr:nth-child(odd) {
					background-color:#fff;
					padding: 10px;
				}

				table#t01 th {
					background-color: #c4261d;
					color: white;
					padding: 10px;
				}
				input ,select{
	 
	 border: 2px solid grey; 
	 border-radius: 10px; 
	 outline-color: transparent;
	 }
			</style>
			
			<div class="table">
			<table id="t01">
			<tr>
				<th style="border-top-left-radius: 2em;">Pizza</th>
				<th>Ingredienti</th>
				<th style="border-top-right-radius: 2em;">Prezzo</th>
			</tr>';
	
	while($row = $db->fetch_assoc()) {
		$result.=' 
			<tr>
				<td>'.$row["nomeprod"].'</td>
				<td>'.$row["ingredienti"].'</td>
				<td>'.$row["prezzo"].'</td>
			</tr>';
			
	}
	
	$result.='
		</table>
		</div>';
}

echo $result;
}else{
	
	echo '<h1 style-color:red>Accesso Negato</h1>';
}


?>