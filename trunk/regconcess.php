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
location.href = "regconcess.php";
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
	if(CheckCampiForm("reg") ==  false) return false;
	var e1 = document.getElementById('password');
	var e2 = document.getElementById('password2');
	
	if (e1.value != e2.value) {
		alert("Devi riconfermare la stessa password!");
		return false;
	}
	
	var logo = document.getElementById('logo');
	
    if(validateFileExtension(logo, "Inserire solo immagini jpeg, jpg, png, gif!", new Array("jpg","jpeg","gif","png")) == false)
        return false;
    
    if(validateFileSize(logo,5048576, "Inserire un'immagine di al massimo 5 MB !") == false)
        return false;
	
	
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
	
	document.getElementById('valid').value="1";
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
			<h1><span>Registrazione concessionarie</span></h1>
		</div>

	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.php">Home</a>  <span class="separator">&rsaquo;</span> <a href="#">Registrazione Concessionarie</a>  </p>
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
					
					<div class="">
						
							<form id="reg" name="reg" action="valregconc.php" method="POST" onsubmit="control()" enctype="multipart/form-data">
								<input type="hidden" id="valid" name="valid" value="0"/>
								
								<table id="tabreg">
									<tr>
										<td class="">* E-mail:</td>
										<td><input type="text" class="controlla" id="email" name="email" /></td>
									</tr>
									
									<tr>
										<td class="">* Password:</td>
										<td><input type="password" class="controlla" id="password" name="password" /></td>
									</tr>
									<tr>
										<td style="">* Conferma Password:</td>
										<td><input type="password" class="controlla" id="password2" name="password2" /></td>
									</tr>
									<tr>
										<td class="">&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td class="">* Logo:</td>
										<td><input type="file" name="logo" id="logo" class="controlla"></td>
									</tr>
									<tr>
										<td class="">* Ragione Sociale:</td>
										<td><input type="text" class="controlla" id="nome" name="nome" /></td>
									</tr>
									<tr>
										<td class="">* Telefono:</td>
										<td><input type="text" class="controlla" id="telefono" name="telefono" /></td>
									</tr>
									<tr>
										<td class="">* Regione:</td>
										<td><select class="controlla" id="idregione" name="idregione" onchange="loadprovincie(this.value)">
												<?php echo $regioni?>
											</select></td>
									</tr>
									<tr>
										<td class="">* Provincia:</td>
										<td><select class="controlla" id="idprovincia" name="idprovincia" onchange="loadcomuni(this.value)">
												<option value="">-- Seleziona --</option>
											</select></td>
									</tr>
									<tr>
										<td class="">* Comune:</td>
										<td><select class="controlla" id="idcomune" name="idcomune">
												<option value="">-- Seleziona --</option>
											</select></td>
									</tr>
									<tr>
										<td class="">* Indirizzo:</td>
										<td><input type="text" class="controlla" id="indirizzo" name="indirizzo" /></td>
									</tr>
									<tr>
										<td class=""></td>
										<td><button class="btn btn_default"><span>REGISTRATI</span></button></td>
									</tr>
								
								</table>
								
							</form>
						
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
