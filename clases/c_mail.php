<?php
require("c_model.php");

define("URLPATH","http://cyberhack-ec.com/votaciones/");

function fnMailConvocatoria(){
        
        //echo $txtNombre;
        require('../PHPMailer/class.phpmailer.php');

        $o_model=new c_model();
        $rs=$o_model->fnAsambleasActivasXMail();
      

        $body             = file_get_contents('../email_template/index.html');
        //$body             = preg_replace("[\]",'',$body);

        //$body="XXX";
        

       /* $body=str_replace( "||CLIENTE||", utf8_decode($txtCliente), $body );
        $body=str_replace( "||CORREO||", utf8_decode($txtCorreoCliente), $body );
    
        $body=str_replace( "||TITULO||", utf8_decode($txtTitulo), $body );
        $body=str_replace( "||CANTIDAD||",$txtCantidad, $body );
        $body=str_replace( "||PRECIO||",$txtPrecio, $body );*/
        while(!$rs->EOF){
              

                $rsArchivos=$o_model->fnFilesConvocatoria($rs->fields["convocatoria_id"]);
                //echo $rs->fields["asamblea_descripcion"];
                $html_archivos='';
                while(!$rsArchivos->EOF){

                    $html_archivos.='<tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td valign="middle" width="70%" style="text-align:left; padding: 0 2.5em;">
                                <div class="product-entry" style="    display: block;
                                    position: relative;
                                    float: left;
                                    padding-top: 20px;">
                                                                    
                                                                    <div class="text">
                                                                        <h3 style="font-family: Work Sans, sans-serif;
                                    color: #000000;
                                    margin-top: 0;
                                    font-weight: 400; margin-bottom: 0;
                                    padding-bottom: 0; margin-bottom: 0;
                                    padding-bottom: 0;">'.$rsArchivos->fields["archivo_convocatoria_nombre"].'</h3>
                                                                        
                                                                        <p style="margin-top: 0;">'.$rsArchivos->fields["archivo_convocatoria_descripcion"].'</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td valign="middle" width="30%" style="text-align:center; padding-right: 2.5em;">
                                                                
                                                                <span><a href="#" class="btn btn-primary" style="padding: 3px 10px;
                                    display: inline-block; border-radius: 5px;
                                    background: #f34949;
                                    color: #ffffff; text-decoration: none;">Descargar</a></span>
                                                            </td>
                          </tr>';
                          $rsArchivos->MoveNext();
                }
                
                $rsUsuarios=$o_model->fnFindParticipantesXAsamblea($rs->fields["asamblea_id"]);
                $i=0;
                while(!$rsUsuarios->EOF){
                        $body             = file_get_contents('../email_template/index.html');

                        $body=str_replace( "||ASAMBLEA||", utf8_decode($rs->fields["asamblea_descripcion"]), $body );
                        $body=str_replace( "||CONVOCATORIA||", utf8_decode($rs->fields["convocatoria_descripcion"]), $body );
                    
                        $body=str_replace( "||IMAGEN||", $rs->fields["agencia_logo"], $body );
                        $body=str_replace( "||URL||",URLPATH, $body );
                        $password=substr($rsUsuarios->fields["usuario_id"], 11,5);
                       
                        $body=str_replace( "||PASSWORD||",$password, $body );    
                        $body=str_replace( "||ID||",$rsUsuarios->fields["quorum_id"], $body ); 
                       // echo $password."<br>";
                        $o_model->fnActualizaPassword(md5($password),$rsUsuarios->fields["usuario_id"] );
                        $body=str_replace("||HTML_ARCHIVOS||", $html_archivos, $body);
                      //$mail->AddReplyTo($rsUsuarios->fields["usuario_correo"], $rsUsuarios->fields["usuario_nombres"]." ".$rsUsuarios->fields["usuario_apellidos"]);
                        $mail             = new PHPMailer(); // defaults to using php "mail()"
                        $mail->SetFrom("testvotaciones@cyberhack-ec.com", "Sistema de Asambleas");


                        //$mail->AddReplyTo("name@yourdomain.com","First Last");
                        //echo $rsUsuarios->fields["usuario_correo"];
                        //$address = $txtCorreoPropietario;
                        $mail->AddAddress($rsUsuarios->fields["usuario_correo"], $rsUsuarios->fields["usuario_nombres"]." ".$rsUsuarios->fields["usuario_apellidos"]);

                        $mail->Subject    = "Convocatoria Asamblea";

                        //$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

                        $mail->MsgHTML($body);
                       
                        $mail->Send();
                         $i++;
                    $rsUsuarios->MoveNext();
                }


               //$body=str_replace( "||PASSWORD||",$txtCantidad, $body );
                /*$body=str_replace( "||PRECIO||",$txtPrecio, $body );*/

            $rs->MoveNext();
        }


    }
fnMailConvocatoria();
?>