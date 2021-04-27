$( document).ready(function(){
    $("#button").click(function(){
        if($("#locos").val() == ""){
            $("#animate").effect("shake",1000,pulsateEffect);
        }
    });
    function pulsateEffect(){
        $("#animate").effect("pulsate",1000,highlightEffect);
    }
    function highlightEffect(){
        $("#animate").effect("highlight",1000);
    }
});