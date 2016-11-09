<?php
session_start();

if(isset($_SESSION['valadmin']) && ($_SESSION['valadmin']==1 || $_SESSION['valdip']==1))
{
include("db_connection.php");

$conn=connect();

$sql = "select ordini.`data`, ordini.ora, ordini.importo, utente.nomeu, utente.cognomeu, utente.indirizzo, utente.civ, prodotti.nomeprod, prodordinato.quantita
from ordini
inner join utente
on ordini.idutente = utente.idutente
inner join prodordinato
on prodordinato.idor = ordini.idor
inner join prodotti
on prodotti.idprod = prodordinato.idprod
order by utente.cognomeu;";
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
				<th style="border-top-left-radius: 2em;">Data</th>
				<th>Ora</th>
				<th>Importo</th>
				<th>Nome</th>
				<th>Cognome</th>
				<th>Indirizzo</th>
				<th>Civ</th>
				<th>Pizza</th>
				<th style="border-top-right-radius: 2em;">Quantità</th>
			</tr>';
	
	while($row = $db->fetch_assoc()) {
		$result.=' 
			<tr>
				<td>'.$row["data"].'</td>
				<td>'.$row["ora"].'</td>
				<td>'.$row["importo"].'</td>
				<td>'.$row["nomeu"].'</td>
				<td>'.$row["cognomeu"].'</td>
				<td>'.$row["indirizzo"].'</td>
				<td>'.$row["civ"].'</td>
				<td>'.$row["nomeprod"].'</td>
				<td>'.$row["quantita"].'</td>
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