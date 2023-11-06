<?php 
 require("../clases/c_view.php");
/*
$filename = $_FILES['file']['name']; 
  

$location = "files/".$filename; 
$uploadOk = 1; 
  
if($uploadOk == 0){ 
   echo 0; 
}else{ 
   
   if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){ 
      echo $location; 
   }else{ 
      echo 0; 
   } 
} */
//print_r($_FILES["file"]);
//print_r($_FILES["file"]);
//echo count($)
//print_r($_POST);
//print_r($_FILES);
$json_archivos=json_decode($_POST["array_archivos"]);
//echo "elementos".count($json_archivos)."---";
//echo $json_archivos[0]->name_file;
//echo "Cod".$_POST["agencia_descripcion"];


$array_archivos=array();

//$filename=$_FILES["file"]["tmp_name"][$i];
//echo $_FILES["file"]["name"][$i];

switch($_POST["tipofile"]){
    case "fisico":  $filename = $_FILES['file']['name'][0]; 
                    $location = "../files/".$filename; 
                    $uploadOk = 1; 
                    if($uploadOk == 0){ 
                        echo 0; 
                    }else{ 

                    if(move_uploaded_file($_FILES['file']['tmp_name'][0], $location)){ 
                                         $bytes = fread(fopen($location, "r"),$_FILES['file']['size'][0]);
                                         $stream = base64_encode(addslashes( $bytes ));
                                         $stream = base64_encode( $bytes );
                                         $file="data:image/png;base64,".$stream;
                

                                         unlink($location);


                                  //echo $location; 
                }else{ 
                    echo 0; 
                } 
              }
       break;
    case "base64": $file=$_POST["file"];
    break;
}




$o_view=new c_view();
$json=$o_view->fnSaveEntidad($_POST["array_css"], $_POST["agencia_id"], $_POST["agencia_descripcion"], 
                           $_POST["agencia_direccion"], $_POST["agencia_telefono"], 
			   $_POST["agencia_correo"], $_POST["agencia_identificacion"], 
			   $file, $_POST["agencia_info_adicional"], 
                           $_POST["agencia_css"], $_POST["agencia_estado"]);
print_r($json);
//print_r($array_archivos);

?> 