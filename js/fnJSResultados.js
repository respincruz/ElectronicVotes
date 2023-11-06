$(document).ready(function(){
   fnViewComboAsambleas(); 
     

           
      
});

// function para cargar las asambleas
function fnViewComboAsambleas(){
	$.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnViewCombosAsambleas"
    		  },
           type: 'POST',
        dataType: 'html',
        cache:false        
    }).done(function(data){
    $("#cmbAsamblea").html(data);
    $('.selectpicker').selectpicker();
    $('.selectpicker').selectpicker('refresh');
    });
}

/// function para mostrar las votaciones asociadas con las asambleas
$(document).on("change", "#cmbAsamblea", "", function(){
	$(".display").removeClass("hidden");
		$.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnViewCombosReferendums",
        		"cod_asamblea":$("#cmbAsamblea").val()
    		  },
           type: 'POST',
        dataType: 'html',
        cache:false        
    }).done(function(data){
    	$("#cmbVotaciones").html(data);
    	$('.selectpicker').selectpicker();
    	$('.selectpicker').selectpicker('refresh');
    });
})

/// function para obtener los resultados de las encuestas
$(document).on("click",  "#btnViewResultados","", function(){
	if($("#cmbAsamblea").val()=="*"){
		alertas("Debe seleccionar una asamblea", "error");
		return 0;
	}
	if($("#cmbVotaciones").val()=="*"){
		alertas("Debe seleccionar una Votación", "error");
		return 0;
	}

	$.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnViewPreguntasResultados",
        		"cod_asamblea":$("#cmbAsamblea").val(),
        		"cod_votacion":$("#cmbVotaciones").val()
    		  },
           type: 'POST',
        dataType: 'html',
        cache:false        
    }).done(function(data){
    	//console.log(data);
    	$("#divResultados > .card").html(data);
    })
})

/// function para mostrar resultados
$(document).on("click", ".card-header", "", function(){
	var pregunta=$(this).find("a").attr("href").substr(1);
	$.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnGetResultados",
        		"cod_asamblea":$("#cmbAsamblea").val(),
        		"cod_votacion":$("#cmbVotaciones").val(),
        		"pregunta":pregunta
    		  },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
    	total=0;
    	for(i=0;i<data.length;i++){
    		total+=data[i].total;
    	}
    	
    	for(i=0;i<data.length;i++){
    		var porcentaje=data[i].total*100/total;
    		$("#"+data[i].pregunta).find(".progress-bar[data-opcion="+data[i].opcion+"]").attr("style","width:"+porcentaje+"%");
    		$("#"+data[i].pregunta).find(".progress-bar[data-opcion="+data[i].opcion+"]").attr("aria-valuenow",porcentaje);
    		$("#"+data[i].pregunta).find("p[data-opcion="+data[i].opcion+"]").text(data[i].descripcion+" ("+data[i].total+") Votos");
    	}
    })
/*
	  $json_resultado=json_decode($this->fnGetResultados($cod_asamblea, $cod_votacion, $json[$i]->campo_dato_formulario_id));
                                  $json_respuesta=json_decode($json_resultado[0]);
                                  print_r($json_respuesta);
                                  //echo $json_respuesta[0]->id_pregunta."<br>";

                                  $respuesta=$json_respuesta[0]->respuesta[0];
                                  //echo count($json_respuesta[0]->respuesta);
                                 // print_r($respuesta->opcion);
                                  //$json_respuestas=json_decode($json_resultado);
                                  //echo $json_resultado[0]["id_pregunta"]."<br>";
                                  //echo $json_respuestas[0]->respuesta."<br>";
                                  //"respuesta":[{"opcion":"1","descripcion":"SI"}]

                                   /*for($k=0;$k<count($json_respuesta);$k++){
                                        echo 
                                   }*/
})