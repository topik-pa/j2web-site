<?php

//@ini_set("display_errors","1");
//@ini_set("display_startup_errors","1");

/**
* Copyright 2003-2013, QUALISYS SOFTWARE
* http://www.qualisys.gr
* @version 1.3
* @package mysqltunnel.php
* 
* * All rights reserved.!
* 
* A simple yet powerfull MySQL HTTP tunnel written in php
* The result is full descriptive, includes field names, field descriptions, and rows in JSON
* Both the request and result can be encrypted, and compresses to preserve bandwithd
*
**/

/**
* Call the script using the following commands in the URL. Can utilize either $_GET or $_POST
* host          = MySQL Host IP
* port          = MySQL Port, Leave blank for default 3306
* dbname        = MySQL Database Name
* username      = MySQL Database UserName
* password      = MySQL Database Password
* encrypted     = Use encrypted=1 for encrypted communications based on hashkey
* compress      = Use compress=1 to indicate resultset should be compressed
* charset       = MySQL Client Characterset
* query         = SQL Script to run on MySQL
* test          = Use test=1 to check if everything is OK
* 
* Examples
* http://[YOUR_URL]/mysqltunnel.php?test=1
* http://[YOUR_URL]/mysqltunnel.php?host=[MYSQL_HOST]&port=[MYSQL_PORT]&charset=[MYSQL_DB_CHARSET]&dbname=[MYSQL_DATABASE]&username=[MYSQL_USERNAME]&password=[MYSQL_PASSWORD]&query=[SQL_QUERY_TO_RUN]&compress=[USE_1_FOR_COMPRESSION]
* http://[YOUR_URL]/mysqltunnel.php?host=[ENCRYPTED_MYSQL_PORT]&port=[ENCRYPTED_MYSQL_PORT]&charset=[ENCRYPTED_MYSQL_DB_CHARSET]&dbname=[ENCRYPTED_MYSQL_DATABASE]&username=[ENCRYPTED_MYSQL_USERNAME]&password=[ENCRYPTED_MYSQL_PASSWORD]&query=[ENCRYPTED_SQL_QUERY_TO_RUN]&compress=[ENCRYPTED_USE_1_FOR_COMPRESSION]&encrypted=1
* 
* [SQL_QUERY_TO_RUN] can be either simple query such as SELECT * FROM contact LIMIT 1000
* 
* or
* 
* [SQL_QUERY_TO_RUN] can be a JSON specified query including parameters. That's used in order to allow base64 encoding of parameters such as BLOB and TEXT / VARCHAR, e.g. {"SQL":"SELECT * from contact LIMIT 1000","params":{}}
* e.g {"SQL":"UPDATE contact SET bActive = :bActive, strMaleFemale = :strMaleFemale, strFirstName = :strFirstName, strLastName = :strLastName, strEmail = :strEmail, dBirthdate = :dBirthdate, objPhoto = :objPhoto, mNotes = :mNotes WHERE iContactID = :Old_iContactID","params":{"dBirthdate":{"value":"STR_TO_DATE('1972-2-14 0:0:0', '%Y-%m-%d %H:%i:%s')"},"mNotes":{"value":"z4bOt863z4nPic64Cs+Iz4nOvgp2aGloaGI=","encoding":"base64","addsinglequotes":"true"},"strFirstName":{"value":"Ts6xz4POv8+CIM+Fz4U=","encoding":"base64","addsinglequotes":"true"},"strMaleFemale":{"value":"NULL"},"Old_iContactID":{"value":"19"},"bActive":{"value":"true"},"objPhoto":{"value":"NULL"},"strLastName":{"value":"zpHOu861zrrOuc62zr8=","encoding":"base64","addsinglequotes":"true"},"strEmail":{"value":"NULL"}}}";
* 
*/

/* Define hash key for encryption/decryption between client and tunnel */
/* The same key should be used in client application as well */
/* Leave this blank if you want unencrypted communication */
define("hashkey", "Em1uoc1gd");
define("aes", "128");       //Use this to encrypt with AES-128
//define("aes", "256");     //Use this to encrypt with AES-256

/* uncomment this line to create a debug log */
define ( "DEBUG", 1 );

/* uncomment this line to displaying information when called from browser with no request */
define ( "WEBBROWSERACCESSERROR", 1 );

/* Global Variables */
$LOGFILE = "mysqltunnel.log";
$LOGFILEHANDLE = 0;
$MAXLOGSIZE = "4000000";

define ( "tunnelversion", '1.0');
define ( "pagelogo", "http://webservices.mymanager.gr/MySQLTunnel.png");

define( "customerrorno", 100);
define( "nullvalue", chr(0));

/* parse REQUEST in $_GET or $_POST*/
$test = False;
$encrypted  = PostValue("encrypted");   // Client requires encrypted communications based on hashkey
$compress   = PostValue("compress");    // Indicate resultset should be compressed
$host       = PostValue("host");        // MySQL Host IP
$port       = PostValue("port");        // MySQL Port, Usually 3306
$charset    = PostValue("charset");     // MySQL Client Characterset
$dbname     = PostValue("dbname");      // MySQL Database Name
$username   = PostValue("username");    // MySQL Database UserName
$password   = PostValue("password");    // MySQL Database Password
$query      = PostValue("query");       // Query to run


/*QUERY PREIMPOSTATE*/

$host = "localhost";
$port = "8443";
$charset ="latin1";
$dbname = "nektasoft_auto";
$username = "j2web";
$password = "Qwe123Rty!";
$id_query = PostValue("v");

switch ($id_query) {
    case "101": //Inserimento autoveicolo
        $query = 'INSERT INTO autoveicoli(idutente, Marca, Modello, Versione, Descrizione, MeseImmatricolazione, AnnoImmatricolazione, idCarburante, idTipologia, idCarrozzeria, PostiASedere, PotenzaKW, PotenzaCV, idColoreEsterno, Metallizzato, PrecedentiProprietari, Chilometraggio, Prezzo, PrezzoConcessionari, condividiveicolo, Trattabile, Contratto, FinitureInterni, ColoreInterni, ABS, Airbag, Antifurto, ChiusuraCentralizzata, ControlloAutomTrazione, ESP, Immobilizer, FreniADisco, AlzacristalliElettrici, Clima, NavigatoreSatellitare, RadioCD, ParkDistControl, SediliRiscaldati, Servosterzo, VolanteMultifunzione, Handicap, CerchiInLega, GancioTraino, Portapacchi, SediliSportivi, Motore, Cambio, NumRapporti, Cilindrata, ClasseEmissione, ConsumoMedio, Immagine1, Immagine2, Immagine3, Immagine4, Immagine5, Immagine6, Immagine7, Immagine8, Immagine9, Immagine10, UrlYT, RagioneSociale, Indirizzo, TelefonoGenerico, NomeReferente, TelefonoReferente, EmailReferente, IdScheda) VALUES (' . PostValue("idutente") . ',\'' . PostValue("Marca") . '\',\'' . PostValue("Modello") . '\',\'' . PostValue("Versione") . '\',\'' . PostValue("Descrizione") . '\',' . PostValue("MeseImmatricolazione") . ',' . PostValue("AnnoImmatricolazione") . ',' . PostValue("idCarburante") . ',' . PostValue("idTipologia") . ',' . PostValue("idCarrozzeria") . ',' . PostValue("PostiASedere") . ',' . PostValue("PotenzaKW") . ',' . PostValue("PotenzaCV") . ',' . PostValue("idColoreEsterno") . ',' . PostValue("Metallizzato") . ',' . PostValue("PrecedentiProprietari") . ',' . PostValue("Chilometraggio") . ',' . PostValue("Prezzo") . ',' . PostValue("PrezzoConcessionari") . ',' . PostValue("condividiveicolo") . ',' . PostValue("Trattabile") . ',\'' . PostValue("Contratto") . '\',\'' . PostValue("FinitureInterni") . '\',\'' . PostValue("ColoreInterni") . '\',' . PostValue("ABS") . ',' . PostValue("Airbag") . ',' . PostValue("Antifurto") . ',' . PostValue("ChiusuraCentralizzata") . ',' . PostValue("ControlloAutomTrazione") . ',' . PostValue("ESP") . ',' . PostValue("Immobilizer") . ',' . PostValue("FreniADisco") . ',' . PostValue("AlzacristalliElettrici") . ',' . PostValue("Clima") . ',' . PostValue("NavigatoreSatellitare") . ',' . PostValue("RadioCD") . ',' . PostValue("ParkDistControl") . ',' . PostValue("SediliRiscaldati") . ',' . PostValue("Servosterzo") . ',' . PostValue("VolanteMultifunzione") . ',' . PostValue("Handicap") . ',' . PostValue("CerchiInLega") . ',' . PostValue("GancioTraino") . ',' . PostValue("Portapacchi") . ',' . PostValue("SediliSportivi") . ',\'' . PostValue("Motore") . '\',\'' . PostValue("Cambio") . '\',' . PostValue("NumRapporti") . ',' . PostValue("Cilindrata") . ',\'' . PostValue("ClasseEmissione") . '\',\'' . PostValue("ConsumoMedio") . '\',\'' . PostValue("Immagine1") . '\',\'' . PostValue("Immagine2") . '\',\'' . PostValue("Immagine3") . '\',\'' . PostValue("Immagine4") . '\',\'' . PostValue("Immagine5") . '\',\'' . PostValue("Immagine6") . '\',\'' . PostValue("Immagine7") . '\',\'' . PostValue("Immagine8") . '\',\'' . PostValue("Immagine9") . '\',\'' . PostValue("Immagine10") . '\',\'' . PostValue("UrlYT") . '\',\'' . PostValue("RagioneSociale") . '\',\'' . PostValue("Indirizzo") . '\',\'' . PostValue("TelefonoGenerico") . '\',\'' . PostValue("NomeReferente") . '\',\'' . PostValue("TelefonoReferente") . '\',\'' . PostValue("EmailReferente") . '\',\'' . PostValue("IdScheda") . '\')';
        break;
	case "203": //Verifica inserimento/eliminazione
        $query = 'SELECT * FROM autoveicoli WHERE (IdScheda =\'' . PostValue("codiceScheda") . '\')';
        break;
	case "305": //Elimina autoveicolo
        $query = 'DELETE FROM autoveicoli WHERE (IdScheda = \'' . PostValue("codiceScheda") . '\')';
        break;
	case "407": //Match cliente-->veicolo
        $query = 'SELECT * FROM autoveicoli WHERE (Marca = ' . '\'' . PostValue("marcaVeicoloCliente") . '\'' . ' AND Modello = ' . '\'' . PostValue("modelloVeicoloCliente") . '\'' . ' OR Versione = ' . '\'' . PostValue("versioneVeicoloCliente") . '\'' . ')'		   ;
        break;
	default:
       //
}

/*QUERY PREIMPOSTATE*/

if (defined("hashkey") && trim(hashkey <> ""))
    $hashkey    = hashkey;
else
    $hashkey    = "";
    
if (defined("aes") && trim(aes <> ""))
    $aes    = aes;
else
    $aes    = "128";
    
$test = PostValue("test"); // pass test=1 to check if everything is OK


WriteLog ( "---------------------------------------------------------------------" );

if (($encrypted) && (trim($hashkey) <> "") && ($aes == "256"))
{
    WriteLog ( "Request is encrypted AES256. Decrypting..." );
    $host       = aes256Decrypt($hashkey, base64_decode($host));
    $compress   = aes256Decrypt($hashkey, base64_decode($compress));
    $port       = aes256Decrypt($hashkey, base64_decode($port));
    $charset    = aes256Decrypt($hashkey, base64_decode($charset));
    $dbname     = aes256Decrypt($hashkey, base64_decode($dbname));
    $username   = aes256Decrypt($hashkey, base64_decode($username));
    $password   = aes256Decrypt($hashkey, base64_decode($password));
    $query      = aes256Decrypt($hashkey, base64_decode($query));
}
else
if (($encrypted) && (trim($hashkey) <> ""))
{
    WriteLog ( "Request is encrypted AES. Decrypting..." );
    $host       = aes128Decrypt($hashkey, base64_decode($host));
    $compress   = aes128Decrypt($hashkey, base64_decode($compress));
    $port       = aes128Decrypt($hashkey, base64_decode($port));
    $charset    = aes128Decrypt($hashkey, base64_decode($charset));
    $dbname     = aes128Decrypt($hashkey, base64_decode($dbname));
    $username   = aes128Decrypt($hashkey, base64_decode($username));
    $password   = aes128Decrypt($hashkey, base64_decode($password));
    $query      = aes128Decrypt($hashkey, base64_decode($query));
}

//Convert Query to defined charset
if ($charset <> "")
{
    $query = mb_convert_encoding($query, $charset, "UTF-8");
}

WriteLog ( "Host             = $host" );
WriteLog ( "Port             = $port" );
WriteLog ( "Charset          = $charset" );
WriteLog ( "DBName           = $dbname" );
WriteLog ( "Username         = $username" );
WriteLog ( "Password provided= $password" ); // " . ($password != '' ? 'YES' : 'NO' ));

if ($jquery = GetJson($query))
{
    WriteLog ( "Query is JSON     = $query");
    $query      = ParseJSONQuery($jquery);
}
else
{
    WriteLog ( "Query is not JSON");
}

if ( strlen ( $query ) == 0 ) 
{
    WriteLog ( "Called from browser." );
    ShowAccessError ();
    WriteLog ( "Query is blank" );       
    return;
}
else
    WriteLog ( "Query            = $query");

/* define class to handle the result */
class typResult {
    public $Query;
    public $ErrorNumber;
    public $ErrorDescr;
    public $ServerInfo;
    public $AffecteRows;
    public $InsertID;
    public $FieldCount;
    private $FieldsDescription;
    private $Rows;
    
    // Constructor, setting up name, file and parameters
    function __construct() {
        $this->Query = "";
        $this->AffecteRows = 0;
        $this->FieldCount  = 0;
        $this->InsertID    = "";
        $this->ErrorNumber = 0;
        $this->ErrorDescr  = "";        
    }
    
    // Print JSON Result
    public function PrintResult($compress = 0) {
        global $encrypted, $aes, $hashkey;
        
        $res = array();        
        $res["tunnelversion"]   = tunnelversion;
        $res["query"]           = $this->Query;
        $res["errornumber"]     = $this->ErrorNumber;
        $res["errordescr"]      = $this->ErrorDescr;
        $res["serverversion"]   = $this->ServerInfo;
        $res["affectedrows"]    = $this->AffecteRows;
        $res["lastinsert_id"]   = $this->InsertID;
        $res["fieldcount"]      = $this->FieldCount;
        $res["fieldsdescr"]     = $this->FieldsDescription;
        $res["rows"]            = $this->Rows;
        utf8_encode_array($res);
        $res = json_encode($res, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        if (($encrypted) && (trim($hashkey) <> "")) 
        {
            if ($aes == "256")
                $res = aes256Encrypt($hashkey, $res);
            else
                $res = aes128Encrypt($hashkey, $res);
            WriteLog("Encrypting Result. Size in bytes: " . strlen($res));
        }
        if ($compress)  
        {
            $res = base64_encode(gzcompress($res));
            WriteLog("Compressing Result. Size in bytes: " . strlen($res));
        }
        
        echo $res;
    }    
    
    public function AddFieldDescription($table, $orgtable, $name, $orgname, $length, $maxlength, $minvalue, $maxvalue, $type, $notnull, $uniquekey, $autoincrement)
    {
            $this->FieldsDescription[] = array("name"=> $name,
                                               "orgname"=> $orgname,
                                               "table"=>$table,
                                               "orgtable"=>$orgtable,
                                               "maxlength"=>$maxlength,
                                               "length"=>$length,
                                               "type"=>$type,
                                               "minvalue"=>$minvalue,
                                               "maxvalue"=>$maxvalue,
                                               "notnull"=>$notnull,
                                               "uniquekey"=>$uniquekey,
                                               "autoincrement"=>$autoincrement                                               
                                              );
            return true;
    }
    
    public function AddRow($row)
    {                
        //Check if $row array is same as $fieldsDescription
        if (count($row) <> count($this->FieldsDescription))
            return false;
        
        $currow = Array();
        foreach($row as $key=>$value)
        {
            $currow[] = array($key + 1 => $value);
        }
        $this->Rows[] = $currow;
        
        return true;
    }
}

function ParseStringForParam($sql, $iStart)
{
    $delims = "\n" . ",;)(' ";
    $chars = str_split($delims);
    $paramName = false;
    $indexStart = mb_strpos($sql, ":", $iStart);
    
    $indexEnd = -1;
    if (!($indexStart === false))   
    {
        foreach($chars as $char){
            $iIndexDelim = mb_strpos($sql, $char, $indexStart);
            if ((!($iIndexDelim === false)) && (($indexEnd == -1) || ($indexEnd > $iIndexDelim)))
                $indexEnd = $iIndexDelim;
        }    
        if (($indexEnd === false) || ($indexEnd == -1))
            $indexEnd = strlen($sql);
        $paramName["param"] = mb_convert_case(trim(mb_substr($sql, $indexStart + 1, $indexEnd - $indexStart - 1)), MB_CASE_LOWER, "UTF-8");
        $paramName["iStart"] = $indexStart;
        $paramName["iLength"]   = $indexEnd - $indexStart - 1;
    }
    return $paramName;
}

function is_base64_encoded()
{
    if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $data)) {
        return TRUE;
    } else {
        return FALSE;
    }
};

function array_change_key_case_unicode($arr, $c = CASE_LOWER) {
    $c = ($c == CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER;
    $ret = array();
    foreach ($arr as $k => $v) {
        $ret[mb_convert_case($k, $c, "UTF-8")] = $v;
    }
    return $ret;
}

function GetJson($string) {
 if ($string == "") return $string;
 $res = json_decode($string);
 
 if (json_last_error() == JSON_ERROR_NONE)
 {  
    $res->params = array_change_key_case_unicode($res->params);
    return $res;
 }
 else
 {
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            WriteLog( 'JSON Decode - No errors');
        break;
        case JSON_ERROR_DEPTH:
            WriteLog( 'JSON Decode - Maximum stack depth exceeded');
        break;
        case JSON_ERROR_STATE_MISMATCH:
            WriteLog( 'JSON Decode - Underflow or the modes mismatch');
        break;
        case JSON_ERROR_CTRL_CHAR:
            WriteLog( 'JSON Decode - Unexpected control character found');
        break;
        case JSON_ERROR_SYNTAX:
            WriteLog( 'JSON Decode - Syntax error, malformed JSON');
        break;
        case JSON_ERROR_UTF8:
            WriteLog( 'JSON Decode - Malformed UTF-8 characters, possibly incorrectly encoded');
        break;
        default:
            WriteLog( 'JSON Decode - Unknown error' );
        break;
    }
    return false;
 }
}
  
function ParseJSONQuery($jquery)
{    
    global $charset;
    
    $sql = $jquery->SQL;
    $params = $jquery->params;

    $iStart = 0;
    while ($param = ParseStringForParam($sql, $iStart))
    {
        WriteLog("Parsing parameter " . $param["param"]);
        if (array_key_exists($param["param"], $params))
        {
            $value = $params[$param["param"]]->value;            
            if ( isset($params[$param["param"]]->encoding) && strtoupper($value) != "NULL" && $params[$param["param"]]->encoding == "base64") 
            {
                WriteLog("Value is base64_encoded");
                $value = base64_decode($value);
                if ($charset <> "")
                {
                    $value = mb_convert_encoding($value, $charset, "UTF-8");
                }

            }
            WriteLog("To value          $value");
            
            if ( isset($params[$param["param"]]->addsinglequotes) && strtoupper($value) != "NULL" && $params[$param["param"]]->addsinglequotes == "true") 
            {
                WriteLog("Adds single quotes");
                $value = "'" . addslashes($value) . "'";
            }
            
            $sql = substr($sql, 0, $param["iStart"]) . $value . substr($sql, $param["iStart"] + $param["iLength"] + 1, strlen($sql) + strlen($value));
            $iStart = $param["iStart"] + strlen($value);
        }
        else
            $iStart = $param["iStart"] + $param["iLength"];
    }
    
    return $sql;
}

function utf8_encode_array (&$array) {
    if(is_array($array)) {
      array_walk($array, 'utf8_encode_array');
    } else {
      global $charset;
      if ($charset <> '')
         $array = mb_convert_encoding($array, "UTF-8", $charset);      
      else
         $array = utf8_encode($array);
    }
}

function base64_encode_array (&$array) {
    if(is_array($array)) {
      array_walk ($array, 'base64_encode_array');
    } else {
      $array = base64_encode($array);      
    }
}

function aes128Encrypt($key, $data) {
  if(16 !== strlen($key)) $key = hash('MD5', $key, true);
  $padding = 16 - (strlen($data) % 16);
  $paddingchar = chr($padding);
  $data .= str_repeat($paddingchar, $padding);
  return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_ECB, str_repeat("\0", 16)));
}
 
function aes256Encrypt($key, $data) {
  if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
  $padding = 16 - (strlen($data) % 16);
  $paddingchar = chr($padding);
  $data .= str_repeat($paddingchar, $padding);
  return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, str_repeat("\0", 16)));
}
 
function aes128Decrypt($key, $data) {
  if(16 !== strlen($key)) $key = hash('MD5', $key, true);
  $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_ECB, str_repeat("\0", 16));
  $padding = ord($data[strlen($data) - 1]); 
  return substr($data, 0, -$padding); 
}
 
function aes256Decrypt($key, $data) {
  if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
  $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, str_repeat("\0", 16));
  $padding = strpos($data, "\x0", 0);
  $padding = ord($data[strlen($data) - 1]); 
  return substr($data, 0, -$padding); 
}

/* PostValue function to get request from $_POST or $_GET */
function Refine($str)
{
    if(get_magic_quotes_gpc())
        return stripslashes($str);
    return $str;
}

function PostValue($name)
{
    if(array_key_exists($name,$_POST))
        $value=$_POST[$name];
    else if(array_key_exists($name,$_GET))
        $value=$_GET[$name];
    else
        return "";
    if(!is_array($value))
        return Refine($value);
    $ret=array();
    foreach($value as $key=>$val)
        $ret[$key]=Refine($val);
    return $ret;
}

/* Custom Error Handler */
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    switch ($errno) {
    case E_ERROR:
        $errfile=preg_replace('|^.*[\\\\/]|','',$errfile);
        echo $ERRSTR."Error in line $errline of file $errfile: [$errno] $errstr\n";
        exit;
    }
}    

/* Log debug functions */
function RotateLog() {
    global $MAXLOGSIZE, $LOGFILE, $LOGFILEHANDLE;
    if ( defined("DEBUG") ) {
        fwrite ($LOGFILEHANDLE, date("d.m.Y H:i:s")." - Logfile reached maximum size ($MAXLOGSIZE)- rotating.\r\n");
        fclose ($LOGFILEHANDLE);
        rename ($LOGFILE,"$LOGFILE.old");
        $LOGFILEHANDLE=fopen ($LOGFILE, "a");
        if (!$LOGFILEHANDLE)
            $LOG=0;
        else 
            fwrite ($LOGFILEHANDLE, date("d.m.Y H:i:s")." - Opening new Logfile.\r\n");
    }
}

function WriteLog ( $loginfo )
{
    global $MAXLOGSIZE, $LOGFILE, $LOGFILEHANDLE;    
    if ( defined("DEBUG") ) 
    {
        $LOGFILEHANDLE = fopen ( $LOGFILE, "a" );

        if ( $LOGFILEHANDLE == FALSE )
            return;
            
        fwrite ($LOGFILEHANDLE, date("d.m.Y H:i:s")." - $loginfo\r\n");
        $lstat=fstat($LOGFILEHANDLE);
        if ($lstat["size"]>$MAXLOGSIZE) RotateLog();
        fclose($LOGFILEHANDLE);
    }
}

/* function checks PHP version */
function CheckPHPVersion()
{

    $phpversionstr  = phpversion();
    $versionarry    = explode(".", $phpversionstr, 2);

    /* We dont support v4.3.0 */
    if ( (integer)$versionarry[0] < 4 || 
         ((integer)$versionarry[0] == 4 && (integer)$versionarry[1] < 3 ))
    {
        return FALSE;        
    } 
    else
    {
        return TRUE;
    }

    return TRUE;
}

function GetMinMaxValue($type, $flags, &$minValue, &$maxValue)
{
    switch($type)
    {
        case "tinyint":
            if ($flags == "unsigned")
            {
                $minValue = 0;
                $maxValue = 255;
            }
            else
            {
                $minValue = -128;
                $maxValue = 127;
            }
            break;
        case "smallint":
            if ($flags == "unsigned")
            {
                $minValue = –32768;
                $maxValue = 32767;
            }
            else
            {
                $minValue = 0;
                $maxValue = 65535;
            }
            break;
        case "mediumint":
            if ($flags == "unsigned")
            {
                $minValue = –8388608;
                $maxValue = 8388607;
            }
            else
            {
                $minValue = 0;
                $maxValue = 16777215;
            }
            break;
        case "int":
            if ($flags == "unsigned")
            {
                $minValue = –2147483648;
                $maxValue = 2147483647;
            }
            else
            {
                $minValue = 0;
                $maxValue = 4294967295;
            }
            break;
        case "bigint":
            if ($flags == "unsigned")
            {
                $minValue = –9223372036854775808;
                $maxValue = 9223372036854775807;
            }
            else
            {
                $minValue = 0;
                $maxValue = 18446744073709551615;
            }
            break;
    }
}

function GetCorrectDataTypeMySQLI( $type ) 
{
    switch($type)
    {           
        case MYSQLI_TYPE_TINY:          
            $data = "tinyint";
            break;
        case MYSQLI_TYPE_SHORT:
            $data = "int";
            break;
        case MYSQLI_TYPE_LONG:         
            $data = "int";
            break;
        case MYSQLI_TYPE_FLOAT:          
            $data = "float";
            break;
        case MYSQLI_TYPE_DOUBLE:          
            $data = "double";
            break;
        case MYSQLI_TYPE_NULL:          
            $data = "default null";
            break;
        case MYSQLI_TYPE_TIMESTAMP:          
            $data = "timestamp" ;
            break;
        case MYSQLI_TYPE_BIT:          
            $data = "bit" ;
            break;
        case MYSQLI_TYPE_LONGLONG:          
            $data = "bigint";
            break;
        case MYSQLI_TYPE_INT24:          
            $data = "mediumint";
            break;
        case MYSQLI_TYPE_DATE:          
            $data = "date";
            break;
        case MYSQLI_TYPE_TIME:          
            $data = "time";
            break;
        case MYSQLI_TYPE_DATETIME:          
            $data = "datetime";
            break;
        case MYSQLI_TYPE_YEAR:          
            $data = "year";
            break;
        case MYSQLI_TYPE_NEWDATE:          
            $data = "date";
            break;
        case MYSQLI_TYPE_ENUM:          
            $data = "enum";
            break;
        case MYSQLI_TYPE_SET:          
            $data = "set";
            break;
        case MYSQLI_TYPE_TINY_BLOB:          
            $data = "tinyblob";
            break;
        case MYSQLI_TYPE_MEDIUM_BLOB:          
            $data = "mediumblob";
            break;
        case MYSQLI_TYPE_LONG_BLOB:          
            $data = "longblob";
            break;
        case MYSQLI_TYPE_BLOB:                      
            $data = "blob";           
            break;
        case MYSQLI_TYPE_VAR_STRING:          
            $data = "varchar";
            break;
        case MYSQLI_TYPE_STRING:          
            $data = "char";
            break;
        case MYSQLI_TYPE_GEOMETRY:          
            $data = "geometry";
            break;
        }    
    return ($data);
}
/* function finds and returns the correct type understood by MySQL C API() */

function GetCorrectDataType ( $result, $j )
{
    $data   = NULL;

    switch( tunnel_mysql_field_type ( $result, $j ) )
    {
        case "int":
            if ( tunnel_mysql_field_len ( $result, $j ) == 1 )
            {
                $data = "boolean";
            }
            elseif ( tunnel_mysql_field_len ( $result, $j ) <= 4 )
            {
                $data = "smallint";
            }
            elseif ( tunnel_mysql_field_len ( $result, $j ) <= 9 )
            {
                $data = "mediumint";
            }
            else
            {
                $data = "int";
            }
            break;
    
        case "real":
            if (tunnel_mysql_field_len($result,$j) <= 10 )
            {
                $data = "float";                                             
            }
            else
            {
                $data = "double";
            }
            break;

        case "string":
            $data = "varchar";
            break;

        case "blob":
            $textblob = "TEXT";
            if ( strpos ( tunnel_mysql_field_flags ($result,$j),"binary") )
            {
                $textblob = "BLOB";
            }
            if (tunnel_mysql_field_len($result,$j) <= 255)
            {
                if ( $textblob == "TEXT" )
                {
                    $data = "tinytext";
                }
                else
                {
                    $data = "tinyblob";
                }
            }
            elseif (tunnel_mysql_field_len($result, $j) <= 65535 )
            {
                if ( $textblob == "TEXT" ) {
                    $data = "mediumtext";
                }
                else
                {
                    $data = "mediumblob";
                }
            }
            else
            {
                if ( $textblob == "TEXT" ) {
                    $data = "longtext";
                }
                else
                {
                    $data = "longblob"; 
                }
            }
            break;

        case "date":
            $data = "date";
            break;

        case "time":
            $data = "time";
            break;

        case "datetime":
            $data = "datetime";
            break;
    }

    return ($data);
}

/*Wrapper Functions for PHP-MYSQL and PHP-MYSQLI*/

function tunnel_mysql_connect ($host, $port, $username, $password, $dbname="", $charset="") 
{
    $username = utf8_decode($username);    
    
    $ret=0;
    switch (DB_EXTENSION) 
    {        
        case "mysql":
            $ret = mysql_connect ($host . ($port != "" ? ":$port" : ""), $username, $password);            
            if (strlen ($dbname)!=0){
                mysql_select_db("$dbname");
            }

            if (strlen ($charset)!=0){
                $query = 'SET NAMES ' . $charset;
                mysql_query($query);
            }            
            
            /* sets the MySQL server to non-strict */
            $query = "set sql_mode=''";
            mysql_query($query);
            
            break;    
        case "mysqli":           
            $GLOBALS["___mysqli_ston"] = mysqli_connect($host, $username,  $password, $dbname, ($port != "" ? $port : null));
            $ret=$GLOBALS["___mysqli_ston"];
            if (strlen ($charset)!=0){
                $query = 'SET NAMES ' . $charset;
                mysqli_query($ret, $query); 
            }            
            /* sets the MySQL server to non-strict */
            $query = "set sql_mode=''";
            mysqli_query($ret, $query);
            break;    
    }
    
    return $ret;
}

function tunnel_mysql_close ( $db_link )
{
    //Close MySQL connection
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":
            $ret = mysql_close ( $db_link );
            break;    
        case "mysqli":
            $ret = mysqli_close ( $db_link );
            break;    
    }
    return $ret;
}

function tunnel_mysql_connect_errno()
{
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysqli":
            $ret=mysqli_connect_errno ();
            break;
        case "mysql":
            $ret=mysql_errno ();
            break;
    }
    return $ret;
}

function tunnel_mysql_connect_error() 
{
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysqli":
            $ret=mysqli_connect_error ();
            break;
        case "mysql":
            $ret=mysql_error ();
            break;
    }
    return $ret;
}

function tunnel_mysql_errno($db_link)
{
    //Returns the numerical value of the error message from previous MySQL operation
    
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":      
            $ret = mysql_errno($db_link);
            break;    
        case "mysqli":        
            $ret = mysqli_errno($db_link);
            break;    
    }
    return $ret;
}

function tunnel_mysql_error($db_link)
{
    //Returns the text of the error message from previous MySQL operation
    
    $ret=0;
    switch (DB_EXTENSION)
    {
        case "mysql":      
            $ret = mysql_error($db_link);        
            break;    
        case "mysqli":        
            $ret = mysqli_error($db_link);        
            break;    
    }
    return $ret;
}

function tunnel_mysql_num_rows($result) 
{
    //Get number of rows in result
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":      
            $ret = mysql_num_rows($result);        
            break;    
        case "mysqli":        
            $ret = mysqli_num_rows($result);        
            break;    
    }
    return $ret;
}


function tunnel_mysql_num_fields($result)
{
    //Get number of fields in result
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":      
            $ret = mysql_num_fields($result);        
            break;    
        case "mysqli":       
            $ret = mysqli_num_fields($result);
            break;      
    }
    return $ret;
}

function tunnel_mysql_fetch_field($result)
{
    //Get column information from a result and return as an object
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":       
            $ret = mysql_fetch_field($result);
            break;    
        case "mysqli":
            $ret = mysqli_fetch_field($result);
            break;    
    }
    return $ret;
}

function tunnel_mysql_field_type($result, $offset) 
{
    //Get the type of the specified field in a result
    
    $ret=0;
    switch (DB_EXTENSION) 
    {   
        case "mysql":
            $ret = mysql_field_type($result, $offset);
            break;    
        case "mysqli":
            $tmp=mysqli_fetch_field_direct($result, $offset);
            $ret = GetCorrectDataTypeMySQLI($tmp->type);
            break;     
    }
    return $ret;
}

function tunnel_mysql_field_len($result, $offset) 
{
    //Returns the length of the specified field
    
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":
            $ret = mysql_field_len($result, $offset);        
            break;    
        case "mysqli":
            $tmp=mysqli_fetch_field_direct($result, $offset);
            $ret = $tmp->length;
            break;    
    }
    return $ret;
}

function tunnel_mysql_fetch_array($result)
{
    //Fetch a result row as an associative array, a numeric array, or both
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":
            $ret=mysql_fetch_array($result);
            break;    
        case "mysqli":
            $ret=mysqli_fetch_array($result);        
            break;    
    }
    return $ret;
}

function tunnel_mysql_fetch_lengths($result)
{
    //Get the length of each output in a result
    $ret=array();
    switch (DB_EXTENSION) 
    {
        case "mysql":
            $ret = mysql_fetch_lengths($result);        
            break;    
        case "mysqli":
            $ret = mysqli_fetch_lengths($result);
            break;    
    }
    return $ret;
}

function tunnel_mysql_free_result($result)
{
    //Free result memory
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":
            $ret = mysql_free_result($result);
            break;    
        case "mysqli":
            $ret = mysqli_free_result($result);
            break;    
    }
    return $ret;
}

function tunnel_mysql_query($sql, $db_link)
{ 
    $ret=array();
    $queries = preg_split("/;+(?=([^'|^\\\']*['|\\\'][^'|^\\\']*['|\\\'])*[^'|^\\\']*[^'|^\\\']$)/", $sql); 
    foreach ($queries as $query){ 
        if (strlen(trim($query)) > 0) 
        {
            //Send a MySQL query    
            switch (DB_EXTENSION) 
            {
                case "mysql":      
                    $result = mysql_query($query, $db_link);
                    /**********************/

                    if (tunnel_mysql_errno($db_link)!=0) {          
                        $temp_ar= array("result"=>-1, "affectedrows"=>tunnel_mysql_affected_rows($db_link));
                        array_push($ret, $temp_ar);                
                    }              
                    elseif ($result===FALSE) {
                        
                        $temp_ar= array("result"=>1, "affectedrows"=>tunnel_mysql_affected_rows($db_link));
                        array_push($ret, $temp_ar);                                
                    }
                    else {
                        $temp_ar= array("result"=>$result, "affectedrows"=>tunnel_mysql_affected_rows($db_link));
                        array_push($ret, $temp_ar);
                    }

                    /**********************/            
                    break;            
                case "mysqli":        
                    $ret[] = get_array_from_query($query, $db_link);                        
                    break;    
            }
        }
    }
    return $ret;
}

function get_array_from_query($query, $db_link) 
{
    $ret=array();
    $bool = mysqli_real_query($db_link, $query) or tunnel_mysql_error($db_link);
    
    if (tunnel_mysql_errno($db_link)!=0) {        

        $temp_ar= array("result"=>-1, "affectedrows"=>0);        
        array_push($ret, $temp_ar);
        
    }
    
    elseif ($bool) {
        do {    
            /* store first result set */
            $result = mysqli_store_result($db_link);
            $num_ar= mysqli_affected_rows($db_link);

            if ($result===FALSE && tunnel_mysql_errno($db_link)!=0) {                          
                $temp_ar= array("result"=>-1, "affectedrows"=>$num_ar);
                array_push($ret, $temp_ar);                
                break;
            }              
            elseif ($result===FALSE) {                
                $temp_ar= array("result"=>1, "affectedrows"=>$num_ar);
                array_push($ret, $temp_ar);                                
            }
            else {
                $temp_ar= array("result"=>$result, "affectedrows"=>$num_ar);
                array_push($ret, $temp_ar);
            }    
        } while (mysqli_next_result($db_link));            

        if (tunnel_mysql_errno($db_link)!=0) {                      
            $temp_ar= array("result"=>-1, "affectedrows"=>$num_ar);
            array_push($ret, $temp_ar);        
        }    
    }
    return $ret;
}

function tunnel_mysql_field_flags ($result, $offset)
{
    //Get the flags associated with the specified field in a result
    
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":
            $ret = mysql_field_flags ($result,$offset);        
            break;    
        case "mysqli":        
            $___mysqli_obj = (mysqli_fetch_field_direct($result, $offset));
            $___mysqli_tmp = $___mysqli_obj->flags;
            $ret=($___mysqli_tmp? (string)(substr((($___mysqli_tmp & MYSQLI_NOT_NULL_FLAG)       ? "not_null "       : "") . (($___mysqli_tmp & MYSQLI_PRI_KEY_FLAG)        ? "primary_key "    : "") . (($___mysqli_tmp & MYSQLI_UNIQUE_KEY_FLAG)     ? "unique_key "     : "") . (($___mysqli_tmp & MYSQLI_MULTIPLE_KEY_FLAG)   ? "unique_key "     : "") . (($___mysqli_tmp & MYSQLI_BLOB_FLAG)           ? "blob "           : "") . (($___mysqli_tmp & MYSQLI_UNSIGNED_FLAG)       ? "unsigned "       : "") . (($___mysqli_tmp & MYSQLI_ZEROFILL_FLAG)       ? "zerofill "       : "") . (($___mysqli_tmp & 128)                        ? "binary "         : "") . (($___mysqli_tmp & 256)                        ? "enum "           : "") . (($___mysqli_tmp & MYSQLI_AUTO_INCREMENT_FLAG) ? "auto_increment " : "") . (($___mysqli_tmp & MYSQLI_TIMESTAMP_FLAG)      ? "timestamp "      : "") . (($___mysqli_tmp & MYSQLI_SET_FLAG)            ? "set "            : ""), 0, -1)) : false);                
            break;     
    }
    return $ret;
}

function tunnel_mysql_get_server_info($db_link)
{
    //Get MySQL server info
    
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":
            $ret = mysql_get_server_info($db_link);
            break;    
        case "mysqli":
            $ret = mysqli_get_server_info($db_link);        
            break;    
    }
    return $ret;
}


function tunnel_mysql_affected_rows($db_link)
{
    //Get number of affected rows in previous MySQL operation
    
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":      
            $ret = mysql_affected_rows($db_link);        
            break;    
        case "mysqli":        
            $ret = mysqli_affected_rows($db_link);        
            break;    
    }
    return $ret;
}

function tunnel_reset_mysql_insert_id($db_link)
{
    //Reset LAST_INSERT_ID to prevent getting same results
    
    $ret=0;
    $query = 'SELECT LAST_INSERT_ID( -1 );'; 
    $result= tunnel_mysql_query($query, $mysql);
    if ($result)
        $ret = 1;
    
    return $ret;
}

function tunnel_mysql_insert_id($db_link)
{
    //Get the ID generated from the previous INSERT operation
    
    $ret=0;
    switch (DB_EXTENSION) 
    {
        case "mysql":      
            $ret = mysql_insert_id($db_link);
            break;    
        case "mysqli":       
            $ret = mysqli_insert_id($db_link);
            break;    
    }
    return $ret;
}



/* function checks if a required module is installed or not */
function ShowAccessError($extra = "")
{   
    $ret = "";
    if (defined("WEBBROWSERACCESSERROR") && WEBBROWSERACCESSERROR == 1)
    {
        $errmsg  = '<div align="justify"><p><b>MySQL Tunnel version: ' . tunnelversion . '</b>.<p>This PHP page exposes the MySQL API as a set of webservices.<br>';

        $ret .= '<html><head><title>MySQL HTTP Tunneling</title></head>'.           
               '<body leftmargin="0" topmargin="0"><br />'.
               '<p align="center"><img src="' . pagelogo . '" alt="MySQL Tunnel"><p>' ;
             
        $ret .= '<table align="center" width="60%" cellpadding="3" border="0">'.
               '<tr><td><font face="Verdana" size="2">' . $errmsg . 
               '</td</tr></table>';

        /* we show PHP version error also if required */
        if ( CheckPHPVersion() == FALSE ) {
            $ret .= '<table width="100%" cellpadding="3" border="0"><tr><td><font face="Verdana" size="2"><p><b>Error: </b>MySQL HTTP Tunnel feature requires PHP version > 4.3.0</td></tr></table>';
        }

        if ($extra != "" ) {
            $ret .= '<table width="100%" cellpadding="3" border="0"><tr><td><font face="Verdana" size="2"><p><b>Error!' . $extra . '</td></tr></table>';
        }

        $ret .= '</body></html>' ;
    }

    echo $ret;
}

/* Function handling mysql_pconnect() error */
function HandleError($errno, $error)
{
    global $compress;
    
    $res = new typResult();
    $res->ErrorNumber = $errno;
    $res->ErrorDescr = $error;
        
    $res->PrintResult($compress);
}

/* function checks if a required module is installed or not */
function AreModulesInstalled ()
{
    global $encrypted;
    
    $modules        = get_loaded_extensions();
    $modulenotfound = '';

    $thisExtension="";
    if ( DB_EXTENSION=="-1") 
    {
        $modulenotfound = 'php_mysqli or php_mysql';  
        $thisExtension="one of these extensions";
    } 
    elseif (($encrypted) && ( MCRYPT=="-1") )
    {
        $modulenotfound = 'mcrypt';  
        $thisExtension="this extension";
    } 
    else if(!$test)
    {
        // if correct modules are found - exit IMMEDIATELY        
        return TRUE;
    }
    
    if($test) // pass test in $_GET to check if everything is OK
    {
        echo(tunnelversion);
        return FALSE;
    }

    // It will come here only when its called from a browser
    $errmsg   = '<font color="#FF0000"><b>Error:</b> </font>Extension <b>' . $modulenotfound . '</b> was not found compiled and loaded in the PHP interpreter. Tunnel requires '.$thisExtension .' to work properly.';   
    $errmsg  .= '<p><b>MySQL Tunnel version: ' . tunnelversion . '</b>.<p>This PHP page exposes the MySQL API as a set of webservices.<br>';

    echo ( '<html><head><title>MySQL HTTP Tunneling</title></head><body leftmargin="0" topmargin="0"><br /><div align=center><img src="' . pagelogo . '" alt="MySQL Tunnel"><p>' );
    echo ( '<table align=center width="60%" cellpadding="3" border="0"><tr><td><font face="Verdana" size="2">' . $errmsg . '</td</tr></table>' );
    echo ( '</body></html>' );

}

/* Process when only a single query is called. */

function ExecuteSingleQuery($mysql, $query)
{
  
    tunnel_reset_mysql_insert_id( $mysql );
    $result     = tunnel_mysql_query($query, $mysql);   
    foreach ($result as $key => $value)
    {
        if ( DB_EXTENSION=="mysqli") 
            $value = $value[0];
        //$value['result'],$value['ar'];

        if ( $value['result']=== -1 ) {
            WriteLog ("MySQL Error " . tunnel_mysql_errno($mysql) . ", '" . tunnel_mysql_error($mysql) . "'" );
            HandleError ( tunnel_mysql_errno($mysql), tunnel_mysql_error($mysql) );
        }
        else
        {    
            WriteLog ("SQL run successful");
    
            /* Create the result */
            if ($key >= count($result) - 1)
                CreateResult ($mysql, $query, $value);

            if ($value['result']!==1) {
                tunnel_mysql_free_result ( $value['result'] );
            }        
        }
    }       
}

function CreateResult($mysql, $query, $value)
{    
    global $compress;
    /* query execute was successful so we need to echo the correct JSON */
    /* the query may or may not return any result */
    
    // check if the query is not a result returning query    
    $isNotResultQuery=0;
    if ( DB_EXTENSION=="mysqli") {        
        ($value['result'] ===1)?$isNotResultQuery=1:$isNotResultQuery=0;
    }   
    else{        
        ($value['result'] ===1)?$isNotResultQuery=1:$isNotResultQuery=0;
    }    

    $res = new typResult();
    $res->Query = $query;
    $res->ServerInfo = tunnel_mysql_get_server_info ( $mysql );
    $res->AffecteRows = $value['affectedrows'];
    $res->InsertID = tunnel_mysql_insert_id ( $mysql );
   
    if (!is_int($value['result'])) {
        /* add the affected rows information */
        $res->AffecteRows = tunnel_mysql_num_rows ( $value['result'] );
        /* add the field count information */
        $res->FieldCount = tunnel_mysql_num_fields ( $value['result'] );
    }
        
    if ( $isNotResultQuery  || (!$res->AffecteRows && !$res->FieldCount ))//
    {   
        /* is a non-result query */
        $res->PrintResult($compress);        
        return;
    }
   
    /* retrieve information about each fields */
    $i = 0;
    $fblobs = array();
    while ($i < $res->FieldCount ) 
    {
        $meta = tunnel_mysql_fetch_field($value['result']);
        switch (DB_EXTENSION) 
        {
        case "mysql":
            $type =  GetCorrectDataType ( $value['result'], $i );
            break;
        case "mysqli":
            $type = tunnel_mysql_field_type( $value['result'], $i );
            break;
        }
        
        if (!(stripos($type, "blob") === false))
            $fblobs[] = $i;
        
        $flags = tunnel_mysql_field_flags($value['result'], $i);
        $notnull     = !(stripos($flags, "not_null") === false);
        $uniquekey  = !(stripos($flags, "unique_key") === false);
        $autoincrement  = !(stripos($flags, "auto_increment") === false);

        GetMinMaxValue($type, $flags, $minValue, $maxValue);
        
        $res->AddFieldDescription($meta->table, $meta->orgtable, $meta->name, $meta->orgname, $meta->max_length, $meta->length, $minValue, $maxValue, $type, $notnull, $uniquekey, $autoincrement);

        $i++;
    }


    /* get information about number of rows in the resultset */    

    /* add up each row information */
    while ( $row = tunnel_mysql_fetch_array ( $value['result'] ) )
    {
//        $lengths = tunnel_mysql_fetch_lengths ( $value['result'] );
        $rowAdd = Array();
        for ( $i=0; $i < $res->FieldCount; $i++ ) 
        {
            if ($row[$i] == null)
            {
                $rowAdd[] = nullvalue;
            }
            else
            {
                if (array_search($i, $fblobs) === false)
                {
                    $rowAdd[] = $row[$i];
                }
                else
                {
                    $rowAdd[] = base64_encode($row[$i]);
                }
            }
        }
        
        if (!$res->AddRow($rowAdd))
        {
                HandleError ( customerrorno, "Difference in fields number when parsing resultset" );
                WriteLog("Error adding row. Difference in fields number");
                return;
        }
    }
    
    $res->PrintResult($compress);
}


/* Process the  query*/
function ProcessQuery ()
{ 
    global $test, $host, $port, $charset, $dbname, $username, $password, $query;
    
    if ( CheckPHPVersion() == FALSE ) 
    {
        /*  now the call can be of three types
            1.) Specific to check tunnel version
            2.) Normal where it is expected that the PHP page is 4.3.0
            3.) From browser
            
            We check this by checking the query string which is sent if just a check is done by tunnel */

        WriteLog ( "CheckPHPVersion is FALSE" );        
        if($test)
        {            
            echo(tunnelversion);
        }
        else
        {
            WriteLog ( "CheckPHPVersion is FALSE and Test query string not set" );
            ShowAccessError();
        }

        return;
            
    }
    
    /* in special case, we can send garbage data with test query string to check for tunnel version*/
    if($test)
    {
        WriteLog ( "test query string not set" );
        echo(tunnelversion);
        return;
    }
    
    /* connect to the mysql server */
    WriteLog ( "Trying to connect" );
    $mysql      = tunnel_mysql_connect ($host, $port, $username, $password, $dbname, $charset );
    if ( !$mysql )
    {
        HandleError ( tunnel_mysql_connect_errno(), tunnel_mysql_connect_error() );
        WriteLog ("MySQL Error = " . tunnel_mysql_connect_error() );
        return;
    }

    WriteLog ( "Connected" );    

    ExecuteSingleQuery ( $mysql, $query );

    tunnel_mysql_close ( $mysql );
    
}

if (version_compare("5.0.0",phpversion())==1) die ("Only PHP 5 or above supported");
set_error_handler("myErrorHandler");

/* we stop all error reporting as we check for all sort of errors */
WriteLog ( "" );
if ( defined("DEBUG") ) 
    error_reporting ( E_ALL );
else
    error_reporting ( 0 );
set_time_limit ( 0 );

if (!defined("MYSQLI_TYPE_BIT")) {
    define ( "MYSQLI_TYPE_BIT", 16);
}

/* Check for the PHP_MYSQL/PHP_MYSQLI extension loaded */

if (extension_loaded('mysqli')) 
{
    define ("DB_EXTENSION", "mysqli");
}

if (extension_loaded('mysql')) 
{
    define ("DB_EXTENSION", "mysql");
}
else 
{
    define ("DB_EXTENSION", "-1");
}

if (extension_loaded('mcrypt')) 
{
    define ("MCRYPT", "mcrypt");
}
else 
{
    define ("MCRYPT", "-1");
}


/* we check if all the external libraries support i.e. mysql in our case is built in or not */
/* if any of the libraries are not found then we show a warning and exit */
if ( AreModulesInstalled () == TRUE ) 
{    
    ProcessQuery();
}
?>