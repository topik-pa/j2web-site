<?php
session_start();

include("config.inc.php");

$foto1=$_FILES["foto1"]["name"];

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["foto1"]["name"]);

$extension = end($temp);
if ((($_FILES["foto1"]["type"] == "image/gif")
|| ($_FILES["foto1"]["type"] == "image/jpeg")
|| ($_FILES["foto1"]["type"] == "image/jpg")
|| ($_FILES["foto1"]["type"] == "image/pjpeg")
|| ($_FILES["foto1"]["type"] == "image/x-png")
|| ($_FILES["foto1"]["type"] == "image/png"))
&& ($_FILES["foto1"]["size"] < 2000000000000000000000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["foto1"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["foto1"]["error"] . "<br>";
    }
  else
    {
    while (file_exists("imgauto/" . $foto1))
      {
		$temp = explode(".", $foto1);
		$foto1 = $temp[0]."(01).".$temp[1];
	}
      move_uploaded_file($_FILES["foto1"]["tmp_name"],
      "imgauto/" . $foto1);
     
    }
  }
  
  
$foto2=$_FILES["foto2"]["name"];
if ($foto2!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto2"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto2"]["type"] == "image/gif")
	|| ($_FILES["foto2"]["type"] == "image/jpeg")
	|| ($_FILES["foto2"]["type"] == "image/jpg")
	|| ($_FILES["foto2"]["type"] == "image/pjpeg")
	|| ($_FILES["foto2"]["type"] == "image/x-png")
	|| ($_FILES["foto2"]["type"] == "image/png"))
	&& ($_FILES["foto2"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto2"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto2"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto2))
		  {
			$temp = explode(".", $foto2);
			$foto2 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto2"]["tmp_name"],
		  "imgauto/" . $foto2);
		 
		}
	  }		
}

$foto3=$_FILES["foto3"]["name"];
if ($foto3!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto3"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto3"]["type"] == "image/gif")
	|| ($_FILES["foto3"]["type"] == "image/jpeg")
	|| ($_FILES["foto3"]["type"] == "image/jpg")
	|| ($_FILES["foto3"]["type"] == "image/pjpeg")
	|| ($_FILES["foto3"]["type"] == "image/x-png")
	|| ($_FILES["foto3"]["type"] == "image/png"))
	&& ($_FILES["foto3"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto3"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto3"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto3))
		  {
			$temp = explode(".", $foto3);
			$foto3 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto3"]["tmp_name"],
		  "imgauto/" . $foto3);
		 
		}
	  }		
}

$foto4=$_FILES["foto4"]["name"];
if ($foto4!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto4"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto4"]["type"] == "image/gif")
	|| ($_FILES["foto4"]["type"] == "image/jpeg")
	|| ($_FILES["foto4"]["type"] == "image/jpg")
	|| ($_FILES["foto4"]["type"] == "image/pjpeg")
	|| ($_FILES["foto4"]["type"] == "image/x-png")
	|| ($_FILES["foto4"]["type"] == "image/png"))
	&& ($_FILES["foto4"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto4"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto4"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto4))
		  {
			$temp = explode(".", $foto4);
			$foto4 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto4"]["tmp_name"],
		  "imgauto/" . $foto4);
		 
		}
	  }		
}

$foto5=$_FILES["foto5"]["name"];
if ($foto5!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto5"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto5"]["type"] == "image/gif")
	|| ($_FILES["foto5"]["type"] == "image/jpeg")
	|| ($_FILES["foto5"]["type"] == "image/jpg")
	|| ($_FILES["foto5"]["type"] == "image/pjpeg")
	|| ($_FILES["foto5"]["type"] == "image/x-png")
	|| ($_FILES["foto5"]["type"] == "image/png"))
	&& ($_FILES["foto5"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto5"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto5"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto5))
		  {
			$temp = explode(".", $foto5);
			$foto5 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto5"]["tmp_name"],
		  "imgauto/" . $foto5);
		 
		}
	  }		
}

$foto6=$_FILES["foto6"]["name"];
if ($foto6!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto6"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto6"]["type"] == "image/gif")
	|| ($_FILES["foto6"]["type"] == "image/jpeg")
	|| ($_FILES["foto6"]["type"] == "image/jpg")
	|| ($_FILES["foto6"]["type"] == "image/pjpeg")
	|| ($_FILES["foto6"]["type"] == "image/x-png")
	|| ($_FILES["foto6"]["type"] == "image/png"))
	&& ($_FILES["foto6"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto6"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto6"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto6))
		  {
			$temp = explode(".", $foto6);
			$foto6 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto6"]["tmp_name"],
		  "imgauto/" . $foto6);
		 
		}
	  }		
}

$foto7=$_FILES["foto7"]["name"];
if ($foto7!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto7"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto7"]["type"] == "image/gif")
	|| ($_FILES["foto7"]["type"] == "image/jpeg")
	|| ($_FILES["foto7"]["type"] == "image/jpg")
	|| ($_FILES["foto7"]["type"] == "image/pjpeg")
	|| ($_FILES["foto7"]["type"] == "image/x-png")
	|| ($_FILES["foto7"]["type"] == "image/png"))
	&& ($_FILES["foto7"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto7"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto7"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto7))
		  {
			$temp = explode(".", $foto7);
			$foto7 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto7"]["tmp_name"],
		  "imgauto/" . $foto7);
		 
		}
	  }		
}

$foto8=$_FILES["foto8"]["name"];
if ($foto8!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto8"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto8"]["type"] == "image/gif")
	|| ($_FILES["foto8"]["type"] == "image/jpeg")
	|| ($_FILES["foto8"]["type"] == "image/jpg")
	|| ($_FILES["foto8"]["type"] == "image/pjpeg")
	|| ($_FILES["foto8"]["type"] == "image/x-png")
	|| ($_FILES["foto8"]["type"] == "image/png"))
	&& ($_FILES["foto8"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto8"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto8"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto8))
		  {
			$temp = explode(".", $foto8);
			$foto8 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto8"]["tmp_name"],
		  "imgauto/" . $foto8);
		 
		}
	  }		
}

$foto9=$_FILES["foto9"]["name"];
if ($foto9!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto9"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto9"]["type"] == "image/gif")
	|| ($_FILES["foto9"]["type"] == "image/jpeg")
	|| ($_FILES["foto9"]["type"] == "image/jpg")
	|| ($_FILES["foto9"]["type"] == "image/pjpeg")
	|| ($_FILES["foto9"]["type"] == "image/x-png")
	|| ($_FILES["foto9"]["type"] == "image/png"))
	&& ($_FILES["foto9"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto9"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto9"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto9))
		  {
			$temp = explode(".", $foto9);
			$foto9 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto9"]["tmp_name"],
		  "imgauto/" . $foto9);
		 
		}
	  }		
}

$foto10=$_FILES["foto10"]["name"];
if ($foto10!=""){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["foto10"]["name"]);

	$extension = end($temp);
	if ((($_FILES["foto10"]["type"] == "image/gif")
	|| ($_FILES["foto10"]["type"] == "image/jpeg")
	|| ($_FILES["foto10"]["type"] == "image/jpg")
	|| ($_FILES["foto10"]["type"] == "image/pjpeg")
	|| ($_FILES["foto10"]["type"] == "image/x-png")
	|| ($_FILES["foto10"]["type"] == "image/png"))
	&& ($_FILES["foto10"]["size"] < 2000000000000000000000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["foto10"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["foto10"]["error"] . "<br>";
		}
	  else
		{
		
		while (file_exists("imgauto/" . $foto10))
		  {
			$temp = explode(".", $foto10);
			$foto10 = $temp[0]."(01).".$temp[1];
		}
		  move_uploaded_file($_FILES["foto10"]["tmp_name"],
		  "imgauto/" . $foto10);
		 
		}
	  }		
}

$idTipologia= $_POST["idTipologia"];
$Marca= $_POST["Marca"];
$Prezzo= $_POST["Prezzo"];
$idCarburante= $_POST["idCarburante"];
$PrecedentiProprietari= $_POST["PrecedentiProprietari"];
$PotenzaKW= $_POST["PotenzaKW"];
$Chilometraggio= $_POST["Chilometraggio"];
$ABS= $_POST["ABS"];
$ChiusuraCentralizzata= $_POST["ChiusuraCentralizzata"];
$Immobilizer= $_POST["Immobilizer"];
$Clima= $_POST["Clima"];
$ParkDistControl= $_POST["ParkDistControl"];
$VolanteMultifunzione= $_POST["VolanteMultifunzione"];
$GancioTraino= $_POST["GancioTraino"];
$Motore= $_POST["Motore"];
$ClasseEmissione= $_POST["ClasseEmissione"];
$Descrizione= $_POST["Descrizione"];
$idCarrozzeria= $_POST["idCarrozzeria"];
$Modello= $_POST["Modello"];
$Trattabile= $_POST["Trattabile"];
$AnnoImmatricolazione= $_POST["AnnoImmatricolazione"];
$idColoreEsterno= $_POST["idColoreEsterno"];
$PotenzaCV= $_POST["PotenzaCV"];
$FinitureInterni= $_POST["FinitureInterni"];
$Airbag= $_POST["Airbag"];
$ControlloAutomTrazione= $_POST["ControlloAutomTrazione"];
$FreniADisco= $_POST["FreniADisco"];
$NavigatoreSatellitare= $_POST["NavigatoreSatellitare"];
$SediliRiscaldati= $_POST["SediliRiscaldati"];
$ColoreInterni= $_POST["ColoreInterni"];
$Handicap= $_POST["Handicap"];
$Portapacchi= $_POST["Portapacchi"];
$Cambio= $_POST["Cambio"];
$ConsumoMedio= $_POST["ConsumoMedio"];
$Cilindrata= $_POST["Cilindrata"];
$Versione= $_POST["Versione"];
$Contratto= $_POST["Contratto"];
$MeseImmatricolazione= $_POST["MeseImmatricolazione"];
$Metallizzato= $_POST["Metallizzato"];
$PostiASedere= $_POST["PostiASedere"];
$Antifurto= $_POST["Antifurto"];
$ESP= $_POST["ESP"];
$AlzacristalliElettrici= $_POST["AlzacristalliElettrici"];
$RadioCD= $_POST["RadioCD"];
$Servosterzo= $_POST["Servosterzo"];
$CerchiInLega= $_POST["CerchiInLega"];
$SediliSportivi= $_POST["SediliSportivi"];
$NumRapporti= $_POST["NumRapporti"];
$UrlYT= $_POST["UrlYT"];


$sql = "INSERT INTO autoveicoli ( idutente, Marca, Modello, Versione, Descrizione, 
			MeseImmatricolazione, AnnoImmatricolazione, idCarburante, idTipologia, idCarrozzeria, PostiASedere, 
			PotenzaKW, PotenzaCV, idColoreEsterno, Metallizzato, PrecedentiProprietari, Chilometraggio, Prezzo, 
			 Trattabile, Contratto, FinitureInterni, ColoreInterni, ABS, Airbag, 
			Antifurto, ChiusuraCentralizzata, ControlloAutomTrazione, ESP, Immobilizer, FreniADisco, AlzacristalliElettrici, 
			Clima, NavigatoreSatellitare, RadioCD, ParkDistControl, SediliRiscaldati, Servosterzo, VolanteMultifunzione, Handicap, 
			CerchiInLega, GancioTraino, Portapacchi, SediliSportivi, Motore, Cambio, NumRapporti, Cilindrata, ClasseEmissione, 
			ConsumoMedio, Immagine1, Immagine2, Immagine3, Immagine4, Immagine5, Immagine6, Immagine7, Immagine8, Immagine9, 
			Immagine10, UrlYT) 
			VALUES ( '".$_SESSION['id']."', '".$Marca."', '".$Modello."', '".$Versione."', '".$Descrizione."', 
			'".$MeseImmatricolazione."', '".$AnnoImmatricolazione."', '".$idCarburante."', '".$idTipologia."', '".$idCarrozzeria."', '".$PostiASedere."', 
			'".$PotenzaKW."', '".$PotenzaCV."', '".$idColoreEsterno."', '".$Metallizzato."', '".$PrecedentiProprietari."', '".$Chilometraggio."', 
			'".$Prezzo."', '".$Trattabile."', '".$Contratto."', '".$FinitureInterni."', '".$ColoreInterni."', '".$ABS."', '".$Airbag."', 
			'".$Antifurto."', '".$ChiusuraCentralizzata."', '".$ControlloAutomTrazione."', '".$ESP."', '".$Immobilizer."', '".$FreniADisco."', 
			'".$AlzacristalliElettrici."', '".$Clima."', '".$NavigatoreSatellitare."', '".$RadioCD."', '".$ParkDistControl."', '".$SediliRiscaldati."', 
			'".$Servosterzo."', '".$VolanteMultifunzione."', '".$Handicap."', '".$CerchiInLega."', '".$GancioTraino."', '".$Portapacchi."', 
			'".$SediliSportivi."', '".$Motore."', '".$Cambio."', '".$NumRapporti."', '".$Cilindrata."', '".$ClasseEmissione."', 
			'".$ConsumoMedio."', '".$foto1."', '".$foto2."', '".$foto3."', '".$foto4."', '".$foto5."', '".$foto6."', '".$foto7."', 
			'".$foto8."', '".$foto9."', '".$foto10."', '".$UrlYT."')";
	
$res = mysql_query( $sql, $connect );
$a="ok";
if(!$res ){
	$a="no";
}



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
	<?php include("header2.php"); ?>
	<!--/ header top bar -->
		
	<!-- header -->
	<div class="header header_thin" style="background-image:url(images/temp/slider_1_1.jpg)">
		
		<?php 
		if($_SESSION['tipo'] == 1){ 
			$result = mysql_query("SELECT * FROM utenti where Id= '".$_SESSION["id"]."'");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
		?>
			<div class="header_title">
				<h1><span>Inserimento Nuovo Annuncio da <?php echo $row["nome"]." ".$row["cognome"]; ?></span></h1>
			</div>
		<?php
		}
		else{
			$result = mysql_query("SELECT * FROM utenti where Id= '".$_SESSION["id"]."'");
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
		?>
			<div class="header_title">
				<h1><span>Inserimento Nuovo Annuncio da <?php echo $row["nome"]; ?></span></h1>
				
			</div>
		<?php
		}
		?>		


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
						<p><h1>ESITO INSERIMENTO:</h1></p>
						<?php if ($a=="ok"){?>
						<p><h3>L'inserimento del Veicolo e' Andato a Buon Fine, Controlla Nell'Area Riservata il Tuo Annuncio.</h3></p>
						<?php }else {?>
						<p><h3>L'inserimento Non è Andato a Buon Fine, Riprova Più Tardi...</h3></p>
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
