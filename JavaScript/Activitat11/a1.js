$( document).ready(function(){
    var hide = 0;
    var fade = 0;
    var slide = 0;
    $("#hide").click(function(){
        if(hide == 0){
            $("#hide").children().hide(1000);
            hide = 1;
        } else {
            $("#hide").children().show(1000);
            hide = 0;
        }
    });
    
    $("#fade").click(function(){
        if(fade == 0){
            $("#fade").children().fadeIn(1000);
            fade = 1;
        } else {
            $("#fade").children().fadeOut(1000);
            fade = 0;
        }
    });
    
    $("#slide").click(function(){
        if(slide == 0){
            $("#slide").children().slideDown(1000);
            slide = 1;
        } else {
            $("#slide").children().slideUp(1000);
            slide = 0;
        }
    });
    
    $("#toggle").click(function(){
        $("#toggle").children().toggle(1000);
    });

});