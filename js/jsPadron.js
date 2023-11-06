$(document).ready(function(){
    fnGetEmpresa(); 
    fnGeneraCaptcha();
});

///function para generar el captchas de robot
function fnGeneraCaptcha(){
    var canvas = document.getElementById("myCanvas");
    var ctx = canvas.getContext("2d");
    ctx.font = "30px Arial";
    ctx.fillStyle="#861031";
    var a=Math.floor(Math.random()*100);
    var b=Math.floor(Math.random()*100);

    localStorage.setItem("captcha",a+b );
    
    ctx.fillText(a+"+"+b+"=?",40,50);
}


//function para limpiar el Canvas
function fnClearCanvas(){
    canvas = document.getElementById("myCanvas");
    ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

//function para consultar en el padrón electoral
$(document).on("click","#btnConsultar", "", function(){
    switch($(this).text()){
        case "Consultar":    if(fnValidaCampos($("#txtCedula"), "Debe ingresar su número de cédula")==0){
                                return 0;
                            }
                            if(fnValidaCampos($("#txtcaptcha"), "Debe ingresar el resultado de la suma")==0){
                                return 0;
                            }
                            if(localStorage.getItem("captcha")!=$("#txtcaptcha").val()){
                                alertas("El valor ingresado no es igual al valor de la imagen", "error");
                                return 0;
                            }
                            $("#divZonaCaptcha").addClass("d-none");
                            $("#btnConsultar").text("Volver a Consultar");
                            fnClearCanvas();
                            fnConsultaPadron();
                           
        break;
        case "Volver a Consultar":
            $("#divZonaCaptcha").removeClass("d-none");
            $("#txtcaptcha").val('');
            $("#txtCedula").val('');
            $(this).text("Consultar");
            if(!$("#divConsultaPadron").hasClass("d-none"))
                $("#divConsultaPadron").addClass("d-none");
            if(!$("#divConsultaNegativo").hasClass("d-none"))
                $("#divConsultaNegativo").addClass("d-none");
            fnClearCanvas();
        break;
    }   
   
    fnGeneraCaptcha();
    
   
    
})

//function para consultar el padrón
function fnConsultaPadron(){
    $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnViewPadron",
        		"txtCedula":$("#txtCedula").val()
    		  },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
        if(data.flag==true){
        $("#lblNombre").text(data.lblNombre);
        $("#lblEmpresa").text(data.lblEmpresa);
        $("#lblFecha").text(data.lblFecha);
        $("#lblHoraInicio").text(data.lblHoraInicio);
        $("#lblHoraFin").text(data.lblHoraFin);
        $("#lblRecinto").text(data.lblRecinto);
        $("#divConsultaPadron").removeClass("d-none");
        }
        else{
            $("#divConsultaNegativo").removeClass("d-none");
        }
    })
}