<?php
session_start();
include("config.inc.php");

$id=$_REQUEST["id"];
$nome=$_REQUEST["nome"];
$mail=$_REQUEST["mail"];
$mess=$_REQUEST["mess"];


$result = mysql_query("SELECT * FROM vistaauto where Id='".$id."'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$a=$row["Marca"];
		$a=str_replace("-"," ",$a);
	
		$a=ucwords($a);
		
		$n=strlen($a);
		if($n<=3)
			$a=strtoupper($a);
			
			

$headers = "From: ".$nome." <".$mail.">"."\n";
$headers.= "MIME-Version: 1.0\n";
$headers.= "Content-type: text/html; charset=utf-8"."\n";

$oggetto = "Richiesta informazioni per auto: ".$a." ".$row["Modello"]." ".$row["Versione"]." id:".$id;			
$oggetto2 = "Copia: Richiesta informazioni per auto: ".$a." ".$row["Modello"]." ".$row["Versione"] ;		

$testo2 = "<strong>Richiesta informazioni per auto: ".$a." ".$row["Modello"]." ".$row["Versione"]."</strong><br><br>";            
$testo2 .= $nome." ti ha inviato un messaggio:<br>";  
$testo2 .= "Email: ".$mail."<br>";  
$testo2 .= "Messaggio: ".$mess."<br>"; 

mail($row["email"],$oggetto,$testo2,$headers);	
mail($mail,$oggetto2,$testo2,$headers);	

header("Location: dettagli.php?id=".$id."&a=1");


?>