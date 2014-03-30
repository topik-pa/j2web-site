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



if (tiporic == ""){
	alert("Nessuna ricerca effettuata!!");
	window.setTimeout("doRedirect()", 2); 
}


if (tiporic == "di"){
	var marca = "<?php echo $_REQUEST["Marca"]?>";
	var modello = "<?php echo $_REQUEST["Modello"]?>";
	var anno = "<?php echo $_REQUEST["AnnoImmatricolazione"]?>";
	var prezzo = "<?php echo $_REQUEST["prezzo"]?>";
	var chilo = "<?php echo $_REQUEST["chilo"]?>";
	var idcarb = "<?php echo $_REQUEST["idCarburante"]?>";
	var idtip = "<?php echo $_REQUEST["idTipologia"]?>";
	var idcarr = "<?php echo $_REQUEST["idCarrozzeria"]?>";
	var idcolo = "<?php echo $_REQUEST["idColore"]?>";

	//marca
	if (query != "") {
		if (marca != "")
			query = query + " AND Marca like '%" + marca + "%'";
	}
	else {
		if (marca != "")
			query = query + " Marca like '%" + marca + "%'";
	}
	
	//modello
	if (query != "") {
		if (modello != "")
			query = query + " AND Modello like '%" + modello + "%'";
	}
	else {
		if (modello != "")
			query = query + " Modello like '%" + modello + "%'";
	}

	//anno
	if (query != "") {
		if (anno != "")
			query = query + " AND AnnoImmatricolazione = '" + anno + "'";
	}
	else {
		if (anno != "")
			query = query + " AnnoImmatricolazione = '" + anno + "'";
	}
	
	//prezzo
	
	if (query != "") {
		if (prezzo != ""){
			if (prezzo == 0)
				query = query + " AND Prezzo > '20000'";
			else
				query = query + " AND Prezzo <= '" + prezzo + "'";
		}
	}
	else {
		if (prezzo != ""){
			if (prezzo == 0)
				query = query + " Prezzo > '20000'";
			else
				query = query + " Prezzo <= '" + prezzo + "'";
		}
	}

	
	if (query != "") {
		if (chilo != "") {
			if (chilo == 0)
				query = query + " AND Chilometraggio > '300000'";
			else
				query = query + " AND Chilometraggio <= '" + chilo + "'";
		}
	}
	else {
		if (chilo != "") {
			if (chilo == 0)
				query = query + " Chilometraggio > '300000'";
			else
				query = query + " Chilometraggio <= '" + chilo + "'";
		}
	}
	
	//carburante
	if (query != "") {
		if (idcarb != "") 
			query= query + " AND idCarburante='" + idcarb + "'";
	}
	else {
		if (idcarb != "") 
			query= query + " idCarburante='" + idcarb + "'";
	}
	
	//tipologia
	if (query != "") { 
		if (idtip != "") 
			query= query + " AND idTipologia='" + idtip + "'";
	}
	else {
		if (idtip != "") 
			query= query + " idTipologia='" + idtip + "'";
	}
	
	//categoria
	if (query != "") { 
		if (idcarr != "") 
			query= query + " AND idCarrozzeria='" + idcarr + "'";
	}
	else {
		if (idcarr != "") 
			query= query + " idCarrozzeria='" + idcarr + "'";
	}

	//colore
	if (query != "") { 
		if (idcolo != "") 
			query= query + " AND idColore='" + idcolo + "'";
	}
	else {
		if (idcolo != "") 
			query= query + " idColore='" + idcolo + "'";
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
