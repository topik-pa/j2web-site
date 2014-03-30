<?php
session_start();

include("config.inc.php");
include("funzioni.php");

if(!isset($_SESSION['id']))
{
	header('Location: login.php');
}
else
{
	if($_SESSION['tipo'] == 1)
		header('Location: inseriscip.php');
	else
		header('Location: inseriscic.php');

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
</body>
</html>
