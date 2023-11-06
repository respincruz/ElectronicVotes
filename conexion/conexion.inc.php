<?php

include_once('../adodb/adodb.inc.php');

	$dbdriver='mysqli';
    $server='webhostingpx.itdospuntocero.net';
    $user='cyberhackec_Elecciones29Octubre';
    $password1='Diciembre2021%';
    $database='cyberhackec_Elecciones29Octubre';
	

	
   $cnnBaseDatos= ADONewConnection($dbdriver);

   $cnnBaseDatos->Connect($server, $user, $password1, $database,0);

	if(!$cnnBaseDatos)
		{
		echo " <html>
		       <head><title>Fatal error</title></head>
			   <body bgcolor=\"#000000\" text=\"#ffffff\">
			   <h1>No se ha podido realizar la conexi�n a la base de datos</h1>
			   </body>
			   </html>";
		exit;
		}
	
		

?>
