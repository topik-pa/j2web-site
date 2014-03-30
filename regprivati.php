<?php
session_start();

include("config.inc.php");
include("funzioni.php");


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
function control()
{	
	if(CheckCampiForm("reg") ==  false) return false;
	var e1 = document.getElementById('password');
	var e2 = document.getElementById('password2');
	
	if (e1.value != e2.value) {
		alert("Devi riconfermare la stessa password!");
		return false;
	}
	
	var mail = document.getElementById('email').value;
	
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "mail=" + mail + "&action=verificamail",
		async: false,
		success: function(msg) {
			if(msg == "no"){
				alert("Email gia' esistente");  
				aa();
			}
			
		},
		error: function(msg) {
			alert(msg);
		}
	});
	
	
	
}


function loadprovincie(idregione)
{
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "idregione=" + idregione + "&action=loadprovincie",
		async: false,
		success: function(msg) {
			if(msg == "0") alert("Errore di lettura dati");  
			else $("#idprovincia").html(msg);
			
		},
		error: function(msg) {
			alert(msg);
		}
	});
}

function loadcomuni(idprovincia)
{
	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: "idprovincia=" + idprovincia + "&action=loadcomuni",
		async: false,
		success: function(msg) {
		
			if(msg == "0") alert("Errore di lettura dati");  
			else $("#idcomune").html(msg);
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
	<?php include("header.php"); ?>
	<!--/ header top bar -->
		
	<!-- header -->
	<div class="header header_thin" style="background-image:url(images/temp/slider_1_1.jpg)">
				
		<div class="header_title">
			<h1><span>Registrazione privati</span></h1>
		</div>

	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.html">Home</a>  <span class="separator">&rsaquo;</span> <a href="#">Registrazione Privati</a>  </p>
			<a href="offers-search.html" class="link_search">Start a Car Search</a>
		</div>
	</div>
	<!--/ breadcrumbs -->

    
	<!-- middle -->   
	<div id="middle" class="full_width">
		<div class="container clearfix">  
		
			<!-- content -->
			<div class="content">            
						  
				<div class="entry">
					
					<div class="">
						<p><h1><strong>Compila</strong> i campi obbligatori (*)</h1></p>
					</div>
					
					<div>
						<form id="reg" name="reg" action="valregpriv.php" method="POST" onsubmit="return control();">
						<table id="tabreg">
							<tr>
								<td>* E-mail:</td>
								<td><input type="text" class="controlla" id="email" name="email" /></td>
							</tr>
							<tr>
								<td>* Password:</td>
								<td><input type="password" class="controlla" id="password" name="password" /></td>
							</tr>
							<tr>
								<td>* Conferma Password:</td>
								<td><input type="password" class="controlla" id="password2" name="password2" /></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>* Nome:</td>
								<td><input type="text" class="controlla" id="nome" name="nome" /></td>
							</tr>
							<tr>
								<td>* Cognome:</td>
								<td><input type="text" class="controlla" id="cognome" name="cognome" /></td>
							</tr>
							<tr>
								<td>* Telefono:</td>
								<td><input type="text" class="controlla" id="telefono" name="telefono" /></td>
							</tr>
							<tr>
								<td>* Regione:</td>
								<td><select class="controlla" id="idregione" name="idregione" onchange="loadprovincie(this.value)">
											<?php echo $regioni?>
										</select></td>
							</tr>
							<tr>
								<td>* Provincia:</td>
								<td><select class="controlla" id="idprovincia" name="idprovincia" onchange="loadcomuni(this.value)">
											<option value="">-- Seleziona --</option>
										</select></td>
							</tr>
							<tr>
								<td>* Comune:</td>
								<td><select class="controlla" id="idcomune" name="idcomune">
											<option value="">-- Seleziona --</option>
										</select></td>
							</tr>
							<tr>
								<td>* Indirizzo:</td>
								<td><input type="text" class="controlla" id="indirizzo" name="indirizzo" /></td>
							</tr>
							<tr>
								<td></td>
								<td><button class="btn btn_default"><span>REGISTRATI</span></button></td>
							</tr>
						
						</table>
						
					
					</div>

				</div>
				
			</div>
			<!--/ content -->
			
				  
		</div>
	</div>
	<!--/ middle -->

	<?php include("footer.php"); ?>
	
</div>
</body>
</html>
