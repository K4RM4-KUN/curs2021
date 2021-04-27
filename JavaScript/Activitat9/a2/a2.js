let $links = $("a");

$links.hover(function(){
    $(this).css("background-color","lightgreen");
},function(){
    $(this).css("background-color","white");
});