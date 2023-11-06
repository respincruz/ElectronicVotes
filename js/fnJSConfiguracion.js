/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   fnGetAsambleas(); 
     $('.form_datetime').datetimepicker({
                 format: 'yyyy-mm-dd hh:ii'
             });

           
      
});




//function para traer las asambleas
function fnGetAsambleas(){
     $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnViewAsambleas"
    		  },
           type: 'POST',
        dataType: 'html',
        cache:false        
    }).done(function(data){
    $("#tabAsambleasPendientes").html(data);    
    });
}

$(document).on("click", "#btnGrabarAsamblea", "", function(){
    if(fnValidaCampos($("#txtAsamblea"), "Debe ingresar el nombre de la Asamblea")==0){
        return 0;
    }
     $("#txtAsamblea").removeClass("border-error");
   
    
    if(fnValidaCampos($("#txtFechaInicio"), "Debe ingresar la Fecha de Inicio de la Asamblea")==0){
        return 0;
    }
    
    $("#txtFechaInicio").removeClass("border-error");
    var fechaActual=moment().format('YYYY-MM-DD HH:mm');
    
     var fechaInicio=$("#txtFechaInicio").val();
    
    if(moment($.trim(fechaInicio)).isBefore(fechaActual)){
    	alertas("La Fecha de Inicio de la Asamblea no puede ser menor a la Actual", "error");
        return false;
    }
     $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnSetAsamblea",
               "hCodAsamblea":$("#hCodAsamblea").val(),
                "agencia_id":"", 
                "txtAsamblea":$("#txtAsamblea").val(),
                "txtFechaInicio":$("#txtFechaInicio").val(),  
                "intQuorum":0,
                "txtFechaCierre":"",
                "BooleanEstado":"A"
    		  },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
        if(data.ESTADO==1){
            tipo="success";
            $("#hCodAsamblea").val(data.MENSAJE.split(",")[1]);
            ChangeTabsConf();
        }
        else
            tipo="error";
        alertas(data.MENSAJE.split(",")[0],tipo);
    });
    
})




///function para subir los archivos excel
$(document).on("change",".fileDocs", "", function(){
    var tipo=$(this).data("tipo");
     var data = new FormData();
     var array_archivos=[];
     data.append('file[]',  $(this)[0].files[0]);
     //console.log($("input[type=file].fileExcel")[0].files[0].name);
     array_archivos.push({ 
                 
                                   "name_file":$(this)[0].files[0].name
                                });
     data.append("array_archivos",  JSON.stringify(array_archivos));
     data.append("hCodAsamblea", $("#hCodAsamblea").val());
     data.append("tipo", $(this).data("tipo"));
     var retorno='';
     switch(tipo){
      case "quorum": retorno="html";
      break;
      case "convocatoria": retorno="json";
      break;
     }
       $.ajax({ 
            url: 'hub/filearchivos.php',  
            type: 'POST', 
            data: data,
           
          contentType: false, 
          processData: false, 
          dataType: retorno,
          }).done(function(data){
              if(data){
                  alertas("Documento subido","success");
              }
              switch(tipo){
                  case "quorum":  $("#divQuorum").removeClass("hidden");
                                  $("#tableQuorum >tbody").html(data);
                  break;
                  case "convocatoria": $("#hNameFile").val(data.file);
                  break;
              }
             
          })
          
})

///eliminar participantes el quorum
$(document).on("click", ".btnDeleteQuorum","", function(){
    fila=$(this).parent().parent();
    var n = noty({
            text        : 'Desea eliminar al participante del quorum?',
            type        : 'confirm',
           
            layout      : "center",
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-danger', text: 'Eliminar', onClick: function ($noty) {
                   
                   $(fila).remove();
                    $noty.close();
                    
                }
                },
                {addClass: 'btn btn-primary', text: 'Cancelar', onClick: function ($noty) {
                    $noty.close();
                   

                }
                }
            ]
        });
})

///function para guardar las personas participantes de la asamblea
$(document).on("click", "#btnAddQuorum", "", function(){
    var array_participantes=[];
    $("#tableQuorum >tbody >tr").each(function(){
     if($(this).find(".chkVotante:checked").length){
        array_participantes.push({ 
                                
                                "usuario_nombres":$(this).find(".tdNombres").text(),
                                "usuario_apellidos": $(this).find(".tdApellidos").text(),
                                "usuario_identificacion": $(this).find(".tdCedula").text(),
                                "usuario_correo": $(this).find(".tdCorreo").text()
                 
                                });
                            }
    });     
     //console.dir(array_participantes);

     $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnSetUsuarioQuorum",
                "array_quorum":array_participantes,
                "asamblea_id":$("#hCodAsamblea").val()
    		  },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
        alertas(data.mensaje, data.ESTADO);
    });

//$.ajax({
//      url: 'hub/hub.php',
//        data: { "funcion": "fnSendMail",
//                "from":"",
//                "subject":"",
//                "to":"",
//                "password":""
//    		  },
//           type: 'POST',
//        dataType: 'json',
//        cache:false        
//    }).done(function(data){
//    
//    })
})

/// function para guardar la convocatoria
$(document).on("click", "#btnGrabarConvocatoria", "", function(){
     if(fnValidaCampos($("#txtConvocatoria"), "Debe ingresar el nombre de la Convocatoria")==0){
        return 0;
    }
     $("#txtConvocatoria").removeClass("border-error");
   
    if(fnValidaCampos($("#txtDescripcionConvocatoria"), "Debe ingresar la Descripción/Motivo de la Convocatoria")==0){
        return 0;
    }
     $("#txtDescripcionConvocatoria").removeClass("border-error");
    
    if(fnValidaCampos($("#txtFechaConvocatoria"), "Debe ingresar la Fecha de Envio de la Convocatoria")==0){
        return 0;
    }
    
    $("#txtFechaConvocatoria").removeClass("border-error");
    var fechaActual=moment().format('YYYY-MM-DD HH:mm');
    
     var fechaInicio=$("#txtFechaConvocatoria").val();
    
    if(moment($.trim(fechaInicio)).isBefore(fechaActual)){
    	alertas("La Fecha de Envió de la Convocatoria no puede ser menor a la Actual", "error");
        return false;
    }
    if($("#tableArchivos > tbody > tr").length<1){
        alertas("Debe al menos subir un archivo", "error");
        return false;
    }
    var array_archivos=[];
    $("#tableArchivos > tbody > tr").each(function(){
            if($(this).find(".btnDown").data("srchref").split("/")[1]===undefined)
                archivofisico=0;
            else
                archivofisico=$(this).find(".btnDown").data("srchref").split("/")[1];
            array_archivos.push({ 
            "nombreFile":$(this).find(".tdNombreFile").text(),
            "descripcionFile":$(this).find(".tdDescripcionFile").text(),
            "archivofisico":archivofisico
         });
        
    });
    //console.dir(array_archivos);
    
    $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnSetConvocatoria",
                  "asamblea_id":$("#hCodAsamblea").val(),
                  "txtConvocatoria":$("#txtConvocatoria").val(),
                  "txtDescripcionConvocatoria":$("#txtDescripcionConvocatoria").val(), 
                  "txtFechaConvocatoria":$("#txtFechaConvocatoria").val(),
                  "hCodConvocatoria":$("#hCodConvocatoria").val(),
                  "array_files":array_archivos
    		  },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
        $("#hCodConvocatoria").val(data.id_convocatoria);
            alertas(data.mensaje, data.ESTADO);
    });
});



/// function para agregar archivos
$(document).on("click", "#btnAddFile", "", function(){
     if(fnValidaCampos($("#txtArchivo"), "Debe ingresar el nombre del Archivo")==0){
        return 0;
    }
     $("#txtArchivo").removeClass("border-error");
    
     if(fnValidaCampos($("#txtDescripcionArchivo"), "Debe ingresar la Descripción del Archivo")==0){
        return 0;
    }
     $("#txtDescripcionArchivo").removeClass("border-error");
    
    if($("#fileConvocatoria").val()===""){
        alertas("Debe subir un archivo", "error");
        return 0;
    }
    var nfiles=$("#tableArchivos > tbody > tr").length+1;
     $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnAddFile",
                 "txtArchivo":$("#txtArchivo").val(),
                 "txtDescripcionArchivo":$("#txtDescripcionArchivo").val(),
                 "nombre_archivo":$("#hNameFile").val(),
                 "nfile":nfiles
    		  },
           type: 'POST',
        dataType: 'html',
        cache:false        
    }).done(function(data){
        $(data).appendTo($("#tableArchivos > tbody"));
        $("#txtArchivo").val('');
        $("#txtDescripcionArchivo").val(''),
        $("#hNameFile").val('');
        $("#fileConvocatoria").val('');
    });
});

//eliminar fila de archivo
$(document).on("click", ".btnDeleteFile", "", function(){
    var fila=$(this).parent().parent();
    var id_archivo=$(fila).attr("id");
    var n = noty({
            text        : 'Desea eliminar este archivo de la Convocatoria?',
            type        : 'confirm',
           
            layout      : "center",
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-danger', text: 'Eliminar', onClick: function ($noty) {
                    $.ajax({
                        url: 'hub/hub.php',
                        data: { "funcion": "fnDeleteFile",
                                 "id_archivo":id_archivo
                                  },
                           type: 'POST',
                        dataType: 'json',
                        cache:false        
                    }).done(function(data){
                            $(fila).remove();
                             $noty.close();
                             if(data.ESTADO==1)
                                alertas("El Archivo ha sido eliminado", "success")
                             else
                                alertas("El Archivo no puede ser eliminado", "success")
                         });
                     
                    
                }
                },
                {addClass: 'btn btn-primary', text: 'Cancelar', onClick: function ($noty) {
                    $noty.close();
                   

                }
                }
            ]
        });
})



// function para registrar la asistencia de los participantes
$(document).on("click", "#btnRegisterAsistencia", "", function(){
    var array_asistentes=[];
    $(".chkPresente").each(function(){ 
      var flag='';
      if($(this).prop("checked"))
        flag=true;
      else
        flag=false;
      
        array_asistentes.push({"quorum_id":$(this).parent().parent().attr("id"),
                              "quorum_presente":flag});
    })

    //console.dir(array_asistentes);
     $.ajax({
            url: 'hub/hub.php',
            data: { "funcion": "fnGrabarAsistencia",
                   "array_quorum":array_asistentes
                  },
            type: 'POST',
            dataType: 'json',
            cache:false
             }).done(function(data){
               alertas(data.mensaje,data.ESTADO);
             });

    

  // QuorumPut($ic_quorum_id,
  //               $ic_codigo_usuario_id,
  //               $ic_codigo_asamblea_id,
  //               $ib_quorum_presente,
  //               $ib_quorum_confirmacion,
  //               $id_quorum_fecha_confirmacion,
  //               $ic_quorum_estado)

})

//function para recuperar los formularios por asamblea

//funcion para desaparecer la lista de formularios y crear uno nuevo
$(document).on("click", "#btnNewReferendum", "", function(){
    $("#divListaReferendums").addClass("hidden");
    $("#divEdicionReferendum").removeClass("hidden");
    $(this).addClass("hidden");
    $("#btnCancelReferendum").removeClass("hidden");
})


//function para editar el referendum
$(document).on("click", ".btnEditFormulario", "", function(){
    $("#divListaReferendums").addClass("hidden");
    $("#divEdicionReferendum").removeClass("hidden");
    $("#txtReferendum").val($(this).parent().parent().find(".tdNombreForm").text());
    $("#hCodReferendum").val($(this).parent().parent().attr("id"));
     $("#btnCancelReferendum").removeClass("hidden");
     $("#btnNewReferendum").addClass("hidden");
    fnLoadPreguntas();
    
})
//function para validar y agregar preguntas a un formulario
$(document).on("click", "#btnAddQuestion", "", function(){
    if(fnValidaCampos($("#txtPregunta"), "Debe ingresar la pregunta")==0){
        return 0;
    }
     $("#txtPregunta").removeClass("border-error");
    if($("#cmbTipoRespuesta").val()=="*"){
        alertas("Debe seleccionar una opción de respuesta","error");
        $("#cmbTipoRespuesta").addClass("border-error");
        return 0;
    } 
    $("#cmbTipoRespuesta").removeClass("border-error");
    var array_opciones=[];
    switch($("#cmbTipoRespuesta").val()){
        case "checkbox":
        case "select": if($("#tableValores > tbody").find("tr").length<2){
                                alertas("Debe elegir al menos 2 opciones", "error");
                                return 0;
                            }
                            else{
                                $("#tableValores > tbody").find("tr").each(function(){
                                    array_opciones.push({"opcion":$(this).find(".tdOpcion").text()});
                                });
                                
                            }
                
        break;
    
    }
    //console.dir(array_opciones);
    $.ajax({
            url: 'hub/hub.php',
            data: { "funcion": "fnAddQuestion",
                    "Pregunta":$("#txtPregunta").val(),
                    "opciones":array_opciones,
                    "tipo":$("#cmbTipoRespuesta").val()
                  },
            type: 'POST',
            dataType: 'html',
            cache:false
             }).done(function(data){
                  $(data).appendTo("#divZonaConfPreguntas");
                  $('.selectpicker').selectpicker();
                  $("#tableValores > tbody").html('');
                  $("#txtPregunta").val('');
             });
    
})

//f¿ function para mostrar u ocultar la tabla de opciones respuesta
$(document).on("change","#cmbTipoRespuesta","", function(){
    switch($(this).val()){
        case "checkbox":
        case "select": $("#divOpciones").removeClass("hidden");
        break;
        case "texto":   $("#divOpciones").addClass("hidden");
        break;
    }
})

// function para agreagar las opciones de respuesta
$(document).on("click","#btnAddOption", "", function(){
    if(fnValidaCampos($("#txtOpcion"), "Debe ingresar la opción")==0){
        return 0;
    }
     $("#txtOpcion").removeClass("border-error");
    var nelementos=$("#tableValores > tbody").find("tr").length;
     $("#txtOpcion").removeClass("border-error");
      $.ajax({
            url: 'hub/hub.php',
            data: { "funcion": "fnAddOpcion",
                    "opcion":$("#txtOpcion").val(),
                    "nelementos":nelementos
                  },
            type: 'POST',
            dataType: 'html',
            cache:false
             }).done(function(data){
                 $(data).appendTo("#tableValores > tbody");
                 $("#txtOpcion").val('');
             });
});

/// function para quitar preguntas del referendum
$(document).on("click", ".btnDelAsk","", function(){
    var fila=$(this).parent().parent();
    var id_campo=$(fila).attr("id");
     var n = noty({
            text        : 'Desea eliminar esta pregunta?',
            type        : 'confirm',
           
            layout      : "center",
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-danger', text: 'Eliminar', onClick: function ($noty) {
                  if(id_campo!==undefined){
                    $.ajax({
                        url: 'hub/hub.php',
                        data: { "funcion": "fnDeleteQuestion",
                                 "id_pregunta":id_campo,
                                 "id_referendum":$("#hCodReferendum").val()
                                  },
                           type: 'POST',
                        dataType: 'json',
                        cache:false        
                    }).done(function(data){
                            $(fila).remove();
                             $noty.close();
                             if(data.ESTADO==1)
                                alertas("La pregunta ha sido eliminada", "success")
                             else
                                alertas("La pregunta no puede ser eliminada", "error")
                        });
                  }
                  else{
                     $(fila).remove();
                      $noty.close();
                      alertas("La pregunta ha sido eliminada", "success")
                  }

                     
                    
                }
                },
                {addClass: 'btn btn-primary', text: 'Cancelar', onClick: function ($noty) {
                    $noty.close();
                   

                }
                }
            ]
        });
})

//funcion para eliminar opciones de respuesta
$(document).on("click", ".btnDelOpcion", "", function(){
    var fila=$(this).parent().parent();
    var n = noty({
            text        : 'Desea eliminar la Opción de Respuesta?',
            type        : 'confirm',
           
            layout      : "center",
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-danger', text: 'Eliminar', onClick: function ($noty) {
                    
                            $(fila).remove();
                             $noty.close();
                      }
                  },
                {addClass: 'btn btn-primary', text: 'Cancelar', onClick: function ($noty) {
                    $noty.close();
                   

                }
                }
            ]
        });
})

function moveUp(element) {
  if(element.previousElementSibling)
    element.parentNode.insertBefore(element, element.previousElementSibling);
}
function moveDown(element) {
  if(element.nextElementSibling)
    element.parentNode.insertBefore(element.nextElementSibling, element);
}

document.querySelector('#divZonaConfPreguntas').addEventListener('click', function(e) {
  if(e.target.className === 'down') moveDown(e.target.parentNode.parentNode);
  else if(e.target.className === 'up') moveUp(e.target.parentNode.parentNode);
});

// function para agregar referendums
$(document).on("click", "#btnAddReferendum", "", function(){
    if(fnValidaCampos($("#txtReferendum"), "Debe ingresar el nombre del Referendum")==0){
        return 0;
    }
     $("#txtReferendum").removeClass("border-error");
     if($(".divAsk").length<1){
         alertas("Debe ingresar al menos una pregunta", "error");
     }
     var array_preguntas=[];
     $(".divAsk").each(function(){
          var array_option=[];
          control=$(this).find("input,select").attr("type");
          switch($(this).find("input,select").attr("type")){
              case "text":
              break;
              case "select": $(this).find(control).find("option").each(function(){
                                array_option.push({"opcion":$(this).text()})
              });
              break;
              case "checkbox": $(this).find("input[type=checkbox].chkOpcion").each(function(){
                                    array_option.push({"opcion":$(this).parent().text()});
                                }); 
                break;
              }
             
       
          array_preguntas.push({"pregunta":$(this).find(".lblPregunta").text(),
                                "tipo":$(this).find("input,select").attr("type"),
                                "opciones":array_option,
                                "id":$(this).attr("id"),
                                "estado":$(this).find(".chkActivo").prop("checked")});
     });
     //console.dir(array_preguntas);
     $.ajax({
            url: 'hub/hub.php',
            data: { "funcion": "fnSetReferendum",
                    "txtReferendum":$("#txtReferendum").val(),
                    "array_preguntas":array_preguntas,
                    "id_asamblea":$("#hCodAsamblea").val(),
                    "id_referendum":$("#hCodReferendum").val()
                  },
            type: 'POST',
            dataType: 'json',
            cache:false
             }).done(function(data){
                 alertas(data.mensaje, data.tipo);
                 fnLoadPreguntas();
             })
})


function fnLoadPreguntas(){
   $.ajax({
            url: 'hub/hub.php',
            data: { "funcion": "fnViewPreguntas",
                    "id_referendum":$("#hCodReferendum").val()
                  },
            type: 'POST',
            dataType: 'html',
            cache:false
             }).done(function(data){
                 $("#divZonaConfPreguntas").html(data);
                  $('.selectpicker').selectpicker();
             })
}
//function para eliminar formularios
$(document).on("click", ".btnDeleteFormulario", "", function(){
    fila=$(this).parent().parent();
    var id_referendum=$(this).parent().parent().attr("id");
    var n = noty({
            text        : 'Desea eliminar el referendum?',
            type        : 'confirm',
           
            layout      : "center",
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-danger', text: 'Eliminar', onClick: function ($noty) {
                   
                   $(fila).remove();
                    $noty.close();
                     $.ajax({
                        url: 'hub/hub.php',
                        data: { "funcion": "fnDeleteReferendum",
                                
                                 "id_referendum":id_referendum
                                  },
                           type: 'POST',
                        dataType: 'json',
                        cache:false        
                    }).done(function(data){
                    });
                    }
                    
                },
                {addClass: 'btn btn-primary', text: 'Cancelar', onClick: function ($noty) {
                    $noty.close();
                   

                }
                }
            ]
        });
})