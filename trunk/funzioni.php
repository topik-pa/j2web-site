<?php

//lista delle regioni
$result = mysql_query("SELECT ID, Descrizione FROM anag_regioni order by Descrizione");
$regioni = "<option value=''>-- Seleziona -- </option>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $regioni .= "<option value='".$row["ID"]."'>".$row["Descrizione"]."</option>";
}
mysql_free_result($result);


//lista dei tipi di auto
$result = mysql_query("SELECT Id, descrizione FROM tipoauto order by descrizione");
$tipo = "<option value=''>* Tipologia Automobile </option>";
$tipo2="<option value=''>Tipologia</option>";
//$tipo .= "<option value=''>Non Specificato </option>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $tipo .= "<option value='".$row["Id"]."'>".$row["descrizione"]."</option>";
   $tipo2 .= "<option value='".$row["Id"]."'>".$row["descrizione"]."</option>";
}
mysql_free_result($result);


//lista delle categorie
$result = mysql_query("SELECT Id, descrizione FROM carrozzeriaauto order by descrizione");
$cat = "<option value=''>* Categoria Automobile </option>";
$cat2="<option value=''>Categoria</option>";
//$cat .= "<option value=''>Non Specificato </option>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $cat .= "<option value='".$row["Id"]."'>".$row["descrizione"]."</option>";
   $cat2 .= "<option value='".$row["Id"]."'>".$row["descrizione"]."</option>";
}
mysql_free_result($result);


//lista delle marche
$result = mysql_query("SELECT * FROM marche order by id");

$marca = "<option value=''>* Marca Automobile </option>";
$marca2="<option value=''>Marca</option>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$marca .= "<option value='".$row['id']."'>".$row['nome']."</option>";
	$marca2 .= "<option value='".$row['id']."'>".$row['nome']."</option>";
}


//lista anni
$a=date("Y");
$anno="<option value=''>* Anno Immatricolazione</option>";
$anno2="<option value=''>Anno</option>";
for ($i = $a; $i >= 1946; $i--) {
    $anno .="<option value='$i'>$i</option>";
	$anno2 .="<option value='$i'>$i</option>";
}


//lista dei carburanti
$result = mysql_query("SELECT id, descrizione FROM carburante order by descrizione");
$carb = "<option value=''>* Carburante </option>";
$carb2 = "<option value=''>Carburante</option>";
//$carb .= "<option value=''>Non Specificato </option>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $carb .= "<option value='".$row["id"]."'>".$row["descrizione"]."</option>";
   $carb2 .= "<option value='".$row["id"]."'>".$row["descrizione"]."</option>";
}
mysql_free_result($result);


//lista dei colori
$result = mysql_query("SELECT id, descrizione FROM colore order by descrizione");
$colo = "<option value=''>* Colore </option>";
$colo2 = "<option value=''>Colore</option>";
//$colo .= "<option value=''>Non Specificato </option>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $colo .= "<option value='".$row["id"]."'>".$row["descrizione"]."</option>";
    $colo2 .= "<option value='".$row["id"]."'>".$row["descrizione"]."</option>";
}
mysql_free_result($result);
?>

