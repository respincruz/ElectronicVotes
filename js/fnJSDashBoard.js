$(document).ready(function(){
	fnGetEmpresa();	
    fnGetMenu(localStorage.getItem("perfil"));
    fnPermaneceActivaSesion();
    $.getJSON('https://api.ipify.org?format=json', function(data){
    console.log(data.ip);
});
});
   
 

function fnPermaneceActivaSesion(){
    setInterval(function(){
       $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnSetSessionActiva",
                
              },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){

        if(data.agencia_sesion)
            console.log(data.agencia_sesion)
        else
            document.location.href="index.php";
    })
    },180000);
}


/// function para construir el menu
function fnGetMenu(perfil){
     $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnBuildMenu",
                "nombre_perfil":perfil
              },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
       $("#h4Perfil").text(data.Name_Menu);
       $("#menuPerfil").html(data.htmlMenu);
       
    });
    
}

/// function para dibujar los contenidos de acuerdo al menu
$(document).on("click", "#menuPerfil>li", "", function(){
    var funcion=$(this).data("funcion");
    var nameMenu=$(this).text();
    fnCallFunction(funcion,nameMenu);
    /* $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": funcion
              },
           type: 'POST',
        dataType: 'html',
        cache:false        
    }).done(function(data){
       $("#h4Title").text(nameMenu);
       $("#divContenido").html(data);
         
       //$("#menuPerfil").html(data.htmlMenu);
       
    });*/
})


function fnControlaTiempo(agencia_id){
    console.log(agencia_id);
    $.ajax({
         url: 'hub/hub.php',
        data: { "funcion": "fnViewControlaTiempo",
                "agencia_id":agencia_id
            
        },
        type: 'POST',
        
        dataType: "json",
        cache:false, 
        async:false
    }).done(function(data){ 
        //console.dir(data);
        localStorage.setItem("flag_permiso",data.flag);
        localStorage.setItem("mensaje", data.mensaje);
        localStorage.setItem("type",data.type);
    });
}

function fnCallFunction(funcion,nameMenu){
    
    if(funcion!="")
      $.ajax({
         url: 'hub/hub.php',
        data: { "funcion": funcion
            
        },
        type: 'POST',
        
        dataType: "html",
        cache:false,
        async:false
    }).done(function(data){  
       $("#h4Title").text(nameMenu);
       $("#divContenido").html(data);
     
       switch(funcion){
        case "fnViewPadronLista":  fnViewTables(true);
        break;
        case "fnViewPadronTotal":  fnViewTables(false);
        break;
        case "fnViewPapeleta":  
                                $.LoadingOverlaySetup({
                                    background      : "rgba(255, 255, 255, 0.8)",
                                    image           : "img/logo29big.png",
                                    imageAnimation:"",
                                    imageColor      : "#202020", 
                                    hideafter:"5000"
                                });

                                $.LoadingOverlay("show");

                                // Hide it after 3 seconds
                                setTimeout(function(){
                                    $.LoadingOverlay("hide");
                                }, 500*6);


                                fnViewPapeleta();
        break;
        case "fnViewBuildHistorial": fnViewBuildHistorial();
        break;
        case "fnViewResultados": fnViewResultados();
        break;
        case "fnViewReportAgencia": fnViewReportAgencia();
        break;
        case "fnViewActaResultados": fnViewBuilTableResultados();

        break;
       }
    });
}


/// function para pintar los resultados en el acta de Resultados
function fnViewBuilTableResultados(){
      $.ajax({
         url: 'hub/hub.php',
        data: { "funcion": "fnViewBuilTableResultados"
            
        },
        type: 'POST',
        
        dataType: "html",
        cache:false,
        async:false
    }).done(function(data){  
        
        fnControlaTiempo( localStorage.getItem("id_agencia"));
        if( localStorage.getItem("flag_permiso")=="true"){
            alertas("La elección aún no termina. No se pueden ver los resultados hasta el final de la elección", "error");
            $("#tableResultados > tbody").html('');
            return false;
        }
        $("#tableResultados > tbody").html(data);
    });


}


function fnViewReportAgencia(){
    $.ajax({
         url: 'hub/hub.php',
        data: { "funcion": "fnLoadAusentismoVsSufragio",
                
            
        },
        type: 'POST',
        
        dataType: "json",
        cache:false
    }).done(function(data){ 
            $("#tableResultados > tbody").html(data.html);
            new Chart(document.getElementById("jsChartAgencia"), {
            type: 'bar',
            data: {
              labels: data.dataLabelAgencia,
              datasets: [
                {
                  label: "Empadronados",
                  backgroundColor: "#3e95cd",
                  data: data.dataEmpadronados
                }, {
                  label: "Sufragios",
                  backgroundColor: "#8e5ea2",
                  data: data.dataSufragios
                }
              ]
            },
            options: {
              title: {
                display: true,
                text: 'Reporte de Ausentismo vs Sufragio'
              }
            }
        });
        });
}

//function para refrescar estilos de resultados
function fnViewResultados(){
  $('.selectpicker').selectpicker();
  $('#cmbAgencia').selectpicker('refresh');

} 
/// cuando modifico la Agencia invoco a los resultados
$(document).on("change", "#cmbAgencias", "", function(){
    $("#tableResultados").removeClass("d-none");
    $("#jsChart").removeClass("d-none");
    
    var agencia_id=$(this).val();

    fnControlaTiempo(agencia_id);
    if( localStorage.getItem("flag_permiso")=="true"){
        alertas("La elección aún no termina. No se pueden ver los resultados hasta el final de la elección", "error");
        return false;
    }

    $("#btnPrintTable").removeClass("d-none");
    $.ajax({
         url: 'hub/hub.php',
        data: { "funcion": "fnViewResultadosXAgencia",
                "agencia_id":agencia_id
            
        },
        type: 'POST',
        
        dataType: "json",
        cache:false
    }).done(function(data){ 
        $("#btnPrintActa").removeClass("d-none");
        $("#tableResultados > tbody").html(data.table);
        var xValues =data.x;
        var yValues = data.y;
        var barColors = data.color;
        $("#divCanvas").html('');
       // $("#jsChart").parent().find(".chartjs-size-monitor").remove();

        $('#divCanvas').html('<canvas id="jsChart"  style="width:100%;"></canvas>');

        var ctx = document.getElementById('jsChart').getContext('2d');
     
        
        jsChart=new Chart("jsChart", {
          type: "bar",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            legend: {display: false},
            title: {
              display: true,
              text: "Resultados"
            }
          }
        });



    })

})

//function para refrescar la papeleta 
$(document).on("click", "#btnRefresh", "", function(){
    fnCallFunction("fnViewPapeleta","Voto Electrónico");
})


function fnViewBuildHistorial(){
    var xyValues = [
  {x:50, y:7},
  {x:60, y:8},
  {x:70, y:8},
  {x:80, y:9},
  {x:90, y:9},
  {x:100, y:9},
  {x:110, y:10},
  {x:120, y:11},
  {x:130, y:14},
  {x:140, y:14},
  {x:150, y:15}
];

new Chart("myChart", {
  type: "scatter",
  data: {
    datasets: [{
      pointRadius: 4,
      pointBackgroundColor: "rgb(0,0,255)",
      data: xyValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      xAxes: [{ticks: {min: 40, max:160}}],
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
}


$(document).on("click", "#btnPrintTable", "", function(){
     $.LoadingOverlaySetup({
                                    background      : "rgba(255, 255, 255, 0.8)",
                                    image           : "img/logo29big.png",
                                    imageAnimation:"",
                                    imageColor      : "#202020", 
                                    hideafter:"5000"
                                });

   /* $.LoadingOverlay("show");
    var nameActa=$(this).data("type");
    var element = document.querySelector('#tableResultados');
    //var element = document.getElementById('element-to-print');
    html2pdf(element, {
      margin:      [-2, 0.2],
      pagesplit: true,
      filename:     nameActa+'.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { dpi: 192, letterRendering: true },
       pagebreak: { mode: ['avoid-all', 'css', 'legacy'] },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    });*/

    /*$.ajax({
                url:'hub/hub.php',
                data: { "funcion": "fnViewResultadosXAgenciaPDF",
                          "agencia_id": $("#cmbAgencia").val()
                    
                },
                type: 'POST',
                
                dataType: "json",
                cache:false,
                async:false
            }).done(function(data){
            });*/
    window.open("admin/print_resultado.php?agencia_id="+$("#cmbAgencias").val());
    
    $.LoadingOverlay("hide");

    
});



/// function para imprimir las actas
$(document).on("click", "#btnPrintActa", "", function(){
    $(this).addClass("d-none");
    $.LoadingOverlaySetup({
                                    background      : "rgba(255, 255, 255, 0.8)",
                                    image           : "img/logo29big.png",
                                    imageAnimation:"",
                                    imageColor      : "#202020", 
                                    hideafter:"5000"
                                });

    $.LoadingOverlay("show");
    var nameActa=$(this).data("type");
    var element = document.querySelector('#divActaPrint');
    //var element = document.getElementById('element-to-print');
    html2pdf(element, {
      margin:      [0.3, 0.2],
      pagesplit: true,
      filename:     nameActa+'.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { dpi: 192, letterRendering: true },
       pagebreak: { mode: ['avoid-all', 'css', 'legacy'] },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    });
    $.LoadingOverlay("hide");

    setTimeout(function(){ $("#btnPrintActa").removeClass("d-none")}, 3000);
    //html2pdf(element);
    
     

    /* var pdf = new jsPDF('p', 'pt', 'a4');
        var options = {
             pagesplit: true,
              margin:      [-1.5, 0.2],
              image:        { type: 'jpeg', quality: 0.98 },
              html2canvas:  { dpi: 192, letterRendering: true },
              jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }

        };

        pdf.addHTML($("#divActaPrint"), options, function()
        {
        pdf.save("test.pdf");
        });*/

     /*$.ajax({
         url: 'hub/hub.php',
        data: { "funcion": "fnViewResultadosXAgencia",
                "agencia_id":agencia_id
            
        },
        type: 'POST',
        
        dataType: "json",
        cache:false
    }).done(function(data){ 

    });*/
        

})

/// fucntion para checquear nulos y blancos
$(document).on("change",".chk", "", function(){ 
  switch($.trim($(this).parent().parent().find("h3").text())){ 
      case "NULO": 
      case "BLANCO":$(".chk").prop( "checked", false );
                    $(this).prop("checked",true);
      break;
      default: $("#divPapeletaVoto").find("h3.candidato").each(function(){
                  switch($.trim($(this).text())){
                    case "NULO": 
                    case "BLANCO": $(this).parent().parent().find(".chk").prop("checked",false);
                    break;
                  }
                  

               });
      break;
    } 
});


//function para mostrar el padrón electoral
function fnViewTables(flag){
    if($("#tableElectores").find("tr").length>2)
        $("#tableElectores").DataTable().destroy();
    $('#tableElectores').DataTable({
        "searching": flag,
        "paging": flag,
        "info": flag,
         "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
       });
        $('[data-toggle="tooltip"]').tooltip();
}

///funcion para recargar el tamaño de la papeleta
function fnViewPapeleta(){
    $(".dashboard-message").not('.candidato').height($(".dashboard-nav").height()*0.55);
    $(".dashboard-list").height($(".dashboard-nav").height()*0.7);
   // fnCalculaHora();
}

function fnCalculaHora(){
    setInterval(function(){
        var array_hora=$("#hHora").text().split(":");
        var segundo=parseInt(array_hora[2]);
        segundo++;
        var minuto=parseInt(array_hora[1]);
        var hora=parseInt(array_hora[0]);
        if(segundo==60){
            segundo=0;
            minuto++;
        }
        if(minuto==60){
            minuto=0;
            hora++;
        }
        if(hora==24)
            hora=0;

        strHora="";
        if(segundo<10)
            segundo="0"+segundo;
        if(minuto<10)
            minuto="0"+minuto;
        if(hora<10)
            hora="0"+hora;
        strHora=hora+":"+minuto+":"+segundo;
        $("#hHora").text(strHora);

    },1000);
        
}

/// function para generar habilitar al votante que se acerque a la mesa
$(document).on("click", ".btnPermiso","", function(){
    var cedula=$(this).parent().parent().find(".tdCedula").text();
    var ep_guid=$(this).parent().parent().attr("id");
    var controlFecha=$(this).parent().parent().find(".tdFechaVoto");
      $.ajax({
                url:'hub/hub.php',
                data: { "funcion": "fnViewGetFechaVoto",
                          "txtCedula": cedula,
                          "el_guid":ep_guid
                    
                },
                type: 'POST',
                
                dataType: "json",
                cache:false,
                async:false
            }).done(function(data){
                $(controlFecha).text(data.fecha);
            });
    
    
    var fecha=$(this).parent().parent().find(".tdFechaVoto").text();
    var date = moment(fecha);


    fnControlaTiempo(localStorage.getItem("id_agencia"));
    if(localStorage.getItem("flag_permiso")=="false"){
        swal(localStorage.getItem("mensaje"), {
                      icon: "error",
                    }); 
        return false;
    }

   if(!date.isValid()){
    swal({
          title: "Estás seguro de habilitar este usuario?",
          text: "Una vez que lo habilites, el usuario estará habilitado por 5 minutos",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            

           
            $.ajax({
                url:'hub/hub.php',
                data: { "funcion": "fnViewHabilitaUsuario",
                          "cedula": cedula,
                          "ep_guid":ep_guid
                    
                },
                type: 'POST',
                
                dataType: "json",
                cache:false
            }).done(function(data){
                if(data.flag==true)
                    swal("El usuario está habilitado!", {
                      icon: "success",
                    });
                else
                    swal("Existe un votante pendiente en la Junta Receptora", {
                      icon: "error",
                    });
            });
           
          } else {
            swal("Se ha cancelado habilitar al usuario!");
          }
        });
    }
    else{
        swal("El usuario ya ha realizado el voto!", {
                      icon: "error",
                    });
    }
})
// function para emitir el certificado
$(document).on("click", ".btnCertificado", "", function(){
    var cedula=$(this).parent().parent().find(".tdCedula").text();
    var ep_guid=$(this).parent().parent().attr("id");

    var controlFecha=$(this).parent().parent().find(".tdFechaVoto");
      $.ajax({
                url:'hub/hub.php',
                data: { "funcion": "fnViewGetFechaVoto",
                          "txtCedula": cedula,
                          "el_guid":ep_guid
                    
                },
                type: 'POST',
                
                dataType: "json",
                cache:false,
                async:false
            }).done(function(data){
                $(controlFecha).text(data.fecha);
            });

    var fecha=$(this).parent().parent().find(".tdFechaVoto").text();
    var date = moment(fecha);
    var votante=$(this).parent().parent().find(".tdVotante").text();
    var cedula=$(this).parent().parent().find(".tdCedula").text();
    var tipo=$(this).data("tipo");
    if(tipo=="P"){
        fecha=moment(moment()).format('YYYY-MM-DD hh:mm:ss');
        fnBuildCertificado(cedula, votante,fecha, tipo);      
    }
    else{
     
   if(date.isValid()){
        fnBuildCertificado(cedula, votante,fecha,tipo);        
    }
    else{
        swal("El usuario aún no ha realizado el voto!", {
                      icon: "error",
                    });
        }
    }
    
})

function fnBuildCertificado(cedula, votante,fecha, tipo){
    $.ajax({
                url:'hub/hub.php',
                data: { "funcion": "fnViewCertificadoHTML",
                          "txtCedula": cedula,
                          "txtnombres": votante,
                          "junta": $("#bJunta").text(), 
                          "txtFecha": fecha,
                          "tipo":tipo
                    
                },
                type: 'POST',
                
                dataType: "html",
                cache:false
            }).done(function(data){
                    const wrapper = document.createElement('div');
                    wrapper.innerHTML = data;

                    swal({
                    title: "Certificado de Votación",
                    content: wrapper,
                    className: "modalspecial",
                    buttons: {
                       
                        cancel : 'Cancelar',
                        print: 'Imprimir'
                    }
                    })
                });
}

///function para consultar el padrón electoral
$(document).on("click", "#btnSearchPadron", "", function(){
     if(fnValidaCampos($("#txtCedula"), "Debe ingresar su número de cédula")==0){
        return 0;
    }
     $("#txtCedula").removeClass("border-error");

       $.ajax({
                url:'hub/hub.php',
                data: { "funcion": "fnViewPadronTabla",
                          "txtCedula": $("#txtCedula").val()
                    
                },
                type: 'POST',
                
                dataType: "html",
                cache:false
            }).done(function(data){
                $("#tableElectores").find("tbody").html(data);
            });
})



/// function para descargar el pdf
$(document).on("click",".swal-button--print","", function(){
   /* var 
    form = $(this).parent().parent().parent()
    cache_width = form.width(),
    a4  =[ 595.28,  841.89];  // for a4 size paper width and height


   $('body').scrollTop(0);
    createPDF(form);*/
    //tab=$(this).parent().parent().parent().parent().attr("id");
    //tab=$("body");
    //getPDF("#divCertificadoPrint","divCertificadoPrint", $("#labelCedulaVotante").text());

    $.LoadingOverlaySetup({
                                    background      : "rgba(255, 255, 255, 0.8)",
                                    image           : "img/logo29big.png",
                                    imageAnimation:"",
                                    imageColor      : "#202020", 
                                    hideafter:"5000"
                                });

    $.LoadingOverlay("show");
    
    var element = document.querySelector('#divCertificadoPrint');
    //var element = document.getElementById('element-to-print');
    html2pdf(element, {
      margin:      [0, 0.2],
      filename:     'certificado.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { dpi: 192, letterRendering: true },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    });
    $.LoadingOverlay("hide");

})



function getPDF(control, tab, cedula){
 
 var HTML_Width = $(control).width();
 var HTML_Height = $(control).height();
 var top_left_margin = 15;
 var PDF_Width = HTML_Width+(top_left_margin*2);
 var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
 var canvas_image_width = HTML_Width*0.6;
 var canvas_image_height = HTML_Height*0.6;
 
 var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
 

 html2canvas($(control)[0],{allowTaint:true}).then(function(canvas) {
 canvas.getContext('2d');
 
 //console.log(canvas.height+"  "+canvas.width);
 
 
 var imgData = canvas.toDataURL("image/jpeg", 1.0);



 var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
     pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
 
 
 for (var i = 1; i <= totalPDFPages; i++) { 
     pdf.addPage(PDF_Width, PDF_Height);
     pdf.addImage(imgData, 'JPG', top_left_margin+150, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
     }
 
     pdf.save("certificado_votacion_"+cedula+".pdf");
     pdf.output('certificado_votacion_'+cedula+'.pdf');
        });
};

//function para saltar a la siguiente página de la eleccion
$(document).on("click", "#btnContinuar", "", function(){
    $("#divInstrucciones").addClass("d-none");
    $("#divPapeleta").removeClass("d-none");

    var eleccion=$(this).data("eleccion");
    var ep_guid=$(this).data("elecpart_guid");
    var cedula=$(this).data("cedula");
     $.ajax({
                url:'hub/hub.php',
                data: { "funcion": "fnBuildCandidatos",
                          "eleccion": eleccion,
                          "ep_guid":ep_guid,
                          "cedula":cedula,
                          "type_return": "html"
                    
                },
                type: 'POST',
                
                dataType: "html",
                cache:false
            }).done(function(data){
                $("#divPapeletaVoto").html(data);
                $("#divPapeletaRepeatInstrucciones").html($("#divLblInstrucciones").html())
            });
})


// function para volver a la primera pantalla de votación
$(document).on("click","#btnVolver", "", function(){
    $("#divInstrucciones").removeClass("d-none");
    $("#divPapeleta").addClass("d-none");
})

/// function para registrar el voto
$(document).on("click", "#btnVotar", "", function(){
    if($(".chk:checked").length==0){
        alertas("Debe elegir al menos un candidato", "error");
        return 0;
    }
    var cedula=$(this).data("cedula");
    var eleccion=$(this).data("eleccion");
    var ep_guid=$(this).data("elecpart_guid");

    var flagValidaConf=true;
    var flagNuloBlanco=false
    $(".chk:checked").each(function(){
        switch($.trim($(this).parent().parent().find("h3").text())){ 
          case "NULO": 
          case "BLANCO": flagNuloBlanco=true;
          break;
        }
    });
    

    if(flagNuloBlanco==false){
        $.ajax({
            url:'hub/hub.php',
            data: { "funcion": "fnCheckConfiguration",
                      "eleccion_guid": eleccion
                      
                
            },
            type: 'POST',
            
            dataType: "json",
            cache:false,
            async:false,
        }).done(function(data){
            intCantidadChecks=$(".chk").filter(':checked').length;
            
             if(data.minimo==data.maximo && (intCantidadChecks<data.minimo || intCantidadChecks>data.maximo)){
                var textoOpcion="";
                if(data.maximo==1)
                   textoOpcion="opción";
                 else
                    textoOpcion="opciones";

                alertas("Debe escoger "+data.maximo+" "+textoOpcion,"error");
                flagValidaConf=false;
             }
             else{

               if(intCantidadChecks<data.minimo || intCantidadChecks>data.maximo){
                  alertas("Debe escoger mínimo "+data.minimo+" y máximo "+data.maximo+" opciones", "error");
                  flagValidaConf=false;

                }
              }
        })

        if(flagValidaConf==false)
            return false;
    }


    var intVotos=0;
    $(".chk:checked").each(function(){
        var opcion=$(this).val();
        $.ajax({
                url:'hub/hub.php',
                data: { "funcion": "fnSetVoto",
                          "eleccion": eleccion,
                          "ep_guid":ep_guid,
                          "cedula":cedula,
                          "opcion":opcion
                    
                },
                type: 'POST',
                
                dataType: "json",
                cache:false,
                async:false,
            }).done(function(data){
                if(data.flag==true)
                    intVotos++;
            })

    });
    
    if(intVotos==$(".chk:checked").length){
        alertas("Su voto ha sido procesado", "success");
        fnCallFunction("fnViewPapeleta","Voto Electrónico");
    }
    else{
        alertas("No ha sido procesado el voto", "error");
    }

})