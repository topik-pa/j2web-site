<?php
session_start();

include("config.inc.php");
include("funzioni.php");

if(!isset($_SESSION['id']))
{
	header('Location: login.php');
}

?>
<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->

<script>

function doRedirect() { 
location.href = "regprivati.php";
}
function aa(){
	window.setTimeout("doRedirect()", 1); 
}

function validateFileExtension(component,msg,extns)
{
   var flag=0;
   with(component)
   {
      var ext=value.substring(value.lastIndexOf('.')+1);
      for(i=0;i<extns.length;i++)
      {
         if(ext==extns[i])
         {
            flag=0;
            break;
         }
         else
         {
            flag=1;
         }
      }
      if(flag!=0)
      {
         alert(msg);;
         return false;
      }
      else
      {
         return true;
      }
   }
}

function validateFileSize(component,maxSize,msg)
{
   if(navigator.appName=="Microsoft Internet Explorer")
   {
      if(component.value)
      {
         var oas=new ActiveXObject("Scripting.FileSystemObject");
         var e=oas.getFile(component.value);
         var size=e.size;
      }
   }
   else
   {
      if(component.files[0]!=undefined)
      {
         size = component.files[0].size;
      }
   }
   
   if(size!=undefined && size>maxSize)
   {
      alert(msg);
      return false;
   }
   else
   {
      return true;
   }
   
}

function control()
{	
	if(CheckCampiForm("ins") ==  false) return false;

	
	var foto1 = document.getElementById('foto1');
	if (foto1.value == ""){
		alert("Devi inserire l'immagine di compertina del veicolo.");
		return false;
	}
	
    if(validateFileExtension(foto1, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
        return false;
    
    if(validateFileSize(foto1,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
        return false;
	
	var foto2 = document.getElementById('foto2');
	if (fot2.value != ""){
		if(validateFileExtension(foto2, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto2,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	

	var foto3 = document.getElementById('foto3');
	if (foto3.value != ""){
		if(validateFileExtension(foto3, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto3,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	
    
	var foto4 = document.getElementById('foto4');
	if (foto4.value != ""){
		if(validateFileExtension(foto4, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto4,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	
	var foto5 = document.getElementById('foto5');
	if (foto5.value != ""){
		if(validateFileExtension(foto5, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto5,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	
	var foto6 = document.getElementById('foto6');
	if (foto6.value != ""){
		if(validateFileExtension(foto6, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto6,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	
	var foto7 = document.getElementById('foto7');
	if (foto7.value != ""){
		if(validateFileExtension(foto7, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto7,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	
	var foto8 = document.getElementById('foto8');
	if (foto8.value != ""){
		if(validateFileExtension(foto8, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto8,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	
	var foto9 = document.getElementById('foto9');
	if (foto9.value != ""){
		if(validateFileExtension(foto9, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto9,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	
	var foto10 = document.getElementById('foto10');
	if (foto10.value != ""){
		if(validateFileExtension(foto10, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
			return false;
    
		if(validateFileSize(foto10,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
			return false;
	}	
	
}


function loadmodelli(idmarca)
{
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "idmarca=" + idmarca + "&action=loadmodelli",
		async: false,
		success: function(msg) {
			if(msg == "0") alert("Errore di lettura dati");  
			else $("#Modello").html(msg);
			
		},
		error: function(msg) {
			alert(msg);
		}
	});
}

</script>

<head>
	<?php include("metascript.php"); ?>
</head>

<body>

<div class="body_wrap">
	
	<!-- header top bar -->
	<?php include("header2.php"); ?>
	<!--/ header top bar -->
		
	<!-- header -->
	<div class="header header_thin" style="background-image:url(images/temp/slider_1_1.jpg)">
				
		<div class="header_title">
			<h1><span>Inserisci un Annuncio</span></h1>
		</div>

	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.php">Home</a>  <span class="separator">&rsaquo;</span> <a href="areaRiservata.php">Area Riservata</a>  <span class="separator">&rsaquo;</span>  <span class="current">Inserisci Annuncio</span></p>
		</div>
	</div>
	<!--/ breadcrumbs -->

    
	<!-- middle -->   
	<div id="middle" class="full_width">
		<div class="container clearfix">  
		
			<!-- content -->
			<div class="content">            
						  
				<div class="entry">
					
					<div class="text-center">
						<p><h1><strong>Compila</strong> i campi obbligatori (*)</h1></p>
					</div>
				
	                <div class="row clearfix">
	                    
						<form id="ins" name="ins" action="valinsc.php" method="POST" onsubmit="return control();" enctype="multipart/form-data">
							
							<div class="col col_1_3 alpha">
								<!-- aggingere la classe listains nel caso!-->
								<ul class="">
									<li>
										<select class="controlla" id="idTipologia" name="idTipologia" >
											<?php echo $tipo?>
										</select>
									</li>

									<li>
										<select class="controlla" id="Marca" name="Marca" onchange="loadmodelli(this.value)">
											<?php echo $marca?>
										</select>
									</li>
									<li><input type="text" class="controlla" id="Prezzo" name="Prezzo" placeholder="* Prezzo"/></li>

									<li>
										<select class="controlla" id="idCarburante" name="idCarburante" >
											<?php echo $carb?>
										</select>
									</li>
									<li>
										<select class="" id="PrecedentiProprietari" name="PrecedentiProprietari">
											<option value="">Precedenti Proprietari</option>
											<option value="">Non Specificato</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
									</li>
									<li><input type="text" class="" id="PotenzaKW" name="PotenzaKW" placeholder="Potenza KW"/></li>
									<li><input type="text" class="" id="Chilometraggio" name="Chilometraggio" placeholder="Chilometraggio"/></li>
									<li>
										<select class="" id="ABS" name="ABS">
											<option value="">ABS</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="ChiusuraCentralizzata" name="ChiusuraCentralizzata">
											<option value="">Chiusura Centralizzata</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="Immobilizer" name="Immobilizer">
											<option value="">Immobilizer</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="Clima" name="Clima">
											<option value="">Clima</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="ParkDistControl" name="ParkDistControl">
											<option value="">Park Dist Control</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="VolanteMultifunzione" name="VolanteMultifunzione">
											<option value="">Volante Multifunzione</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="GancioTraino" name="GancioTraino">
											<option value="">Gancio Traino</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li><input type="text" class="" id="Motore" name="Motore" placeholder="Motore"/></li>
									<li>
										<select class="" id="ClasseEmissione" name="ClasseEmissione">
											<option value="">Classe D'Emissione</option>
											<option value="Euro 0">Euro 0</option>
											<option value="Euro 1">Euro 1</option>
											<option value="Euro 2">Euro 2</option>
											<option value="Euro 3">Euro 3</option>
											<option value="Euro 4">Euro 4</option>
											<option value="Euro 5">Euro 5</option>
										</select>
									</li>
									<li><textarea class="controlla" id="Descrizione" name="Descrizione" placeholder="* Aggiungi una descrizione del veicolo"></textarea></li>
	
	
								</ul>
							</div>
							<!-- aggingere la classe asd nel caso!-->
							<div class="col col_1_3 ">
								<ul class="">
									<li>
										<select class="controlla" id="idCarrozzeria" name="idCarrozzeria" >
											<?php echo $cat?>
										</select>
									</li>
									<li>
										<select class="controlla" id="Modello" name="Modello">
											<option value="">* Modello Auto</option>
										</select>
									</li>
									<li><input type="text" class="" id="PrezzoConcessionari" name="PrezzoConcessionari" placeholder="Prezzo per altre Concessionarie"/></li>
									<li>
										<select class="" id="Trattabile" name="Trattabile">
											<option value="">Trattabile</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="controlla" id="AnnoImmatricolazione" name="AnnoImmatricolazione">
											<?php echo $anno?>
										</select>
									</li>
									<li>
										<select class="controlla" id="idColoreEsterno" name="idColoreEsterno">
											<?php echo $colo?>
										</select>
									</li>
									<li><input type="text" class="" id="PotenzaCV" name="PotenzaCV" placeholder="Potenza CV"/></li>
									<li><input type="text" class="" id="FinitureInterni" name="FinitureInterni" placeholder="Finiture Interni"/></li>
									<li>
										<select class="" id="Airbag" name="Airbag">
											<option value="">Airbag</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="ControlloAutomTrazione" name="ControlloAutomTrazione">
											<option value="">Controllo Autom. Trazione</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="FreniADisco" name="FreniADisco">
											<option value="">Freni A Disco</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="NavigatoreSatellitare" name="NavigatoreSatellitare">
											<option value="">Navigatore Satellitare</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="SediliRiscaldati" name="SediliRiscaldati">
											<option value="">Sedili Riscaldati</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="Handicap" name="Handicap">
											<option value="">Handicap</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="Portapacchi" name="Portapacchi">
											<option value="">Portapacchi</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="Cambio" name="Cambio">
											<option value="">Cambio</option>
											<option value="Automatico">Automatico</option>
											<option value="Manuale">Manuale</option>
										</select>
									</li>
									
									
								</ul>
							</div>

							<div class="col col_1_3 omega">
								<ul class="">
									<li><input type="text" class="controlla" id="Cilindrata" name="Cilindrata" placeholder="* Cilindrata"/></li>
									
									<li><input type="text" class="" id="Versione" name="Versione" placeholder="Versione"/></li>
									<li>
										<select class="controlla" id="condividiveicolo" name="condividiveicolo">
											<option value="">* Condividere Veicolo</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="controlla" id="Contratto" name="Contratto">
											<option value="">* Contratto</option>
											<option value="Vendita">Vendita</option>
											<option value="Acquisto">Acquisto</option>
										</select>
									</li>
									<li>
										<select class="controlla" id="MeseImmatricolazione" name="MeseImmatricolazione">
											<option value="">* Mese Immatricolazione</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
									</li>
									<li>
										<select class="" id="Metallizzato" name="Metallizzato">
											<option value="">Metallizzato</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li><input type="text" class="" id="PostiASedere" name="PostiASedere" placeholder="Posti A Sedere"/></li>
									<li><input type="text" class="" id="ColoreInterni" name="ColoreInterni" placeholder="Colore Interni"/></li>
									<li>
										<select class="" id="Antifurto" name="Antifurto">
											<option value="">Antifurto</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="ESP" name="ESP">
											<option value="">ESP</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="AlzacristalliElettrici" name="AlzacristalliElettrici">
											<option value="">Alzacristalli Elettrici</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="RadioCD" name="RadioCD">
											<option value="">Radio CD</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="Servosterzo" name="Servosterzo">
											<option value="">Servosterzo</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="CerchiInLega" name="CerchiInLega">
											<option value="">Cerchi In Lega</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li>
										<select class="" id="SediliSportivi" name="SediliSportivi">
											<option value="">SediliSportivi</option>
											<option value="1">Si</option>
											<option value="2">No</option>
										</select>
									</li>
									<li><input type="text" class="" id="NumRapporti" name="NumRapporti" placeholder="Numero Rapporti"/></li>
									<li><input type="text" class="" id="ConsumoMedio" name="ConsumoMedio" placeholder="Consumo Medio"/></li>
									<li><input type="text" class="" id="UrlYT" name="UrlYT" placeholder="Url YouTube"/><a onclick="alert('Andare in \'Condividi\' e selzionare il link della sezione \'Condividi questo video\'');"><img src="images/icons/icon_info.png" style="margin-left:5px;" id="info"/></a></li>
									

								</ul>
							</div>
	                </div>
					
					<div class="text-center">
						<p><h1><strong>Inserisci</strong> le immagini. <strong>L'immagine di copertina</strong> e' obbligatoria</h1></p>
						<p>N.B. Inserisci sono immagini jpeg, gif jpg, png di al massimo 5 MB.</p>
						<input type="file" name="foto1" id="foto1" class=""> <-- Immagine di copertina dell'auto.
						<br/><br/>
					</div>
						<div class="col col_1_3 alpha">
	                        <ul class="listains2">
								<li><input type="file" name="foto4" id="foto4" class=""></li>
								<li><input type="file" name="foto7" id="foto7" class=""></li>
								<li><input type="file" name="foto10" id="foto10" class=""></li>
							</ul>
	                    </div>
	                
	                    <div class="col col_1_3 ">
	                        <ul class="listains2">
								<li><input type="file" name="foto2" id="foto2" class=""></li>
								<li><input type="file" name="foto5" id="foto5" class=""></li>
								<li><input type="file" name="foto8" id="foto8" class=""></li>
							</ul>                       
	                    </div>
	                    
	                    <div class="col col_1_3  omega">
	                        <ul class="listains2">
								<li><input type="file" name="foto3" id="foto3" class=""></li>
								<li><input type="file" name="foto6" id="foto6" class=""></li>
								<li><input type="file" name="foto9" id="foto9" class=""></li>
							</ul>	                       
	                    </div>
					<div class="text-center">
						<p><button class="btn btn_default"><span>INSERISCI AUTO</span></button></p>
					</div>
						</form>
				</div>
				
			</div>
			<!--/ content -->
			
				  
		</div>
	</div>
	<!--/ middle -->


	
	<?php include("footer.php"); ?>
	
</div>




<script>
$(document).ready(function(){
       

</script>
</body>
</html>
