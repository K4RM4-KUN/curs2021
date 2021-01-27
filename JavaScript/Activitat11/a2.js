$( document).ready(function(){
    var $td = $("td");
    for(let i=0;i<$td.length;i++){
        $($td[i]).click(function(){
            $($td[i]).children().hide(1000).delay(2000).show(1000);
        });
    }
});