$( document).ready(function(){
    jQuery.fx.speeds.liHides = 1000;
    jQuery.fx.speeds.aAppear = 200;
    jQuery.fx.speeds.dDisappear = 600;
    var $li = $("li");
    for(let i=0;i<$li.length;i++){
        $($li[i]).click(function(){     
            $($li[i]).hide("liHides");
        });
    }

    $("#A").click(function(){ 
        for(let i=0;i<$li.length;i++){           
            $($li[i]).show("aAppear");
        }
    });

    $("#D").click(function(){
        for(let i=0;i<$li.length;i++){
             $($li[i]).hide("dDisappear");
        }
    });
});