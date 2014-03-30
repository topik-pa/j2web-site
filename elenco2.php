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



	if (tiporic == "de"){
		query = "<?php echo $_REQUEST["query"]?>";
		start = "<?php echo $_REQUEST["start"]?>";
		limit = "<?php echo $_REQUEST["limit"]?>";
		tiporic = "<?php echo $_REQUEST["tipoRic"]?>";
		page = "<?php echo $_REQUEST["page"]?>";
		ordine = "<?php echo $_REQUEST["ordine"]?>";
	}

function Elenco(query, start, limit, tipoRic, page, ordine){
	if (ordine == "")
			query = query + " ORDER BY Prezzo ASC";
		else if (ordine == "pc")
			query = query + " ORDER BY Prezzo ASC";
		else if (ordine == "pd")
			query = query + " ORDER BY Prezzo DESC";
		else if (ordine == "ui")
			query = query + " ORDER BY datains desc";
		else if (ordine == "cc")
			query = query + " ORDER BY Chilometraggio ASC";
		else if (ordine == "cd")
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
			<h1>Showing <span>143 RESULTS</span> for your search</h1>
		</div>

	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.php">Home</a>  <span class="separator">&rsaquo;</span>  Ricerca <span class="separator">&rsaquo;</span>  <span class="current">143 Results</span></p>
			
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
								<option value="pc">Prezzo Crescente</option>
								<option value="pd">Prezzo Decrescente</option>
								<option value="ui">Ultimi inseriti</option>
								<option value="cc">Chilometraggio Crescente</option>
								<option value="cd">Chilometraggio Decrescente</option>
								
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
					<h3 class="widget-title">ADJUST SEARCH RESULTS</h3>
						
					<form action="#" method="get" class="side_form">
					
						<div class="row field_select" style="z-index:10">
							<label class="label_title">Car Maker:</label>
							<select class="select_styled white_select" name="car_maker">
								<option value="0" class="default">- SELECT -</option>
								<option value="1">Alfa Romeo</option>
								<option value="2">Audi</option>
								<option value="3">BMW</option>
								<option value="4">Chevrolet</option>
								<option value="5">Ford</option>
								<option value="6">Honda</option>                                                
								<option value="7">Lexus</option>
								<option value="8">Mazda</option>
								<option value="9">Mercedes Benz</option>
								<option value="10">Mitsubishi</option>
								<option value="11">Nissan</option>
								<option value="12">Opel</option>
								<option value="13">Toyota</option>                       
								<option value="14">Volkswagen</option>
								<option value="15">Volvo</option>                        
							</select>
						</div>
						
						<div class="row field_select" style="z-index:9">
							<label class="label_title">Model:</label>
							<select class="select_styled white_select" name="car_model">
								<option value="0" class="default">- SELECT -</option>
								<option value="1">626</option>
								<option value="2">323</option>
								<option value="3">3</option>
								<option value="4">5</option>
								<option value="5">7</option>
								<option value="6">?X-7</option>                                                
								<option value="7">MVP</option>
								<option value="8">RX-8</option>
								<option value="9">MX-3</option>
								<option value="10">MX-5</option>
								<option value="11">MX-6</option>
								<option value="12">BT-50</option>
								<option value="13">CX-9</option>                       
							</select>
						</div>
						
						<div class="row field_select" style="z-index:8">
							<label class="label_title">Regist. from:</label>
							<select class="select_styled white_select" name="car_year">
								<option value="2013">2013</option>
								<option value="2012">2012</option>
								<option value="2011">2011</option>
								<option value="2010">2010</option>
								<option value="2009">2009</option>
								<option value="2008">2008</option>
								<option value="2007">2007</option>
								<option value="2006">2006</option>  
								<option value="2005">2005</option>
								<option value="2004">2004</option>
								<option value="2003">2003</option>
							</select>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title2">Vehicle Type:</label><br>                            
							<input type="checkbox" name="vehicle_type_1" id="vehicle_type_1" value="1"> <label for="vehicle_type_1">Compact Cars <span>(32)</span></label>
							<input type="checkbox" name="vehicle_type_2" id="vehicle_type_2" value="2" checked> <label for="vehicle_type_2">SUVs & PickUps <span>(49)</span></label>
							<input type="checkbox" name="vehicle_type_3" id="vehicle_type_3" value="3"> <label for="vehicle_type_3">Estate Saloons <span>(56)</span></label>
							<input type="checkbox" name="vehicle_type_4" id="vehicle_type_4" value="4"> <label for="vehicle_type_4">Sedan Cars <span>(31)</span></label>
							<input type="checkbox" name="vehicle_type_5" id="vehicle_type_5" value="5"> <label for="vehicle_type_5">Sports Cars <span>(23)</span></label>
							<input type="checkbox" name="vehicle_type_6" id="vehicle_type_6" value="6"> <label for="vehicle_type_6">Van & Minibus <span>(46)</span></label>
						</div>
						
						<div class="row rangeField">
							<label class="label_title2">Price Range:</label>
							<div class="range-slider">
								<input id="price_range" type="text" name="price_range" value="5000;60000">
							</div>                   
							<div class="clear"></div>
						</div>
						
						<div class="row rangeField">
							<label class="label_title2">Kilometers:</label>
							<div class="range-slider">
								<input id="miliage" type="text" name="miliage" value="50000;400000">
							</div>                   
							<div class="clear"></div>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title2">Fuel Type:</label><br>                            
							<input type="checkbox" name="fuel_type_1" id="fuel_type_1" value="1"> <label for="fuel_type_1">Petrol  <span>(32)</span></label>
							<input type="checkbox" name="fuel_type_2" id="fuel_type_2" value="2" checked> <label for="fuel_type_2">Diesel <span>(49)</span></label>
							<input type="checkbox" name="fuel_type_3" id="fuel_type_3" value="3"> <label for="fuel_type_3">Natural Gas <span>(56)</span></label>
							<input type="checkbox" name="fuel_type_4" id="fuel_type_4" value="4"> <label for="fuel_type_4">LPG <span>(31)</span></label>
							<input type="checkbox" name="fuel_type_5" id="fuel_type_5" value="5"> <label for="fuel_type_5">Electric <span>(23)</span></label>
							<input type="checkbox" name="fuel_type_6" id="fuel_type_6" value="6" checked> <label for="fuel_type_6">Hybrid <span>(46)</span></label>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title2">Engine Size:</label><br>                            
							<input type="checkbox" name="engine_power_1" id="engine_power_1" value="1" checked> <label for="engine_power_1">1.1 - 1.5  <span>(32)</span></label>
							<input type="checkbox" name="engine_power_2" id="engine_power_2" value="2" checked> <label for="engine_power_2">1.6 - 2.0  <span>(49)</span></label>
							<input type="checkbox" name="engine_power_3" id="engine_power_3" value="3"> <label for="engine_power_3">2.1 - 3.0  <span>(56)</span></label>
							<input type="checkbox" name="engine_power_4" id="engine_power_4" value="4"> <label for="engine_power_4">3.1 - 4.0 <span>(31)</span></label>
							<input type="checkbox" name="engine_power_5" id="engine_power_5" value="5"> <label for="engine_power_5">4.1 +   <span>(23)</span></label>
						</div>
						
						<div class="row input_styled checklist">
							<label class="label_title2">Car Colour:</label><br>                            
							<input type="checkbox" name="car_color_all" id="car_color_all" value="0" checked> <label for="car_color_all">All Colours <span>(332)</span></label>
							<input type="checkbox" name="car_color_1" id="car_color_1" value="1"> <label for="car_color_1">Silver <span>(49)</span></label>
							<input type="checkbox" name="car_color_2" id="car_color_2" value="2"> <label for="car_color_2">Black <span>(56)</span></label>
							<input type="checkbox" name="car_color_3" id="car_color_3" value="3"> <label for="car_color_3">Brown <span>(31)</span></label>
							<input type="checkbox" name="car_color_4" id="car_color_4" value="4"> <label for="car_color_4">White <span>(23)</span></label>
							<input type="checkbox" name="car_color_5" id="car_color_5" value="5"> <label for="car_color_5">Red <span>(46)</span></label>
							<input type="checkbox" name="car_color_6" id="car_color_6" value="5"> <label for="car_color_6">Green <span>(46)</span></label>
							<input type="checkbox" name="car_color_other" id="car_color_other" value="7"> <label for="car_color_other">Other <span>(115)</span></label>
						</div>
						
						<div class="row rowSubmit">
							<span class="btn btn_search"><input type="submit" value="SEARCH"></span>
						</div>
						
					</form>    
				
					<script type="text/javascript" >
						
							jQuery(document).ready(function($) {	
								
								Elenco(query, start, limit, tiporic, page, ordine);
								
								// Price Range Input
								$("#price_range").slider({ 
									from: 100,
									to: 100000,
									limits: false, 
									scale: ['$100', '$100k'],
									heterogeneity: ['50/50000'],
									step: 100,
									smooth: true,
									dimension: '$',
									skin: "round_blue"
								});
								$("#miliage").slider({ 
									from: 0,
									to: 500000,
									limits: false, 
									scale: ['0', '500k'],
									heterogeneity: ['50/250000'],
									step: 5000,
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

<!-- popular brands -->
<div class="middle_row row_white brand_list">
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
</div>
<!--/ popular brands -->

<div class="footer">
	<div class="container clearfix">
    
		<div class="f_col f_col_1">  
            <h3>Vehicles:</h3>
            <ul>
                <li><a href="#"><span>Motorbikes</span></a></li> 
                <li><a href="#"><span>Compacts</span></a></li>
                <li><a href="#"><span>Sedans</span></a></li>
                <li><a href="#"><span>4x4 SUVs</span></a></li>
                <li><a href="#"><span>Pickups</span></a></li>
                <li><a href="#"><span>Vans & Trucks</span></a></li>                                
            </ul>
        </div>
        <!--/ footer col 1 -->
        
        <div class="f_col f_col_2">        	
			<h3>Services:</h3>
            <ul>
                <li><a href="#"><span>Buy a car</span></a></li> 
                <li><a href="#"><span>Sell your Car</span></a></li>
                <li><a href="#"><span>Buy Back</span></a></li>
                <li><a href="#"><span>Repair Shop </span></a></li>
            </ul>
        </div>
        <!--/ footer col 2 -->
        
        <div class="f_col f_col_3">        	
            <h3>Privacy:</h3>
            <ul>
                <li><a href="#"><span>Terms & Conditions</span></a></li> 
                <li><a href="#"><span>Privacy Statement</span></a></li>
                <li><a href="#"><span>F.A.Q.</span></a></li>
                <li><a href="#"><span>Support</span></a></li>
                <li><a href="#"><span>Confidentiality</span></a></li>
            </ul>
        </div>        
        <!--/ footer col 3 -->
        
        <div class="f_col f_col_4">   
           	<h3>OUR SHOWROOM</h3>
            <div class="footer_address">
                <div class="address">
	                21 Sunset Blvd, Los Angeles<br>
	                California, 90453
                </div>
                <div class="hours">
                	Mon - Fri: 9AM - 7 PM<br>
					Sat - Sun: 9AM - 2 PM
				</div>
                <a href="contact.html" class="notice">View Bigger Map</a>
            </div>
            <div class="footer_map" style="background:url(images/temp/footer_map.jpg);"><a href="contact.html" class="amap"></a></div>
      	</div>
        <!--/ footer col 4 -->
        
        <div class="clear"></div>
        
        <div class="footer_social">
        	<div class="social_inner">
			    <a href="#" class="social-google"><span>Google +1</span></a>
			    <a href="#" class="social-fb"><span>Facebook</span></a>
			    <a href="#" class="social-twitter"><span>Twitter</span></a>
			    <a href="#" class="social-dribble"><span>Dribble</span></a>
			    <a href="#" class="social-linkedin"><span>LinkedIn</span></a>
			    <a href="#" class="social-vimeo"><span>Vimeo</span></a>
			    <a href="#" class="social-flickr"><span>Flickr</span></a>
			    <a href="#" class="social-da"><span>Devianart</span></a>
            </div>
		</div>
        
        <div class="footer_contacts">
        	<span class="phone">555-39.84.35</span>
            <span class="email">hello@autotrader.com</span>
        </div>
        
        <div class="copyright">
        AutoTrader Wordpress theme by <a href="http://themefuse.com">Themefuse</a>  &nbsp;|&nbsp;  <a href="http://themefuse.com" class="link_white">Premium WordPress themes</a>
        </div>
        	        
    </div> 
</div>

</div>
</body>
</html>
