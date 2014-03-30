<?php
include("config.inc.php");

//lista delle marche

$i = date("Y");


	$url = 'http://www.carqueryapi.com/api/0.3/?callback=?&cmd=getMakes&year='.$i;
	$content = file_get_contents($url);

	$content = substr($content, 4);
	$content = substr($content,0,-2);
	
	$json = json_decode($content, true);

	foreach($json["Makes"] as $item) {
		$conta=0;
		$id=$item['make_id'];
		$nome=$item['make_display'];
		$naz=$item['make_country'];
		
		$result = mysql_query("SELECT count(id) as conta FROM marche where id='".$id."'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if ($row["conta"] == 0){
			
			$result2 = mysql_query("insert into marche (id, nome, nazione) VALUES ('".$id."', '".$nome."', '".$naz."')");
		}
		
		
		
	}	


?>