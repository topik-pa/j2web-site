<?php
session_start();
include("../config.inc.php");

$gl="imgauto/";

if($_REQUEST["action"] == "loadprovincie")
{	
	$reg= $_POST["idregione"];
	$result = mysql_query("SELECT ID, Descrizione FROM anag_provincie where IDRegione='".$reg."' order by Descrizione");
	$prov = "<option value=''>-- Seleziona -- </option>";
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	   $prov .= "<option value='".$row["ID"]."'>".$row["Descrizione"]."</option>";
	}
	mysql_free_result($result);
	
	die($prov);
}

if($_REQUEST["action"] == "loadmodelli")
{
	$marca= $_POST["idmarca"];
	
	//lista delle marche
	$url = 'http://www.carqueryapi.com/api/0.3/?callback=?&cmd=getModels&make='.$marca;
	$content = file_get_contents($url);
	
	$content = substr($content, 4);
	$content = substr($content,0,-2);

	$json = json_decode($content, true);

	$marca = "<option value=''>* Modello </option>";

	foreach($json["Models"] as $item) {
		$marca .= "<option value='".$item['model_name']."'>".$item['model_name']."</option>";
	}
	
	die($marca);

}

if($_REQUEST["action"] == "loadmodelli2")
{
	$marca= $_POST["idmarca"];
	
	//lista delle marche
	$url = 'http://www.carqueryapi.com/api/0.3/?callback=?&cmd=getModels&make='.$marca;
	$content = file_get_contents($url);
	
	$content = substr($content, 4);
	$content = substr($content,0,-2);

	$json = json_decode($content, true);

	$marca = "<option value='' selected>Modello</option>";

	foreach($json["Models"] as $item) {
		$marca .= "<option value='".$item['model_name']."'>".$item['model_name']."</option>";
	}
	
	die($marca);

}

if($_REQUEST["action"] == "loadcomuni")
{	
	$prov= $_POST["idprovincia"];
	$result = mysql_query("SELECT ID, Descrizione FROM anag_comuni where IDProvincia='".$prov."' order by Descrizione");
	$com = "<option value=''>-- Seleziona -- </option>";
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	   $com .= "<option value='".$row["ID"]."'>".$row["Descrizione"]."</option>";
	}
	mysql_free_result($result);
	
	die($com);
}

if($_REQUEST["action"] == "verificamail")
{	
	$mail= $_POST["mail"];
	
	$result = mysql_query("SELECT email FROM utenti where email like '".$mail."'");
	
	$a="ok";
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		$a="no";
	
	die($a);
	
	mysql_free_result($result);
}

if($_REQUEST["action"] == "login")
{		
	foreach($_POST as $key=>$val) {
		if($key=="email")
		{
			$mail=$val;
		}
		if($key=="password")
		{
			$pass=$val;
		}
	}
	
	$result = mysql_query("SELECT Id, nome, cognome, tipoutente FROM utenti where email like '".$mail."' and password like '".$pass."'");
	
	$a="no";
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$nome=$row["nome"];
		$cognome=$row["cognome"];
		$tipoutente=$row["tipoutente"];
		
		$_SESSION['id']=$row["Id"];
		$_SESSION['tipo']=$tipoutente;
		
		$a="ok";
	}
	
	if ($a=="ok"){
		if ($tipoutente==2)
			die("Benvenuto $nome");
		else
			die("Benvenuto $nome $cognome");
	}
	die($a);
	
	mysql_free_result($result);
}

if($_REQUEST["action"] == "tabella") {

	$result = mysql_query("SELECT * FROM vistaauto where idutente='".$_SESSION['id']."'");
	$tab="						<table>
							<thead>
								<tr>
									<th style='width:22%'>Marca</th>
									<th style='width:22%'>Modello</th>
									<th style='width:22%'>Prezzo</th>
									<th style='width:22%'>Chilometraggio</th>
									<th style='width:12%'>Operazioni</th>
								</tr>
							</thead>
							<tbody>";
	$conta=0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$a=$row["Marca"];
		$a=str_replace("-"," ",$a);
	
		$a=ucwords($a);
		
		$n=strlen($a);
		if($n<=3)
			$a=strtoupper($a);
		
		$b=number_format($row['Chilometraggio'],0,",",".");
		if ($b == "")
			$b="Non Specificato";
		
		$c=$row['Modello'];
		$d=number_format($row['Prezzo'],2,",",".");
		
		$conta++;
		if (($conta % 2) == 0){
			$tab .= "<tr class='odd'>
								  <td>$a</td>
								  <td>$c</td>
								  <td>$d &euro;</td>
								  <td>$b km</td>
								  <td><a href='dettagli.php?id=".$row['Id']."'><img src='images/icons/zi.png' style='margin-right:15px; margin-left:0px;'/></a>
								  <a onclick='elimina(".$row['Id'].")' id='elimina'><img src='images/icons/re.png' /></a></td>
								</tr>";
		}
		else {
			$tab .= "<tr>
								  <td>$a</td>
								  <td>$c</td>
								  <td>$d &euro;</td>
								  <td>$b km</td>
								  <td><a href='dettagli.php?id=".$row['Id']."'><img src='images/icons/zi.png' style='margin-right:15px; margin-left:0px;'/></a>
								  <a onclick='elimina(".$row['Id'].")' id='elimina'><img src='images/icons/re.png' /></a></td>
								</tr>";
		}
	}
	$tab .= "</tbody>
						</table>";
	mysql_free_result($result);
	
	die($tab);
	

}

if($_REQUEST["action"] == "tabella2") {

	$result = mysql_query("SELECT * FROM vistaauto where idutente='".$_SESSION['id']."'");
	$tab="						<table>
							<thead>
								<tr>
									<th style='width:15%'>Marca</th>
									<th style='width:15%'>Modello</th>
									<th style='width:18%'>Prezzo</th>
									<th style='width:24%'>Prezzo Altre Concessionarie</th>
									<th style='width:18%'>Veicolo Condiviso</th>
									<th style='width:10%'>Dettaglio</th>
								</tr>
							</thead>
							<tbody>";
	$conta=0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$a=$row["Marca"];
		$a=str_replace("-"," ",$a);
	
		$a=ucwords($a);
		
		$n=strlen($a);
		if($n<=3)
			$a=strtoupper($a);
		
		$b=$row['condividiveicolo'];
		if ($b == "0")
			$b="Non Specificato";
		else if ($b == "1")
			$b="Si";
		else if ($b == "2")
			$b="No";
		
		$c=$row['Modello'];
		$d=number_format($row['Prezzo'],2,",",".");
		
		$e=number_format($row['PrezzoConcessionari'],2,",",".");
		if ($e == "")
			$e="Non Specificato";
		
		
		$conta++;
		if (($conta % 2) == 0){
			$tab .= "<tr class='odd'>
								  <td>$a</td>
								  <td>$c</td>
								  <td>$d &euro;</td>
								  <td>$e &euro;</td>
								  <td>$b</td>
								  <td><a href='dettagli.php?id=".$row['Id']."'><img src='images/icons/zi.png' style='margin-right:15px; margin-left:0px;'/></a>
								 <a onclick='elimina(".$row['Id'].")' id='elimina'><img src='images/icons/re.png' /></a></td>
								</tr>";
		}
		else {
			$tab .= "<tr>
								  <td>$a</td>
								  <td>$c</td>
								  <td>$d &euro;</td>
								  <td>$e &euro;</td>
								  <td>$b</td>
								  <td> <a href='dettagli.php?id=".$row['Id']."'> <img src='images/icons/zi.png' style='margin-right:15px; margin-left:0px;'/></a>
								  <!--<a onclick='elimina(".$row['Id'].")' id='elimina'><img src='images/icons/re.png' /></a>--></td>
								</tr>";
		}
	}
	$tab .= "</tbody>
						</table>";
	mysql_free_result($result);
	
	die($tab);
	

}

if($_REQUEST["action"] == "elimina") {
	
	$id=$_POST["id"];
	$result = mysql_query("DELETE FROM autoveicoli WHERE Id = $id");

	mysql_free_result($result);
	
	die("Cancellazione avvenuta con successo!");
}


if($_REQUEST["action"] == "elencoauto")
{	

	if($_REQUEST["limit"] > 0) $limit = $_REQUEST["limit"];
	else $limit = 8;
	
	if($_REQUEST["start"] == "") $start = 0;
	else $start = $_REQUEST["start"];

	if($_REQUEST["query"] != "") $query = " WHERE ".$_REQUEST["query"];
	else $query = " ";
	
	$tiporic= $_REQUEST["tiporic"];
	$ordine= $_REQUEST["ordine"];
	
	$page =($_REQUEST["page"]);
	
	if ($page>1)
	$start = $start-8;
    if ($page==1)
	$start = 0;		
	
	$result = mysql_query("SELECT * FROM vistaauto ".$query." LIMIT ".$start.",".$limit);
	$elenco = "";
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$a=$row["Marca"];
		$a=str_replace("-"," ",$a);
		$a=ucwords($a);
		$n=strlen($a);
		if($n<=3)
			$a=strtoupper($a);
						
		$d=number_format($row['Prezzo'],2,",",".");
				
		$b=number_format($row['Chilometraggio'],0,",",".");
		$result2 = mysql_query("SELECT LEFT(Descrizione, '200') as descr from autoveicoli where Id='".$row["Id"]."'");
		$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
		
		$elenco .="<div class='offer_item clearfix'>
						<div class='offer_image'><a href='dettagli.php?id=".$row["Id"]."'><img src='".$gl.$row["Immagine1"]."' alt='' style='width:100%; height:100%;'></a></div>
						<div class='offer_aside'>
							<h2><a href='dettagli.php?id=".$row["Id"]."'>".$a." ".$row["Modello"]." ".$row["Versione"]."</a></h2>
							<div class='offer_descr'>
								<p>".$row2["descr"]."</p>
							</div>
							<div class='offer_data'>
								<div class='offer_price'>&euro; ".$d."</div>
								<span class='offer_miliage'>".$b." KM</span>
								<span class='offer_regist'>".$row["MeseImmatricolazione"]."/".$row["AnnoImmatricolazione"]."</span>                            
							</div>
						</div>
					</div>";	
	}
	
	die($elenco);
}

if($_REQUEST["action"] == "elencoauto2")
{	

	if($_REQUEST["limit"] > 0) $limit = $_REQUEST["limit"];
	else $limit = 8;
	
	if($_REQUEST["start"] == "") $start = 0;
	else $start = $_REQUEST["start"];

	if($_REQUEST["query"] != "") $query = " WHERE ".$_REQUEST["query"];
	else $query = " ";
	
	$tiporic= $_REQUEST["tiporic"];
	$ordine= $_REQUEST["ordine"];
	
	$page =($_REQUEST["page"]);
	
	if ($page>1)
	$start = $start-8;
    if ($page==1)
	$start = 0;		
	
	$result = mysql_query("SELECT * FROM vistaauto ".$query." LIMIT ".$start.",".$limit);
	$elenco = "";
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$a=$row["Marca"];
		$a=str_replace("-"," ",$a);
		$a=ucwords($a);
		$n=strlen($a);
		if($n<=3)
			$a=strtoupper($a);
						
		$d=number_format($row['PrezzoConcessionari'],2,",",".");
				
		$b=number_format($row['Chilometraggio'],0,",",".");
		$result2 = mysql_query("SELECT LEFT(Descrizione, '200') as descr from autoveicoli where Id='".$row["Id"]."'");
		$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
		
		$elenco .="<div class='offer_item clearfix'>
						<div class='offer_image'><a href='dettagli.php?id=".$row["Id"]."'><img src='".$gl.$row["Immagine1"]."' alt='' style='width:100%; height:100%;'></a></div>
						<div class='offer_aside'>
							<h2><a href='dettagli.php?id=".$row["Id"]."'>".$a." ".$row["Modello"]." ".$row["Versione"]."</a></h2>
							<div class='offer_descr'>
								<p>".$row2["descr"]."</p>
							</div>
							<div class='offer_data'>
								<div class='offer_price'>&euro; ".$d."</div>
								<span class='offer_miliage'>".$b." KM</span>
								<span class='offer_regist'>".$row["MeseImmatricolazione"]."/".$row["AnnoImmatricolazione"]."</span>                            
							</div>
						</div>
					</div>";	
	}
	
	die($elenco);
}


if($_REQUEST["action"] == "elencopag")
{	

	if($_REQUEST["limit"] > 0) $limit = $_REQUEST["limit"];
	else $limit = 8;
	
	if($_REQUEST["start"] == "") $start = 0;
	else $start = $_REQUEST["start"];

	if($_REQUEST["query"] != "") $query = " WHERE ".$_REQUEST["query"];
	else $query = " ";
	
	$tiporic= $_REQUEST["tiporic"];
	$ordine= $_REQUEST["ordine"];
	
	$page =($_REQUEST["page"]);

	
	
	if ($page>1)
	$start = $start-8;
    if ($page==1)
	$start = 0;		
	
	
	//*********** impaginazione ******************************************
	$result = mysql_query("SELECT COUNT(ID) AS Tot FROM vistaauto".$query);
	$arr = mysql_fetch_array($result, MYSQL_ASSOC);
	$total_pages = 0;
	$total_pages = $arr["Tot"];
	
	$stages = 1;
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;	
	
	$paginate = '';
	if($lastpage > 1)
	{	

		$paginate .= "";
		// Previous
		
		if ($page > 1){
			$paginate.= "<a onClick=\"Elenco(query, ".($prev*$limit).", limit, tiporic, ".($prev).", '".$ordine."'); return false;\" href='' class='page_prev'><span></span>PREV</a> ";
		}else{
			$paginate.= "<a class='page_prev'><span></span>PREV</a> ";	}
		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='page-numbers page_current'>$counter</span>";
				}else{
					$paginate.= "<a href='' onClick=\"Elenco(query, ".($counter*$limit).", limit, tiporic, ".($counter).", '".$ordine."'); return false;\"  class='page-numbers'>$counter</a> ";}					
			}
			//die($paginate);
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='page-numbers page_current'>$counter</span>";
					}else{
						$paginate.= "<a href='' onClick=\"Elenco(query, ".($counter*$limit).", limit, tiporic, ".($counter).", '".$ordine."'); return false;\"  class='page-numbers'>$counter</a> ";}					
				}
				$paginate.= "&hellip; ";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".($LastPagem1*$limit).", limit, tiporic, ".($LastPagem1).", '".$ordine."'); return false;\"  class='page-numbers'>$LastPagem1</a>";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".($lastpage*$limit).", limit, tiporic, ".($lastpage).", '".$ordine."'); return false;\" class='page-numbers'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='' onClick=\"Elenco(query, ".(1*$limit).", limit, tiporic, 1, '".$ordine."'); return false;\" class='page-numbers'>1</a>";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".(2*$limit).", limit, tiporic, 2, '".$ordine."'); return false;\" class='page-numbers'>2</a>";
				$paginate.= "&hellip;";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='page-numbers page_current'>$counter</span>";
					}else{
						$paginate.= "<a href='' onClick=\"Elenco(query, ".($counter*$limit).", limit, tiporic, ".($counter).", '".$ordine."'); return false;\" class='page-numbers'>$counter</a>";}					
				}
				$paginate.= "&hellip;";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".($LastPagem1*$limit).", limit, tiporic, ".($LastPagem1).", '".$ordine."'); return false;\" class='page-numbers'>$LastPagem1</a>";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".($lastpage*$limit).", limit, tiporic, ".($lastpage).", '".$ordine."'); return false;\" class='page-numbers'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='' onClick=\"Elenco(query, ".(1*$limit).", limit, tiporic, 1, '".$ordine."'); return false;\" class='page-numbers'>1</a>";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".(2*$limit).", limit, tiporic, 2, '".$ordine."'); return false;\" class='page-numbers'>2</a>";
				$paginate.= "&hellip;";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='page-numbers page_current'>$counter</span>";
					}else{
						$paginate.= "<a href='' onClick=\"Elenco(query, ".($counter*$limit).", limit, tiporic, ".($counter).", '".$ordine."'); return false;\" class='page-numbers'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a class='page_next' href='' onClick=\"Elenco(query, ".($next*$limit).", limit, tiporic, ".($next).", '".$ordine."'); return false;\"> <span></span>NEXT </a>";
		}else{
			$paginate.= "<a class='page_next'><span></span>NEXT</a>";
			}
			
		
	}
		
	$inviare=$paginate;
	
	die($inviare);
}

function disgeod ($latA, $lonA, $latB, $lonB)
{
      /* Definisce le costanti e le variabili */
      $R = 6371.005076123;
      $pigreco = pi ();
      
      /* Converte i gradi in radianti */
      $lat_alfa = $pigreco * $latA / 180.0;
      $lat_beta = $pigreco * $latB / 180.0;
      $lon_alfa = $pigreco * $lonA / 180.0;
      $lon_beta = $pigreco * $lonB / 180.0;
      /* Calcola l'angolo compreso fi */
      $fi = abs($lon_alfa - $lon_beta);
      /* Calcola il terzo lato del triangolo sferico */
	  $p = acos(sin($lat_beta) * sin($lat_alfa) +
        cos($lat_beta) * cos($lat_alfa) * cos($fi));
      /* Calcola la distanza sulla superficie
      terrestre R = ~6371 km */
      $d = $p * $R;
      return($d);
}	
	
if($_REQUEST["action"] == "elencoauto5")
{	

	if($_REQUEST["limit"] > 0) $limit = $_REQUEST["limit"];
	else $limit = 8;
	
	if($_REQUEST["start"] == "") $start = 0;
	else $start = $_REQUEST["start"];

	if($_REQUEST["query"] != "") $query = " ".$_REQUEST["query"];
	else $query = " ";
	
	$tiporic= $_REQUEST["tiporic"];
	$ordine= $_REQUEST["ordine"];
	$citta= $_REQUEST["citta"];
	$distanza= $_REQUEST["distanza"];
	
	if ($citta != ""){
		$a1=urlencode($citta);
		$geocode1=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$a1&sensor=false");

		$output1= json_decode($geocode1);

		$lat1 = $output1->results[0]->geometry->location->lat;
		$long1 = $output1->results[0]->geometry->location->lng;
		
		
	}
	
	$page =($_REQUEST["page"]);
	
	if ($page>1)
	$start = $start-8;
    if ($page==1)
	$start = 0;		
	
	$pi = 3.1415926535898;  
	$raggio_quadratico_medio = 6372.795477598;  
	
	if ($distanza != ""){
	
		$result = mysql_query("SELECT *,($raggio_quadratico_medio*ACOS( 
                        (SIN($pi * $lat1 / 180)*SIN($pi * lat / 180)) + 
                        (COS($pi * $lat1 / 180)*COS($pi * lat / 180) * COS(ABS(($pi * $long1 / 180) - ($pi * lon / 180))) ) 
                          )) as distanza  FROM vistaauto2 ".$query." LIMIT ".$start.",".$limit);
	}
	else {
	
		$result = mysql_query("SELECT * FROM vistaauto ".$query." LIMIT ".$start.",".$limit);
	}
		
		
	$elenco = "";
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	

				
				$a=$row["Marca"];
				$a=str_replace("-"," ",$a);
				$a=ucwords($a);
				$n=strlen($a);
				if($n<=3)
					$a=strtoupper($a);
								
				$d=number_format($row['Prezzo'],2,",",".");
						
				$b=number_format($row['Chilometraggio'],0,",",".");
				$result2 = mysql_query("SELECT LEFT(Descrizione, '200') as descr from autoveicoli where Id='".$row["Id"]."'");
				$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
				
				$elenco .="<div class='offer_item clearfix'>
								<div class='offer_image'><a href='dettagli.php?id=".$row["Id"]."'><img src='".$gl.$row["Immagine1"]."' alt='' style='width:100%; height:100%;'></a></div>
								<div class='offer_aside'>
									<h2><a href='dettagli.php?id=".$row["Id"]."'>".$a." ".$row["Modello"]." ".$row["Versione"]."</a></h2>
									<div class='offer_descr'>
										<p>".$row2["descr"]."</p>
									</div>
									<div class='offer_data'>
										<div class='offer_price'>&euro; ".$d."</div>
										<span class='offer_miliage'>".$b." KM</span>
										<span class='offer_regist'>".$row["MeseImmatricolazione"]."/".$row["AnnoImmatricolazione"]."</span>                            
									</div>
								</div>
							</div>";
		
	}
	
	die($elenco);
}

if($_REQUEST["action"] == "elencopag5")
{	

	if($_REQUEST["limit"] > 0) $limit = $_REQUEST["limit"];
	else $limit = 8;
	
	if($_REQUEST["start"] == "") $start = 0;
	else $start = $_REQUEST["start"];

	if($_REQUEST["query"] != "") $query = " ".$_REQUEST["query"];
	else $query = " ";
	
	$tiporic= $_REQUEST["tiporic"];
	$ordine= $_REQUEST["ordine"];
	$citta= $_REQUEST["citta"];
	$distanza= $_REQUEST["distanza"];
	
	if ($citta != ""){
		$a1=urlencode($citta);
		$geocode1=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$a1&sensor=false");

		$output1= json_decode($geocode1);

		$lat1 = $output1->results[0]->geometry->location->lat;
		$long1 = $output1->results[0]->geometry->location->lng;
	}
	
	$page =($_REQUEST["page"]);

	
	
	if ($page>1)
	$start = $start-8;
    if ($page==1)
	$start = 0;		
	
	$pi = 3.1415926535898;  
	$raggio_quadratico_medio = 6372.795477598;  
	

	//*********** impaginazione ******************************************
	if ($distanza != ""){
		$conta=0;
		
		$result = mysql_query("SELECT *,($raggio_quadratico_medio*ACOS( 
                        (SIN($pi * $lat1 / 180)*SIN($pi * lat / 180)) + 
                        (COS($pi * $lat1 / 180)*COS($pi * lat / 180) * COS(ABS(($pi * $long1 / 180) - ($pi * lon / 180))) ) 
                          )) as distanza  FROM vistaauto2 ".$query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			
				$conta++;
		}
		
		$total_pages = $conta;
	
	}
	else{
		$result = mysql_query("SELECT COUNT(ID) AS Tot FROM vistaauto".$query);
		$arr = mysql_fetch_array($result, MYSQL_ASSOC);
		$total_pages = 0;
		$total_pages = $arr["Tot"];
	}
	
	$stages = 1;
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;	
	
	$paginate = '';
	if($lastpage > 1)
	{	

		$paginate .= "";
		// Previous
		
		if ($page > 1){
			$paginate.= "<a onClick=\"Elenco(query, ".($prev*$limit).", limit, tiporic, ".($prev).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\" href='' class='page_prev'><span></span>PREV</a> ";
		}else{
			$paginate.= "<a class='page_prev'><span></span>PREV</a> ";	}
		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='page-numbers page_current'>$counter</span>";
				}else{
					$paginate.= "<a href='' onClick=\"Elenco(query, ".($counter*$limit).", limit, tiporic, ".($counter).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\"  class='page-numbers'>$counter</a> ";}					
			}
			//die($paginate);
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='page-numbers page_current'>$counter</span>";
					}else{
						$paginate.= "<a href='' onClick=\"Elenco(query, ".($counter*$limit).", limit, tiporic, ".($counter).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\"  class='page-numbers'>$counter</a> ";}					
				}
				$paginate.= "&hellip; ";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".($LastPagem1*$limit).", limit, tiporic, ".($LastPagem1).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\"  class='page-numbers'>$LastPagem1</a>";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".($lastpage*$limit).", limit, tiporic, ".($lastpage).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='' onClick=\"Elenco(query, ".(1*$limit).", limit, tiporic, 1, '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>1</a>";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".(2*$limit).", limit, tiporic, 2, '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>2</a>";
				$paginate.= "&hellip;";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='page-numbers page_current'>$counter</span>";
					}else{
						$paginate.= "<a href='' onClick=\"Elenco(query, ".($counter*$limit).", limit, tiporic, ".($counter).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>$counter</a>";}					
				}
				$paginate.= "&hellip;";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".($LastPagem1*$limit).", limit, tiporic, ".($LastPagem1).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>$LastPagem1</a>";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".($lastpage*$limit).", limit, tiporic, ".($lastpage).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='' onClick=\"Elenco(query, ".(1*$limit).", limit, tiporic, 1, '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>1</a>";
				$paginate.= "<a href='' onClick=\"Elenco(query, ".(2*$limit).", limit, tiporic, 2, '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>2</a>";
				$paginate.= "&hellip;";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='page-numbers page_current'>$counter</span>";
					}else{
						$paginate.= "<a href='' onClick=\"Elenco(query, ".($counter*$limit).", limit, tiporic, ".($counter).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\" class='page-numbers'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a class='page_next' href='' onClick=\"Elenco(query, ".($next*$limit).", limit, tiporic, ".($next).", '".$ordine."', '".$citta."', '".$distanza."'); return false;\"> <span></span>NEXT </a>";
		}else{
			$paginate.= "<a class='page_next'><span></span>NEXT</a>";
			}
			
		
	}
		
	$inviare=$paginate;
	
	die($inviare);
}



?>