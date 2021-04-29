$('document').ready(function(){

    $('#typeNobels').hide();
    $('#typeOthers').hide();
    
    $('#visualNovel').click(function(){
        if ($('#visualNovel').is(':checked')){
            $('#typeNobels').show(700);
        }else{
            $('#typeNobels').hide(700);
        }
    })

    $("input").click(function() {  
        if($("#other").is(':checked')) {  
            $('#typeOthers').show(500);
        } else {  
            $('#typeOthers').hide(500);
        }  
    });  
});