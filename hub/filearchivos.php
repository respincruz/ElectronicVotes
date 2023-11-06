<?php 
 require("../clases/c_view.php");

$json_archivos=json_decode($_POST["array_archivos"]);



$array_archivos=array();

//$filename=$_FILES["file"]["tmp_name"][$i];
//echo $_FILES["file"]["name"][$i];
//echo $_FILES['file']['name'][0]; 
	$filename= preg_replace("/[^a-z0-9\_\-\.]/i", '',$_FILES['file']['name'][0]);
//$filename = $_FILES['file']['name'][0]; 
                    $location = "../files/".$filename; 
                    $uploadOk = 1; 
                    if($uploadOk == 0){ 
                        echo 0; 
                    }else{ 

                    if(move_uploaded_file($_FILES['file']['tmp_name'][0], $location)){ 
 

                        $o_view=new c_view();                                        
                       switch($_POST["tipo"]){
                           case "quorum":  $o_view->fnProcesaExcelPadron($filename);


                              break;
                           case "convocatoria": 
                                               echo json_encode(array("file"=>$filename));
                                               //$file="data:image/png;base64,".$stream;
                           break;
                       }

                    }
                    }
/*
$o_view=new c_view();
$json=$o_view->fnSaveEntidad($_POST["array_css"], $_POST["agencia_id"], $_POST["agencia_descripcion"], 
                           $_POST["agencia_direccion"], $_POST["agencia_telefono"], 
			   $_POST["agencia_correo"], $_POST["agencia_identificacion"], 
			   $file, $_POST["agencia_info_adicional"], 
                           $_POST["agencia_css"], $_POST["agencia_estado"]);
print_r($json);
//print_r($array_archivos);*/

?> 