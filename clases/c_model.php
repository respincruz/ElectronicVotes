<?php
require("../conexion/conexion.inc.php");
class c_model{
	
	/// function para obtener los datos de la empresa
	function fnBDDEmpresaGet()
	{
		global $cnnBaseDatos;
		$sql = "CALL PRC_EMPRESA_GET()";
		//$sql = "select empresa_guid, empresa_logo, empresa_css, empresa_descripcion, empresa_estado
		//		 from empresa where empresa_estado=1";
		//echo $sql;
		$rsEmpresa = $cnnBaseDatos->Execute($sql);
		return $rsEmpresa;
	}

	public function fnBDDPerfil(){
		global $cnnBaseDatos;
		
		//echo $sql;
		$sql = "CALL PRC_USUARIO_PERFIL()";
		//$sql="select perfil_guid, perfil_perfil, perfil_nombrecorto from perfil where perfil_enable=1";
		$rsPerfil=$cnnBaseDatos->Execute($sql);
		//echo $rsPerfil;
		return $rsPerfil;
	}

	/// function para Login Usuario
	function fnBDDLogin($ic_usuario_identificacion, 
						$ic_usuario_contrasena){
		global $cnnBaseDatos;
		$cnnBaseDatos->SetFetchMode(ADODB_FETCH_BOTH);
		$sql = "CALL PRC_USUARIO_LOGIN('".$ic_usuario_identificacion."', 
									   '".$ic_usuario_contrasena."')";
		/*$sql = "CALL PRC_USUARIO_LOGIN('".$ic_usuario_identificacion."', 
									   '".md5($ic_usuario_contrasena)."',
									   '".$ic_codigo_agencia_id."')";*/
		//echo $sql;
		$rsLogin = $cnnBaseDatos->Execute($sql);
		return $rsLogin;
	}
	
	/// function para Obtener los datos del Padron electoral de la cedula ingresada
	function fnBDDGetPadronElectoral($ic_usuario_identificacion){
		global $cnnBaseDatos;
		$cnnBaseDatos->SetFetchMode(ADODB_FETCH_BOTH);
		$sql = "CALL PRC_GET_PADRON_ELECTORAL('".$ic_usuario_identificacion."')";
		$rsPadronElectoral = $cnnBaseDatos->Execute($sql);
		return $rsPadronElectoral;
	}

	/// function para obtener las agencias de la empresa enviada.
	function fnBDDGetAgencias($ic_empresa_id){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_AGENCIAS('".$ic_empresa_id."')";
		$rsAgencias = $cnnBaseDatos->Execute($sql);
		return $rsAgencias;
	}

	/// function para obtener el menu dependiendo del perfil enviado.
	function fnBDDGetMenuPerfil($ic_perfil_id){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_MENU_PERFIL('".$ic_perfil_id."')";
		$rsMenu = $cnnBaseDatos->Execute($sql);
		return $rsMenu;
	}

	/// function para obtener todas las elecciones que estan parametrizadas.
	function fnBDDGetElecciones(){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_ELECCIONES()";
		$rsElecciones = $cnnBaseDatos->Execute($sql);
		return $rsElecciones;
	}


	/// function para obtener La Eleccion enviada en el ID
	function fnBDDGetEleccionId($ic_eleccion_guid){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_ELECCION_ID('".$ic_eleccion_guid."')";
		$rsEleccionId = $cnnBaseDatos->Execute($sql);
		return $rsEleccionId;
	}

	/// function para obtener el padron por Agencia.
	function fnBDDGetPadronAgencia($ic_agencia_id){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_PADRON_ELECTORAL_AGENCIA('".$ic_agencia_id."')";
		$rsPadronElectoralAgencia = $cnnBaseDatos->Execute($sql);
		return $rsPadronElectoralAgencia;
	}

	/// function para habilitar el votante para que pueda sufragar.
	function fnBDDHabilitaVotante($ic_identificacion, $it_ep_guid){
		global $cnnBaseDatos;
		$sql = "CALL PRC_ENABLE_VOTANTE('".$ic_identificacion."', 
										'".$it_ep_guid."')";
		$rsHabilitaVotante = $cnnBaseDatos->Execute($sql);
		return $rsHabilitaVotante;
	}

	/// function para insertar Elecciones.
	function fnBDDSetElecciones($ic_eleccion_guid, $it_eleccion_nombre, $it_eleccion_descripcion, $idt_eleccion_fechopen, $idt_eleccion_fechclose,
								$it_eleccion_logo, $ic_tipo_tipo_guid, $it_eleccion_instruccion, $dt_eleccion_fechcreate, $in_eleccion_edit, $in_agenciaID){
		global $cnnBaseDatos;
		// Enviar variable $ic_eleccion_guid en NULL si es nuevo, caso contrario enviar el eleccion_guid si es modificación
		$sql = "CALL PRC_SET_ELECCIONES('".$ic_eleccion_guid."', 
										'".$it_eleccion_nombre."',
										'".$it_eleccion_descripcion."', 
										'".$idt_eleccion_fechopen."',
										'".$idt_eleccion_fechclose."', 
										'".$it_eleccion_logo."',
										'".$ic_tipo_tipo_guid."', 
										'".$it_eleccion_instruccion."',
										'".$dt_eleccion_fechcreate."', 
										'".$in_eleccion_edit."', 
										'".$in_agenciaID."')";
		// Recupero la eleccion insertada o actualizada
		$rsGetEleccion = $cnnBaseDatos->Execute($sql);
		return $rsGetEleccion->fields['vln_accion'];
		
		
	}

	/// function para insertar Configuracion.
	function fnBDDSetConfiguracion($ic_conf_guid, $it_conf_configuracion, $it_conf_descripcion, $ic_configuration_valor, $in_conf_enable){
		global $cnnBaseDatos;
		// Enviar variable $ic_conf_guid en NULL si es nuevo, caso contrario enviar el conf_guid si es modificación
		$sql = "CALL PRC_SET_CONFIGURACION('".$ic_conf_guid."', 
										'".$it_conf_configuracion."',
										'".$it_conf_descripcion."', 
										'".$ic_configuration_valor."',
										'".$in_conf_enable."')";
		// Recupero la eleccion insertada o actualizada
		$rsGetConfig = $cnnBaseDatos->Execute($sql);
		return $rsGetConfig->fields['vln_accion'];
	}

	/// function para insertar Configuracion.
	function fnBDDGetConfiguracion($ic_conf_guid){
		global $cnnBaseDatos;
		// Enviar variable $ic_conf_guid para devolver el registro del GUID enviado
		$sql = "CALL PRC_GET_CONFIGURACION('".$ic_conf_guid."')";
		$rsGetConfig = $cnnBaseDatos->Execute($sql);
		return $rsGetConfig;
	}

	/// function para insertar Eleccion Configuracion.
	function fnBDDSetEleConf($ic_elco_guid, $idt_elec_fecha, $ic_eleccion_eleccion_guid, $ic_configuration_conf_guid, $in_elco_minimo, $in_elco_maximo){
		global $cnnBaseDatos;
		// Enviar variable $ic_elco_guid en NULL si es nuevo, caso contrario enviar el elco_guid si es modificación
		$sql = "CALL PRC_SET_ELEC_CONF('".$ic_elco_guid."', 
										'".$idt_elec_fecha."',
										'".$ic_eleccion_eleccion_guid."', 
										'".$ic_configuration_conf_guid."',
										'".$in_elco_minimo."', 
										'".$in_elco_maximo."')";
		// Recupero la eleccion insertada o actualizada
		$rsGetEleConf = $cnnBaseDatos->Execute($sql);
		return $rsGetEleConf->fields['vln_accion'];
	}

	/// function para Mostrar datos de Eleccion Configuracion.
	function fnBDDGetEleConf($ic_elco_guid){
		global $cnnBaseDatos;
		// Enviar variable $ic_elco_guid para devolver el registro del GUID enviado
		$sql = "CALL PRC_GET_ELEC_CONF('".$ic_elco_guid."')";
		$rsGetEleConf = $cnnBaseDatos->Execute($sql);
		return $rsGetEleConf;
	}

	/// function para Eliminara la Configuracion de la Eleccion.
	function fnBDDDelEleConf($ic_elco_guid){
		global $cnnBaseDatos;
		// Enviar variable $ic_elco_guid para Eliminar el registro del GUID enviado
		$sql = "CALL PRC_DEL_ELEC_CONF('".$ic_elco_guid."')";
		$rsDelEleConf = $cnnBaseDatos->Execute($sql);
		return $rsDelEleConf;
	}

	/// function para Mostrar datos de Eleccion Configuracion de la Eleccion Enviada.
	function fnBDDGetEleConfEleccion($ic_elec_guid){
		global $cnnBaseDatos;
		// Enviar variable $ic_elec_guid para devolver el registro del GUID enviado
		$sql = "CALL PRC_GET_ELEC_CONF_ELECCION('".$ic_elec_guid."')";
		$rsGetEleConfElec = $cnnBaseDatos->Execute($sql);
		return $rsGetEleConfElec;
	}

	/// function para Eliminara todas las configuraciones de la eleccion Enviada
	function fnBDDDelEleConfElec($ic_eleccion_guid){
		global $cnnBaseDatos;
		// Enviar variable $ic_eleccion_guid para Eliminar el registro de le eleccion enviado
		$sql = "CALL PRC_DEL_ELEC_CONF_ELECCION('".$ic_eleccion_guid."')";
		$rsDelEleConfElec = $cnnBaseDatos->Execute($sql);
		return $rsDelEleConfElec;
	}

	/// function para insertar Candidatos.
	function fnBDDSetCandidatos($ic_opcion_guid, $ic_opcion_opcion, $it_opcion_foto, $idt_opcion_fechmod, $ic_eleccion_eleccion_guid, $ic_opcion_cargo, $in_opcion_orden){
		global $cnnBaseDatos;
		// Enviar variable $ic_opcion_guid en NULL si es nuevo, caso contrario enviar el opcion_guid si es modificación
		$sql = "CALL PRC_SET_CANDIDATOS('".$ic_opcion_guid."', 
										'".$ic_opcion_opcion."',
										'".$it_opcion_foto."', 
										'".$idt_opcion_fechmod."',
										'".$ic_eleccion_eleccion_guid."', 
										'".$ic_opcion_cargo."',
										'".$in_opcion_orden."')";
		// Recupero la eleccion insertada o actualizada
		$rsGetCandidatos = $cnnBaseDatos->Execute($sql);
		return $rsGetCandidatos->fields['vln_accion'];
	}

	/// function para Retornar el Candidato Enviado.
	public function fnBDDGetCandidatos($ic_opcion_guid){
		global $cnnBaseDatos;
		// Enviar variable $ic_opcion_guid para devolver el registro del GUID enviado
		$sql = "CALL PRC_GET_CANDIDATOS('".$ic_opcion_guid."')";
		$rsGetCandidatos = $cnnBaseDatos->Execute($sql);
		return $rsGetCandidatos;
	}

	/// function para Eliminar el Candidato Enviado.
	function fnBDDDelCandidato($ic_opcion_guid){		
		global $cnnBaseDatos;
		// Enviar variable $ic_opcion_guid eliminara el Candidato enviado
		$sql = "CALL PRC_DEL_CANDIDATO('".$ic_opcion_guid."')";
		$rsDelCandidato = $cnnBaseDatos->Execute($sql);
		return $rsDelCandidato;
	}

	/// function para Retornar el Candidato Enviado.
	function fnBDDGetCandidatosElec($ic_eleccion_guid){
		global $cnnBaseDatos;
		// Enviar variable $ic_eleccion_guid para devolver todos los candidatos para la eleccion enviada
		$sql = "CALL PRC_GET_CANDIDATOS_ELECCION('".$ic_eleccion_guid."')";
		$rsGetCandidatosElec = $cnnBaseDatos->Execute($sql);
		return $rsGetCandidatosElec;
		$cnnBaseDatos->Close();
	}

	/// function para Eliminar los candidatos de la Eleccion enviada.
	function fnBDDDelCandidatosElec($ic_eleccion_guid){
		global $cnnBaseDatos;
		// Enviar variable $ic_eleccion_guid eliminara los candidatos de la Eleccion enviada
		$sql = "CALL PRC_DEL_CANDIDATO_ELECCION('".$ic_eleccion_guid."')";
		$rsDelCandidatos = $cnnBaseDatos->Execute($sql);
		return $rsDelCandidatos;
	}


	/// function para insertar Logs.
	function fnBDDSetLogs($ic_votante_votante_cedula, $ic_disparador_disp_guid, $it_logs_infoextra, $ic_logs_origen, $ic_logs_accion){
		global $cnnBaseDatos;
		$sql = "CALL PRC_SET_LOGS('".$ic_votante_votante_cedula."', 
										'".$ic_disparador_disp_guid."',
										'".$it_logs_infoextra."', 
										'".$ic_logs_origen."',
										'".$ic_logs_accion."')";
		$rsGetLogs = $cnnBaseDatos->Execute($sql);
		return $rsGetLogs->fields['vln_accion'];
	}

	/// function para obtener el padron por Agencia.
	function fnBDDGetVotacionAgencia($ic_agencia_id){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_VOTACION_AGENCIA('".$ic_agencia_id."')";
		$rsVotacionAgencia = $cnnBaseDatos->Execute($sql);
		return $rsVotacionAgencia;
	}

	/// function para registrar el Voto.
	function fnBDDSetVotacion($ic_opcion_opcion_guid, $ic_elec_part_ep_guid, $ic_eleccion_eleccion_guid, $ic_voto_ip, $ic_voto_mac, 
		$ic_votante_votante_cedula){
		global $cnnBaseDatos;
		$sql = "CALL PRC_SET_VOTO('".$ic_opcion_opcion_guid."', 
										'".$ic_elec_part_ep_guid."',
										'".$ic_eleccion_eleccion_guid."', 
										'".$ic_voto_ip."',
										'".$ic_voto_mac."',
										'".$ic_votante_votante_cedula."')";
        $rsSetVoto = $cnnBaseDatos->Execute($sql);
        if($rsSetVoto->fields["MYSQL_ERROR"] == "")
				return true;
			else
				return $rsSetVoto->fields["MYSQL_ERROR"];
	}

	/// function para obtener el total de votos por horas
	function fnBDDGetHorasVotos(){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_HORAS_VOTOS()";
		$rsHorasVotos = $cnnBaseDatos->Execute($sql);
		return $rsHorasVotos;
	}

	/// function para obtener el total de votos por candidato de la Eleccion enviada.
	function fnBDDGetVotosCandidatoElec($ic_eleccion_guid){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_VOTOS_OPCION_ELECCION('".$ic_eleccion_guid."')";
		$rsGetVotosCandElec = $cnnBaseDatos->Execute($sql);
		return $rsGetVotosCandElec;
	}

	/// function para registrar el Voto.
	function fnBDDSetVoto($ic_opcion_opcion_guid, $ic_elec_part_ep_guid, $ic_eleccion_eleccion_guid, $ic_voto_ip, $ic_voto_mac, $ic_votante_votante_cedula){
		global $cnnBaseDatos;
		$sql = "CALL PRC_SET_VOTO('".$ic_opcion_opcion_guid."', 
										'".$ic_elec_part_ep_guid."',
										'".$ic_eleccion_eleccion_guid."', 
										'".$ic_voto_ip."',
										'".$ic_voto_mac."',
										'".$ic_votante_votante_cedula."')";
        $rsSetVoto = $cnnBaseDatos->Execute($sql);
        if($rsSetVoto->fields["MYSQL_ERROR"] == "")
				return true;
			else
				return $rsSetVoto->fields["MYSQL_ERROR"];
	}


	///function para obtener el código de eleccion basado en la agencia
	function fnGetEleccionXAgencia($agencia_id){
		global $cnnBaseDatos;
		$sql="select eleccion_guid from eleccion where AgenciaID='".$agencia_id."'";
		$rsEleccion=$cnnBaseDatos->Execute($sql);
		return $rsEleccion->fields["eleccion_guid"];
	}

	/// function para controlar los tiempos de ingreso de votaciones
	function fnControlTiemposAcceso($agencia_id){
		global $cnnBaseDatos;
		$sql="select eleccion_fechopen, eleccion_fechclose 
				from eleccion e  where AgenciaID ='".$agencia_id."'
				and eleccion_fechopen <now() and now()<eleccion_fechclose";
		//echo $sql;
		$rsEleccion=$cnnBaseDatos->Execute($sql);

		return $rsEleccion;
	}

	///function para obtener datos de las fechas de la eleccion
	function fnFechaOpenCierre($agencia_id){
		global $cnnBaseDatos;
		$sql="select eleccion_fechopen, eleccion_fechclose 
				from eleccion e  where AgenciaID ='".$agencia_id."'";
		//echo $sql;
		$rsEleccion=$cnnBaseDatos->Execute($sql);

		return $rsEleccion;	
	}

	/// function para obtener el total de personas empadronadas y las que votaron por agencia
	function fnBDDGetDatosXAgencia(){
		global $cnnBaseDatos;
		$sql = "CALL PRC_GET_DATOS_X_AGENCIA()";
		$rsDatosxAgencia = $cnnBaseDatos->Execute($sql);
		return $rsDatosxAgencia;
	}

	//function para obtener los datos de la configuración de la eleccion
	function fnGetConfEleccion($eleccion_guid){
		global $cnnBaseDatos;
		$sql="select ec.elco_minimo, ec.elco_maximo 
			from elec_conf ec
			inner join configuration c on c.conf_guid=ec.configuration_conf_guid 
			where c.conf_configuracion ='lista-candidatos'
			and ec.eleccion_eleccion_guid ='".$eleccion_guid."'";
		$rsElecConf=$cnnBaseDatos->Execute($sql);
		return $rsElecConf;
	}

	function fnGetDatosActaAperturaCierre($agencia_id){
		global $cnnBaseDatos;
		$sqlLANG="SET lc_time_names = 'es_PE';";
		$rsLANG=$cnnBaseDatos->Execute($sqlLANG);

		$sql="select e.eleccion_guid, e.eleccion_nombre, a.NombreAgencia , a.Direccion, emp.empresa_descripcion, 
				CONCAT( 
						concat(
						CONCAT( 
						concat(concat(concat(DATE_FORMAT(e.eleccion_fechopen,'%W'),', '), 
							   DATE_FORMAT(e.eleccion_fechopen,'%d')),' de '),
						DATE_FORMAT(e.eleccion_fechopen,'%M')
						), ' del '), DATE_FORMAT(e.eleccion_fechopen, '%Y'))
							   
						
						as fechaOpen,
				CONCAT( 
						concat(
						CONCAT( 
						concat(concat(concat(DATE_FORMAT(e.eleccion_fechclose,'%W'),', '), 
							   DATE_FORMAT(e.eleccion_fechclose,'%d')),' de '),
						DATE_FORMAT(e.eleccion_fechclose,'%M')
						), ' del '), DATE_FORMAT(e.eleccion_fechclose, '%Y'))
							   
						
						as fechaCierre,
						
				(select count(*) from elec_part ep where ep.eleccion_eleccion_guid =e.eleccion_guid ) as votantes,
				(select count(*) from elec_part ep where ep.eleccion_eleccion_guid =e.eleccion_guid 
				and ep.ep_fechcierre is not null) as votos
				from eleccion e
				inner join Agencia a on a.AgenciaID =e.AgenciaID 
				inner join empresa emp on emp.empresa_guid =a.guidEmpresa  
				where a.AgenciaID ='".$agencia_id."'";
		$rsApertura=$cnnBaseDatos->Execute($sql);
		return $rsApertura;
	}

	///function para obtener los valores los datos de los resultados
	function fnGetDatosActaResultados($agencia_id){
		global $cnnBaseDatos;
		$rsGetDatos=$this->fnGetDatosActaAperturaCierre($agencia_id);

		$rsResultados=fnBDDGetVotosCandidatoElec($rsGetDatos->fields["eleccion_guid"]);
		return json_encode(array("eleccion_nombre"=>utf8_encode(strtoupper($rsGetDatos->fields["eleccion_nombre"])),
								"registros"=>$rsResultados->RecordCount()));
	}

	//function para recuperar la fecha de voto de un elector
	function fnBDDGetFechaVoto($el_guid, $txtCedula){
		global $cnnBaseDatos;
		$sql="select ep_fechcierre from elec_part where ep_guid='".$el_guid."' and votante_votante_cedula='".$txtCedula."'";
		$rsFechaVoto=$cnnBaseDatos->Execute($sql);
		return $rsFechaVoto->fields["ep_fechcierre"];
	}

}




//Codigo para testear que este funcionando bien los métodos de consulta
 /*$o_model=new c_model();
// //
$rs=$o_model->fnBDDGetVotacionAgencia(3);
echo $rs->fields["eleccion_guid"];

$rs2=$o_model->fnBDDGetCandidatosElec("47540b9c-6ccf-11ec-a077-0050560ac19d");
echo "---".$rs2->fields["opcion_opcion"]."...";*/ 
//echo "....".$rs->fields["electores"]."...";
/* $rs=$o_model->fnBDDUsuarioRegistro("533696ff-c814-48eb-9203-6b77359804df", "1", "Alexis", "Armijos", "666666", "", "aarmijos@usfq.edu.ec", "2020-04-20", "098f6bcd4621d373cade4e832627b4f6", "",
								  "f6079703-f077-11ea-8885-0050560ac19d");*/
/*
$resultado_dato='[{"id_pregunta":"E0CFD6F8-DCEF-1336-EE20-08EAC9C6CEFA","pregunta":"Alcalde","respuesta":[{"opcion":"2","descripcion":"Moncayo"}]}]';
 $rs=$o_model->fnBDDSetResultado("69ff270a-fc7e-11ea-8885-0050560ac19d", $resultado_dato, "ca3a1417-001e-11eb-8885-0050560ac19d", "f6079703-f077-11ea-8885-0050560ac19d");*/
 //fnBDDSetResultado($codigo_formulario_id, $resultado_dato, $usuario_id, $guid_resultado)
//  while(!$rs->EOF){
//    echo utf8_encode($rs->fields["asamblea_descripcion"]);
//     $rs->MoveNext(); }
?>
