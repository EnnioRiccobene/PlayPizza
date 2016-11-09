<?php
session_start();

if(isset($_SESSION['valadmin']) && ($_SESSION['valadmin']==1 || $_SESSION['valdip']==1))
{

include("db_connection.php");

$conn=connect();

$sql = "select nomeu, cognomeu, email, cittau, provincia, cap, indirizzo, civ, citofono, telefono, cellulare
from utente
where valadmin = 0 and valdip = 0;";
$db = query($conn,$sql);

close_connection($conn);	

$result ='';
if(isEmpty($db)==false){
	$db->data_seek(0);
	$result='
			<style>
			input ,select{
	 
	 border: 2px solid grey; 
	 border-radius: 10px; 
	 outline-color: transparent;
	 }
			
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
			</style>
			
			<div class="table">
			<table id="t01">
			<tr>
				<th style="border-top-left-radius: 2em;">Nome</th>
				<th>Cognome</th>
				<th>Email</th>
				<th>Città</th>
				<th>Provincia</th>
				<th>CAP</th>
				<th>Indirizzo</th>
				<th>Civ</th>
				<th>Citofono</th>
				<th>Telefono</th>
				<th style="border-top-right-radius: 2em;">Cellulare</th>
			</tr>';
	
	while($row = $db->fetch_assoc()) {
		$result.=' 
			<tr>
				<td>'.$row["nomeu"].'</td>
				<td>'.$row["cognomeu"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["cittau"].'</td>
				<td>'.$row["provincia"].'</td>
				<td>'.$row["cap"].'</td>
				<td>'.$row["indirizzo"].'</td>
				<td>'.$row["civ"].'</td>
				<td>'.$row["citofono"].'</td>
				<td>'.$row["telefono"].'</td>
				<td>'.$row["cellulare"].'</td>
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