$(document).ready(function(){
	  $.ajax({
        url: 'hub/hub.php',
        data: { "funcion": "fnConfirmaAsistencia",
        		"id_quorum": $.urlParam('ID')
    		  },
           type: 'POST',
        dataType: 'json',
        cache:false        
    }).done(function(data){
    })
})

    $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}