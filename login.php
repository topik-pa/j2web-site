<?php
session_start();

include("config.inc.php");
include("funzioni.php");

if(isset($_SESSION['id']))
{
	header('Location: areaRiservata.php');
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

function login()
{	
	if(CheckCampiForm("accedi") ==  false) return false;

	$.ajax({
		type: "POST",
		url: "ajax/gestione.php",
		data: $("#accedi").serialize() + "&action=login",
		async: false,
		success: function(msg) 
		{
			if(msg == "no") alert("E-mail o password non corretti!");
			else 
			{
				alert(msg);
				aa();
			}
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
			<h1>Accedi all'area riservata oppure... <span>Registrati</span></h1>
		</div>

	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<!-- <div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.html">Home</a>  <span class="separator">&rsaquo;</span> <a href="#">Login</a>  </p>
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
					
					<div class="text-center">
						<p><h1><strong>ACCEDI</strong>   - Effettua il login</h1></p>
						<form name="accedi" id="accedi">
							<p><input type="text" class="controlla" Placeholder="* E-mail" id="email" name="email"/></p>
							<p><input type="password" class="controlla" Placeholder="* Password" id="password" name="password"/></p>
							<p><button type="submit" class="btn btn_default" id="login"><span>LOGIN</span></button></p>
						</form>
						<p><a href="">Recupera password</a></p>
						<p><h1><strong>oppure...</strong></h1></p>
					</div>
				
	                <div class="row clearfix">
	                    <div class="col col_1_2 ">
							<div class="text-center">
								<a class="btn btn_blue" href="regprivati.php"><span>Registrazione Privati</span></a>
							</div>
	                    </div>
	                    
						<div class="col col_1_2 ">
							<div class="text-center">
								<a class="btn btn_green" href="regconcess.php"><span>Registrazione Concessionarie</span></a>
							</div>
						</div>
	                </div>
				
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

			$("#login").click(function() {
				login();
			});
		});
</script>

</body>
</html>
