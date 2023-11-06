// function para la carga de la pagina
$(document).ready(function(){
$("#page_scroller").addClass("bg");
fnGetAgencia(); 
 fnGetCSS();
 
        
             
$('.demo').each( function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
          control: $(this).attr('data-control') || 'hue',
          defaultValue: $(this).attr('data-defaultValue') || '',
          format: $(this).attr('data-format') || 'hex',
          keywords: $(this).attr('data-keywords') || '',
          inline: $(this).attr('data-inline') === 'true',
          letterCase: $(this).attr('data-letterCase') || 'lowercase',
          opacity: $(this).attr('data-opacity'),
          position: $(this).attr('data-position') || 'bottom',
          swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
          change: function(value, opacity) {
            if( !value ) return;
            if( opacity ) value += ', ' + opacity;
            if( typeof console === 'object' ) {
              //console.log(value);
            }
          },
          theme: 'bootstrap'
        });

      });

      
  
})

//function para validar la información de la entidad/agencia
$(document).on("click", "#btnSaveAdminEntidad", "", function(){
     //alto=$(window).height()/2+20;
    if(fnValidaCampos($("#txtEntidad"), "Debe ingresar el nombre de la Entidad")==0){
        return 0;
    }
     $("#txtEntidad").removeClass("border-error");
    if(fnValidaCampos($("#txtDireccion"), "Debe ingresar la Dirección")==0){
        return 0;
    }
    $("#txtDireccion").removeClass("border-error");
    if(fnValidaCampos($("#txtTelefono"), "Debe ingresar el Teléfono")==0){
        return 0;
    }
    $("#txtTelefono").removeClass("border-error");
    
    if(fnValidaCampos($("#txtCorreo"), "Debe ingresar el Correo Electrónico")==0){
        return 0;
    }
    $("#txtCorreo").removeClass("border-error");
    
    if(fnValidaCampos($("#txtRuc"), "Debe ingresar el RUC")==0){
        return 0;
    }
    $("#txtRuc").removeClass("border-error");
    
    if($("input[type=file].fileLogo")[0].files[0]!==undefined)
        if(fnUploadLogo()==0){
            return 0;
        }
   
    if(fnValidaCampos($("#txtColorButton"), "Debe ingresar el color de fondo de los botones")==0){
        return 0;
    }
    
    $("#txtColorButton").removeClass("border-error");
    
    if(fnValidaCampos($("#txtTextColorButton"), "Debe ingresar el color del texto de los Botones")==0){
        return 0;
    }
    $("#txtTextColorButton").removeClass("border-error");
    
    if(fnValidaCampos($("#txtColorLabel"), "Debe ingresar el color de las Etiquetas")==0){
        return 0;
    }
    $("#txtColorLabel").removeClass("border-error");
    
    if(fnValidaCampos($("#txtColorMenu"), "Debe ingresar del texto de los menus")==0){
        return 0;
    }
    $("#txtColorMenu").removeClass("border-error");
    var array_css=[];
    $(".demo").each(function(){
        array_css.push({"css":$(this).data("css"),
                    "attribute":$(this).data("attribute"),
                    "extracss":$(this).data("extracss"),
                    "valor":$(this).val(),
                    "extraatribute":$(this).data("extraatribute")
                });
    })
    //console.dir(array_css);
     var data = new FormData();
     var array_archivos=[];
     if($("input[type=file].fileLogo")[0].files[0]!==undefined){
    
    
   
            data.append('file[]',  $("input[type=file].fileLogo")[0].files[0]);
             array_archivos.push({ 
                 
                                   "name_file":$("input[type=file].fileLogo")[0].files[0].name
                                });
                           
                            data.append("tipofile", "fisico"); 
    }
    else{
        data.append('file',$("#imgPreview").attr("src"));
        data.append("tipofile","base64");
    }
    //console.dir(array_archivos);
    var estado='';
    if($("#chkEstado:checked").length)
        estado="A";
    else
        estado="I";
    data.append("funcion", "fnSaveEntidad");
    data.append("array_css", JSON.stringify(array_css));
    data.append("agencia_id","");
    data.append("agencia_descripcion",$("#txtEntidad").val());
    data.append("agencia_direccion",$("#txtDireccion").val()); 
    data.append("agencia_telefono",$("#txtTelefono").val());
    data.append("agencia_correo", $("#txtCorreo").val());
    data.append("agencia_identificacion",$("#txtRuc").val()); 
    data.append("agencia_logo",""); 
    data.append("agencia_info_adicional",""); 
    data.append("agencia_css","");
    data.append("agencia_estado",estado);
    
    data.append("array_archivos",  JSON.stringify(array_archivos));
    /*console.log(data.agencia_descripcion);
    console.log(data.get("agencia_descripcion"));*/

      $.ajax({ 
            url: 'hub/fileupload.php',  
            type: 'POST', 
            data: data,
           
          contentType: false, 
          processData: false, 
          dataType: 'json',
          }).done(function(data){
              if(data.ESTADO==1){
                alertas(data.MENSAJE.split(",")[0], "success");
                setTimeout(function(){location.reload();},4000);
           }
           else{
                alertas(data.MENSAJE.split(",")[0], "error");
           }  
          });
     /*
     $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnSaveEntidad",
                "array_css":array_css,
                "agencia_id":"",
                "agencia_descripcion":$("#txtEntidad").val(), 
                "agencia_direccion":$("#txtDireccion").val(), 
                "agencia_telefono":$("#txtTelefono").val(), 
		"agencia_correo":$("#txtCorreo").val(), 
                "agencia_identificacion":$("#txtRuc").val(), 
                "agencia_logo":"", 
                "agencia_info_adicional":"", 
                "agencia_css":"",
                "agencia_estado":$("#chkEstado:checked").length
              },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
        if(data.flag==1){
              ohSnap(data.mensaje, {color: 'green'});
        }
        setTimeout(function(){location.reload();},4000);
    });*/
})


///function para leer archivo css
function fnGetCSS(){
    $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnGetCSS"
              },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
        console.dir(data);
        for(i=0;i<data.length;i++){
            $(".demo[data-css='"+data[i]["css"]+"'][data-attribute='"+data[i]["atributo"]+"']").minicolors("value",data[i]["valor"]);
           
        }
    });
    }
    
/// function para subir el logo
function fnUploadLogo(){
    $("input[type=file].fileLogo").each(function(){
        size=$(this)[0].files[0].size/1024/1024;
        if(size>1){
            alertas("La imagen no puede ser mayor a 1MB", "error");
            $(this).val(null);
            return 0;
        }
        var ext=$(this)[0].files[0].name.split(".")[1];
        switch(ext){
            case "png":
            case "jpg":
            break;
            default:     alertas("Solo se puede subir imágenes png y jpg", "error");
                        return 0;
            break;
        }
        
});
}

$("input[type=file].fileLogo").on("change", function(){  previewFile(); });


function previewFile(){
        var file = $("input[type=file].fileLogo").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#imgPreview").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }



