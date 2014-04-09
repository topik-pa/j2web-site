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
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->

<script>

function doRedirect() { 
location.href = "areaRiservata.php";
}
function aa(){
	window.setTimeout("doRedirect()", 1);
}
function carica()
{	
	
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "action=tabella",
		async: false,
		success: function(msg) 
		{
			if(msg == "0") alert("Error!");
			else if(msg == "") alert("Nessun dato trovato");
			else $("#tabella").html(msg);	
		},
		error: function(msg) 
		{
			
			alert(msg);
		}
	});
	
	
}

function carica2()
{	
	
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "action=tabella2",
		async: false,
		success: function(msg) 
		{
			if(msg == "0") alert("Error!");
			else if(msg == "") alert("Nessun dato trovato");
			else $("#tabella2").html(msg);	
		},
		error: function(msg) 
		{
			
			alert(msg);
		}
	});
}

function elimina(id)
{	
	var a=confirm("Vuoi davvero eliminare il veicolo?");
	if (a==true){
		$.ajax({
			type: "POST",
			url: "ajax/gestione.php",
			data: "id=" + id + "&action=elimina",
			async: false,
			success: function(msg) 
			{
				if(msg == "0") alert("Error!");
				
				else {alert(msg);
				aa();}
			},
			error: function(msg) 
			{
				
				alert(msg);
			}
		});
	}
		
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
		
		<?php 
		if($_SESSION['tipo'] == 1){ 
			$result = mysql_query("SELECT * FROM utenti where Id= '".$_SESSION["id"]."'");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
		?>
			<div class="header_title">
				<h1><span>Benvenuto <?php echo $row["nome"]." ".$row["cognome"]; ?></span></h1>
			</div>
		<?php
		}
		else{
			$result = mysql_query("SELECT * FROM utenti where Id= '".$_SESSION["id"]."'");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
		?>
			<div class="header_title">
				<h1><span>Benvenuto <?php echo $row["nome"]; ?></span></h1>
				
			</div>
		<?php
		}
		?>		


	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.php">Home</a>  <span class="separator">&rsaquo;</span> <a href="#">Area Riservata</a> &rsaquo;  </p>
		</div>
	</div>
	<!--/ breadcrumbs -->

    
	<!-- middle -->   
	<div id="middle" class="full_width">
		<div class="container clearfix">  
		
			<!-- content -->
			<div class="content"> 

				<!--Sezione download del sw j2web-->
				<?php 
				if($_SESSION['tipo'] == 2){  //� un concessionario
							
				?> 
				<div id="j2web-download">
					<div id="getj2web">
						<h3>Scarica la tua versione di J2Web</h3>					
						
						<?php 
							$url = 'http://' . $_SERVER['SERVER_NAME'] . '/j2web/jnlp/j2web_' . $row["Id"] . '.jnlp';
							$array = get_headers($url);
							$string = $array[0];
							if (!strpos($string,"200")) { ?>
								<p>Attualmente non è disponibile una versione valida del software</p>
								<?php
							}
							else {?>
								<script src="https://www.java.com/js/deployJava.js"></script>
								<script>
									// using JavaScript to get location of JNLP
									// file relative to HTML page
									var idUtente = <?php echo $row["Id"]; ?>;
									var dir = location.href.substring(0,
										location.href.lastIndexOf('/')+1);
									var url = dir + 'j2web/jnlp/' + 'j2web_' + idUtente + '.jnlp';  //Path del file jnlp
									deployJava.createWebStartLaunchButton(url, '1.7.0');
								</script>
								<?php
							}
							?>
						
					</div>
					
					<div id="getjava">
						<a href="http://www.java.com"><img src="http://download.oracle.com/technetwork/java/get-java/getjavasoftware-180x150.png" alt="Get Java Software" border="0" width="180" height="150" /></a>
					</div>
					
					<div class="clear"></div>
				</div>
				<?php
				}
				?>
				<!--Sezione download del sw j2web-->				
						  
				<div class="entry">
					
					<div class="text-center">
						<a class="btn btn_blue" href="inserisci.php"><span>Inserisci Annuncio</span></a>
						<p><h1><strong>ELENCO DEGLI ANNUNCI INSERITI</strong></h1></p>
					</div>
					
					<?php 
					if($_SESSION['tipo'] == 1){ ?>
						<div class="styled_table table_blue" id="tabella"></div>
						<?php
					}
					else{?>
						<div class="styled_table table_blue" id="tabella2"></div>
						<?php
					}
					?>
	                
				
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

carica();
carica2();
$("#elimina").click(function() {
				elimina(id);
			});
});
</script>

</body>
</html>
