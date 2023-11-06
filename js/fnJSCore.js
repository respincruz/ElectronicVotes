/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function fnValidaCampos(campo, mensaje){
    if($.trim($(campo).val()).length==0){
        alertas(mensaje, 'error');
        
        $(campo).focus();
        $(campo).addClass("border-error");
        return 0;
    }
    else return 1;
}

/// function para mostrar los mensajes de error
function alertas(texto, type) {
     default_layout="centerRight";
    // alert($.browser);
  

    
     
        var n = noty({
            text        : texto,
            type        : type,
           /* dismissQueue: true,
            closeWith   : ['click', 'backdrop*/
            modal       : true,
            layout      : default_layout,
            theme       : 'defaultTheme',
            maxVisible  : 10,
            animation: {
                open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
                close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
                easing: 'swing',
                speed: 500 // opening & closing animation speed
            },
            timeout: 2000, // delay for closing event. Set false for sticky notifications
        });
       
    }
 $(document).on("keypress", ".solonumero", "", function(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    });  


// funcion para obtener informacion de la agencia
function fnGetEmpresa(){
      $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnGetEmpresa"
              },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
       // console.dir(data);
        $("#logo, .logo").attr("src",data[0].empresa_logo);
        
        $("title").text("::"+data[0].empresa_descripcion+" - Junta de Socios::");
        $("#hCodAgencia").val(data[0].empresa_guid)
        $("#txtEntidad").val(data[0].empresa_descripcion);
        $("#txtDireccion").val(data[0].empresa_direccion);
        
        $("#lblAgencia").text(data[0].empresa_descripcion);
        switch(data[0].empresa_estado){
            case "I": $("#chkEstado").prop("checked",false);
            break;
            case "A": $("#chkEstado").prop("checked",true);
            break;
        }
        localStorage.setItem("hCodAgencia",data[0].empresa_guid);
    });
}

function fnRefreshCombos(control){
    $(".chosen-select").chosen({width: '100%'});
    $("select").trigger("chosen:updated");
  }


function ChangeTabsConf(){
      var actual=$("#tabConf").find(".active").attr("id");
            var siguiente=$("#tabConf").find(".active").next().attr("id");
            $("#"+actual).removeClass("active").addClass("fade");
            $("#"+siguiente).addClass("active").removeClass("fade");
            
            var actuallink=$(".nav-link[href='#"+actual+"']").attr("id");
            var siguientelink=$(".nav-link[href='#"+siguiente+"']").attr("id");
            
            $("#"+actuallink).removeClass("active");
            $("#"+siguientelink).addClass("active");
}




/// funciton para obtener el archivo actual
function filename(){
    var rutaAbsoluta = self.location.href;   
    var posicionUltimaBarra = rutaAbsoluta.lastIndexOf("/");
    var rutaRelativa = rutaAbsoluta.substring( posicionUltimaBarra + "/".length , rutaAbsoluta.length );
    return rutaRelativa;  
}


