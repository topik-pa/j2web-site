<?php
session_start();

include("config.inc.php");
include("funzioni.php");

$gl="imgauto/";
?>

<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="it" class="no-js" xmlns="http://www.w3.org/1999/xhtml"><!--<![endif]-->
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
	
	if((document.getElementsByName("idCarburante")[0].value) == "")
	{
		
		count2++;
	}
	
	if((document.getElementsByName("AnnoImmatricolazioneda")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("AnnoImmatricolazionea")[0].value) == "")
	{
		
		count2++;
	}
	
	if((document.getElementsByName("prezzoda")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("prezzoa")[0].value) == "")
	{
		
		count2++;
	}
	
	if((document.getElementsByName("chiloda")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("chiloa")[0].value) == "")
	{
		
		count2++;
	}
	
	if((document.getElementsByName("citta")[0].value) == "")
	{
		count2++;
	}
	
	
	if((document.getElementsByName("versione")[0].value) == "")
	{ 
		count2++;
	}
	if((document.getElementsByName("cambio")[0].value) == "")
	{ 
		count2++;
	}
	
	if((document.getElementsByName("idcolore")[0].value) == "")
	{
		
		count2++;
	}
	
	if((document.getElementsByName("pkwda")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("pkwa")[0].value) == "")
	{
		
		count2++;
	}
	
	if((document.getElementsByName("pcvda")[0].value) == "")
	{
		
		count2++;
	}
	if((document.getElementsByName("pcva")[0].value) == "")
	{
		
		count2++;
	}
	
	
	if(!$("#abs").is(":checked")){
		count2++;
	}
	if(!$("#airbag").is(":checked")){
		count2++;
	}
	if(!$("#Antifurto").is(":checked")){
		count2++;
	}
	if(!$("#ccentr").is(":checked")){
		count2++;
	}
	if(!$("#esp").is(":checked")){
		count2++;
	}
	if(!$("#immobilizer").is(":checked")){
		count2++;
	}
	if(!$("#freni").is(":checked")){
		count2++;
	}
	if(!$("#aele").is(":checked")){
		count2++;
	}
	if(!$("#clima").is(":checked")){
		count2++;
	}
	if(!$("#navigatore").is(":checked")){
		count2++;
	}
	if(!$("#radio").is(":checked")){
		count2++;
	}
	if(!$("#pdc").is(":checked")){
		count2++;
	}
	if(!$("#sedili").is(":checked")){
		count2++;
	}
	if(!$("#Servosterzo").is(":checked")){
		count2++;
	}
	if(!$("#volante").is(":checked")){
		count2++;
	}
	if(!$("#Handicap").is(":checked")){
		count2++;
	}
	if(!$("#cerchi").is(":checked")){
		count2++;
	}
	if(!$("#gancio").is(":checked")){
		count2++;
	}
	if(!$("#ssportivi").is(":checked")){
		count2++;
	}
	if(!$("#pacchi").is(":checked")){
		count2++;
	}
	
	
	if((document.getElementsByName("distanza")[0].value) != "")
	{
		if((document.getElementsByName("citta")[0].value) == "")
		{
			alert("Se inserisci la distanza devi inserire anche un punto dal quale partire!");
			return false;
		}
		else
			return true;
	}
	
	if (count2 == 37) {
		alert("Devi inserire almeno un parametro");
		return false;
	}

	return true;
}


function apri() {
		$("#apri").hide();
		$("#chiudi").show();
		$("#danascondere").show();
		}

function chiudi() {
		$("#chiudi").hide();
		$("#apri").show();
		$("#danascondere").hide();
		}

</script>
<body>
<div class="body_wrap homepage">
	
	<!-- header top bar -->
	<?php 
		if(isset($_SESSION['id']))
			include("header2.php"); 
		else
			include("header.php"); 
	?>
	<!--/ header top bar -->
		

<!-- header -->
<div class="header" style="background:#000">
            
    <!-- header slider -->
    <div class="fullwidthbanner-container"> 
		<div class="fullwidthbanner">
        	<ul>
				<li data-transition="fade" data-slotamount="1" data-masterspeed="500">
					<img src="images/temp/slider_1_1.jpg" data-fullwidthcentering="on">
                    
                    <div class="caption sft text_line" data-x="10" data-y="190" data-speed="1700" data-start="800" data-easing="easeOutExpo"></div>
                    <div class="caption sfb text_line" data-x="10" data-y="300" data-speed="1700" data-start="800" data-easing="easeOutExpo"></div>
					<div class="caption sfl white_text big_title" data-x="10" data-y="220" data-speed="1700" data-start="500" data-easing="easeOutExpo">
                         <a href="#"><strong>COMPRA O VENDI LA TUA AUTO</strong></a>
                    </div>
                    <div class="caption sfr white_text subtitle" data-x="10" data-y="257" data-speed="1700" data-start="700" data-easing="easeOutExpo">
                         <span>Inserisci Gratuitamente il Tuo Annuncio </span>
                    </div>
                    
				</li>
                <li data-transition="fade" data-slotamount="7" data-masterspeed="500">
					<img src="images/temp/slider_1_2.jpg" data-fullwidthcentering="on">
                    
                    <div class="caption sft text_line" data-x="550" data-y="250" data-speed="1700" data-start="800" data-easing="easeOutExpo"></div>
                    <div class="caption sfb text_line" data-x="550" data-y="360" data-speed="1700" data-start="800" data-easing="easeOutExpo"></div>
                    
					<div class="caption sft white_text big_title" data-x="550" data-y="280" data-speed="1700" data-start="500" data-easing="easeOutExpo">
                         <a href="#"><strong>CERCA LA TUA AUTO</strong></a>
                    </div>
                    <div class="caption sfb white_text subtitle" data-x="550" data-y="317" data-speed="1700" data-start="700" data-easing="easeOutExpo">
                       Tra gli Annunci di Privati o Concessionarie
                    </div>
				</li>
                <li data-transition="fade" data-slotamount="7" data-masterspeed="500">
					<img src="images/temp/slider_1_3.jpg" data-fullwidthcentering="on">
                    
                    <div class="caption sft text_line" data-x="10" data-y="190" data-speed="1700" data-start="800" data-easing="easeOutExpo"></div>
                    <div class="caption sfb text_line" data-x="10" data-y="300" data-speed="1700" data-start="800" data-easing="easeOutExpo"></div>
                    
					<div class="caption sfr white_text big_title" data-x="10" data-y="220" data-speed="1700" data-start="500" data-easing="easeOutExpo">
                         <a href="#"><strong>LASCIA LA TUA RICHIESTA</strong></a>
                    </div>
                    <div class="caption sfl white_text subtitle" data-x="10" data-y="257" data-speed="1700" data-start="700" data-easing="easeOutExpo">
                        <span>Verrai Ricontattato dalle Concessionarie che ti Forniranno Offerte Personalizzate </span>
                    </div>
				</li>
            </ul>
        </div>          
	</div>
    
    <script>


		jQuery(document).ready(function($) {

			if ($.fn.cssOriginal!=undefined)
				$.fn.css = $.fn.cssOriginal;

			$('.fullwidthbanner').revolution({
					delay:5000,
					startwidth:950,
					startheight:617,

					onHoverStop:"off",						// Stop Banner Timet at Hover on Slide on/off
					hideThumbs:0,
					navigationType:"bullet",				// bullet, thumb, none
					navigationArrows:"none",				// nexttobullets, solo (old name verticalcentered), none

					navigationStyle:"round",				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
					
					navigationHAlign:"center",				// Vertical Align top,center,bottom
					navigationVAlign:"bottom",				// Horizontal Align left,center,right
					navigationHOffset:0,
					navigationVOffset:23,

					touchenabled:"on",						// Enable Swipe Function : on/off

					stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
					stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

					hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
					hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
					hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value

					fullWidth:"on",
					shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

				});
			});
	</script>
    <!--/ header slider -->

</div>
<!--/ header -->

	<!-- middle -->   
	<div class="middle_row row_white search_row">
		<div class="container">
			<form action="elenco5.php" class="search_form advsearch_hide clearfix"  onsubmit="return validation();">
				
            	<div class="row field_select">
                    <label class="label_title">Seleziona la Marca:</label>
                    <select class="select_styled" id="Marca" name="Marca" onchange="loadmodelli(this.value)">
						<?php echo $marca2?>
					</select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Seleziona il Modello:</label>
                    <select class="selricprin" id="Modello" name="Modello">
						<option value=''> Modello </option>
					</select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Anno da:</label>
                    <select class="select_styled" id="AnnoImmatricolazioneda" name="AnnoImmatricolazioneda">
						<?php echo $anno2?>
					</select>
                </div>
				
				<div class="row field_select">
                    <label class="label_title">Anno a:</label>
                    <select class="select_styled" id="AnnoImmatricolazionea" name="AnnoImmatricolazionea">
						<?php echo $anno2?>
					</select>
                </div>
                
				<div class="row field_select" style="margin-left:0px;">
                    <label class="label_title">Prezzo da:</label>
                    <select class="select_styled" id="prezzoda" name="prezzoda">
						<option value="1000">1000 EUR</option>
                        <option value="3000">3000 EUR</option>
                        <option value="5000">5000 EUR</option>
                        <option value="7000">7000 EUR</option>
                        <option value="10000" >10000 EUR</option>
                        <option value="20000">20000 EUR</option>		
                        <option value="" selected>Non Definito</option>
                    </select>
                </div>
				<div class="row field_select">
                    <label class="label_title">Prezzo fino a:</label>
                    <select class="select_styled" id="prezzoa" name="prezzoa">
                        <option value="3000">3000 EUR</option>
                        <option value="5000">5000 EUR</option>
                        <option value="10000">10000 EUR</option>
                        <option value="20000" >20000 EUR</option>
                        <option value="30000">30000 EUR</option>
						<option value="40000">40000 EUR</option>
						<option value="50000">50000 EUR</option>
                        <option value="" selected>Non Definito</option>
                    </select>
                </div>
                
				<div class="row field_select">
                    <label class="label_title">Chilometri da:</label>
                    <select class="select_styled"  id="chiloda" name="chiloda">
						<option value="">Non Definito</option>
                        <option value="50000">50.000</option>
                        <option value="100000">100.000</option>
                        <option value="150000">150.000</option>
                        <option value="200000">200.000</option>
						<option value="300000">300.000</option>
                        
                    </select>
                </div>
				<div class="row field_select">
                    <label class="label_title">Chilometri a:</label>
                    <select class="select_styled"  id="chiloa" name="chiloa">
						<option value="">Non Definito</option>
                        <option value="50000">50.000</option>
                        <option value="100000">100.000</option>
                        <option value="150000">150.000</option>
                        <option value="200000">200.000</option>
						<option value="300000">300.000</option>
                        
                    </select>
                </div>
                <div class="row field_select" style="margin-left:0px;">
                    <label class="label_title">Tipo Carburante:</label>
                    <select class="select_styled" id="idCarburante" name="idCarburante" >
						<?php echo $carb2?>
					</select>
                </div>
				<div class="row field_input">
                    <label class="label_title">Citta':</label>
                    <input type="text" class="selected_styled" id="citta" name="citta" style="width: 150px;"/>
                </div>
				<div class="row field_input">
                    <label class="label_title">Distanza (Km):</label>
                    <input type="text" class="selected_styled" id="distanza" name="distanza" style="width: 150px;"/>
                </div>

                
                <div class="adv_search_hidden clearfix">
					<div class="row field_input">
						<label class="label_title">Versione Modello:</label>
						<input type="text" class="input_styled" id="versione" name="versione" style="width: 150px;"/>
					</div>
					
					<div class="row field_select">
						<label class="label_title">Cambio:</label>
						<select class="select_styled" id="cambio" name="cambio" >
							<option value="">Non Specificato</option>
							<option value="Automatico">Automatico</option>
							<option value="Manuale">Manuale</option>
						</select>
					</div>
					<div class="row field_select">
						<label class="label_title">Colore:</label>
						<select class="select_styled" id="idcolore" name="idcolore" >
							<?php echo $colo2?>
						</select>
					</div>
					<div class="row field_input">
						<label class="label_title">Potenza kW da:</label>
						<input type="text" class="input_styled" id="pkwda" name="pkwda" style="width: 150px;"/>
					</div>
					<div class="row field_input" style="margin-left:0px;">
						<label class="label_title">Potenza kW fino a:</label>
						<input type="text" class="input_styled" id="pkwa" name="pkwa" style="width: 150px;"/>
					</div>
					<div class="row field_input">
						<label class="label_title">Potenza CV da:</label>
						<input type="text" class="input_styled" id="pcvda" name="pcvda" style="width: 150px;"/>
					</div>
					<div class="row field_input">
						<label class="label_title">Potenza CV fino a:</label>
						<input type="text" class="input_styled" id="pcva" name="pcva" style="width: 150px;"/>
					</div>
					<div class="row field_input" id="apri">
						<label class="label_title">Mostra Equipaggiamenti</label>
						<a class="btn btn_blue" onclick='apri()' style="width: 150px;"><span>APRI</span></a>
					</div>
					<div class="row field_input" id="chiudi">
						<label class="label_title">Nascondi Equipaggiamenti</label>
						<a class="btn btn_blue" onclick='chiudi()' style="width: 150px;"><span>CHIUDI</span></a>
					</div>
					
					
				</div>
				
				<div class="clearfix" id="danascondere">
					<div class="row field_input" style="width: 172px;">
						<label class="">Abs:</label>
						<input type="checkbox" class="" id="abs" name="abs" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Airbag:</label>
						<input type="checkbox" class="" id="airbag" name="airbag" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Antifurto:</label>
						<input type="checkbox" class="" id="Antifurto" name="Antifurto" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Chiusura Centralizzata:</label>
						<input type="checkbox" class="" id="ccentr" name="ccentr" value="1"/>
					</div>
					<div class="row field_input" style="margin-left:0px;width: 172px;">
						<label class="">ESP:</label>
						<input type="checkbox" class="" id="esp" name="esp" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Immobilizer:</label>
						<input type="checkbox" class="" id="immobilizer" name="immobilizer" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Freni a Disco:</label>
						<input type="checkbox" class="" id="freni" name="freni" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Alzacristalli Elettrici:</label>
						<input type="checkbox" class="" id="aele" name="aele" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;margin-left:0px;">
						<label class="">Climatizzatore:</label>
						<input type="checkbox" class="" id="clima" name="clima" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Navigatore Satellitare:</label>
						<input type="checkbox" class="" id="navigatore" name="navigatore" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Radio CD:</label>
						<input type="checkbox" class="" id="radio" name="radio" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Park Disc Control:</label>
						<input type="checkbox" class="" id="pdc" name="pdc" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;margin-left:0px;">
						<label class="">Sedili Riscaldati:</label>
						<input type="checkbox" class="" id="sedili" name="sedili" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Servosterzo:</label>
						<input type="checkbox" class="" id="Servosterzo" name="Servosterzo" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Volante Multifunzione:</label>
						<input type="checkbox" class="" id="volante" name="volante" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Handicap:</label>
						<input type="checkbox" class="" id="Handicap" name="Handicap" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;margin-left:0px;">
						<label class="">Cerchi in lega:</label>
						<input type="checkbox" class="" id="cerchi" name="cerchi" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Gancio Traino:</label>
						<input type="checkbox" class="" id="gancio" name="gancio" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Sedili Sportivi:</label>
						<input type="checkbox" class="" id="ssportivi" name="ssportivi" value="1"/>
					</div>
					<div class="row field_input" style="width: 172px;">
						<label class="">Porta Pacchi:</label>
						<input type="checkbox" class="" id="pacchi" name="pacchi" value="1"/>
					</div>
				</div>
				
				
                <input type="hidden" name="tiporic" value="di"/>
                <div class="row rowSubmit">
                	<label class="label_title" id="adv_search_open">Ricerca Avanzata</label>
                    <span class="btn btn_search"><input type="submit" value="Cerca"></span>
                </div>
            </form>
            <script type="text/javascript">
			jQuery(document).ready(function($) {					
				// Show/Hide Advanced Search
				$("#danascondere").hide();
	
				$("#chiudi").hide();
				$(".adv_search_hidden").hide();
				$("#adv_search_open").click(function(){								
					if ($(this).closest(".search_form").hasClass("advsearch_hide")) {
						$(".adv_search_hidden").stop().slideDown();
						$(this).html("Chiudi Ricerca Avanzata");
					} else {
						$(".adv_search_hidden").stop().slideUp();
						$(this).html("Ricerca Avanzata");
					}
					$(this).closest(".search_form").toggleClass("advsearch_hide");					
				});				
			});				
			</script>
		</div>
	</div>
	
	<div class="middle_row row_light_gray">
		<div class="container clearfix">  
			<!-- week offer -->
            <div class="week_offer">
				<?php
				$result = mysql_query("SELECT * from vistaauto order by datains desc limit 0 , 1");
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
				$a=$row["Marca"];
				$a=str_replace("-"," ",$a);
			
				$a=ucwords($a);
				
				$n=strlen($a);
				if($n<=3)
					$a=strtoupper($a);
					
				$d=number_format($row['Prezzo'],2,",",".");
				
				$result2 = mysql_query("SELECT LEFT(Descrizione, '200') as descr from autoveicoli where Id='".$row["Id"]."'");
				$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
				?>
			
            	<h2>IN EVIDENZA</h2>
                <div class="offer_box">
	                <div class="offer_image"><a href="dettagli.php?id=<?php echo $row["Id"];?>"><img src="<?php echo $gl.$row["Immagine1"];?>" alt=""></a></div>
                    <div class="offer_text">
                    	<h3><a href="dettagli.php?id=<?php echo $row["Id"];?>"><?php echo $a." ".$row["Modello"];?> </a></h3>
                        <div class="offer_price">&euro; <?php echo $d;?></div>
                        <div class="offer_descr">
							<?php echo $row2["descr"]."...";?>
						</div>
                    </div>
                    <div class="link_more"><a href="dettagli.php?id=<?php echo $row["Id"];?>">Vedi Maggiori Dettagli</a></div>
                </div>
            </div>
            <!--/ week offer -->
            <!-- special offer -->
            <div class="special_offers">
            	<h2>ULTIMI ANNUNCI INSERITI</h2>
				
				<div id="special_offers">
				<?php
				$result = mysql_query("SELECT * from vistaauto order by datains desc limit 1 , 6");
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$a=$row["Marca"];
					$a=str_replace("-"," ",$a);
				
					$a=ucwords($a);
					
					$n=strlen($a);
					if($n<=3)
						$a=strtoupper($a);
						
					$d=number_format($row['Prezzo'],2,",",".");
				
					$b=number_format($row['Chilometraggio'],0,",",".");
				?>

                	<div class="special_item">
                    	<div class="special_image">
                    	<a href="dettagli.php?id=<?php echo $row["Id"];?>"><img src="<?php echo $gl.$row["Immagine1"];?>" style="width:100%" alt=""></a>
                        </div>
                        <div class="special_text">
                        	<h3><a href="dettagli.php?id=<?php echo $row["Id"];?>"><?php echo $a." ".$row["Modello"];?> </a></h3>
                            <div class="info_row"><span>Immatricolazione:</span> <?php echo $row["AnnoImmatricolazione"];?></div>
                            <div class="info_row"><span>Cilindrata:</span> <?php echo $row["Cilindrata"]." CV";?></div>
                            <div class="info_row"><span>Chilometraggio</span> <?php echo $b." km";?></div>
                            <div class="special_price">&euro; <?php echo $d;?></div>
                        </div>
                    </div>
                    
				<?php
				}
				?>

                    
                </div>
                <a class="prev" id="special_offers_prev" href="#"></a>
            	<a class="next" id="special_offers_next" href="#"></a>
                
                
            
                <script>	
				jQuery(document).ready(function($) {
					function carSpecicalInit() {
						var car_specical = $('#special_offers');
						car_specical.carouFredSel({
							prev : "#special_offers_prev",
							next : "#special_offers_next",
							infinite: true,
							circular: false,
							auto: false,
							width: '100%',
							direction: "down",						
							scroll: {
								items : 1
							}
						});						
					}
					$(window).load(function() {
						carSpecicalInit();
					}); 
					var resizeTimer;
					$(window).resize(function() {
						clearTimeout(resizeTimer);
						resizeTimer = setTimeout(carSpecicalInit, 100);
					});							          
				});
			    </script> 
            </div>           
            <!--/ special offer -->			
		</div>
	</div>
	
    <!-- car types -->
	<div class="middle_row row_gray">
		<div class="container clearfix">  
			
            <div class="car_types_list">
            	<h2>Scegli in base alla Categoria</h2>
                <ul>
					<?php
					$result = mysql_query("SELECT count(Id) as c from vistaauto where idCarrozzeria=1");
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					?>
					<li class="type_hover cart_type_2">
                        <a href="tipologie.php?tiporic=1" class="front"><strong>CITY CAR</strong> <em><?php echo $row["c"]." ANNUNCI"; ?></em></a>
                        <a href="tipologie.php?tiporic=1" class="back"><strong>CITY CAR</strong> <em>Vedi</em></a>
                    </li>
 					<?php
					$result = mysql_query("SELECT count(Id) as c from vistaauto where idCarrozzeria=4");
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					?>
					<li class="type_hover cart_type_1">
                        <a href="tipologie.php?tiporic=4" class="front"><strong>MONOVOLUME & STATION</strong> <em><?php echo $row["c"]." ANNUNCI"; ?></em></a>
                        <a href="tipologie.php?tiporic=4" class="back"><strong>MONOVOLUME & STATION</strong> <em>Vedi</em></a>
                    </li>
					<?php
					$result = mysql_query("SELECT count(Id) as c from vistaauto where idCarrozzeria=7");
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					?>
                    <li class="type_hover cart_type_3">
                    <a href="tipologie.php?tiporic=7" class="front"><strong>CABRIO & SPORTIVE</strong> <em><?php echo $row["c"]." ANNUNCI"; ?></em></a>
                    <a href="tipologie.php?tiporic=7" class="back"><strong>CABRIO & SPORTIVE</strong> <em>Vedi</em></a>
                    </li>
					<?php
					$result = mysql_query("SELECT count(Id) as c from vistaauto where idCarrozzeria=5");
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					?>
                    <li class="type_hover cart_type_4">
                    <a href="tipologie.php?tiporic=5" class="front"><strong>SUVS & FUORISTRADA</strong> <em><?php echo $row["c"]." ANNUNCI"; ?></em></a>
                    <a href="tipologie.php?tiporic=5" class="back"><strong>SUVS & FUORISTRADA</strong> <em>Vedi</em></a>
                    </li>
 					<?php
					$result = mysql_query("SELECT count(Id) as c from vistaauto where idCarrozzeria=2");
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					?>
					<li class="type_hover cart_type_5">
                    <a href="tipologie.php?tiporic=2" class="front"><strong>BERLINE</strong> <em><?php echo $row["c"]." ANNUNCI"; ?></em></a>
                    <a href="tipologie.php?tiporic=2" class="back"><strong>BERLINE</strong> <em>Vedi</em></a>
                    </li>
                </ul>                
            	
            </div>
            <script>	
			jQuery(document).ready(function($) {		
				$('.type_hover').hover(function(){
					$(this).addClass('flip');
				},function(){
					$(this).removeClass('flip');
				});		          
			});
			</script> 
            
		</div>
	</div>
    <!--/ car types -->
    
    
    <!-- latest_offers -->
	<div class="middle_row latest_offers">
		<div class="container clearfix">         			
        	<h2>LE CONCESSIONARIE</h2>
                     
            
		</div>
            
        <div id="latest_offers">
		
			<?php
			$result = mysql_query("SELECT * FROM utenti where tipoutente=2");
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			?>
				<div class="latest_item">
				<a ><img src="loghi/<?php echo $row["logo"]; ?>"  width="260px" height="160px" alt=""></a>
				<a ><?php echo $row["nome"]; ?></a>
				</div>

			<?php
			}
			?>

        </div>
        
        <a class="prev" id="latest_offers_prev" href="#"></a>
        <a class="next" id="latest_offers_next" href="#"></a>
                    
        <script>	
        jQuery(document).ready(function($) {	
			var screenRes = $(window).width();
			
            $('#latest_offers').carouFredSel({
                prev : "#latest_offers_prev",
                next : "#latest_offers_next", 
                infinite: false,
                circular: true,
                auto: false,
                width: '100%',				
                scroll: {
                    items : 1,
					onBefore: function (data) {
						if (screenRes > 900) {
						data.items.visible.eq(0).animate({opacity: 0.15},300);
						data.items.old.eq(-1).animate({opacity: 1},300);
						data.items.visible.eq(-1).animate({opacity: 0.15},300);		               
						}
		            },
					onAfter: function (data) {
						if (screenRes > 900) {
						data.items.old.eq(0).animate({opacity: 1},300);	
						}
		            }
                }
            });			
			if (screenRes > 900) {
				var vis_items = $("#latest_offers").triggerHandler("currentVisible");
				vis_items.eq(-1).animate({opacity: 0.15},100);
				vis_items.eq(0).animate({opacity: 0.15},100);
			}
        });
        </script>
	</div>
    <!--/ latest_offers -->

	
	<!-- popular brands 
	<div class="middle_row row_light_gray brand_list">
		<div class="container">
	            <h2>MOST POPULAR BRANDS:</h2>
	            <ul>
	            	<li><a href="#"><img src="images/temp/brand_logo_1.png" alt=""></a></li>
                    <li><a href="#"><img src="images/temp/brand_logo_2.png" alt=""></a></li>
                    <li><a href="#"><img src="images/temp/brand_logo_3.png" alt=""></a></li>
                    <li><a href="#"><img src="images/temp/brand_logo_4.png" alt=""></a></li>
                    <li><a href="#"><img src="images/temp/brand_logo_5.png" alt=""></a></li>
                    <li><a href="#"><img src="images/temp/brand_logo_6.png" alt=""></a></li>
                    <li><a href="#"><img src="images/temp/brand_logo_7.png" alt=""></a></li>
                    <li><a href="#"><img src="images/temp/brand_logo_8.png" alt=""></a></li>
	            </ul>
	            
	            <a href="#" class="link_more">View All Popular Brands</a>
        </div>
	</div>-->
    <!--/ popular brands -->
<!--/ middle -->

	<?php include("footer.php"); ?>
	
</div>
</body>
</html>
