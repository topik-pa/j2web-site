<?php
session_start();

include("config.inc.php");
include("funzioni.php");

$gallery= "imgauto/";

$id=$_GET["id"];
$result = mysql_query("SELECT * FROM vistaauto where Id='$id'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
/**/
$idCarburante = $row["idCarburante"];
$queryCarburante = mysql_query("SELECT * FROM carburante where id='$idCarburante'");
$rowCarburante = mysql_fetch_array($queryCarburante, MYSQL_ASSOC);

$idTipologia = $row["idTipologia"];
$queryTipologia = mysql_query("SELECT * FROM tipoauto where id='$idTipologia'");
$rowTipologia = mysql_fetch_array($queryTipologia, MYSQL_ASSOC);

$idCarrozzeria = $row["idCarrozzeria"];
$queryCarrozzeria = mysql_query("SELECT * FROM carrozzeriaauto where id='$idCarrozzeria'");
$rowCarrozzeria = mysql_fetch_array($queryCarrozzeria, MYSQL_ASSOC);

$idColoreEsterno = $row["idColoreEsterno"];
$queryColoreEsterno = mysql_query("SELECT * FROM colore where id='$idColoreEsterno'");
$rowColoreEsterno = mysql_fetch_array($queryColoreEsterno, MYSQL_ASSOC);

/**/

$a=$row["Marca"];
$a=str_replace("-"," ",$a);
$a=ucwords($a);
$n=strlen($a);
if($n<=3)
	$a=strtoupper($a);

if(isset($_REQUEST['a'])){
?>
<script>
alert("Messaggio inviato con successo! Controlla nella sezione spam della tua casella di posta elettronica nel caso non visualizzi una mail di conferma di avvenuto invio messeggio");
</script>
<?php
}

if(isset($_REQUEST['b'])){
?>
<script>
alert("Messaggio inviato con successo! Controlla nella sezione spam della tua casella di posta elettronica nel caso non visualizzi una mail di conferma di avvenuto invio messeggio");
</script>
<?php
}
?>
<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
<head>
<?php include("metascript.php"); ?>
</head>

<script>
function validation(){

	if((document.getElementsByName("nome")[0].value) == "")
	{ 
		alert("Devi inserire il nome");
		return false;
	}
	if((document.getElementsByName("mail")[0].value) == "")
	{ 
		alert("Devi inserire la mail");
		return false;
	}
	if((document.getElementsByName("mess")[0].value) == "")
	{ 
		alert("Devi inserire il messaggio");
		return false;
	}

		return true;
	
}

function validation2(){

	if((document.getElementsByName("nome2")[0].value) == "")
	{ 
		alert("Devi inserire la tua mail");
		return false;
	}
	if((document.getElementsByName("nome3")[0].value) == "")
	{ 
		alert("Devi inserire la mail del tuo amico");
		return false;
	}
	if((document.getElementsByName("mess2")[0].value) == "")
	{ 
		alert("Devi inserire il messaggio");
		return false;
	}

		return true;
	
}

</script>

<body>
<div class="body_wrap">
	
	<!-- header top bar -->
	<?php 
		if(isset($_SESSION['id']))
			include("header2.php"); 
		else
			include("header.php"); 
	?>
	<!--/ header top bar -->
		
	<!-- header -->
	<div class="header header_thin" style="background-image:url(images/temp/slider_1_1.jpg)">
            
		<div class="header_title">
			<h1><span><?php echo $a; ?></span> <?php echo $row["Modello"]." ".$row["Versione"]." ".$row["AnnoImmatricolazione"]; ?></h1>
		</div>

	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.php">Home</a> <span class="separator">&rsaquo;</span> <a href="categorie.php?tiporic=<?php echo $row["idTipologia"]; ?>"><?php echo $row["tipoauto"]; ?></a> 
			<span class="separator">&rsaquo;</span> <a ><?php echo $row["Contratto"]; ?></a> 
			<span class="separator">&rsaquo;</span><a href="tipologie.php?tiporic=<?php echo $row["idCarrozzeria"]; ?>"><?php echo $row["carrozzeria"]; ?> </a> 
			<span class="separator">&rsaquo;</span>  
			<?php echo $a ?>  
			<a href="javascript:history.back();" class="link_back">Torna alla pagina precedente</a>
		</div>
	</div>
	<!--/ breadcrumbs -->

	<!-- middle -->   
	<div id="middle" class="full_width">
		<div class="container clearfix">  
		
			<!-- content -->
			<div class="content">
				
				<div class="offer_details clearfix">
					<!-- offer left -->
					<div class="offer_gallery">
						<div class="gallery_images">
							<div id="gallery_images">
								<?php
								if ($row["Immagine1"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine1"]."' style='width:100%; height:100%;' />
											<a href='".$gallery.$row["Immagine1"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine2"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine2"]."' style='width:100%; height:100%;' />
											<a href='".$gallery.$row["Immagine2"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine3"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine3"]."' style='width:100%; height:100%;' />
											<a href='".$gallery.$row["Immagine3"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine4"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine4"]."' style='width:100%; height:100%' />
											<a href='".$gallery.$row["Immagine4"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine5"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine5"]."'  style='width:100%; height:100%' />
											<a href='".$gallery.$row["Immagine5"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine6"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine6"]."' style='width:100%; height:100%' / >
											<a href='".$gallery.$row["Immagine6"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine7"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine7"]."' style='width:100%; height:100%' / >
											<a href='".$gallery.$row["Immagine7"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine8"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine8"]."' style='width:100%; height:100%' / >
											<a href='".$gallery.$row["Immagine8"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine9"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine9"]."' style='width:100%; height:100%'' / >
											<a href='".$gallery.$row["Immagine9"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								
								if ($row["Immagine10"] != ""){
								echo	"<div class='gallery_image_item'>
											<img src='".$gallery.$row["Immagine10"]."' style='width:100%; height:100%' / >
											<a href='".$gallery.$row["Immagine10"]."' data-rel='prettyPhoto[gal]'><span><em class='ico_large'></em></span></a>
										</div>";
								}
								?>
								
							</div>
						</div>
						
						<div class="gallery_thumbs">
							<div id="gallery_thumbs">
								<?php
								if ($row["Immagine1"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine1"]."'></a>";
								}
								
								if ($row["Immagine2"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine2"]."'></a>";
								}
								
								if ($row["Immagine3"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine3"]."'></a>";
								}
								
								if ($row["Immagine4"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine4"]."'></a>";
								}
								
								if ($row["Immagine5"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine5"]."'></a>";
								}
								
								if ($row["Immagine6"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine6"]."'></a>";
								}
								
								if ($row["Immagine7"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine7"]."'></a>";
								}
								
								if ($row["Immagine8"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine8"]."'></a>";
								}
								
								if ($row["Immagine9"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine9"]."'></a>";
								}
								
								if ($row["Immagine10"] != "NULL"){
								echo	"<a href='#'><img src='".$gallery.$row["Immagine10"]."'></a>";
								}
								?>
								
							</div>
							<a href="#" class="prev" id="gallery_thumbs_prev"></a>
							<a href="#" class="next" id="gallery_thumbs_next"></a>
						</div>
						
						
					</div>
					<!--/ offer left -->
					<!-- offer right -->
					<div class="offer_aside">
						<div class="offer_price">
							<?php
							if(isset($_SESSION['id'])){
								if($_SESSION['tipo'] == 2){
									if ($row['condividiveicolo'] == 1){
										if ($row['PrezzoConcessionari'] != ""){
											$p=number_format($row['PrezzoConcessionari'],0,",",".");	
											$p1=number_format($row['Prezzo'],0,",",".");	
											echo "<strong>".$p." EUR</strong><br>
													<em>Prezzo Standard ".$p1." EUR</em><br>";
										}
										else {
											$p=number_format($row['Prezzo'],0,",",".");
											echo "<strong>".$p." EUR</strong><br>";
										}
									}
									else {
										$p=number_format($row['Prezzo'],0,",",".");
										echo "<strong>".$p." EUR</strong><br>";
									}
								}
								else {
									$p=number_format($row['Prezzo'],0,",",".");
									echo "<strong>".$p." EUR</strong><br>";
								}
							}
							else {
								$p=number_format($row['Prezzo'],0,",",".");
								echo "<strong>".$p." EUR</strong><br>";
							}
							if ($row['Trattabile'] == 0){
								echo "<em>Prezzo Trattabile: Non Specificato</em>";
							}
							else if ($row['Trattabile'] == 1){
								echo "<em>Prezzo Trattabile: Si</em>";
							}
							else if ($row['Trattabile'] == 2){
								echo "<em>Prezzo Trattabile: No</em>";
							}
							
							?>
							
						</div>
						
						<div class="offer_data">
							<ul>
							
								<?php
								if ($row["Chilometraggio"] != 0){
									echo "<li>" . $row["MeseImmatricolazione"] . "/" .$row["AnnoImmatricolazione"] . "</li>";
								}
								else {
									echo "<li>" . "Da immatricolare" . "</li>";
								}
								?>
							
								
								<?php
								if ($row["Chilometraggio"] != 0){
									echo "<li>".$row["Chilometraggio"]." KM</li>";
								}
								?>
								<li><?php echo $rowCarburante["descrizione"]; ?></li>
								<?php
								if ($row["Cilindrata"] != 0){
									echo "<li>".$row["Cilindrata"]." CC</li>";
								}
								?>
							</ul>
						</div>
						
						<div class="offer_descr">
							<p><?php echo $row["Descrizione"]; ?></p>
						</div>
						
						<div class="offer_specification">
							<ul>
								<li><span class="spec_name">Tipo Contratto:</span> <strong class="spec_value"><?php echo $row["Contratto"]; ?></strong> </li>
								<?php
								if ($row["PotenzaKW"] != 0){
									echo "<li><span class='spec_name'>Potenza KW:</span> <strong class='spec_value'>".$row["PotenzaKW"]." KW</strong></li>";
								}
								else {
									echo "<li><span class='spec_name'>Potenza KW:</span> <strong class='spec_value'>Non Specificato</strong></li>";
								}
								?>
								<li><span class="spec_name">Tipologia:</span> <strong class="spec_value"><?php echo $rowTipologia["descrizione"]; ?></strong> </li>
								<li><span class="spec_name">Categoria:</span> <strong class="spec_value"><?php echo $rowCarrozzeria["descrizione"]; ?></strong> (<?php echo $row["PostiASedere"]; ?> porte)</li>
								<?php
								if ($row["Cambio"] != ""){
									echo "<li><span class='spec_name'>Cambio:</span> <strong class='spec_value'>".$row["Cambio"]."</strong>";
									if ($row["NumRapporti"] != "0"){
										echo " (".$row["NumRapporti"]." marce)</li>";
									}
									else{
										echo "</li>";
									}
								}
								else {
									echo "<li><span class='spec_name'>Cambio:</span> <strong class='spec_value'>Non Specificato</strong></li>";
								}
								if ($row["ClasseEmissione"] != ""){
									echo "<li><span class='spec_name'>Classe di Emissione:</span> <strong class='spec_value'>".$row["ClasseEmissione"]."</strong></li>";
								}
								else {
									echo "<li><span class='spec_name'>Classe di Emissione:</span> <strong class='spec_value'>Non Specificato</strong></li>";
								}
								?>
								<li><span class="spec_name">Luogo Veicolo:</span> <strong class="spec_value"><?php echo $row["Indirizzo"]; ?></strong></li>
							</ul>
						</div>
						
					</div>
					<!--/ offer right -->
				</div>
				
				<!-- details tabs -->
				<div class="details_tabs">
					<ul class="tabs linked">
						<li><a href="#t_overview"><span>DETTAGLI</span></a></li>
						
						<li><a href="#t_contacts"><span>CONTATTACI</span></a></li>
						<li><a href="#t_send"><span>CONDIVIDI</span></a></li>
					</ul>
					<div id="t_overview" class="tabcontent clearfix">
						<div class="col col_1_3">
							
							<ul>
								<?php
								if ($rowColoreEsterno["descrizione"] != ""){
									echo "<li>Colore Esterno: <strong class='spec_value'>".$rowColoreEsterno["descrizione"]."</strong></li>";
								}
								else {
									echo "<li>Colore Esterno: <strong class='spec_value'>Non Specificato</strong></li>";
									
								}
								
								if ($row["Metallizzato"] == 0){
									echo "<li>Metallizzato: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["Metallizzato"] == 1){
									echo "<li>Metallizzato: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["Metallizzato"] == 2){
									echo "<li>Metallizzato: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["PrecedentiProprietari"] == 0){
									echo "<li>Precedenti Proprietari: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else {
									echo "<li>Precedenti Proprietari: <strong class='spec_value'>".$row["PrecedentiProprietari"]."</strong></li>";
								}
								
								if ($row["FinitureInterni"] != ""){
									echo "<li>Finiture Interni: <strong class='spec_value'>".$row["FinitureInterni"]."</strong></li>";
								}
								else {
									echo "<li>Finiture Interni: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								
								if ($row["ColoreInterni"] != ""){
									echo "<li>Colore Interni: <strong class='spec_value'>".$row["ColoreInterni"]."</strong></li>";
								}
								else {
									echo "<li>Colore Interni: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								
								if ($row["ABS"] == 0){
									echo "<li>ABS: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["ABS"] == 1){
									echo "<li>ABS: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["ABS"] == 2){
									echo "<li>ABS: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["Airbag"] == 0){
									echo "<li>Airbag: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["Airbag"] == 1){
									echo "<li>Airbag: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["Airbag"] == 2){
									echo "<li>Airbag: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["Antifurto"] == 0){
									echo "<li>Antifurto: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["Antifurto"] == 1){
									echo "<li>Antifurto: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["Antifurto"] == 2){
									echo "<li>Antifurto: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["Portapacchi"] == 0){
									echo "<li>Portapacchi: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["Portapacchi"] == 1){
									echo "<li>Portapacchi: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["Portapacchi"] == 2){
									echo "<li>Portapacchi: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["ConsumoMedio"] == 0){
									echo "<li>Consumo Medio: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else {
									echo "<li>Consumo Medio: <strong class='spec_value'>".$row["ConsumoMedio"]." (l/100km)</strong></li>";
								}
								?>
							</ul>
						</div>
						
						<div class="col col_1_3">
							<ul>
								<?php

								if ($row["ChiusuraCentralizzata"] == 0){
									echo "<li>Chiusura Centralizzata: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["ChiusuraCentralizzata"] == 1){
									echo "<li>Chiusura Centralizzata: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["ChiusuraCentralizzata"] == 2){
									echo "<li>Chiusura Centralizzata: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["ESP"] == 0){
									echo "<li>ESP: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["ESP"] == 1){
									echo "<li>ESP: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["ESP"] == 2){
									echo "<li>ESP: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["ControlloAutomTrazione"] == 0){
									echo "<li>Controllo AutomTrazione: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["ControlloAutomTrazione"] == 1){
									echo "<li>Controllo AutomTrazione: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["ControlloAutomTrazione"] == 2){
									echo "<li>Controllo AutomTrazione: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["Immobilizer"] == 0){
									echo "<li>Immobilizer: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["Immobilizer"] == 1){
									echo "<li>Immobilizer: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["Immobilizer"] == 2){
									echo "<li>Immobilizer: <strong class='spec_value'>No</strong></li>";
								}

								if ($row["FreniADisco"] == 0){
									echo "<li>Freni A Disco: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["FreniADisco"] == 1){
									echo "<li>Freni A Disco: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["FreniADisco"] == 2){
									echo "<li>Freni A Disco: <strong class='spec_value'>No</strong></li>";
								}

								if ($row["AlzacristalliElettrici"] == 0){
									echo "<li>Alzacristalli Elettrici: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["AlzacristalliElettrici"] == 1){
									echo "<li>Alzacristalli Elettrici: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["AlzacristalliElettrici"] == 2){
									echo "<li>Alzacristalli Elettrici: <strong class='spec_value'>No</strong></li>";
								}

								if ($row["Clima"] == 0){
									echo "<li>Clima: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["Clima"] == 1){
									echo "<li>Clima: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["Clima"] == 2){
									echo "<li>Clima: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["NavigatoreSatellitare"] == 0){
									echo "<li>Navigatore Satellitare: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["NavigatoreSatellitare"] == 1){
									echo "<li>Navigatore Satellitare: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["NavigatoreSatellitare"] == 2){
									echo "<li>Navigatore Satellitare: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["SediliSportivi"] == 0){
									echo "<li>Sedili Sportivi: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["SediliSportivi"] == 1){
									echo "<li>Sedili Sportivi: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["SediliSportivi"] == 2){
									echo "<li>Sedili Sportivi: <strong class='spec_value'>No</strong></li>";
								}
								?>
							</ul>
						</div>
						<div class="col col_1_4">
							
							<ul>
								<?php

								if ($row["RadioCD"] == 0){
									echo "<li>RadioCD: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["RadioCD"] == 1){
									echo "<li>RadioCD: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["RadioCD"] == 2){
									echo "<li>RadioCD: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["ParkDistControl"] == 0){
									echo "<li>ParkDistControl: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["ParkDistControl"] == 1){
									echo "<li>ParkDistControl: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["ParkDistControl"] == 2){
									echo "<li>ParkDistControl: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["SediliRiscaldati"] == 0){
									echo "<li>Sedili Riscaldati: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["SediliRiscaldati"] == 1){
									echo "<li>Sedili Riscaldati: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["SediliRiscaldati"] == 2){
									echo "<li>Sedili Riscaldati: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["Servosterzo"] == 0){
									echo "<li>Servosterzo: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["Servosterzo"] == 1){
									echo "<li>Servosterzo: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["Servosterzo"] == 2){
									echo "<li>Servosterzo: <strong class='spec_value'>No</strong></li>";
								}

								if ($row["VolanteMultifunzione"] == 0){
									echo "<li>Volante Multifunzione: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["VolanteMultifunzione"] == 1){
									echo "<li>Volante Multifunzione: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["VolanteMultifunzione"] == 2){
									echo "<li>Volante Multifunzione: <strong class='spec_value'>No</strong></li>";
								}

								if ($row["CerchiInLega"] == 0){
									echo "<li>Cerchi In Lega: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["CerchiInLega"] == 1){
									echo "<li>Cerchi In Lega: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["CerchiInLega"] == 2){
									echo "<li>Cerchi In Lega: <strong class='spec_value'>No</strong></li>";
								}

								if ($row["Handicap"] == 0){
									echo "<li>Handicap: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["Handicap"] == 1){
									echo "<li>Handicap: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["Handicap"] == 2){
									echo "<li>Handicap: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["GancioTraino"] == 0){
									echo "<li>Gancio Traino: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								else if ($row["GancioTraino"] == 1){
									echo "<li>Gancio Traino: <strong class='spec_value'>Si</strong></li>";
								}
								else if ($row["GancioTraino"] == 2){
									echo "<li>Gancio Traino: <strong class='spec_value'>No</strong></li>";
								}
								
								if ($row["Motore"] != ""){
									echo "<li>Motore: <strong class='spec_value'>".$row["Motore"]."</strong></li>";
								}
								else {
									echo "<li>Motore: <strong class='spec_value'>Non Specificato</strong></li>";
								}
								?>
							</ul>
						</div>
						
					</div>
					
					<div id="t_contacts" class="tabcontent clearfix">
						<form class="details_form"  action="inviamail.php"  onsubmit="return validation();">
							<div class="form_col_1">
								<div class="row">
									<label class="label_title">* Il tuo Nome:</label>
									<input type="text" name="nome" id="nome" class="controlla" value="">
								</div>
								<div class="row">
									<input type="hidden" name="id" id="id" value="<?php echo $row["Id"];?>">
									<label class="label_title">* La tua E-mail:</label>
									<input type="text" name="mail" id="mail" class="controlla" value="">
								</div>                            
							</div>
							<!--/ form col 1 -->
							<div class="form_col_2">
								<div class="row">
									<label class="label_title">* Messaggio:</label>
									<textarea rows="4" cols="5" name="mess" id="mess" class="textareaField controlla"></textarea>
								</div>
								<div class="row rowSubmit">
									<a href="#" class="link_reset" onclick="document.getElementById('offer_contact').reset();return false">Resetta tutti i campi</a>
									<span class="btn btn_default"><input type="submit" value="INVIA MESSAGGIO"></span>
								</div>
							</div>
							<!--/ form col 2 -->
							
						</form>                    
					</div>
					
					<div id="t_send" class="tabcontent clearfix ">
						<form class="details_form"action="inviamail2.php"  onsubmit="return validation2();">
							<div class="form_col_1">                            
								<div class="row">
									<label class="label_title">La tua E-mail:</label>
									<input type="text" name="nome2" id="nome2" class="inputField required" value="">
								</div>   
								<div class="row">
								<input type="hidden" name="id" id="id" value="<?php echo $row["Id"];?>">
									<label class="label_title">L'e-mail del tuo Amico:</label>
									<input type="text" name="nome3" id="nome3" class="inputField required" value="">
								</div>                         
							</div>
							<!--/ form col 1 -->
							<div class="form_col_2 col_thin">
								<div class="row">
									<label class="label_title">Messaggio:</label>
									<textarea rows="4" cols="5" name="mess2" name="mess" class="textareaField required">Ciao vedi quest annuncio:
	http://www.auto-nuove-usate.it/dettagli.php?id=<?php echo $row["Id"];?></textarea>
								</div>
								<div class="row rowSubmit">
									<a href="#" class="link_reset" onclick="document.getElementById('offer_send_friend').reset();return false">Resetta tutti i campi</a>
									<span class="btn btn_default"><input type="submit" value="INVIA MESSAGGIO"></span>
								</div>
							</div>
							<!--/ form col 2 -->
							<div class="form_col_3">
								<div class="row">
									<label class="label_title">Condividi:</label>
									<a href="#" class="btn_share"><img src="images/btn_share_tweet.png" alt=""></a>
									<a href="#" class="btn_share"><img src="images/btn_share_like.png" alt=""></a>
									<a href="#" class="btn_share"><img src="images/btn_share_g1.png" alt=""></a>
								</div>
							</div>
							<!--/ form col 3 -->
							
						</form>
					</div>
				</div>
				<!--/ details tabs 
				
				<div class="text_box">
					<p>
					<a href="#" class="btn btn_big btn_white"><span>CALL US AT: <strong>1 800 956 756</strong></span></a>
					<a href="#" class="btn btn_big btn_orange"><span>EMAIL US ABOUT THIS CAR</span></a>
					</p>
					<p><em>Prices are subject to change. Please see our <a href="#">Privacy Policy</a> for more info</em></p>
				</div>-->
				
			</div>
			<!--/ content -->
        
              
		</div>
	</div>

	<script>	
						jQuery(document).ready(function($) {
						
			
							function carGalleryInit() {
								$('#gallery_thumbs').children().each(function(i) {
									$(this).addClass( 'itm'+i );
									$(this).click(function() {
										$('#gallery_images').trigger('slideTo',[i, 0, true]);
										$('#gallery_thumbs a').removeClass('selected');
										$(this).addClass('selected');
										return false;
									});
								});
								$('#gallery_thumbs a.itm0').addClass('selected');
									
								$('#gallery_images').carouFredSel({
									infinite: false,
									circular: false,
									auto: false,
									width: '100%',
									scroll: {
										items : 1,
										fx : "crossfade"
									}
								});
								$('#gallery_thumbs').carouFredSel({
									prev : "#gallery_thumbs_prev",
									next : "#gallery_thumbs_next", 
									infinite: false,
									circular: false,
									auto: false,
									width: '100%',
									scroll: {
										items : 1
									}
								});		
							}
							
							$(window).load(function() {
								carGalleryInit();
							}); 
							var resizeTimer;
							$(window).resize(function() {
								clearTimeout(resizeTimer);
								resizeTimer = setTimeout(carGalleryInit, 100);
							});	          
						});
						</script> 
					

	<?php include("footer.php"); ?>
	
</div>
</body>
</html>
