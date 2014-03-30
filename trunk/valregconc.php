<?php
session_start();

include("config.inc.php");

$valid=$_POST["valid"];
if ($valid==0){
	header('Location: regconcess.php');
	exit;
}

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["logo"]["name"]);

$extension = end($temp);
if ((($_FILES["logo"]["type"] == "image/gif")
|| ($_FILES["logo"]["type"] == "image/jpeg")
|| ($_FILES["logo"]["type"] == "image/jpg")
|| ($_FILES["logo"]["type"] == "image/pjpeg")
|| ($_FILES["logo"]["type"] == "image/x-png")
|| ($_FILES["logo"]["type"] == "image/png"))
&& ($_FILES["logo"]["size"] < 2000000000000000000000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["logo"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["logo"]["error"] . "<br>";
    }
  else
    {
	$name=$_FILES["logo"]["name"];
    while (file_exists("loghi/" . $name))
      {
		$temp = explode(".", $name);
		$name = $temp[0]."(01).".$temp[1];
	}
      move_uploaded_file($_FILES["logo"]["tmp_name"],
      "loghi/" . $name);
     
    }
  }


$mail= $_POST["email"];
$password= $_POST["password"];
$nome= $_POST["nome"];
$telefono= $_POST["telefono"];
$idregione= $_POST["idregione"];
$idprovincia= $_POST["idprovincia"];
$idcomune= $_POST["idcomune"];
$indirizzo= $_POST["indirizzo"];

$sql2 = "select Descrizione from anag_comuni where id=".$idcomune;
	
$res2 = mysql_query( $sql2, $connect );
$row = mysql_fetch_array($res2, MYSQL_ASSOC);
$nome2=$row["Descrizione"];
$geocode1=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$nome2&sensor=false");

  $output1= json_decode($geocode1);

  $lat1 = $output1->results[0]->geometry->location->lat;
  $long1 = $output1->results[0]->geometry->location->lng;

$sql = "INSERT INTO utenti (tipoutente, confermato, logo, email, password, nome, telefono, idregione, idprovincia, idcomune, indirizzo, lat, lon) 
		VALUES ('2', '0', '".$name."', '".$mail."','".$password."','".$nome."','".$telefono."','".$idregione."','".$idprovincia."','".$idcomune."','".$indirizzo."','".$lat1."','".$long1."')";
	
$res = mysql_query( $sql, $connect );
$a="ok";
if(!$res ){
	$a="no";
}




$headers = "From: ".$nomeagenzia." <".$emailagenzia.">"."\n";
$headers.= "MIME-Version: 1.0\n";
$headers.= "Content-type: text/html; charset=utf-8"."\n";

$oggetto = "Registrazione Concessionaria";				

$testo2 = "<strong>Registrazione Concessionaria</strong><br><br>";            
$testo2 .= $nome." ti sei registrato al servizio di auto nuove e usate.<br>";  
$testo2 .= "Email: ".$mail."<br>";  
$testo2 .= "Password: ".$password."<br>"; 

mail($emailagenzia,$oggetto,$testo2,$headers);	
mail($mail,$oggetto,$testo2,$headers);	


?>
<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
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
			<h1><span>Registrati</span></h1>
		</div>

	</div>
	<!--/ header -->

	<!-- breadcrumbs -->
	<div class="middle_row row_white breadcrumbs">
		<div class="container">
			<p><a href="index.php">Home</a></p>
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
						<p><h1>NOTIFICA DI AVVENUTA REGISTRAZIONE</h1></p>
						<?php if ($a=="ok"){?>
						<p>Attendere la notifica di avvenuta registrazione all'indirizzo e-mail: <strong><?php echo $mail?></strong></p>
						<?php }else {?>
						<p>La Registrazione non è andata a buon fine, riprova più tardi...</p>
						<?php }?>
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
