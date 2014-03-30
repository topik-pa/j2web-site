<?php
session_start();

include("config.inc.php");
include("funzioni.php");

$gl="imgauto/";
?>

</script>
<!doctype html>
<!-- [if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->

<script>

var query = "";
var start = 0;
var limit = 0;
var page = 1;
var ordine = "";
var interr= "";

var tiporic = "<?php echo $_REQUEST["tiporic"]?>";




function doRedirect() { //funzione con il link alla pagina che si desidera raggiungere
location.href = "index.php";
}



if (tiporic == ""){
	alert("Nessuna ricerca effettuata!!");
	window.setTimeout("doRedirect()", 2); 
}
function validation(){
	var count2=0;

	
	if((document.getElementsByName("Marca")[0].value) == "")
	{ 
		count2++;
	}
	if((document.getElementsByName("Modello")[0].value) == "")
	{ 
		count2++;
	}
	if((document.getElementsByName("AnnoImmatricolazione")[0].value) == "")
	{ 
		count2++;
	}
	if((document.getElementsByName("prezzo")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("chilo")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("idCarburante")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("idTipologia")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("idCarrozzeria")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("idColore")[0].value) == "")
	{
		
		count2++;
	}
	
	
	if (count2 == 9) {
		alert("Devi inserire almeno un parametro");
		return false
	}
	else
		return true
	
}



if (tiporic == "di"){
	
	var marca = "<?php echo $_REQUEST["Marca"]?>";
	if (query != "") {
		if (marca != "")
			query = query + " AND Marca like '%" + marca + "%'";
	}
	else {
		if (marca != "")
			query = query + " Marca like '%" + marca + "%'";
	}
	
	var modello = "<?php echo $_REQUEST["Modello"]?>";
	if (query != "") {
		if (modello != "")
			query = query + " AND Modello like '%" + modello + "%'";
	}
	else {
		if (modello != "")
			query = query + " Modello like '%" + modello + "%'";
	}
	
	var annoda = "<?php echo $_REQUEST["AnnoImmatricolazioneda"]?>";
	if (query != "") {
		if (annoda != "")
			query = query + " AND AnnoImmatricolazione >= '" + annoda + "'";
	}
	else {
		if (annoda != "")
			query = query + " AnnoImmatricolazione >= '" + annoda + "'";
	}
	
	var annoa = "<?php echo $_REQUEST["AnnoImmatricolazionea"]?>";
	if (query != "") {
		if (annoa != "")
			query = query + " AND AnnoImmatricolazione <= '" + annoa + "'";
	}
	else {
		if (annoa != "")
			query = query + " AnnoImmatricolazione <= '" + annoa + "'";
	}
	
	var prezzoda = "<?php echo $_REQUEST["prezzoda"]?>";
	if (query != "") {
		if (prezzoda != ""){
			query = query + " AND Prezzo >= '" + prezzoda + "'";
		}
	}
	else {
		if (prezzoda != ""){
			query = query + " Prezzo >= '" + prezzoda + "'";
		}
	}

	var prezzoa = "<?php echo $_REQUEST["prezzoa"]?>";
	if (query != "") {
		if (prezzoa != ""){
			query = query + " AND Prezzo <= '" + prezzoa + "'";
		}
	}
	else {
		if (prezzoa != ""){
			query = query + " Prezzo <= '" + prezzoa + "'";
		}
	}
	
	var chiloda = "<?php echo $_REQUEST["chiloda"]?>";
	if (query != "") {
		if (chiloda != "") {
			query = query + " AND Chilometraggio >= '" + chiloda + "'";
		}
	}
	else {
		if (chiloda != "") {
			query = query + " Chilometraggio >= '" + chiloda + "'";
		}
	}
	var chiloa = "<?php echo $_REQUEST["chiloa"]?>";
	if (query != "") {
		if (chiloa != "") {
			query = query + " AND Chilometraggio <= '" + chiloa + "'";
		}
	}
	else {
		if (chiloa != "") {
			query = query + " Chilometraggio <= '" + chiloa + "'";
		}
	}
	
	var idcarb = "<?php echo $_REQUEST["idCarburante"]?>";
	if (query != "") {
		if (idcarb != "") 
			query= query + " AND idCarburante='" + idcarb + "'";
	}
	else {
		if (idcarb != "") 
			query= query + " idCarburante='" + idcarb + "'";
	}
	
	var citta = "<?php echo $_REQUEST["citta"]?>";
	if (query != "") {
		if (citta != "") 
			query= query + " AND comune like '%" + citta + "%'";
	}
	else {
		if (citta != "") 
			query= query + " comune like '%" + citta + "%'";
	}
	
	var versione = "<?php echo $_REQUEST["versione"]?>";
	if (query != "") {
		if (versione != "") 
			query= query + " AND Versione like '%" + versione + "%'";
	}
	else {
		if (versione != "") 
			query= query + " Versione like '%" + versione + "%'";
	}
	var cambio = "<?php echo $_REQUEST["cambio"]?>";
	if (query != "") {
		if (cambio != "") 
			query= query + " AND Cambio like '%" + cambio + "%'";
	}
	else {
		if (cambio != "") 
			query= query + " Cambio like '%" + cambio + "%'";
	}
	var idcolore = "<?php echo $_REQUEST["idcolore"]?>";
	if (query != "") {
		if (idcolore != "") 
			query= query + " AND idColoreEsterno='" + idcolore + "'";
	}
	else {
		if (idcolore != "") 
			query= query + " idColoreEsterno='" + idcolore + "'";
	}
	
	var pkwda = "<?php echo $_REQUEST["pkwda"]?>";
	if (query != "") {
		if (pkwda != "") {
			query = query + " AND PotenzaKW >= '" + pkwda + "'";
		}
	}
	else {
		if (pkwda != "") {
			query = query + " PotenzaKW >= '" + pkwda + "'";
		}
	}
	var pkwa = "<?php echo $_REQUEST["pkwa"]?>";
	if (query != "") {
		if (pkwa != "") {
			query = query + " AND PotenzaKW <= '" + pkwa + "'";
		}
	}
	else {
		if (pkwa != "") {
			query = query + " PotenzaKW <= '" + pkwa + "'";
		}
	}
	
	var pcvda = "<?php echo $_REQUEST["pcvda"]?>";
	if (query != "") {
		if (pcvda != "") {
			query = query + " AND PotenzaCV >= '" + pcvda + "'";
		}
	}
	else {
		if (pcvda != "") {
			query = query + " PotenzaCV >= '" + pcvda + "'";
		}
	}
	var pcva = "<?php echo $_REQUEST["pcva"]?>";
	if (query != "") {
		if (pcva != "") {
			query = query + " AND PotenzaCV <= '" + pcva + "'";
		}
	}
	else {
		if (pcva != "") {
			query = query + " PotenzaCV <= '" + pcva + "'";
		}
	}
	
	var abs = "<?php echo $_REQUEST["abs"]?>";
	if (query != "") {
		if (abs != "") 
			query= query + " AND ABS='" + abs + "'";
	}
	else {
		if (abs != "") 
			query= query + " ABS='" + abs + "'";
	}
	var airbag = "<?php echo $_REQUEST["airbag"]?>";
	if (query != "") {
		if (airbag != "") 
			query= query + " AND Airbag='" + airbag + "'";
	}
	else {
		if (airbag != "") 
			query= query + " Airbag='" + airbag + "'";
	}
	var Antifurto = "<?php echo $_REQUEST["Antifurto"]?>";
	if (query != "") {
		if (Antifurto != "") 
			query= query + " AND Antifurto='" + Antifurto + "'";
	}
	else {
		if (Antifurto != "") 
			query= query + " Antifurto='" + Antifurto + "'";
	}
	var ccentr = "<?php echo $_REQUEST["ccentr"]?>";
	if (query != "") {
		if (ccentr != "") 
			query= query + " AND ChiusuraCentralizzata='" + ccentr + "'";
	}
	else {
		if (ccentr != "") 
			query= query + " ChiusuraCentralizzata='" + ccentr + "'";
	}
	var esp = "<?php echo $_REQUEST["esp"]?>";
	if (query != "") {
		if (esp != "") 
			query= query + " AND ESP='" + esp + "'";
	}
	else {
		if (esp != "") 
			query= query + " ESP='" + esp + "'";
	}
	var immobilizer = "<?php echo $_REQUEST["immobilizer"]?>";
	if (query != "") {
		if (immobilizer != "") 
			query= query + " AND Immobilizer='" + immobilizer + "'";
	}
	else {
		if (immobilizer != "") 
			query= query + " Immobilizer='" + immobilizer + "'";
	}
	var freni = "<?php echo $_REQUEST["freni"]?>";
	if (query != "") {
		if (freni != "") 
			query= query + " AND FreniADisco='" + freni + "'";
	}
	else {
		if (freni != "") 
			query= query + " FreniADisco='" + freni + "'";
	}
	var aele = "<?php echo $_REQUEST["aele"]?>";
	if (query != "") {
		if (aele != "") 
			query= query + " AND AlzacristalliElettrici='" + aele + "'";
	}
	else {
		if (aele != "") 
			query= query + " AlzacristalliElettrici='" + aele + "'";
	}
	var clima = "<?php echo $_REQUEST["clima"]?>";
	if (query != "") {
		if (clima != "") 
			query= query + " AND Clima='" + clima + "'";
	}
	else {
		if (clima != "") 
			query= query + " Clima='" + clima + "'";
	}
	var navigatore = "<?php echo $_REQUEST["navigatore"]?>";
	if (query != "") {
		if (navigatore != "") 
			query= query + " AND NavigatoreSatellitare='" + navigatore + "'";
	}
	else {
		if (navigatore != "") 
			query= query + " NavigatoreSatellitare='" + navigatore + "'";
	}
	var radio = "<?php echo $_REQUEST["radio"]?>";
	if (query != "") {
		if (radio != "") 
			query= query + " AND RadioCD='" + radio + "'";
	}
	else {
		if (radio != "") 
			query= query + " RadioCD='" + radio + "'";
	}
	var pdc = "<?php echo $_REQUEST["pdc"]?>";
	if (query != "") {
		if (pdc != "") 
			query= query + " AND ParkDistControl='" + pdc + "'";
	}
	else {
		if (pdc != "") 
			query= query + " ParkDistControl='" + pdc + "'";
	}
	var sedili = "<?php echo $_REQUEST["sedili"]?>";
	if (query != "") {
		if (sedili != "") 
			query= query + " AND SediliRiscaldati='" + sedili + "'";
	}
	else {
		if (sedili != "") 
			query= query + " SediliRiscaldati='" + sedili + "'";
	}
	var Servosterzo = "<?php echo $_REQUEST["Servosterzo"]?>";
	if (query != "") {
		if (Servosterzo != "") 
			query= query + " AND Servosterzo='" + Servosterzo + "'";
	}
	else {
		if (Servosterzo != "") 
			query= query + " Servosterzo='" + Servosterzo + "'";
	}
	var volante = "<?php echo $_REQUEST["volante"]?>";
	if (query != "") {
		if (volante != "") 
			query= query + " AND VolanteMultifunzione='" + volante + "'";
	}
	else {
		if (volante != "") 
			query= query + " VolanteMultifunzione='" + volante + "'";
	}
	var Handicap = "<?php echo $_REQUEST["Handicap"]?>";
	if (query != "") {
		if (Handicap != "") 
			query= query + " AND Handicap='" + Handicap + "'";
	}
	else {
		if (Handicap != "") 
			query= query + " Handicap='" + Handicap + "'";
	}
	var cerchi = "<?php echo $_REQUEST["cerchi"]?>";
	if (query != "") {
		if (cerchi != "") 
			query= query + " AND CerchiInLega='" + cerchi + "'";
	}
	else {
		if (cerchi != "") 
			query= query + " CerchiInLega='" + cerchi + "'";
	}
	var gancio = "<?php echo $_REQUEST["gancio"]?>";
	if (query != "") {
		if (gancio != "") 
			query= query + " AND GancioTraino='" + gancio + "'";
	}
	else {
		if (gancio != "") 
			query= query + " GancioTraino='" + gancio + "'";
	}
	var ssportivi = "<?php echo $_REQUEST["ssportivi"]?>";
	if (query != "") {
		if (ssportivi != "") 
			query= query + " AND SediliSportivi='" + ssportivi + "'";
	}
	else {
		if (ssportivi != "") 
			query= query + " SediliSportivi='" + ssportivi + "'";
	}
	var pacchi = "<?php echo $_REQUEST["pacchi"]?>";
	if (query != "") {
		if (pacchi != "") 
			query= query + " AND Portapacchi='" + pacchi + "'";
	}
	else {
		if (pacchi != "") 
			query= query + " Portapacchi='" + pacchi + "'";
	}

	
}



function Elenco(query, start, limit, tipoRic, page, ordine){
	if (ordine == "")
			query = query + " ORDER BY Prezzo ASC";
		else if (ordine == 1)
			query = query + " ORDER BY Prezzo ASC";
		else if (ordine == 2)
			query = query + " ORDER BY Prezzo DESC";
		else if (ordine == 3)
			query = query + " ORDER BY datains desc";
		else if (ordine == 4)
			query = query + " ORDER BY Chilometraggio ASC";
		else if (ordine == 5)
			query = query + " ORDER BY Chilometraggio DESC";
			
	
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "start=" + start + "&limit=" + limit + "&tiporic=" + tiporic + "&query=" + escape(query) + "&page=" + page + "&ordine=" + ordine + "&action=elencoauto",
		async: false,
		success: function(msg) 
		{
			if(msg == "0") alert("Errore di lettura!");
			else if(msg == "") alert("Nessun dato trovato");
			else $("#boxelenco").html(msg);		
		},
		error: function(msg) 
		{
			alert(msg);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "start=" + start + "&limit=" + limit + "&tiporic=" + tiporic + "&query=" + escape(query) + "&page=" + page + "&ordine=" + ordine + "&action=elencopag",
		async: false,
		success: function(msg) 
		{
			//alert(msg);
			if(msg == "0") alert("Errore di lettura9!");
			else $("#boxpag").html(msg);		
		},
		error: function(msg) 
		{
			alert(msg);
		}
	});
}

</script>



<head>
	<?php include("metascript.php"); ?>

</head>

<script>

function loadmodelli(idmarca)
{
	
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "idmarca=" + idmarca + "&action=loadmodelli2",
		async: false,
		success: function(msg) {
		
			if(msg == "0") {alert("Errore di lettura dati");  }
			else {$("#Modello").html(msg);}
			
		},
		error: function(msg) {
			alert(msg);
		}
	});
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
			<h1>RISULTATO DELLA RICERCA</h1>
		</div>

	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.php">Home</a>  <span class="separator">&rsaquo;</span>  Ricerca </p>
			
		</div>
	</div>
	<!--/ breadcrumbs -->

	<!-- middle -->   
	<div id="middle" class="cols2">
		<div class="container clearfix">  
			<!-- content -->
			<div class="content">
				<a class="btn btn_blue" href="javascript:history.back();" hidefocus="true" style="outline: none; opacity: 0.800000011920929; margin-bottom:20px;"><span>Torna Indietro</span></a>
				
				<!-- sorting, pages -->
				<div class="list_manage">
					<div class="inner clearfix">
					
						<span class="manage_title">Ordina Per:</span>
							<select class="select_styled white_select" name="sort_list" id="sort_list" onchange='Elenco(query, start, limit, tiporic, page, (this.value))'>
								<option value="1">Prezzo Crescente</option>
								<option value="2">Prezzo Decrescente</option>
								<option value="3">Ultimi inseriti</option>
								<option value="4">Chilometraggio Crescente</option>
								<option value="5">Chilometraggio Decrescente</option>
								
							</select>
					 

					 
					</div>
				</div>
				<!--/ sorting, pages -->
				
				<!-- offers list -->
				<div class="offer_list clearfix" id="boxelenco">
				

				</div>
				<!--/ offers list -->
				
				<!-- pagination -->
				<div class="tf_pagination">
					<div class="inner" id="boxpag">
						
						  
					</div>
				</div>
				<!--/ pagination -->
				
			</div>
			<!--/ content -->
			
			<!-- sidebar -->
			<div class="sidebar">
				<div class="box">
				
				<!-- filter -->
				<div class="widget-container widget_adv_filter">
					<h3 class="widget-title">RICERCA AUTO</h3>
						
					<form action="ricerca.php" class="side_form " onsubmit="return validation();">
						<input type="hidden" name="tiporic" value="di"/>
						<div class="row field_select" style="z-index:10">
							<label class="label_title">Marca:</label>
							<select class="select_styled white_select" id="Marca" name="Marca" onchange="loadmodelli(this.value)">
								<?php echo $marca2?>
							</select>
						</div>
						
						<div class="row field_select" style="z-index:9">
							 <label class="label_title">Modello:</label>
							<select class="selricprin2 white_select" id="Modello" name="Modello">
								<option value=''> Modello </option>
							</select>
						</div>
						
						<div class="row field_select" style="z-index:8">
							<label class="label_title">Anno:</label>
							<select class="select_styled white_select" id="AnnoImmatricolazione" name="AnnoImmatricolazione">
								<?php echo $anno2?>
							</select>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title">Tipologia:</label>
							<select class="select_styled white_select" id="idTipologia" name="idTipologia" >
								<?php echo $tipo2?>
							</select>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title">Categoria:</label>
							<select class="select_styled white_select" id="idCarrozzeria" name="idCarrozzeria" >
								<?php echo $cat2?>
							</select>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title">Prezzo:</label>
							
								<select class="select_styled white_select" id="prezzo" name="prezzo" >
									<option value="3000">3000 EUR</option>
									<option value="5000">5000 EUR</option>
									<option value="7000">7000 EUR</option>
									<option value="10000" >10000 EUR</option>
									<option value="20000">20000 EUR</option>
									<option value="0">20000 + EUR</option>
									<option value="" selected>Non Definito</option>
								</select>
						
						</div>
						
						<div class="row input_styled checklist" style="padding-bottom:20px;">
							<label class="label_title">Chilometri<br>Percorsi:</label>
							<select class="select_styled white_select"  id="chilo" name="chilo">
								<option value="">Non Definito</option>
								<option value="50000">50.000</option>
								<option value="100000">100.000</option>
								<option value="150000">150.000</option>
								<option value="200000">200.000</option>
								<option value="300000">300.000</option>
								<option value="0">300.000 +</option>
							</select>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title">Carburante:</label>
							<select class="select_styled white_select" id="idCarburante" name="idCarburante" >
								<?php echo $carb2?>
							</select>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title">Colore:</label>
							<select class="select_styled white_select" id="idColore" name="idColore" >
								<?php echo $colo2?>
							</select>
						</div>

						
						<div class="row rowSubmit">
							<span class="btn btn_search"><input type="submit" value="SEARCH"></span>
						</div>
						
					</form>    
				
					<script type="text/javascript" >
						
							jQuery(document).ready(function($) {	
								
								Elenco(query, start, limit, tiporic, page, ordine);
								
								// Price Range Input
								$("#prezzo").slider({ 
									from: 100,
									to: 100000,
									limits: false, 
									scale: ['&euro;100', '&euro;100000'],
									heterogeneity: ['50/50000'],
									step: 1000,
									smooth: true,
									dimension: '&euro;',
									skin: "round_blue"
								});
								
								
								$("#chilo").slider({ 
									from: 0,
									to: 500000,
									limits: false, 
									scale: ['0', '500000'],
									heterogeneity: ['50/250000'],
									step: 1000,
									smooth: true,
									skin: "round_blue"
								});
								
							});
					</script>           
				</div>
				<!--/ filter -->
				
				<div class="box_bot"></div>
				</div>
			</div>
			<!--/ sidebar -->  
				  
		</div>
	</div>
	<!--/ middle -->


	<?php include("footer.php"); ?>
</div>
</body>
</html>
