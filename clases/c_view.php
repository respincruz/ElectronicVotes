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

class c_view {
    public function fnGetEmpresa(){
    

    $o_model=new c_model();
    $response=$o_model->fnBDDEmpresaGet();
    $jsonResp = array();
    while(!$response->EOF){
        if(!isset($_SESSION["empresa_guid"])){
            session_start();
            $_SESSION['empresa_guid']=$response->fields["empresa_guid"];
        }
        $json=array("empresa_guid"=>$response->fields["empresa_guid"],
                "empresa_descripcion"=>utf8_encode($response->fields["empresa_descripcion"]),
                
                "empresa_logo"=>$response->fields["empresa_logo"],
            
                "empresa_css"=>$response->fields["empresa_css"],
                "empresa_estado"=>$response->fields["empresa_estado"]
               );
        array_push($jsonResp, $json);
        $response->MoveNext();
     }
   
    print_r(json_encode($jsonResp));
   }

   public function fnViewPerfil(){
       $o_model=new c_model();
       $rsPerfil=$o_model->fnBDDPerfil();
       $html_combo='<option value="*">--Seleccione--</option>';
       while(!$rsPerfil->EOF){
        $html_combo.='<option value="'.$rsPerfil->fields["perfil_guid"].'" 
                    data-nombrecorto="'.$rsPerfil->fields["perfil_nombrecorto"]
           .'">'.utf8_encode($rsPerfil->fields["perfil_perfil"]).'</option>';
        $rsPerfil->MoveNext();

       }
       echo $html_combo;
   }

   ///function para consultar el padrón electoral
   public function fnViewPadron($txtCedula){
       $o_model=new c_model();
       $rsElector=$o_model->fnBDDGetPadronElectoral($txtCedula);
       if($rsElector->RecordCount()>0)
           $json=array("lblNombre"=>utf8_encode($rsElector->fields["votante_nombres"]),
                   "lblEmpresa"=>utf8_encode($rsElector->fields["empresa_descripcion"]),
                   "lblFecha"=>utf8_encode($rsElector->fields["fechaOpen"]),
                   "lblHoraInicio"=>$rsElector->fields["horaOpen"],
                   "lblHoraFin"=>$rsElector->fields["horaClose"],
                   "lblRecinto"=>utf8_encode($rsElector->fields["NombreAgencia"]),
                   "flag"=>true
                );
       else{
            $json=array("flag"=>false);
       }
       
   echo json_encode($json);
   }

   public function fnViewPadronTabla($txtCedula){
       $o_model=new c_model();
       $rsElector=$o_model->fnBDDGetPadronElectoral($txtCedula);
       $html='';
       if($rsElector->RecordCount()>0)
            $html='<tr>
                <td>1</td>
                <td class="tdCedula">'.$txtCedula.'</td>
                <td class="tdVotante">'.utf8_encode($rsElector->fields["votante_nombres"]).'</td>
                <td>'.utf8_encode($rsElector->fields["NombreAgencia"]).'</td>
                <td><button type="button" class="btn btn-md button-theme bg c-font-label f-bold btnCertificado no-border" data-toggle="tooltip" data-placement="top" title="Imprimir Certificado de Presentación" data-tipo="P" data-toggle="modal" data-target="#confirm-logout">
                                                    <span class="lnr lnr-license f-14"></span></button></td>
              </tr>';

        echo $html;

   }
    ///function de logueo
    public function fnVerificaUsuario($txtUsuario, $txtPassword, $hCodAgencia){
       $o_model=new c_model();
       $rsLogin=$o_model->fnBDDLogin($txtUsuario, $txtPassword);
        if(FLAG_MAC==true){
           
            if(!($rsLogin->fields["usuario_mac"]==$this->fnGetDireccionMac())){
                echo json_encode(array("mensaje"=>"La dirección mac de su equipo no está registrada",
                                        "type"=>"error"));

                exit();
            }
        }

  
      
        
        if($rsLogin->fields["perfil"]!=""){
            session_start();
            //$_SESSION["nombre_usuario"]=utf8_decode($rsLogin->fields["usuario_nombre"]);

            $_SESSION["perfil_nombrecorto"]=$rsLogin->fields["perfil"];
            $_SESSION["agencia"]=$rsLogin->fields["agencia"];
            $json=array(//"nombre_usuario"=>utf8_decode($rsLogin->fields["usuario_nombre"]),
                        "perfil_nombrecorto"=>$rsLogin->fields["perfil"],
                        "agencia"=>$rsLogin->fields["agencia"],
                        "mensaje"=>"Usuario y contraseña correctas. En un momento ingresará",
                        "type"=>"success");
            echo json_encode($json);
        }
        else{
            echo json_encode(array("mensaje"=>"No existe un usuario con estos datos",
                                    "type"=>"error"));
        }
        
        
    }
    ///function para obtener la dirección MAC
    public function fnGetDireccionMac(){
        /*$mac_address_data=exec('getmac');
        $mac_address_data=explode(" ", $mac_address_data);
        $mac_address=$mac_address_data[0];
        return $mac_address;*/
        return $_SERVER['REMOTE_ADDR'];

    }

    /// function para desplegar el menu
    public function fnBuildMenu($nombre_perfil){
        $o_model=new c_model();
        $rsMenu=$o_model->fnBDDGetMenuPerfil($nombre_perfil);
        $htmlMenu='';
        
        while(!$rsMenu->EOF){
            $htmlMenu.='<li data-funcion="'.$rsMenu->fields["menu_function"].'""><a href="#"><i class="'.$rsMenu->fields["menu_logo"].'"></i> '.utf8_encode($rsMenu->fields["menu_menu"]).'</a></li>';
            $rsMenu->MoveNext();
        }
        echo json_encode(array("Name_Menu"=>strtoupper($nombre_perfil), "htmlMenu"=>$htmlMenu));

    }


    ///function para chequear los accesos por tiempo de inicio y cierre de la eleccion
    function fnViewControlaTiempo($agencia_id){
        $o_model=new c_model();
        $rsAcceso=$o_model->fnControlTiemposAcceso($agencia_id);
        if($rsAcceso->RecordCount()>0)
            echo json_encode(array("flag"=>true, "mensaje"=>utf8_encode("Acceso No Permitido debido a que las elecciones comienzan ".$rsAcceso->fields["eleccion_fechopen"]." y termina ".$rsAcceso->fields["eleccion_fechclose"]),
                                  "type"=>"success"));
        else{
            $rsEleccion=$o_model->fnFechaOpenCierre($agencia_id);
            echo json_encode(array("flag"=>false, "mensaje"=>utf8_encode("Acceso No Permitido debido a que la elecciones comienzan ".$rsEleccion->fields["eleccion_fechopen"]." y termina ".$rsEleccion->fields["eleccion_fechclose"]),
                                  "type"=>"error"));
        }
    }

    /// funcion para mostrar el padron
    function fnViewPadronLista(){
        session_start();
        $o_model=new c_model();
        $rsPadron=$o_model->fnBDDGetPadronAgencia($_SESSION['agencia']);
       
        $html='<h3 class="heading">Junta Receptora del Voto <b id="bJunta">'.utf8_encode($rsPadron->fields["NombreAgencia"]).'</b></h3>
                    <div class="dashboard-message contact-2 bdr clearfix">
                        <div class="row">
                            <div class="col-md-12">
                              <table id="tableElectores" class="display dataTable col-md-12">
                                    <thead>
                                      <tr>
                                        
                                        <th>Orden</th>
                                        <th>Cédula</th>
                                        <th>Votante</th>
                                        <th>Fecha de Voto</th>
                                        <th></th>
                                        <th></th>
                                       
                                      </tr>
                                    </thead>
                                    <tbody>';
                                    $i=1;
                                    while(!$rsPadron->EOF){
                                        if($rsPadron->fields["voto_fechvoto"]==""){
                                            $fecha="Aún no ha votado";
                                        }
                                        else
                                            $fecha=$rsPadron->fields["voto_fechvoto"];
                                        $html.='<tr id='.$rsPadron->fields["ep_guid"].'>
                                                    <td>'.$i.'</td>
                                                    <td class="tdCedula">'.$rsPadron->fields["votante_cedula"].'</td>
                                                    <td class="tdVotante">'.utf8_encode($rsPadron->fields["votante_nombres"]).'
                                                    <td class="tdFechaVoto">'.$fecha.'
                                                    <td><button type="button" class="btn btn-md button-theme bg c-font-label f-bold btnCertificado no-border" data-toggle="tooltip" data-placement="top" title="Imprimir Certificado de Votación" data-tipo="V" data-toggle="modal" data-target="#confirm-logout">
                                                    <span class="lnr lnr-license f-14"></span></button></td>
                                                    <td><button type="button" class="btn btn-md button-theme bg c-font-label f-bold btnPermiso no-border" data-toggle="tooltip" data-placement="top" title="Habilitar elector por 5 minutos">
                                                    <span class="lnr lnr-hourglass" ></span></button></td>
                                                </tr>';
                                        $i++;
                                        $rsPadron->MoveNext();
                                    }
                            $html.='</tbody>

                              </table>
                              </div>
                            
                        </div>
                    </div>                 
                    ';

        echo $html;
    }

    /// funcion para habilitar a un elector para que se acerque a la mesa electoral a votar
    public function fnViewHabilitaUsuario($cedula, $ep_guid){
        $o_model=new c_model();
        $rsEnable=$o_model->fnBDDHabilitaVotante($cedula, $ep_guid);
        if($rsEnable->fields["VLN_ESTADO"]==1)
            echo json_encode(array("flag"=>true));
        else
            echo json_encode(array("flag"=>false));

    }

    // function para mostrar el panel del padron electoral
    function fnViewPadronTotal(){
        session_start();
        $o_model=new c_model();
        $rsPadron=$o_model->fnBDDGetPadronAgencia($_SESSION['agencia']);
       
     
        $htmlPanel='<div class="dashboard-list">
                   <h3 class="heading">Junta Receptora del Voto <b id="bJunta">'.utf8_encode($rsPadron->fields["NombreAgencia"]).'</b></h3>
                    <div class="dashboard-message contact-2 bdr clearfix">
                        <div class="row">
                            
                            <div class="col-lg-12 col-md-12">
                                
                                    <div class="row">
                                        <div class="col-lg-9 col-md-9">
                                            <div class="form-group name">
                                                <label>Cédula del Votante</label>
                                                <input type="text" name="name" maxlength="10" class="form-control solonumero" id="txtCedula" placeholder="ej: 1723452233">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group name">
                                                <button type="button" id="btnSearchPadron" class="btn btn-md button-theme bg c-font-label f-bold  no-border m-t-30" data-toggle="tooltip" data-placement="top" title="Buscar">
                                                    <span class="lnr lnr-magnifier"></span></button>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                           <table id="tableElectores" class="display dataTable col-md-12">
                                            <thead>
                                              <tr>
                                                <th>Orden</th>
                                                <th>Cédula</th>
                                                <th>Votante</th>
                                                <th>Lugar de Votación</th>
                                                <th></th>
                                             </tr>
                                        </div>
                                    </div>
                               
                            </div>
                        </div>
                    </div>
                </div>';
                echo $htmlPanel;

    }


    public function fnViewCertificadoHTML($txtCedula,$txtnombres,$junta, $txtFecha, $tipo){
        $strTipoCertificado='';
        switch($tipo){
            case "V": $strTipoCertificado="VOTACIÓN";
            break;
            case "P": $strTipoCertificado="PRESENTACIÓN";
            break;
        }
        $htmlCertificado='<div class="dashboard-message contact-2 bdr clearfix bg" id="divCertificadoPrint">
                           <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label f-18">CERTIFICADO DE '.strtoupper($strTipoCertificado).'</label>
                                        
                                    </div>
                                </div>
                           </div>
                           <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <!-- Edit profile photo -->
                                <div class="edit-profile-photo">
                                    <img src="img/logo_acta.png" alt="profile-photo" class="img-fluid">
                                    
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                               
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group name text-justify m-0">
                                                <label class="f-bold c-font-label">Nombres y Apellidos</label>
                                                <label class="f-bold f-12">'.$txtnombres.'</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                              <div class="form-group name text-justify m-0">
                                                <label class="f-bold c-font-label">Cédula</label>
                                                <label class="f-bold f-12">'.$txtCedula.'</label>
                                            </div>
                                        </div>
                                       <div class="col-lg-12 col-md-12">
                                              <div class="form-group name text-justify m-0">
                                                <label class="f-bold c-font-label">Fecha de Votación</label>
                                                <label class="f-bold f-12">'.$txtFecha.'</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                              <div class="form-group name text-justify m-0">
                                                <label class="f-bold c-font-label">Junta Receptora:</label>
                                                <label class="f-bold f-12">'.$junta.'</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 m-t-30">
                                              <hr class="new1">
                                              <div class="form-group name text-center m-0">
                                                <label class="f-bold c-font-label">Firma de Vocal de Junta</label>
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 m-t-30">
                                              <hr class="new1">
                                              <div class="form-group name text-center m-0">
                                                <label class="f-bold c-font-label">Firma del Socio</label>
                                                
                                            </div>
                                        </div>
                                    </div>
                              
                            </div>
                        </div>
                        <hr class="new2">
                        <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label f-18">CERTIFICADO DE '.strtoupper($strTipoCertificado).'</label>
                                        
                                    </div>
                                </div>
                           </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <!-- Edit profile photo -->
                                <div class="edit-profile-photo">
                                    <img src="img/logo_acta.png" alt="profile-photo" class="img-fluid">
                                    
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                               
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group name text-justify m-0">
                                                <label class="f-bold c-font-label">Nombres y Apellidos</label>
                                                <label class="f-bold f-12" id="labelNombresVotante">'.$txtnombres.'</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                              <div class="form-group name text-justify m-0">
                                                <label class="f-bold c-font-label">Cédula</label>
                                                <label class="f-bold f-12" id="labelCedulaVotante">'.$txtCedula.'</label>
                                            </div>
                                        </div>
                                       <div class="col-lg-12 col-md-12">
                                              <div class="form-group name text-justify m-0">
                                                <label class="f-bold c-font-label">Fecha de Votación</label>
                                                <label class="f-bold f-12">'.$txtFecha.'</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                              <div class="form-group name text-justify m-0">
                                                <label class="f-bold c-font-label">Junta Receptora:</label>
                                                <label class="f-bold f-12">'.$junta.'</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 m-t-30">
                                              <hr class="new1">
                                              <div class="form-group name text-center m-0">
                                                <label class="f-bold c-font-label">Firma de Vocal Principal</label>
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 m-t-30">
                                              <hr class="new1">
                                              <div class="form-group name text-center m-0">
                                                <label class="f-bold c-font-label">Firma del Socio</label>
                                                
                                            </div>
                                        </div>
                                    </div>
                              
                            </div>
                        </div>
                    </div>';
        echo $htmlCertificado;
    }

    /// function para mantener la sesión Activa
    public function fnSetSessionActiva(){
        session_start();

        if (isset($_SESSION["agencia"])) { //if you have more session-vars that are needed for login, also check if they are set and refresh them as well
            $_SESSION["agencia"]= $_SESSION["agencia"];
             $_SESSION["perfil_nombrecorto"]=$_SESSION["perfil_nombrecorto"];
            echo json_encode(array("agencia_sesion"=>$_SESSION["agencia"]));
        }
        else{
            echo json_encode(array("agencia_sesion"=>false));
        }
    }


    public function fnGet(){
        $o_model2=new c_model();
        $rs=$o_model2->fnBDDGetCandidatosElec("47540b9c-6ccf-11ec-a077-0050560ac19d");
        
       
        print_r($rs);//->fields["opcion_opcion"]."****";
    }


    // function para mostrar los resultados finales
    public function fnViewResultados(){
        session_start();
        $o_model=new c_model();
        $rsAgencias=$o_model->fnBDDGetAgencias($_SESSION["empresa_guid"]);
        $htmlResultados='<div class="dashboard-list" id="divResultadosAgencia">
                    <div class="row ">
                        <div class="col-md-12 p-r-0">
                            <h3 class="heading bg">Resultados Generales </h3>
                        </div>
                         
                    </div>
                    <div class="dashboard-message contact-2 bdr clearfix">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                   <label class="f-bold c-font-label">Agencias</label>
                                   <select id="cmbAgencias">
                                   <option value="*">--Seleccione--</option>
                                   ';
                                   while(!$rsAgencias->EOF){
                                    $htmlResultados.='<option value="'.$rsAgencias->fields["AgenciaID"].'">'.
                                                     utf8_encode($rsAgencias->fields["NombreAgencia"]).'</option>';
                                    $rsAgencias->MoveNext();
                                   }
                  $htmlResultados.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12" id="divCanvas">
                                <canvas id="jsChart" class="d-none" style="width:100%;"></canvas>
                            </div>
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <table id="tableResultados" class="display dataTable col-md-12 d-none">
                                    <thead>
                                      <tr>
                                        
                                        <th>Orden</th>
                                        <th>Foto</th>
                                        <th>Candidato</th>
                                        <th>Votos</th>
                                        
                                       
                                      </tr>
                                    </thead>
                                    <tbody>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 text-right">
                        <button type="button" id="btnPrintTable" class="btn btn-md button-theme buttons d-none"><span class="lnr lnr-printer"></span> Imprimir</button>
                            </div>
                        </div>
                        </div>
                    </div>';
        echo $htmlResultados;
    }

function fnDiferentColor(){
        $hex1 = hexdec($this->rand_color());
        $hex2=hexdec($this->rand_color());
        $sum = (int)($hex1+rand(1,200));
        return "#".dechex($sum);
    }

function rand_color() {
        return str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    /// resultados por agencia
    function fnViewResultadosXAgencia($agencia_id){
        $o_model=new c_model();
        $eleccion_guid=$o_model->fnGetEleccionXAgencia($agencia_id);

        $rsResultados=$o_model->fnBDDGetVotosCandidatoElec($eleccion_guid);
        $htmlResultados='';
        $i=1;
        $array_x=array();
        $array_y=array();
        $array_color=array();
        while(!$rsResultados->EOF){
            $htmlResultados.='<tr>
                                <td>'.$i.'</td>
                                <td><img style="max-width:100px; max-height:100px" src="data:image/png;base64,'.$rsResultados->fields["opcion_foto"].'"></td>
                                <td>'.utf8_encode($rsResultados->fields["opcion_opcion"]).'</td>
                                <td>'.$rsResultados->fields["votos"].'</td>
                             </tr>';
            $color=$this->fnDiferentColor();
            while(strlen($color)<7)
                $color=$this->fnDiferentColor();

            array_push($array_x,utf8_encode($rsResultados->fields["opcion_opcion"]));
            array_push($array_y,$rsResultados->fields["votos"]);
            array_push($array_color,$color);
            $rsResultados->MoveNext();
            $i++;
        }
        //print_r($array_x);
        echo json_encode(array("table"=>$htmlResultados,
                                "x"=>$array_x,
                                "y"=>$array_y,
                                "color"=>$array_color));
        //echo $htmlResultados;
    }


    /// resultados por agencia
    function fnViewResultadosXAgenciaPDF($agencia_id){
        include("../html2pdf/html2pdf.class.php");
        $o_model=new c_model();
        $eleccion_guid=$o_model->fnGetEleccionXAgencia($agencia_id);

        $rsResultados=$o_model->fnBDDGetVotosCandidatoElec($eleccion_guid);
        $htmlResultados='
    <style>
                .txt {
                  display: inline-block;    
                  word-break: break-all;
                   font-size: 11px;
                }
                .border{
                  border: solid 1px black;                
                  vertical-align: middle;
                
                
                }
                .align{               
                  vertical-align: middle;
                }
            </style>
        <page backtop="14mm" backbottom="14mm" backleft="16mm" backright="90mm">
            
            <div style="page-break-after:always; clear:both;"" >


        <table id="tableResultados" class="display dataTable col-md-12 d-none">
                                    <thead>
                                      <tr>
                                        
                                        <th>Orden</th>
                                        <th>Foto</th>
                                        <th>Candidato</th>
                                        <th>Votos</th>
                                        
                                       
                                      </tr>
                                    </thead>
                                    <tbody>';
        $i=1;
        $array_x=array();
        $array_y=array();
        $array_color=array();
        while(!$rsResultados->EOF){
            $htmlResultados.='<tr>
                                <td>'.$i.'</td>
                                <td><img style="max-width:100px; max-height:100px" src="data:image/png;base64,'.$rsResultados->fields["opcion_foto"].'"></td>
                                <td>'.utf8_encode($rsResultados->fields["opcion_opcion"]).'</td>
                                <td>'.$rsResultados->fields["votos"].'</td>
                             </tr>';
            
            $rsResultados->MoveNext();
            $i++;
        }
        $htmlResultados.="</tbody>
        </table>
        </div>
        <page_footer>
                    [[page_cu]]/[[page_nb]]
                </page_footer>  

        </page>";

        $html2pdf = new HTML2PDF('P', 'A4', 'es');
        $html2pdf->setDefaultFont('Arial');
        try{                                
            $html2pdf->writeHTML($content);                                             
            $html2pdf->Output('resultados.pdf');
        }

        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }

        //print_r($array_x);
        
        //echo $htmlResultados;
    }
    ///function para generar la papeleta de votacion
    public function fnViewPapeleta(){
        session_start();
        

     
        $o_model=new c_model();
        $rsEleccion=$o_model->fnBDDGetVotacionAgencia($_SESSION["agencia"]);
      


        
        
        if($rsEleccion->RecordCount()){
            $htmlPapeleta='
                
                <div class="dashboard-list" id="divInstrucciones">
                    <div class="row ">
                        <div class="col-md-6 p-r-0">
                            <h3 class="heading bg">Junta  Receptora del Voto - '.utf8_encode($rsEleccion->fields["NombreAgencia"]).' </h3>
                        </div>
                         <div class="col-md-6 p-l-0 text-right">
                            <h3 class="heading bg">Votante: '.utf8_encode($rsEleccion->fields["votante_nombres"]).' </h3>
                        </div>
                    </div>
                    <div class="dashboard-message contact-2 bdr clearfix">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                   
                                    <p class=" f-12">'.utf8_encode($rsEleccion->fields["eleccion_descripcion"]).'</p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0" id="divLblInstrucciones">
                                    <label class="f-bold c-font-label">Instrucciones</label>
                                      <p class=" f-12">'.utf8_encode($rsEleccion->fields["eleccion_instruccion"]).'</p>
                                </div>
                            </div>
                        </div>


                        <div class="row m-b-20" style="position:absolute;bottom:0">
                          <div class="col-md-12 text-center">
                            <div class="send-btn">
                                <button type="button" id="btnContinuar" class="btn btn-md button-theme buttons " 
                                data-eleccion="'.$rsEleccion->fields["eleccion_guid"].'" data-elecpart_guid="'.$rsEleccion->fields["ep_guid"].'" data-cedula="'.$rsEleccion->fields["votante_cedula"].'">Continuar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-list d-none" id="divPapeleta">
                    <div class="row ">
                        <div class="col-md-6 p-r-0">
                            <h3 class="heading bg">Junta  Receptora del Voto - '.utf8_encode($rsEleccion->fields["NombreAgencia"]).' </h3>
                        </div>
                         <div class="col-md-6 p-l-0 text-right">
                            <h3 class="heading bg">Votante: '.utf8_encode($rsEleccion->fields["votante_nombres"]).' </h3>
                        </div>
                    </div>
                    <div class="dashboard-message contact-2 bdr clearfix">
                        <div class="row" >
                            <div class="col-md-12" id="divPapeletaVoto">
                            </div>
                        </div>
                    </div>
                </div>';
            }
            else{
                date_default_timezone_set("America/Guayaquil");
                $htmlPapeleta='<div class="dashboard-list text-center" style="display: table;" id="divVotoDesactivo">
                                    <div class="row" style=" display: table-cell; vertical-align: middle;">
                                        <div class="col-md-12">
                                        <h3 class="heading c-font-label  f-30">Cooperativa 29 de Octubre - Elecciones '.date("Y").'</h3>
                                        </div>
                                        <div class="col-md-12 m-t-30">
                                            <img src="img/logo29big.png">
                                        </div>
                                        <!--<div class="col-md-12">
                                            <h3 class="heading c-font-label  f-30" id="hHora">'.date("H:i:s").'</h3>
                                        </div>-->
                                        <div class="col-md-12 text-center m-t-30">
                                            <button type="button" id="btnRefresh" class="btn btn-md button-theme buttons " 
                                >Ingresar</button>
                                        </div>

                                </div>';
            }
            echo $htmlPapeleta;
            
    }

    /// function para obtener las configuraciones de la eleccion
    function fnCheckConfiguration($eleccion_guid){
        $o_modelo=new c_model();
        $rsConf=$o_modelo->fnGetConfEleccion($eleccion_guid);
        echo json_encode(array("minimo"=>$rsConf->fields["elco_minimo"], "maximo"=>$rsConf->fields["elco_maximo"]));
    }

    /// funcion para generar la cajas de candidatos
    function fnBuildCandidatos($eleccion, $ep_guid, $cedula, $type_return){
       $o_modelo=new c_model();
       
        $rsCandidatos=$o_modelo->fnBDDGetCandidatosElec($eleccion);
        //echo $rsCandidatos->RecordCount();

       

        $htmlCandidatos='<div class="row">
                            <div class="col-md-12" id="divPapeletaRepeatInstrucciones">
                            </div>
                         </div>
                         <div class="row">';
       
        while (!$rsCandidatos->EOF) {
                $htmlCandidatos.='<div class="col-md-2 p-l-r-5">
                        <div class="dashboard-list text-center">
                            
                            <div class="dashboard-message contact-2 candidato">
                            <div class="row">
                                <div class="col-md-12">
                                <img style="max-width:130px; max-heignt:130px" src="data:image/png;base64,'.$rsCandidatos->fields["opcion_foto"].'">
                                </div>
                                <div class="col-md-12 m-t-10">
                                 <input type="checkbox" id="check-'.$rsCandidatos->fields["opcion_guid"].'" value="'.$rsCandidatos->fields["opcion_guid"].'"  class="chk m-t-10"/>
                                      <label for="check-'.$rsCandidatos->fields["opcion_guid"].'" style="--d: 50px;">
                                        <svg viewBox="0,0,50,50">
                                          <path d="M5 30 L 20 45 L 45 5"></path>
                                        </svg>
                                </div>
                                
                                    <div class="col-md-12 ">
                                    <h3 class="heading c-font-label bg f-12 p-l-r-5 p-t-b-15 height-60 candidato">'.utf8_encode(strtoupper($rsCandidatos->fields["opcion_opcion"])).'</h3>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>';
                $rsCandidatos->MoveNext();
            }
        $htmlCandidatos.='</div>
                         <div class="row m-b-20">
                            <div class="col-md-12 text-center">
                                <button type="button" id="btnVotar" class="btn btn-md button-theme buttons " 
                                data-eleccion="'.$eleccion.'" data-elecpart_guid="'.$ep_guid.'" data-cedula="'.$cedula.'">Votar</button>
                                <button type="button" id="btnVolver" class="btn btn-md button-theme bg " 
                                >Volver</button>
                            </div>
                         </div>';

        switch($type_return){
            case "retorno": return $htmlCandidatos;
            break;
            case "html": echo $htmlCandidatos;
            break;
        }
        
        

    }


    /// function para obtener los numeros por agencia
    function fnViewReportAgencia(){
        $o_model=new c_model();
        $rsAgencias=$o_model->fnBDDGetDatosXAgencia();
        $htmlTableAgencias='<div class="row">
                                <div class="col-md-12" >
                                        <canvas id="jsChartAgencia" style="width:100%;"></canvas>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tableResultados" class="display dataTable col-md-12">
                                            <thead>
                                              <tr>
                                                
                                                <th width="40px">Orden</th>
                                                <th width="150px">Agencia</th>
                                                <th width="400px">Votantes Empadronados</th>
                                                <th width="80px">Votos Ejercidos</th>
                                                
                                               
                                              </tr>
                                            </thead>
                                            <tbody>';
                               
                       $htmlTableAgencias.='</tbody>
                                        </table>
                                </div>
                            </div>';

        echo $htmlTableAgencias;
    }

    function fnLoadAusentismoVsSufragio(){
        $o_model=new c_model();
        $rsAgencias=$o_model->fnBDDGetDatosXAgencia();
        $i=1;
        $htmlTableAgencias="";

        $array_Agencia=array();
        $array_Empadronados=array();
        $array_Sufragios=array();
       

            


        while(!$rsAgencias->EOF){
            $htmlTableAgencias.='<tr>
                                    <td>'.$i.'</td>
                                    <td>'.utf8_encode($rsAgencias->fields["NombreAgencia"]).'</td>
                                    <td>'.$rsAgencias->fields["TotalPadron"].'</td>
                                    <td>'.$rsAgencias->fields["TotalVotantes"].'</td>
                                </tr>';
            array_push($array_Agencia,utf8_encode($rsAgencias->fields["NombreAgencia"]));  
            array_push($array_Empadronados, $rsAgencias->fields["TotalPadron"]);
            array_push($array_Sufragios, $rsAgencias->fields["TotalVotantes"]);
            $rsAgencias->MoveNext();
            $i++;
        }
        echo json_encode(array("html"=>$htmlTableAgencias, "dataLabelAgencia"=>$array_Agencia, 
                                "dataEmpadronados"=>$array_Empadronados, "dataSufragios"=>$array_Sufragios));
    }

    ///function para registrar el voto
    function fnSetVoto($eleccion,$ep_guid,$cedula,$opcion){
        $o_model=new c_model();
        //echo $this->fnGetDireccionMac();
        if($o_model-> fnBDDSetVoto($opcion, $ep_guid, $eleccion, $this->fnGetDireccionMac(), "", $cedula)==true)
            echo json_encode(array("flag"=>true));
        else
            echo json_encode(array("flag"=>false));


    }

    ///funcion para mostrar el admin
    function fnViewAdmin(){
        
        $html=' <div  style="position:relative; height:650px">
        <iframe src="admin/admin.php" scrolling="no" frameborder="0"
    style="position:absolute;top:0px;width:100%;height:100vh;"></iframe>';
        echo $html;
    }

    /// function construye panel Historial
    function fnViewBuildHistorial(){
        $html='<div class="row">
                    <div class="col-md-12">
                    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                    </div>
                </div>';
        echo $html;
    }

    /// function para generar el html de la Acta de Inicio de Escrutinio
    function fnViewActaInicio(){
        date_default_timezone_set("America/Guayaquil");
         session_start();
        

     
       
        $o_modelo=new c_model();
        $rsApertura=$o_modelo->fnGetDatosActaAperturaCierre($_SESSION["agencia"]);
        $htmlActa='
                <div class="dashboard-list" id="divActaPrint">

                    <div class="row ">
                        <div class="col-md-12 p-r-0">
                            <h3 class="heading bg">Acta de Instalación</h3>
                        </div>
                         
                    </div>
                    <div class="dashboard-message contact-2 bdr clearfix">
                        <div class="row">
                        <div class="col-md-8">
                            <div class="form-group name text-justify m-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img style="max-width:150px" src="img/logo_acta.png">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="row">
                               
                                <div class="col-md-12">
                                    <h4 class="heading c-font-label no-border-line">Junta Electoral '.utf8_encode($rsApertura->fields["NombreAgencia"]).' </h4>
                                </div>
                             </div>
                             
                                
                        </div>
                    
                        <div class="row">

                            <div class="col-md-12 text-center">
                                <h4 class="heading c-font-label no-border-line">ACTA DE INSTALACIÓN</h4>
                                
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="heading c-font-label no-border-line">ELECCIÓN DE REPRESENTANTES A LA ASAMBLEA GENERAL DE LA '.utf8_encode(strtoupper($rsApertura->fields["empresa_descripcion"])).'</h4>
                                
                            </div>
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    Siendo las  <b>'.date("H:i").'</b>, del día <b>'.utf8_encode($rsApertura->fields["fechaOpen"]).'</b>, en las oficinas de la Agencia <b>'.utf8_encode($rsApertura->fields["NombreAgencia"]).'</b>, se instala la mesa de la Junta Receptora del Voto, pasando acto seguido a la revisión de los equipos electrónicos y la habilitación del sistema para la Votación electrónica,  para lo cual se cuenta con el apoyo informático para la emisión, conteo y escrutinio de votos.</div>
                                </div>
                                <div class="col-md-12">
                                    Se verifica que para la emisión de los votos se encuentre instalada y habilitada la computadora autorizada para emitir el voto, la misma que opera con el sistema en línea, para el registro de los candidatos y la obtención de resultados.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row m-t-80">
                            <div class="col-md-6">
                               <div class="row">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">f) ___________________________________________________________</label><br>
                                        <label class="f-bold c-font-label">Vocal Principal</label>
                                       
                                    </div>
                                    </div>
                                </div> 
                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Nombres y Apellidos</label>
                                        <label class="f-bold c-font-label">___________________________________________________</label>
                                    </div>
                                    </div>
                                </div>     

                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Número de Cédula</label>
                                        <label class="f-bold c-font-label">_________________________________________________________</label>
                                    </div>
                                    </div>
                                </div> 

                            </div>
                            <div class="col-md-6">
                                    <div class="row">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                       
                                        <label class="f-bold c-font-label">f) __________________________________________________________</label><br> 
                                        <label class="f-bold c-font-label">Asistente Digitador</label>
                                    </div>
                                    </div>
                                </div> 
                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Nombres y Apellidos</label>
                                        <label class="f-bold c-font-label">___________________________________________________</label>
                                    </div>
                                    </div>
                                </div>     

                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Número de Cédula</label>
                                        <label class="f-bold c-font-label">_________________________________________________________</label>
                                    </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12 text-right">
                             <button type="button" id="btnPrintActa" data-type="Acta_Apertura_'.utf8_encode($rsApertura->fields["NombreAgencia"]).'" class="btn btn-md button-theme buttons "><span class="lnr lnr-printer"></span> Imprimir</button>
                            </div>
                        </div>

                    </div>
                    </div>';
        echo $htmlActa;
    }

    /// function para generar el acta con html2pdf
    function fnBuildPDF($html){
        require_once('../html2pdf/html2pdf.class.php');
        $htmlCSS='<style>
                    .dashboard-list {
                        /* box-shadow: 0 0 35px rgb(0 0 0 / 10%); */
                        padding: 0;
                        margin-bottom: 30px;
                        display: inline-block;
                        width: 100%;
                    }
                    .row {
                        display: -ms-flexbox;
                        display: flex;
                        -ms-flex-wrap: wrap;
                        flex-wrap: wrap;
                        margin-right: -15px;
                        margin-left: -15px;
                    }

                    .col-md-12 {
                        -ms-flex: 0 0 100%;
                        flex: 0 0 100%;
                        max-width: 100%;
                        position: relative;
                        width: 100%;
                        padding-right: 15px;
                        padding-left: 15px;
                    }
                    .p-r-0 {
                        padding-right: 0px!important;
                    }
                    .dashboard-list h3 {
                        padding: 15px 25px;
                        border-bottom: 1px solid #eee;
                        font-size: 18px;
                        margin: 0;
                        width: 100%;
                        font-weight: 500;
                    }

                    .bg, input:checked {
                        background-color: #fec839!important;
                        color: #861031!important;
                    }


                    .dashboard-message {
                        float: left;
                        padding: 25px 25px;
                        position: relative;
                        border-bottom: 1px solid #eee;
                        width: 100%;
                    }

                    .clearfix::after {
                        display: block;
                        clear: both;
                        content: "";
                    }
                    .col-md-3 {
                        -ms-flex: 0 0 25%;
                        flex: 0 0 25%;
                        max-width: 25%;
                    }

                    .text-justify {
                        text-align: justify!important;
                    }
                 </style>';
        $htmlBody=$htmlCSS.$html;

    }

     /// function para generar el html de la Acta de Cierre de Escrutinio
    function fnViewActaCierre(){
        date_default_timezone_set("America/Guayaquil");
        session_start();
        $o_modelo=new c_model();
        $rsApertura=$o_modelo->fnGetDatosActaAperturaCierre($_SESSION["agencia"]);

        $htmlActa=' <div class="dashboard-list" id="divActaPrint">

                    <div class="row ">
                        <div class="col-md-12 p-r-0">
                            <h3 class="heading bg">Acta de Cierre </h3>
                        </div>
                         
                    </div>
                    <div class="dashboard-message contact-2 bdr clearfix">
                        <div class="row">
                        <div class="col-md-8">
                            <div class="form-group name text-justify m-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img style="max-width:150px" src="img/logo_acta.png">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="row">
                               
                                <div class="col-md-12">
                                    <h4 class="heading c-font-label no-border-line">Junta Electoral '.utf8_encode($rsApertura->fields["NombreAgencia"]).' </h4>
                                </div>
                             </div>
                             
                                
                        </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12 text-center">
                                <h4 class="heading c-font-label no-border-line">ACTA DE CIERRE</h4>
                                
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="heading c-font-label no-border-line">ELECCIÓN DE REPRESENTANTES A LA ASAMBLEA GENERAL DE LA '.utf8_encode(strtoupper($rsApertura->fields["empresa_descripcion"])).'</h4>
                                
                            </div>
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    Siendo las   <b>'.date("H:i").'</b> del <b>'.utf8_encode($rsApertura->fields["fechaCierre"]).'</b> en las oficinas de la AGENCIA <b>'.utf8_encode($rsApertura->fields["NombreAgencia"]).'</b>,  se da por cerrado el proceso de elecciones teniendo un total de <b>'.$rsApertura->fields["votantes"].'</b>  electores, de los cuales se han presentado a sufragar <b>'.$rsApertura->fields["votos"].'</b> votantes.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row m-t-80">
                            <div class="col-md-6">
                               <div class="row">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">f) ___________________________________________________________</label><br>
                                        <label class="f-bold c-font-label">Vocal Principal</label>
                                       
                                    </div>
                                    </div>
                                </div> 
                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Nombres y Apellidos</label>
                                        <label class="f-bold c-font-label">___________________________________________________</label>
                                    </div>
                                    </div>
                                </div>     

                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Número de Cédula</label>
                                        <label class="f-bold c-font-label">_________________________________________________________</label>
                                    </div>
                                    </div>
                                </div> 

                            </div>
                            <div class="col-md-6">
                                    <div class="row">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                       
                                        <label class="f-bold c-font-label">f) __________________________________________________________</label><br> 
                                        <label class="f-bold c-font-label">Asistente Digitador</label>
                                    </div>
                                    </div>
                                </div> 
                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Nombres y Apellidos</label>
                                        <label class="f-bold c-font-label">___________________________________________________</label>
                                    </div>
                                    </div>
                                </div>     

                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Número de Cédula</label>
                                        <label class="f-bold c-font-label">_________________________________________________________</label>
                                    </div>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12 text-right">
                             <button type="button" id="btnPrintActa"  data-type="Acta_Cierre_'.utf8_encode($rsApertura->fields["NombreAgencia"]).'"  class="btn btn-md button-theme buttons "><span class="lnr lnr-printer"></span> Imprimir</button>
                            </div>
                        </div>

                    </div>
                    </div>';
        echo $htmlActa;
    }


    /// function para generar el html de la Acta de Resultados
    function fnViewActaResultados(){
        date_default_timezone_set("America/Guayaquil");

        session_start();
        
        $o_modelo=new c_model();
        $rsApertura=$o_modelo->fnGetDatosActaAperturaCierre($_SESSION["agencia"]);

        $htmlActa='<div class="row m-t-30">
                            <div class="col-md-12 text-right">
                             <button type="button" id="btnPrintActa" data-type="Acta_Resultados_'.utf8_encode($rsApertura->fields["NombreAgencia"]).'" class="btn btn-md button-theme buttons "><span class="lnr lnr-printer"></span> Imprimir</button>
                            </div>
                        </div> 
                   <div class="dashboard-list m-t-30 " id="divActaPrint">
                    <div class="row ">
                        <div class="col-md-12 p-r-0">
                            <h3 class="heading bg">Acta de Resultados </h3>
                        </div>
                         
                    </div>
                    <div class="dashboard-message contact-2 bdr clearfix">
                        
                        <div class="row">
                        <div class="col-md-8">
                            <div class="form-group name text-justify m-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img style="max-width:150px" src="img/logo_acta.png">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="row">
                               
                                <div class="col-md-12">
                                    <h4 class="heading c-font-label no-border-line">Junta Electoral '.utf8_encode($rsApertura->fields["NombreAgencia"]).' </h4>
                                </div>
                             </div>
                             
                                
                        </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12 text-center">
                                <h4 class="heading c-font-label no-border-line">ACTA DE ESCRUTINIO</h4>
                                
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="heading c-font-label no-border-line">DE VOTOS DE LA ELECCIÓN DE REPRESENTANTES A LA ASAMBLEA GENERAL DE LA '.utf8_encode(strtoupper($rsApertura->fields["empresa_descripcion"])).'</h4>
                                
                            </div>
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    Siendo las   <b>'.date("H:i").'</b> del <b>'.utf8_encode($rsApertura->fields["fechaCierre"]).'</b> en las oficinas de la AGENCIA <b>'.utf8_encode($rsApertura->fields["NombreAgencia"]).'</b>,  se llevó a cabo la elección de representantes para la Asamblea General de la Cooperativa de Ahorro y Crédito "29 de Octubre” Ltda., mediante votación electrónica y para realizar el escrutinio de los votos, se reúnen:______________________________________________________________ Vocal Principal de la Junta Receptora del Voto; y _________________________________________________________ Asistente Digitador.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                Del escrutinio realizado se obtienen los siguientes resultados:
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    En la Junta Electoral <b>'.utf8_encode($rsApertura->fields["NombreAgencia"]).', '.utf8_encode($rsApertura->fields["fechaCierre"]).' </b>siendo las '.date("H:i").' en virtud del reglamento de Elecciones de '.utf8_encode(strtoupper($rsApertura->fields["empresa_descripcion"])).' se presentan los siguientes resultados.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row m-t-80">
                            <div class="col-md-12">
                                <table id="tableResultados" class="display dataTable col-md-12">
                                    <thead>
                                      <tr>
                                        
                                        <th width="40px">Orden</th>
                                       <th width="400px">Nombre del Candidato</th>
                                        <th width="80px">Votos</th>
                                        
                                       
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row m-t-80">
                             <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    <label class="f-bold c-font-label">RELACIÓN DE LAS RECLAMACIONES</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    <label class="f-bold c-font-label">______________________________________________________________________________________________________________________________________________________________</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    <label class="f-bold c-font-label">______________________________________________________________________________________________________________________________________________________________</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    <label class="f-bold c-font-label">______________________________________________________________________________________________________________________________________________________________</label>
                                </div>
                            </div>
                            
                        </div>

                          <div class="row m-t-80">
                             <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    <label class="f-bold c-font-label">OBSERVACIONES Y/O SUGERENCIAS</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    <label class="f-bold c-font-label">______________________________________________________________________________________________________________________________________________________________</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    <label class="f-bold c-font-label">______________________________________________________________________________________________________________________________________________________________</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group name text-justify m-0">
                                    <label class="f-bold c-font-label">______________________________________________________________________________________________________________________________________________________________</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row m-t-80">
                            <div class="row m-t-80">
                            <div class="col-md-6">
                               <div class="row">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">f) ___________________________________________________________</label><br>
                                        <label class="f-bold c-font-label">Vocal Principal</label>
                                       
                                    </div>
                                    </div>
                                </div> 
                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Nombres y Apellidos</label>
                                        <label class="f-bold c-font-label">___________________________________________________</label>
                                    </div>
                                    </div>
                                </div>     

                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Número de Cédula</label>
                                        <label class="f-bold c-font-label">_________________________________________________________</label>
                                    </div>
                                    </div>
                                </div> 

                            </div>
                            <div class="col-md-6">
                                    <div class="row">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                       
                                        <label class="f-bold c-font-label">f) __________________________________________________________</label><br> 
                                        <label class="f-bold c-font-label">Asistente Digitador</label>
                                    </div>
                                    </div>
                                </div> 
                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Nombres y Apellidos</label>
                                        <label class="f-bold c-font-label">___________________________________________________</label>
                                    </div>
                                    </div>
                                </div>     

                                <div class="row m-t-30">
                                   <div class="col-md-12">
                                   <div class="form-group name text-justify m-0">
                                        <label class="f-bold c-font-label">Número de Cédula</label>
                                        <label class="f-bold c-font-label">_________________________________________________________</label>
                                    </div>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        

                    </div>
                    </div>';
        echo $htmlActa;
    }

    /// function para traer los resultados de la agencia y mostrarlo en el acta
    function fnViewBuilTableResultados(){
        session_start();
        $o_model=new c_model();
        $eleccion_guid=$o_model->fnGetEleccionXAgencia($_SESSION['agencia']);

        $rsResultados=$o_model->fnBDDGetVotosCandidatoElec($eleccion_guid);
        $htmlResultados='';
        $i=1;
        /*<td><img style="max-width:80px; max-height:80px" src="data:image/png;base64,'.$rsResultados->fields["opcion_foto"].'"></td>*/
        while(!$rsResultados->EOF){
           $htmlResultados.='<tr>
                                <td>'.$i.'</td>
                                
                                <td>'.utf8_encode($rsResultados->fields["opcion_opcion"]).'</td>
                                <td>'.$rsResultados->fields["votos"].'</td>
                             </tr>';
            $i++;
            $rsResultados->MoveNext();
        }
        echo $htmlResultados;

    }

    // function para obtener la fecha de voto
    function fnViewGetFechaVoto($el_guid, $txtCedula){
        $o_model=new c_model();
        $txtFecha=$o_model->fnBDDGetFechaVoto($el_guid, $txtCedula);
        if($txtFecha==NULL || $txtFecha=="")
            $txtFecha=utf8_decode("Aún no ha votado");

        echo json_encode(array("fecha"=>$txtFecha));
    }

    /// function para controlar el log de actividad en el sistema
    function fnViewLog($txtCedula, $disp_guid, $origen, $accion){
        $o_model=new c_model();
        echo $o_model->fnBDDSetLogs($txtCedula, $disp_guid, "", $origen, $accion);

    }
    /*
    public function fnGetAgencia(){
         // client
        $options= array(
          'location' 	=>	URL_WS,
          'uri'		=>	URL_WS
        );
        $client=new SoapClient(NULL,$options);
        
  
        $response=$client->AgenciaGet();
        echo $response;
    }
    */
    /// function para leer el archivo css
    public function fnGetCSS(){
        $strCss='';
        $file = fopen("../css/custom.css", "r");
        while(!feof($file))
        {
        $strCss.=fgets($file);
        }
        fclose($file);
        $array_css=explode("/**/",$strCss);
        $array_etiquetas=[".bg, input:checked",
            ".c-font-label", 
            ".dashboard-nav ul li a:hover", 
            ".dashboard-nav ul li.active, .dashboard-nav ul li:hover",
            ".tab-box-2 .nav-pills .nav-link.active, .nav-pills .show>.nav-link"];
        $json_css=array();
        for($i=0;$i<count($array_css);$i++){
            for($j=0;$j<count($array_etiquetas);$j++){
               
                   
                               
                                if(strpos($array_css[$i], $array_etiquetas[$j])!== false){
                                    $css=explode("{",$array_css[$i]);
                                    $elements_css=explode(";",$css[1]);
                                    for($k=0;$k<count($elements_css)-1;$k++){
                                            $valores=explode(":",$elements_css[$k]);
                                            $outimportant=explode("!", $valores[1]);
                                            //echo $valores[0]."----".$outimportant[0];
                                            
                                            array_push($json_css, array("css"=>$array_etiquetas[$j], "atributo"=>trim($valores[0]),"valor"=>trim($outimportant[0])));
                                    }
                                }
                                
                   
               
                
            }    
            
        }
        echo json_encode($json_css);
       //return $strCss;
    }
    
    ///function para grabar los datos de la entidad
    function fnSaveEntidad($array_css, $agencia_id, $agencia_descripcion, 
                           $agencia_direccion, $agencia_telefono, 
			   $agencia_correo, $agencia_identificacion, 
			   $agencia_logo, $agencia_info_adicional, $agencia_css, $agencia_estado){
        session_start();
        //print_r($array_css);
        $this->fnEditaCss($array_css);
        
         $options= array(
          'location' 	=>	URL_WS,
          'uri'		=>	URL_WS
        );
        $client=new SoapClient(NULL,$options);
                                                           
        $response=$client->AgenciaPut($_SESSION["agencia_id"], $agencia_descripcion, 
                                      $agencia_direccion, $agencia_telefono, 
				      $agencia_correo, $agencia_identificacion, 
                                      $agencia_logo, $agencia_info_adicional, 
                                      $agencia_css, $agencia_estado);
        print_r($response);
        //echo json_encode(array("flag"=>1, "mensaje"=>"Se ha actualizado la información"));
        
    }
    
    //function que edita el css
    function fnEditaCss($array_css){
        $etiqueta='';
        $strCSS='';
        $array_css=json_decode($array_css);
        //echo count($json);
        //recho $json[0]->css;
        for($i=0;$i<count($array_css);$i++){
            if($etiqueta!=$array_css[$i]->css){
                $strCSS.=$array_css[$i]->css."{".PHP_EOL;
            }
            $strCSS.=$array_css[$i]->attribute.":".$array_css[$i]->valor."!important;".PHP_EOL;
            $etiqueta=$array_css[$i]->css;
            if(($i+1)<count($array_css) && $etiqueta!=$array_css[$i+1]->css){
                $strCSS.="}".PHP_EOL."/**/";
            }
        }
        $strCSS.="}".PHP_EOL."/**/";
        
        
        for($i=0;$i<count($array_css);$i++){
            if(isset($array_css[$i]->extracss)!="")
                $strCSS.=$array_css[$i]->extracss."{".PHP_EOL.$array_css[$i]->extraatribute.":".$array_css[$i]->valor."!important;}".PHP_EOL."/**/";
        }
       // echo $strCSS;
        $file = fopen("../css/custom.css", "w");
        fwrite($file, $strCSS. PHP_EOL);
        fclose($file);
    }
   



    // generar guid
    function createGUID() { 
    
    // Create a token
    $token      = $_SERVER['HTTP_HOST'];
    $token     .= $_SERVER['REQUEST_URI'];
    $token     .= uniqid(rand(), true);
    
    // GUID is 128-bit hex
    $hash        = strtoupper(md5($token));
    
    // Create formatted GUID
    $guid        = '';
    
    // GUID format is XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX for readability    
    $guid .= substr($hash,  0,  8) . 
         '-' .
         substr($hash,  8,  4) .
         '-' .
         substr($hash, 12,  4) .
         '-' .
         substr($hash, 16,  4) .
         '-' .
         substr($hash, 20, 12);
            
    return $guid;
    }

    

    public static function Utf8_ansi($valor='') {

    $utf8_ansi2 = array(
    "u00c0" =>"À",
    "u00c1" =>"Á",
    "u00c2" =>"Â",
    "u00c3" =>"Ã",
    "u00c4" =>"Ä",
    "u00c5" =>"Å",
    "u00c6" =>"Æ",
    "u00c7" =>"Ç",
    "u00c8" =>"È",
    "u00c9" =>"É",
    "u00ca" =>"Ê",
    "u00cb" =>"Ë",
    "u00cc" =>"Ì",
    "u00cd" =>"Í",
    "u00ce" =>"Î",
    "u00cf" =>"Ï",
    "u00d1" =>"Ñ",
    "u00d2" =>"Ò",
    "u00d3" =>"Ó",
    "u00d4" =>"Ô",
    "u00d5" =>"Õ",
    "u00d6" =>"Ö",
    "u00d8" =>"Ø",
    "u00d9" =>"Ù",
    "u00da" =>"Ú",
    "u00db" =>"Û",
    "u00dc" =>"Ü",
    "u00dd" =>"Ý",
    "u00df" =>"ß",
    "u00e0" =>"à",
    "u00e1" =>"á",
    "u00e2" =>"â",
    "u00e3" =>"ã",
    "u00e4" =>"ä",
    "u00e5" =>"å",
    "u00e6" =>"æ",
    "u00e7" =>"ç",
    "u00e8" =>"è",
    "u00e9" =>"é",
    "u00ea" =>"ê",
    "u00eb" =>"ë",
    "u00ec" =>"ì",
    "u00ed" =>"í",
    "u00ee" =>"î",
    "u00ef" =>"ï",
    "u00f0" =>"ð",
    "u00f1" =>"ñ",
    "u00f2" =>"ò",
    "u00f3" =>"ó",
    "u00f4" =>"ô",
    "u00f5" =>"õ",
    "u00f6" =>"ö",
    "u00f8" =>"ø",
    "u00f9" =>"ù",
    "u00fa" =>"ú",
    "u00fb" =>"û",
    "u00fc" =>"ü",
    "u00fd" =>"ý",
    "u00ff" =>"ÿ");

    return strtr($valor, $utf8_ansi2);      

}


    function searchArrayKeyVal($sKey, $id, $array) {
       foreach ($array as $key => $val) {
           if ($val[$sKey] == $id) {
               return $key;
           }
        }
       return false;
    }


}
