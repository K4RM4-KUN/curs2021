let $buttonP = $("#P");
let $buttonNP = $("#NP");
let activeP = false;
let activeNP = false;

$buttonP.click(function(){
    if(activeP){
        $("tr:even").css("background-color","white");
        activeP = false;
    } else {
        $("tr:even").css("background-color","lightblue");
        activeP = true;
    }
});

$buttonNP.click(function(){
    if(activeNP){
        $("tr:odd").css("background-color","white");
        activeNP = false;
    } else {
        $("tr:odd").css("background-color","lightgreen");
        activeNP = true;
    }
});