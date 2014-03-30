<?php
session_start();
include("config.inc.php");

$id=$_REQUEST["id"];
$mail1=$_REQUEST["nome2"];
$mail2=$_REQUEST["nome3"];
$mess=$_REQUEST["mess2"];


$result = mysql_query("SELECT * FROM vistaauto where Id='".$id."'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$a=$row["Marca"];
		$a=str_replace("-"," ",$a);
	
		$a=ucwords($a);
		
		$n=strlen($a);
		if($n<=3)
			$a=strtoupper($a);
			
			

$headers = "From:  <".$mail1.">"."\n";
$headers.= "MIME-Version: 1.0\n";
$headers.= "Content-type: text/html; charset=utf-8"."\n";

$oggetto = "Vedi l'auto: ".$a." ".$row["Modello"]." ".$row["Versione"]." id:".$id;			
$oggetto2 = "Copia: vedi l'auto: ".$a." ".$row["Modello"]." ".$row["Versione"] ;		

$testo2 = "<strong>Ciao ti cosiglio di vedere quest annuncio: ".$a." ".$row["Modello"]." ".$row["Versione"]."</strong><br><br>";            
$testo2 .= $mail1." ti ha inviato un messaggio:<br>";   
$testo2 .= "Messaggio: ".$mess."<br>"; 

mail($mail2,$oggetto,$testo2,$headers);	
mail($mail1,$oggetto2,$testo2,$headers);	

header("Location: dettagli.php?id=".$id."&a=1");


?>