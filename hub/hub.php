<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("FLAG_MAC",false);
require("../clases/c_view.php");
require("../clases/c_model.php");

require("../clases/c_admin.php");

$o_view=new c_view();
$o_admin = new c_admin();

switch($_REQUEST["funcion"]){

    case "fnGetEmpresa": call_user_func(array($o_view, "fnGetEmpresa"));
    break;
    case "fnViewPerfil": call_user_func(array($o_view, "fnViewPerfil"));
    break;
    case "fnViewPadron":call_user_func(array($o_view,"fnViewPadron"), $_POST["txtCedula"]);		
    break;
	
             /**********admin**************/
    case "fnGetElecciones":call_user_func(array($o_admin,"fnGetElecciones"));
    break;
        
    case "fnGetAgencias": call_user_func(array($o_admin, "fnGetAgencias"),$_POST["ep_guid"]);
    break;
        
    case "fnGetEleccionId": call_user_func(array($o_admin, "fnGetEleccionId"),$_POST["el_guid"]);
    break;
        
    case "fnGetEleConfEleccion": call_user_func(array($o_admin, "fnGetEleConfEleccion"),$_POST["el_guid"]);
    break;
        
    case "fnGetCandidatosElec": call_user_func(array($o_admin, "fnGetCandidatosElec"),$_REQUEST["el_guid"]);
    break;
    
    case "fnGetCandidatos": call_user_func(array($o_admin, "fnGetCandidatos"),$_POST["op_guid"]);
    break;
        
    case "fnDelCandidato": call_user_func(array($o_admin, "fnDelCandidato"),$_POST["op_guid"]);
    break;
        
    case "fnDelEleConfElec": call_user_func(array($o_admin, "fnDelEleConfElec"),$_POST["elp_guid"]);
    break;
        
        
        
    case "fnSetElecciones": call_user_func(array($o_admin, "fnSetElecciones"),
                                           $_POST["guid"],$_POST["nombre"],$_POST["descripcion"],$_POST["fechopen"],$_POST["fechclose"],
                                           $_POST["logo"],$_POST["tipo_guid"],$_POST["instruccion"],$_POST["edit"],
                                           $_POST["agenciaID"]);
    break;
    case "fnSetEleConf": call_user_func(array($o_admin, "fnSetEleConf"), $_POST["elco_guid"],$_POST["chkAnonimo"],$_POST["chkCandidato"],
                                        $_POST["eleccion_guid"],$_POST["elco_minimo"],$_POST["elco_maximo"]);
    break;
        
    case "fnSetCandidatos": call_user_func(array($o_admin, "fnSetCandidatos"),  $_POST["opcion_guid"],$_POST["opcion"],$_POST["opcion_foto"],$_POST["eleccion_guid"],$_POST["opcion_cargo"],$_POST["opcion_orden"]);
    break;
        /**********admin**********/







   
    case "fnVerificaUsuario": call_user_func(array($o_view, "fnVerificaUsuario"),
                		 $_POST["txtUsuario"], $_POST["txtPassword"], 
                                 $_POST["hCodAgencia"]);
    break;
    case "fnBuildMenu": call_user_func(array($o_view, "fnBuildMenu"),$_POST["nombre_perfil"]);
    break;
    case "fnViewPadronLista": call_user_func(array($o_view,"fnViewPadronLista"));
    break;
    case "fnViewHabilitaUsuario": call_user_func(array($o_view, "fnViewHabilitaUsuario"), $_POST['cedula'], $_POST["ep_guid"]);
    break;
    case "fnViewPadronTotal": call_user_func(array($o_view, "fnViewPadronTotal"));
    break;
    case "fnViewPadronTabla": call_user_func(array($o_view, "fnViewPadronTabla"), $_POST["txtCedula"]);
    break;
    case "fnViewCertificadoHTML": call_user_func(array($o_view, "fnViewCertificadoHTML"),$_POST["txtCedula"],
                          $_POST["txtnombres"],$_POST["junta"], $_POST["txtFecha"], $_POST["tipo"]);
    break;
    case "fnSetSessionActiva": call_user_func(array($o_view, "fnSetSessionActiva"));
    break;
    case "fnViewPapeleta": call_user_func(array($o_view,"fnViewPapeleta"));
    break;
    case "fnViewAdmin": call_user_func(array($o_view, "fnViewAdmin"));
    break;
    case "fnBuildCandidatos": call_user_func(array($o_view, "fnBuildCandidatos"), $_POST["eleccion"],
                          $_POST["ep_guid"], $_POST["cedula"], $_POST["type_return"]);
    break;
    case "fnViewBuildHistorial": call_user_func(array($o_view, "fnViewBuildHistorial"));
    break;
    case "fnViewActaInicio": call_user_func(array($o_view, "fnViewActaInicio"));
    break;
    case "fnViewActaCierre": call_user_func(array($o_view, "fnViewActaCierre"));
    break;
    case "fnViewActaResultados": call_user_func(array($o_view, "fnViewActaResultados"));
    break;
    case "fnSetVoto": call_user_func(array($o_view,"fnSetVoto"),$_POST["eleccion"],$_POST["ep_guid"],$_POST["cedula"],$_POST["opcion"]);
    break;
    case "fnViewResultados": call_user_func(array($o_view, "fnViewResultados"));
    break;
    case "fnViewResultadosXAgencia": call_user_func(array($o_view, "fnViewResultadosXAgencia"),$_POST["agencia_id"]);
    break;
    case "fnViewControlaTiempo": call_user_func(array($o_view, "fnViewControlaTiempo"),$_POST["agencia_id"]);
    break;
    case "fnViewReportAgencia":call_user_func(array($o_view, "fnViewReportAgencia"));
    break;
    case "fnLoadAusentismoVsSufragio":call_user_func(array($o_view,"fnLoadAusentismoVsSufragio"));
    break;
    case "fnCheckConfiguration": call_user_func(array($o_view, "fnCheckConfiguration"), $_POST["eleccion_guid"]);
    break;
    case "fnViewBuilTableResultados": call_user_func(array($o_view,"fnViewBuilTableResultados"));
    break;
    case "fnBuildPDF": call_user_func(array($o_view, "fnBuildPDF"), $_POST["html"]);
    break;
    case "fnViewGetFechaVoto": call_user_func(array($o_view, "fnViewGetFechaVoto"),$_POST["el_guid"], $_POST["txtCedula"]);
    break;
    case "fnViewLog": call_user_func(array($o_view, "fnViewLog"), $_POST["txtCedula"], $_POST["disp_guid"], $_POST["origen"], $_POST["accion"]);
    break;
    /*case "fnViewResultadosXAgenciaPDF": call_user_func(array($o_view,"fnViewResultadosXAgenciaPDF"),$_POST["agencia_id"]);
    break;*/
    /*
    case "fnGetCSS": call_user_func(array($o_view, "fnGetCSS"));
    break;
    case "fnSaveEntidad": call_user_func(array($o_view,"fnSaveEntidad"),$_POST["array_css"],
                          $_POST["agencia_id"], $_POST["agencia_descripcion"], 
                          $_POST["agencia_direccion"], $_POST["agencia_telefono"], 
			  $_POST["agencia_correo"], $_POST["agencia_identificacion"], 
			  $_POST["agencia_logo"], $_POST["agencia_info_adicional"], 
                          $_POST["agencia_css"], $_POST["agencia_estado"]);
    break;
    case "fnViewAsambleas": call_user_func(array($o_view, "fnViewAsambleas"));
    break;
    case "fnSetAsamblea": call_user_func(array($o_view, "fnSetAsamblea"),$_POST["hCodAsamblea"], 
                          $_POST["agencia_id"], $_POST["txtAsamblea"], $_POST["txtFechaInicio"],  
                          $_POST["intQuorum"], $_POST["txtFechaCierre"], $_POST["BooleanEstado"]);
    break;
    case "fnGetAsamblea": session_start();
                          call_user_func(array($o_view, "fnGetAsamblea"), $_POST["asamblea_id"],
                                        "", $_POST["retorno"]);
    break;
    case "fnSendMail": call_user_func(array($o_view, "fnSendMail"), $_POST["from"], $_POST["subject"], 
                                        $_POST["to"], $_POST["password"]);
    break;
    case "fnSetUsuarioQuorum": call_user_func(array($o_view, "fnSetUsuarioQuorum"), $_POST["array_quorum"],
                               $_POST["asamblea_id"]);
    break;
    case "fnSetConvocatoria": call_user_func(array($o_view, "fnSetConvocatoria"), $_POST["asamblea_id"],
                            $_POST["txtConvocatoria"], $_POST["txtDescripcionConvocatoria"], 
                            $_POST["txtFechaConvocatoria"],$_POST["hCodConvocatoria"],$_POST["array_files"]);
    break;
    case "fnViewConvocatoria": call_user_func(array($o_view,"fnViewConvocatoria"), $_POST["asamblea_id"], 
                                $_POST["retorno"]);
    break;
    case "fnAddFile": call_user_func(array($o_view, "fnAddFile"),$_POST["txtArchivo"],
                 $_POST["txtDescripcionArchivo"], $_POST["nombre_archivo"], $_POST["nfile"]);
    break;
    case "fnDownFile": call_user_func(array($o_view, "fnDownFile"), $_POST["id_archivo"], $_POST["nameFile"], $_POST["ext"]);
    break;
    case "fnDeleteFile": call_user_func(array($o_view,"fnDeleteFile"),$_POST["id_archivo"]);
    break;
    case "fnViewReferendums": call_user_func(array($o_view, "fnViewReferendums"), $_POST["asamblea_id"],$_POST["retorno"]);
    break;
    case "fnSetReferendum":   if(isset($_POST["id_referendum"]))
                                $id_referendum=$_POST["id_referendum"];
                            else
                                $id_referendum="";
        
                    call_user_func(array($o_view,"fnSetReferendum"),$_POST["txtReferendum"],
                    $_POST["array_preguntas"], $_POST["id_asamblea"],$id_referendum);
    break;
    case "fnAddOpcion": call_user_func(array($o_view, "fnAddOpcion"), $_POST["opcion"],
                             $_POST["nelementos"]);
    break;
    case "fnAddQuestion":   if(isset($_POST["opciones"]))
                                $opciones=$_POST["opciones"];
                            else
                                $opciones=array();
                            call_user_func(array($o_view, "fnAddQuestion"),$_POST["Pregunta"],
                             $opciones, $_POST["tipo"]);
    break;
    case "fnViewPreguntas": call_user_func(array($o_view, "fnViewPreguntas"),$_POST["id_referendum"]);
    break;
    case "fnDeleteQuestion":call_user_func(array($o_view,"fnDeleteQuestion"), $_POST["id_pregunta"], $_POST["id_referendum"]);
    break;
    case "fnDeleteReferendum": call_user_func(array($o_view, "fnDeleteReferendum"), $_POST["id_referendum"]);
    break;
    case "fnViewQuorum": call_user_func(array($o_view, "fnViewQuorum"), $_POST["asamblea_id"]);
    break;
    case "fnGrabarAsistencia": call_user_func(array($o_view, "fnGrabarAsistencia"), $_POST["array_quorum"]);
    break;
    case "fnViewAsambleasXUsuario": call_user_func(array($o_view, "fnViewAsambleasXUsuario"));
    break;
    case "fnSaveRespuestas": call_user_func(array($o_view, "fnSaveRespuestas"),$_POST["codigo_formulario_id"],
                    $_POST["resultado_dato"]);
    break;
    case "fnConfirmaAsistencia": call_user_func(array($o_view,"fnConfirmaAsistencia"), $_POST["id_quorum"]);
    break;
    case "fnViewCombosAsambleas": call_user_func(array($o_view, "fnViewCombosAsambleas"));
    break;
    case "fnViewCombosReferendums": call_user_func(array($o_view, "fnViewCombosReferendums"), $_POST["cod_asamblea"]);
    break;
    case "fnViewPreguntasResultados": call_user_func(array($o_view, "fnViewPreguntasResultados"),$_POST["cod_asamblea"],
                             $_POST["cod_votacion"]);
    break;
    case "fnGetResultados": call_user_func(array($o_view, "fnGetResultados"), $_POST["cod_asamblea"], $_POST["cod_votacion"],$_POST["pregunta"]);
    break;
    */
}