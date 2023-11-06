<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of c_view
 *
 * @author Sistemas
 */

//require("../conexion/conexion.inc.php");
class c_admin{
	public function fnGetElecciones(){
		/*****************/
		$data=array();
		$i=0;
		try{	
			$o_model=new c_model();
			$response=$o_model->fnBDDGetElecciones();

			while(!$response->EOF){						
				$data[$i]['proc'] = utf8_encode($response->fields['eleccion_nombre']);
				$data[$i]['elec'] = $response->fields['electores'];
				$data[$i]['fechi'] = utf8_encode($response->fields['fechaOpen']).' <b>Hora:</b> '.$response->fields['horaOpen'];
				$data[$i]['fechf'] = utf8_encode($response->fields['fechaClose']).' <b>Hora:</b> '.$response->fields['horaClose'];
				$data[$i]['edit'] = '<a href="#" class="btn btn-theme btn-md" id="id_edit_elec" data-regId="'.$response->fields['eleccion_guid'].'">Editar Proceso</a>';				
				$data[$i]['padr'] = '<a href="#" class="btn btn-theme btn-md" id="id_view_padr" data-regId="'.$response->fields['eleccion_guid'].'">Ver Padrón</a>';
				$data[$i]['pap'] = '<a href="#" class="btn btn-theme btn-md" id="id_view_pap" data-regId="'.$response->fields['eleccion_guid'].'">Ver Papeleta</a>';				
				$i++;
				$response->MoveNext();
			}	
		}
		
		catch (Exception $exception) {echo "ERROR: ".$exception;}	
		//print_r($data);
		$result = ["sEcho" => 1, "iTotalRecords" => count($data), "iTotalDisplayRecords" => count($data), "aaData" => $data ];
		echo json_encode($result);		
   }
	
	
   public function fnGetCandidatosElec($el_guid){
		/*****************/
		$data=array();
		$i=0;
	   	$cont =1;
		try{	
			$o_model=new c_model();
			$response=$o_model->fnBDDGetCandidatosElec($el_guid);

			while(!$response->EOF){					
				
				$data[$i]['num'] = $cont;
				$data[$i]['nombres'] = utf8_encode($response->fields['opcion_opcion']);
				$data[$i]['cargo'] = utf8_encode($response->fields['opcion_cargo']);
				$data[$i]['orden'] = $response->fields['opcion_orden'];
				$data[$i]['logo'] = '<img height="80" width="80" src="data:image/jpeg;base64,'.utf8_encode($response->fields['opcion_foto']).'" class="img-thumbnail"/>';				
				$data[$i]['admin'] = '
				<a href="#" class="btn btn btn-light btn-sm" id="id_edit_candidato" data-regId="'.$response->fields['opcion_guid'].'"><img src="../img/editIcon.png" width="20" height="24" title="Editar Registro"></a>
			<a href="#" class="btn btn btn-light btn-sm" id="id_del_candidato" data-regId="'.$response->fields['opcion_guid'].'"><img src="../img/deleteIcon.png" width="20" height="24" title="Eliminar Registro"></a>';								
				$i++;
				$cont++;
				$response->MoveNext();
			}	
		}
		
		catch (Exception $exception) {echo "ERROR: ".$exception;}	
		//print_r($data);
		$result = ["sEcho" => 1, "iTotalRecords" => count($data), "iTotalDisplayRecords" => count($data), "aaData" => $data ];
		echo json_encode($result);		
   }
	
	
	public function fnGetAgencias($ep_guid){
		/*****************/
		$data=array();
		$i=0;
		try{	
			$o_model=new c_model();
			$response=$o_model->fnBDDGetAgencias($ep_guid);
			while(!$response->EOF){		
				
				$data[$i]['agencia_id'] = utf8_encode($response->fields['AgenciaID']);
				$data[$i]['agencia_nombre'] = utf8_encode($response->fields['NombreAgencia']);
				$data[$i]['agencia_estado'] = utf8_encode($response->fields['Estado']);
				$data[$i]['agencia_dir'] = utf8_encode($response->fields['Direccion']);
					
				$i++;
				$response->MoveNext();
			}	
		}
		
		catch (Exception $exception) {echo "ERROR: ".$exception;}	
		//print_r($data);		
		echo json_encode($data);		
   }
	
	public function fnGetEleccionId($el_guid){
		/*****************/
		$data=array();		
		try{	
			$o_model=new c_model();
			$response=$o_model->fnBDDGetEleccionId($el_guid);
			if(!$response->EOF){
				$DateTimeOpen = explode(' ',$response->fields['eleccion_fechopen']);
				$DateTimeOpen = explode(' ',$response->fields['eleccion_fechclose']);				
				$data[0]['nombre'] = utf8_encode($response->fields['eleccion_nombre']);
				$data[0]['desc'] = utf8_encode($response->fields['eleccion_descripcion']);
				$data[0]['inst'] = utf8_encode($response->fields['eleccion_nombre']);
				$data[0]['agencia'] = utf8_encode($response->fields['AgenciaID']);				
				$data[0]['fechi'] = $DateTimeOpen[0];
				$data[0]['fechf'] = $DateTimeOpen[0];
				$data[0]['horai'] = $response->fields['horaOpen'];
				$data[0]['horaf'] = $response->fields['horaClose'];												
			}	
		}		
		catch (Exception $exception) {echo "ERROR: ".$exception;}	
		//print_r($data);		
		echo json_encode($data);		
   }
	
	public function fnGetEleConfEleccion($el_guid){
		/*****************/
		$data=array();		
		$i=0;
		try{	
			$o_model=new c_model();
			$response=$o_model->fnBDDGetEleConfEleccion($el_guid);
			while(!$response->EOF){
				$data[$i]['elco_guid'] = $response->fields['elco_guid'];
				$data[$i]['conf_guid'] = $response->fields['configuration_conf_guid'];
				$data[$i]['min'] = $response->fields['elco_minimo'];
				$data[$i]['max'] = $response->fields['elco_maximo'];
				$response->MoveNext();
				$i++;
			}	
		}		
		catch (Exception $exception) {echo "ERROR: ".$exception;}	
		//print_r($data);		
		echo json_encode($data);	
   }
	
	public function fnGetCandidatos($op_guid){
		/*****************/
		$data=array();		
		try{	
			$o_model=new c_model();
			$response=$o_model->fnBDDGetCandidatos($op_guid);
			if(!$response->EOF){
				$data[0]['nombres'] = utf8_encode($response->fields['opcion_opcion']);
				$data[0]['cargo'] = utf8_encode($response->fields['opcion_cargo']);
				$data[0]['orden'] = $response->fields['opcion_orden'];
				$data[0]['logo'] = utf8_encode($response->fields['opcion_foto']);
				$data[0]['logoIMG'] = '<img height="80" width="80" src="data:image/jpeg;base64,'.utf8_encode($response->fields['opcion_foto']).'" class="img-thumbnail"/>';
			}	
		}		
		catch (Exception $exception) {echo "ERROR: ".$exception;}	
		//print_r($data);		
		echo json_encode($data);	
   }
		
	
	public function fnSetElecciones($guid, $nombre, $descripcion, $fechopen, $fechclose,
									$logo, $tipo_guid, $instruccion, $edit, $agenciaID){
		$data=array();		
		try{
			$o_model=new c_model();
			$response=$o_model->fnBDDSetElecciones($guid, utf8_decode($nombre), utf8_decode($descripcion), $fechopen, $fechclose,									$logo, $tipo_guid, utf8_decode($instruccion), date('Y-m-d H:i'), $edit, $agenciaID);			
		}		
		catch (Exception $exception) {echo "ERROR: ".$exception;}		
		$data['MSG']=$response;
		//print_r($response);	
		echo json_encode($data);		
   }
	
	public function fnSetEleConf($elco_guid, $chkAnonimo, $chkCandidato, $eleccion_guid, $elco_minimo, $elco_maximo){	
		
		$data=array();		
		try{
			$o_model=new c_model();
			
			if($this->fnDelEleConfElec($eleccion_guid)){
				if($chkAnonimo!=''){$response = $o_model->fnBDDSetEleConf($elco_guid, date('Y-m-d H:i'), $eleccion_guid, $chkAnonimo, 1, 1);}
				if($chkCandidato!=''){$response = $o_model->fnBDDSetEleConf($elco_guid, date('Y-m-d H:i'), $eleccion_guid, $chkCandidato, $elco_minimo, $elco_maximo);}
			}
			 			
		}		
		catch (Exception $exception) {echo "ERROR: ".$exception;}		
		$data['MSG']=$response;
		//print_r($response);	
		echo json_encode($data);
   }
	
	public function fnSetCandidatos($opcion_guid, $opcion, $opcion_foto, $eleccion_guid, $opcion_cargo, $opcion_orden){	
		$data=array();
		
		try{			
			if(is_array($_FILES)) {
				if(is_uploaded_file($_FILES['opcion_foto']['tmp_name'])) {
					$tmp_file_size = $_FILES['opcion_foto']['size'];
					$tmp_file_name = $_FILES['opcion_foto']['tmp_name'];			
					$path = $_FILES['opcion_foto']['name'];
					$tmp_file_ext = pathinfo($path, PATHINFO_EXTENSION);
					$targetPath = "../tmparchs/".$path;			
					if(move_uploaded_file($tmp_file_name,$targetPath)) {				
						$bytes = fread(fopen($targetPath, "r"), $tmp_file_size);				
						$stream = base64_encode($bytes);
					}			
				}				
			}
			else{
				$stream = "";
			}			
			$o_model=new c_model();
			$response=$o_model->fnBDDSetCandidatos($opcion_guid, utf8_decode($opcion), $stream, date('Y-m-d H:i'), $eleccion_guid, utf8_decode($opcion_cargo), $opcion_orden);			
		}		
		catch (Exception $exception) {echo "ERROR: ".$exception;}
		//unlink($targetPath);
		$data['MSG']=$response;
		//print_r($response);	
		echo json_encode($data);		
   }
	
	/***********************************/
	
	public function fnDelEleConfElec($el_guid){			
		$data=array();
		$o_model=new c_model();
		try{$response = $o_model->fnBDDDelEleConfElec($el_guid);}		
		catch (Exception $exception) {echo "ERROR: ".$exception;}				
		//print_r($response);	
		return $response;
   }
	
	public function fnDelCandidato($op_guid){	
		$data=array();		
		$o_model=new c_model();
		try{$response = $o_model->fnBDDDelCandidato($op_guid);}		
		catch (Exception $exception) {echo "ERROR: ".$exception;}		
		$data['MSG']=$response;
		//print_r($response);	
		echo json_encode($data);
   }
	
		
	
}

?>