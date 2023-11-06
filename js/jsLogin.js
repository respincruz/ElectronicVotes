/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var intPeticiones=0;
$(document).ready(function(){
   fnGetEmpresa(); 
   fnGetPerfil();
   console.log(localStorage.getItem("localPerfil"));
   switch(localStorage.getItem("localPerfil")){
       case "mesa":    fnBlockDebuggersDevs();
                       //fnPantallaCompleta();
                       setTimeout(fnPantallaCompleta(),3000);
       break;
       default:
       break;
   }

   var url=window.location.href.split("/");
    var path=url[url.length-1];
    console.log(localStorage.getItem("localPerfil"));
    if(path=="login.php"  && localStorage.getItem("localPerfil")==null){
        alertas("Debe seleccionar el Tipo de Cuenta","error");
        setTimeout(function(){
         document.location.href="index.php";

        },5000);
       
    }
   
    

});

///boton volver
$(document).on("click", "#btnVolver", "", function(){
    document.location.href="index.php";
})

$(document).mousemove(function(event){
    console.log(intPeticiones);
    if(intPeticiones==0){
    var url=$(location).attr('href').split("/");

    var intElementos=url.length;
   
    if(url[intElementos-1]!="" || url[intElementos-1]!="index.php")
        switch(localStorage.getItem("localPerfil")){
            case "mesa":    //fnBlockDebuggersDevs();
                        fnPantallaCompleta();
        }
    intPeticiones++;
    }
    
    
})
/// function para bloquear clic derecho y devtools
function fnBlockDebuggersDevs(){
    $(document).keydown(function(event){
        if(event.keyCode==123){
            return false;
        }
        else if (event.ctrlKey && event.shiftKey && event.keyCode==73){        
                 return false;
        }
    });
    
    $(document).on("contextmenu",function(e){        
       e.preventDefault();
    });
}

///function para mostrar pantalla completa
function fnPantallaCompleta(){  
        var docElm = document.documentElement;  
        //W3C   
        if (docElm.requestFullscreen) {  
            docElm.requestFullscreen();  
        }  
            //FireFox   
        else if (docElm.mozRequestFullScreen) {  
            docElm.mozRequestFullScreen();  
        }  
                         // Chrome, etc.   
        else if (docElm.webkitRequestFullScreen) {  
            docElm.webkitRequestFullScreen();  
        }  
            //IE11   
        else if (elem.msRequestFullscreen) {  
            elem.msRequestFullscreen();  
        }  
    }  

//function para mostrar los perfiles
function fnGetPerfil(){
    $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnViewPerfil"
    
            },
        type: 'POST',
        dataType: 'html',
        cache:false        
    }).done(function(data){
        $("#cmbPerfil").html(data);
        $('.selectpicker').selectpicker();
        $('#cmbPerfil').selectpicker('refresh');
        //fnRefreshCombos("cmbPerfil");
    })
}

$(document).on("click", "#btnLogin", "", function(){
    //alto=$(window).height()/2+20;
    //fnPantallaCompleta();
    if(fnValidaCampos($("#txtCedula"), "Debe ingresar su número de cédula")==0){
        return 0;
    }
     $("#txtCedula").removeClass("border-error");
    if(fnValidaCampos($("#txtPassword"), "Debe ingresar su contraseña")==0){
        return 0;
    }
    $("#txtPassword").removeClass("border-error");
  
    
    
    $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnVerificaUsuario",
        		"txtUsuario":$("#txtCedula").val(),
        		"txtPassword":$("#txtPassword").val(),
                "hCodAgencia": $("#hCodAgencia").val()
    		  },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
        
        if(data.type=="success"){  
            alertas(data.mensaje,data.type);
            localStorage.setItem("perfil", data.perfil_nombrecorto);
            localStorage.setItem("id_agencia", data.agencia)
            fnLog($("#txtCedula").val(),"1ee24650-785a-11ec-986f-0050560ac19d", "LOGIN", "LOGIN");
          setTimeout(function(){
              
            document.location.href="dashboard.php";
        },5000);
            
        }
        else
            alertas(data.mensaje, data.type);
    });
    
});

function fnLog(txtCedula,disp_guid, origen, accion){
     $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnViewLog",
                "txtCedula":txtCedula,
                "disp_guid":disp_guid,
                "origen": origen,
                "accion":accion
              },
           type: 'POST',
        dataType: 'json',
        cache:false,
        async:false        
    }).done(function(data){

    })
    
}

// boton de seleccion de tipo de perfil
$(document).on("click", "#btnGo", "", function(){
    if($("#cmbPerfil").val()=="*"){
        alertas("Debe seleccionar un perfil","error");
        return false;
    }
    localStorage.setItem("localPerfil", $("#cmbPerfil > option:selected").data("nombrecorto"));
    document.location.href="login.php";
})

