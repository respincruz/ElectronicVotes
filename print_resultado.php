<?php
$_REQUEST['agencia_id'];
 include("html2pdf/html2pdf.class.php");
 require("clases/c_model.php");
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
        ?>